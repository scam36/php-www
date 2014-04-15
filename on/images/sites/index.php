<?php

if( $_SERVER["HTTP_HOST"] == 'localhost' || $_SERVER["HTTP_HOST"] == '127.0.0.1' || $_SERVER["HTTP_HOST"] == 'local.olympe.in' )
	exit();

$url = str_replace(array('..', '\\', '|', '*', ' ', 'http://'), array('', '', '', '', '', ''), $_GET['url']);
$file = $url.'.png';

function resize($content)
{
	$percent = 0.5;
	
	if( $content )
	{
		$filename = '/tmp/' . md5(time());
		file_put_contents($filename, $content);
			
		list($width, $height) = getimagesize($filename);
		$newwidth = $width * $percent;
		$newheight = $height * $percent;

		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefrompng($filename);

		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);		
		unlink($filename);
		
		return imagepng($thumb);
	}
}

if( file_exists($file) )
{
	$mod = filemtime($file);
	$size = filesize ($file);
	$current = time();
	
	if( $mod <= $current-(3600*24*30) || $size < 10 )
	{
		$address = 'http://172.16.1.200:3000?url=' . $url . '&clipRect={"top":0,"left":0,"width":1024,"height":600}';
		$content = file_get_contents($address);
		$content = resize($content);
		
		file_put_contents($file, $content);
	}
}
else
{
	$address = 'http://172.16.1.200:3000?url=' . $url . '&clipRect={"top":0,"left":0,"width":1024,"height":600}';
	$content = file_get_contents($address);
	$content = resize($content);
		
	file_put_contents($file, $content);
}

header("content-type: image/png");
echo file_get_contents($file);

?>
