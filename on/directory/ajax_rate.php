<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

api::send('self/busit/connector/setrate', array('id'=>$_GET['id'], 'rating'=>$_GET['rating']));

?>