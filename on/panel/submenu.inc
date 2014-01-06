<?php

if( isset($GLOBALS['lang']) && is_object($GLOBALS['lang']) )
	$GLOBALS['lang']->import(__DIR__ . '/submenu.lang');

// initialize the menu
$menu = array(
	array('text'=>"phome", 'default'=>true, 'link'=>"/panel"),
	array('text'=>"pdomains", 'link'=>"/panel/domain"),
	array('text'=>"pdatabases", 'link'=>"/panel/database"),
	array('text'=>"pmails", 'link'=>"/panel/user"),
	array('text'=>"pservices", 'link'=>"/panel/service"),
	array('text'=>"pquota", 'link'=>"/panel/quota"),
	array('text'=>"psettings", 'link'=>"/panel/settings"),
);

return $menu;

?>
