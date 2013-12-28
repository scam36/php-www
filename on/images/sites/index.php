<?php

$url = str_replace(array('..', '\\', '|', '*', ' '), array('', '', '', '', ''), $_GET['url']);
$file = $url.'.png';

if( file_exists($file) )
{
	$mod = filemtime($file);
	$size = filesize ($file);
	$current = time();
	
	if( $mod <= $current-(3600*24*7) || $size < 2000 )
	{
		$address = 'http://api.snapito.com/?delay=0&freshness=0&size=sc&fast=false&timestamp=false&type=PNG&url=' . $url;
		$content = file_get_contents($address);
		if( $content )
			file_put_contents($file, $content);
		else
			file_put_contents($file, file_get_contents('site.png'));
	}
}
else
{
	$address = 'http://api.snapito.com/?delay=0&freshness=0&size=sc&fast=false&timestamp=false&type=PNG&url=' . $url;
	$content = file_get_contents($address);
	if( $content )
		file_put_contents($file, $content);
	else
		file_put_contents($file, file_get_contents('site.png'));
}

header("content-type: image/png");
echo file_get_contents($file);

?>
