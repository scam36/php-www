<?php

if( $_SERVER["HTTP_HOST"] == 'localhost' || $_SERVER["HTTP_HOST"] == '127.0.0.1' || $_SERVER["HTTP_HOST"] == 'local.olympe.in' )
	exit();
	
$url = str_replace(array('..', '\\', '|', '*', ' ', 'http://'), array('', '', '', '', '', ''), $_GET['url']);
$file = $url.'.png';

if( file_exists($file) )
{
	$mod = filemtime($file);
	$size = filesize ($file);
	$current = time();
	
	if( $mod <= $current-(3600*24*30) || $size < 10 )
	{
		$address = 'http://172.16.1.200:3000?width=200&height=150&url=' . $url;
		$content = file_get_contents($address);
		if( $content )
			file_put_contents($file, $content);
		else
			file_put_contents($file, file_get_contents('site.png'));
	}
}
else
{
	$address = 'http://172.16.1.200:3000?url=' . $url;
	$content = file_get_contents($address);
	if( $content )
		file_put_contents($file, $content);
	else
		file_put_contents($file, file_get_contents('site.png'));
}

header("content-type: image/png");
echo file_get_contents($file);

?>
