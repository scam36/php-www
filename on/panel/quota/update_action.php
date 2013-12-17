<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( $_POST['activate'] != 'yes' )
	$_POST['limit'] = 0;
elseif( $_POST['limit'] < 50 )
	$_POST['limit'] = 50;
	
$userinfo = api::send('self/whoami');
$userinfo = $userinfo[0];

api::send('quota/user/update', array('user'=>$userinfo['id'], 'quota'=>'POSTPAID', 'max'=>$_POST['limit']), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

$_SESSION['MESSAGE']['TYPE'] = 'success';
$_SESSION['MESSAGE']['TEXT']= $lang['success'];	

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	template::redirect('/panel/quota');

?>