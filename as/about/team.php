<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
	<div class=\"box nocol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
			</div>
		</div>
		<div class=\"container\">
			<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/yann.png\" />
			<h3 class=\"colored\">Yann Autissier</h3>
			<br />
			<p class=\"large\">{$lang['yann']}</p>
			<div class=\"clearfix\"></div>
			<br />
			<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/sam.png\" />
			<h3 class=\"colored\">Samuel Hassine</h3>
			<br />
			<p class=\"large\">{$lang['sam']}</p>
			<div class=\"clearfix\"></div>
			<br />
			<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/simon.png\" />
			<h3 class=\"colored\">Simon Uyttendaele</h3>
			<br />
			<p class=\"large\">{$lang['simon']}</p>
			<div class=\"clearfix\"></div>
			<br />
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>