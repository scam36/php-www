<?php

if( isset($GLOBALS['lang']) && is_object($GLOBALS['lang']) )
	$GLOBALS['lang']->import(__DIR__ . '/mainmenu.lang');

// initialize the menu
$menu = array(
	array('text'=>"nservice", 'link'=>"/service"),
	array('text'=>"nabout", 'link'=>"/about"),
	array('text'=>"ncontact", 'link'=>"/about/contact"),
	array('text'=>"nhelp", 'link'=>"https://projets.anotherservice.com/projects/as-panel/wiki"),
	array('text'=>"npanel", 'anonymous'=>false, 'link'=>"/panel"),
	array('text'=>"nlogout", 'anonymous'=>false, 'link'=>"/logout"),
	array('text'=>"nlogin", 'anonymous'=>true, 'link'=>"/login"),
	array('text'=>"nregister", 'anonymous'=>true, 'link'=>"/join"),
);

return $menu;

?>