<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

api::send('self/database/add', array('type'=>$_POST['type'], 'desc'=>$_POST['desc'], 'pass'=>$_POST['password']));

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel/database');

?>
