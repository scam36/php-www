<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$users = api::send('user/list', array('count'=>1), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$sites = api::send('site/list', array('count'=>1), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$dbs = api::send('database/list', array('count'=>1), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$domains = api::send('domain/list', array('count'=>1), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

$content = "		
			<span style=\"display: block; font-size: 70px; margin: 0 auto;\">".number_format($users['count'])."</span>
			<span style=\"display: block; font-size: 30px; color: #7bbb51; margin-top: 5px;\">{$lang['users']}</span>
			<span style=\"display: block; font-size: 18px; margin-top: 20px;\">
				<span style=\"color: #910000\">".number_format($sites['count'])."</span> {$lang['sites']}, 
				<span style=\"color: #910000\">".number_format($dbs['count'])."</span> {$lang['databases']} 
				<span style=\"color: #910000\">".number_format($domains['count'])."</span> {$lang['domains']}
			</span>
";

echo $content;

?>