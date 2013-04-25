<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

echo '{"token":"'.security::get('API_AUTH').'"}';
exit;

?>