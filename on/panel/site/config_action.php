<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$params = array('site'=>$_POST['id']);

if( $_POST['passowrd'] )
	$params['password'] = $_POST['password'];
if( $_POST['description'] )
	$params['description'] = $_POST['description'];
if( $_POST['category'] )
	$params['category'] = $_POST['category'];
	
api::send('self/site/update', $params);

$_SESSION['MESSAGE']['TYPE'] = 'success';
$_SESSION['MESSAGE']['TEXT']= $lang['success'];	

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel/site/config?id=' . security::encode($_POST['id']));

?>
