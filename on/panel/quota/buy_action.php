<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$number = explode('.', $_POST['number']);
$result = api::send('self/bill/add', array('service'=>$_POST['service'], 'number'=>$number[0]));

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	template::redirect('/panel/quota/view?id='.$result['id']);

?>
