<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( !$_POST['parent'] )
{
	$message = "[i]{$lang['type']}[/i] {$lang['quota']}
[i]{$lang['select']}[/i] {$_POST['quota']}
[i]{$lang['request']}[/i] {$_POST['max']}

{$_POST['content']}
	";
}
else
{
	$message = $_POST['content'];
	api::send('self/message/update', array('id'=>$_POST['parent'], 'status'=>1));
}	

$params = array();
$params['content'] = bbcode::encode($message);
$params['type'] = $_POST['type'];
if( $_POST['title'] )
	$params['title'] = $_POST['title'];
if( $_POST['parent'] )
	$params['parent'] = $_POST['parent'];

try
{
	api::send('self/message/add', $params);
}
catch( Exception $e )
{
	$_SESSION['MESSAGE']['TYPE'] = 'error';
	$_SESSION['MESSAGE']['TEXT']= $lang['error'];	
}

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel/messages');

?>
