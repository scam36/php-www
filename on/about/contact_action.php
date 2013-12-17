<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$message = "
Name: {$_POST['name']}
Email: {$_POST['email']}
Subjet: {$_POST['subject']}

Message: {$_POST['message']}
";

mail("contact@bus-it.com", "[BI] {$_POST['subject']}", $message, "From: {$_POST['email']}");

$_SESSION['MESSAGE']['TYPE'] = 'success';
$_SESSION['MESSAGE']['TEXT']= $lang['success'];

template::redirect('/about/contact');

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>