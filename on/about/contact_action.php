<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( $security->hasAccess('/panel') )
	$user = security::get('USER');

$message = "
Name: ".security::encode($_POST['name'])."
Email: ".security::encode($_POST['email'])."
Subjet: ".security::encode($_POST['subject'])."
Compte: {$user}

Message: ".security::encode($_POST['message'])."
";

mail("contact@olympe.in", "[Olympe] {$_POST['subject']}", $message, "From: ".security::encode($_POST['email']));

$_SESSION['MESSAGE']['TYPE'] = 'success';
$_SESSION['MESSAGE']['TEXT']= $lang['success'];

template::redirect('/about/contact');

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>