<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

require_once('_LIB/openerplib/openerplib.php');

$open = new OpenERP();

$p = $open->account_invoice->get(164);
print_r($p);

?>