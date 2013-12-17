<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

try
{
	$result = api::send('user/add', array('user'=>$_POST['username'], 'pass'=>$_POST['password'], 'email'=>$_POST['email'], 'ip'=>$_SERVER['HTTP_X_REAL_IP'], 'firstname'=>'', 'lastname'=>'', 'language'=>translator::getLanguage()), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
	$uid = $result['id'];
	
	api::send('group/user/add', array('user'=>$uid, 'group'=>'USERS'), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

	$result = api::send('token/insert', array('user'=>$uid, 'lease'=>0, 'name'=>'Bus IT', 'grants'=>'ACCESS,SELF_ACCESS,CONNECTOR_SELECT,SELF_LINK_INSERT,SELF_LINK_UPDATE,SELF_LINK_SELECT,SELF_LINK_DELETE,SELF_BILL_INSERT,SELF_BILL_UPDATE,SELF_BILL_DELETE,SELF_BILL_SELECT,SELF_GRANT_TOKEN_DELETE,SELF_GRANT_TOKEN_INSERT,SELF_GRANT_TOKEN_SELECT,SELF_GRANT_USER_SELECT,SELF_GROUP_USER_DELETE,SELF_GROUP_USER_SELECT,SELF_IDENTITY_DELETE,SELF_IDENTITY_INSERT,SELF_IDENTITY_SELECT,SELF_IDENTITY_UPDATE,SELF_INSTANCE_DELETE,SELF_INSTANCE_INSERT,SELF_INSTANCE_SELECT,SELF_INSTANCE_UPDATE,SELF_QUOTA_USER_SELECT,SELF_TOKEN_DELETE,SELF_TOKEN_INSERT,SELF_TOKEN_SELECT,SELF_TOKEN_UPDATE,SELF_USER_DELETE,SELF_USER_SELECT,SELF_USER_UPDATE,SELF_GRANT_TOKEN_DELETE,SELF_GRANT_TOKEN_INSERT,SELF_GRANT_TOKEN_SELECT,SELF_GROUP_USER_DELETE,SELF_GROUP_USER_SELECT,SELF_QUOTA_USER_SELECT,SELF_TOKEN_DELETE,SELF_TOKEN_INSERT,SELF_TOKEN_SELECT,SELF_TOKEN_UPDATE,SELF_USER_DELETE,SELF_USER_SELECT,SELF_USER_UPDATE,SELF_SPACE_SELECT,SELF_SPACE_UPDATE,SELF_SPACE_DELETE,SELF_SPACE_INSERT'), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
	$token = $result['value'];
	
	api::send('quota/user/add', array('user'=>$uid, 'quotas'=>'CREDITS'), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
	
	$email = str_replace(array('{EMAIL}', '{USER}', '{PASS}'), array($_POST['email'], $_POST['username'], $_POST['password']), $lang['content']);
	$result = mail($_POST['email'], $lang['subject'], str_replace('{CONTENT}', $email, $GLOBALS['CONFIG']['MAIL_TEMPLATE']), "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Bus IT <no-reply@bus-it.com>\r\Bcc: contact@bus-it.com\r\n");

	api::send('confirm/delete', array('id'=>$_POST['id']), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
	
	$_SESSION['MESSAGE']['TYPE'] = 'success';
	$_SESSION['MESSAGE']['TEXT']= $lang['success'];
	
	template::redirect('/');
}
catch(Exception $e)
{
	$_SESSION['REGISTER']['STATUS'] = true;
	$_SESSION['REGISTER']['ID'] = security::encode($_POST['id']);
	$_SESSION['REGISTER']['EMAIL'] = security::encode($_POST['email']);
	
	$template->redirect($_SERVER['HTTP_REFERER'] . (strstr($_SERVER['HTTP_REFERER'], 'eregister')===false?"?eregister":""));
}

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>