<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$params = array();
if( strlen($_POST['password']) > 0 )
	$params['pass'] = $_POST['password'];

$params['database'] = $_POST['database'];
$params['desc'] = $_POST['desc'];

api::send('self/database/update', $params);

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel/database');

?>
