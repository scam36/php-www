<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$connector = api::send('busit/connector/list', array('id'=>$_POST['connector']), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$connector = $connector[0];

$user = api::send('system/user/select', array('id'=>$connector['connector_user']), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$user = $user[0];

$email = str_replace(array('{CONNECTOR}', '{DESCRIPTION}', '{CONTENT}'), array($connector['connector_name'], $_POST['title'], $_POST['content']), $lang['content']);

mail('contact@bus-it.com', $lang['subject'], str_replace('{CONTENT}', $email, $GLOBALS['CONFIG']['MAIL_TEMPLATE']), "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Bus IT <no-reply@bus-it.com>\r\n");

$_SESSION['MESSAGE']['TYPE'] = 'success';
$_SESSION['MESSAGE']['TEXT']= $lang['success'];

template::redirect('/store/connector?id=' . security::encode($_POST['connector']));

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>