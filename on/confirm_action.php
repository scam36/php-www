<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}


$result = api::send('user/add', array('user'=>$_POST['username'], 'ip'=>$_SERVER['HTTP_X_REAL_IP'], 'pass'=>$_POST['password'], 'email'=>$_POST['email'], 'firstname'=>'', 'lastname'=>'', 'language'=>translator::getLanguage()), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$uid = $result['id'];

if( !is_numeric($uid) || $uid <= 0 )
	throw new SiteException("User creation failed", 500, "Generated uid : {$uid}");

// REGISTRATION IS OK -> DELETE REGISTRATION
api::send('registration/delete', array('code'=>$_POST['code']), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

// INSERT THE USER IN THE USERS GROUP
api::send('group/user/add', array('user'=>$uid, 'group'=>'USERS'), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

// CREATE THE FIRST TOKEN WITH BASIC ACCESS
$result = api::send('token/insert', array('user'=>$uid, 'lease'=>0, 'name'=>'Olympe', 'grants'=>'ACCESS,SELF_SELECT,SELF_UPDATE,SELF_DELETE,SELF_GRANT_SELECT,SELF_GROUP_SELECT,SELF_GROUP_DELETE,SELF_TOKEN_INSERT,SELF_TOKEN_SELECT,SELF_TOKEN_UPDATE,SELF_TOKEN_DELETE,SELF_QUOTA_SELECT,SELF_TOKEN_GRANT_DELETE,SELF_TOKEN_GRANT_INSERT,SELF_SITE_SELECT,SELF_SITE_DELETE,SELF_SITE_INSERT,SELF_SITE_UPDATE,SELF_DOMAIN_INSERT,SELF_DOMAIN_SELECT,SELF_DOMAIN_DELETE,SELF_DOMAIN_UPDATE,SELF_DATABASE_INSERT,SELF_DATABASE_UPDATE,SELF_DATABASE_DELETE,SELF_DATABASE_SELECT,SELF_SUBDOMAIN_SELECT,SELF_SUBDOMAIN_UPDATE,SELF_SUBDOMAIN_INSERT,SELF_SUBDOMAIN_DELETE,SELF_ACCOUNT_DELETE,SELF_ACCOUNT_INSERT,SELF_ACCOUNT_SELECT,SELF_ACCOUNT_UPDATE,SELF_APP_INSERT,SELF_APP_DELETE,SELF_APP_UPDATE,SELF_APP_SELECT'), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$token = $result['token'];

// ADD USER QUOTAS
api::send('quota/user/add', array('user'=>$uid, 'quotas'=>'SITES,DATABASES,DOMAINS,BYTES,MAILS'), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
api::send('quota/user/update', array('user'=>$uid, 'quota'=>'SITES', 'max'=>1), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
api::send('quota/user/update', array('user'=>$uid, 'quota'=>'DATABASES', 'max'=>3), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
api::send('quota/user/update', array('user'=>$uid, 'quota'=>'DOMAINS', 'max'=>3), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
api::send('quota/user/update', array('user'=>$uid, 'quota'=>'BYTES', 'max'=>200), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
api::send('quota/user/update', array('user'=>$uid, 'quota'=>'MAILS', 'max'=>100), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

$email = str_replace(array('{EMAIL}', '{USER}', '{PASS}'), array($_POST['email'], $_POST['username'], $_POST['password']), $lang['content']);
$result = mail($_POST['email'], $lang['subject'], str_replace('{CONTENT}', $email, $GLOBALS['CONFIG']['MAIL_TEMPLATE']), "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Olympe <no-reply@olympe.in>\r\nBcc: contact@olympe.in\r\n");

$_SESSION['MESSAGE']['TYPE'] = 'success';
$_SESSION['MESSAGE']['TEXT']= $lang['success'];

template::redirect('/');


/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>