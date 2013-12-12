<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( $_POST['pass'] == $_POST['confirm'] )
{
	api::send('self/app/update', array('app'=>$_POST['id'], 'pass' => $_POST['pass']));
	$_SESSION['MESSAGE']['TYPE'] = 'success';
	$_SESSION['MESSAGE']['TEXT']= $lang['success'];
}
else
{
	$_SESSION['MESSAGE']['TYPE'] = 'error';
	$_SESSION['MESSAGE']['TEXT']= $lang['error'];
}
	
if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel/app/show?id=' . $_POST['id']);

?>