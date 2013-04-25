<?php

if( isset($GLOBALS['lang']) && is_object($GLOBALS['lang']) )
	$GLOBALS['lang']->import(__DIR__ . '/mainmenu.lang');

// initialize the menu
$menu = array(
	array('text'=>"nservice", 'anonymous'=>true, 'link'=>"/service"),
	array('text'=>"nservice", 'anonymous'=>false, 'link'=>"/service"),
	array('text'=>"nabout", 'anonymous'=>true, 'link'=>"/about"),
	array('text'=>"nabout", 'anonymous'=>false, 'link'=>"/about"),
	array('text'=>"ncontact", 'anonymous'=>true, 'link'=>"/about/contact"),
	array('text'=>"ncontact", 'anonymous'=>false, 'link'=>"/about/contact"),
	array('text'=>"nhelp", 'anonymous'=>true, 'link'=>"https://projets.anotherservice.com/projects/as-panel/wiki"),
	array('text'=>"nhelp", 'anonymous'=>false, 'link'=>"https://projets.anotherservice.com/projects/as-panel/wiki"),
	array('text'=>"npanel", 'anonymous'=>false, 'link'=>"/panel"),
	array('text'=>"nlogout", 'anonymous'=>false, 'link'=>"/logout"),
	array('text'=>"nlogin", 'anonymous'=>true, 'link'=>"/login"),
	array('text'=>"nregister", 'anonymous'=>true, 'link'=>"/join"),
);

return $menu;

?>