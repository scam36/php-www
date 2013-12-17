<?php

$url = str_replace(array('..', '\\', '|', '*', ' '), array('', '', '', '', ''), $_GET['url']);
$file = $url.'.png';

if( file_exists($file) )
{
	$mod = filemtime($file);
	$current = time();
	
	if( $mod <= $current-(3600*2) )
	{
		$url = 'http://api.snapito.com/?delay=0&freshness=0&size=sc&fast=false&timestamp=false&type=PNG&url=' . $url;
		file_put_contents($file, file_get_contents($url));
	}	
}
else
{
	$url = 'http://api.snapito.com/?delay=0&freshness=0&size=sc&fast=false&timestamp=false&type=PNG&url=' . $url;
	file_put_contents($file, file_get_contents($url));
}

header("content-type: image/png");
echo file_get_contents($file);

?>
