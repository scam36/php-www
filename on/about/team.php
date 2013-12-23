<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
			<div class=\"head-light\">
				<div class=\"container\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
			</div>	
			<div class=\"content\">
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/yann.png\" />
				<h3 class=\"colored\">Yann Autissier</h3>
				<br />
				<p class=\"large\">{$lang['yann']}</p>
				<div class=\"clear\"></div>
				<br />
				
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/sam.png\" />
				<h3 class=\"colored\">Samuel Hassine</h3>
				<br />
				<p class=\"large\">{$lang['sam']}</p>
				<div class=\"clear\"></div>
				<br />
				
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/simon.png\" />
				<h3 class=\"colored\">Simon Uyttendaele</h3>
				<br />
				<p class=\"large\">{$lang['simon']}</p>
				<div class=\"clear\"></div>
				<br />
			</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>