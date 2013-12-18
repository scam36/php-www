<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( isset($_GET['token']) && preg_match("/^[a-f0-9]{32}$/i", $_GET['token']) && isset($_GET['user']) )
{
	$auth = $_GET['user'].':'.$_GET['token'];
	$security->directLogin($auth);
}

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	template::redirect('/panel');

?>