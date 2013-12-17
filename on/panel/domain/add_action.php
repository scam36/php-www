<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

api::send('self/domain/add', array('domain'=>$_POST['domain'], 'site'=>$_POST['subdomain'], 'dir'=>$_POST['dir']));

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/panel/domain');

?>
