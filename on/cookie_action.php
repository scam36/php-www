<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

setcookie("OLYMPE_CGU_201404", "1", time() + (60 * 24 * 60 * 60));

$template->redirect($_SERVER['HTTP_REFERER']);

?>