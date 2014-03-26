<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

api::send('self/site/add', array('site'=>$_POST['subdomain'], 'pass'=>$_POST['password']));

unset($_SESSION['subdomain']);

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel');

?>
