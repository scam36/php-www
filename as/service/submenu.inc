<?php

if( isset($GLOBALS['lang']) && is_object($GLOBALS['lang']) )
	$GLOBALS['lang']->import(__DIR__ . '/submenu.lang');

// initialize the menu
$menu = array(
	array('text'=>"menu_overview", 'default'=>true, 'link'=>"/service"),
	array('text'=>"menu_hosting", 'link'=>"/service/hosting"),
	array('text'=>"menu_consulting", 'link'=>"/service/consulting"),
	array('text'=>"menu_open", 'link'=>"/service/opensource"),
	array('text'=>"menu_project", 'link'=>"/service/project")
);

return $menu;

?>
