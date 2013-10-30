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
				<div class=\"subhead\">{$lang['subtitle']}</div>
			</div>
		</div>
		<div class=\"container\">		
			<p class=\"large\">{$lang['intro']}</p>
			<hr>
			<br />
			<h1>{$lang['busit']}</h1>
			<img class=\"icon-right\" style=\"border: 3px solid #868686; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/illustrations/busit.png\" alt=\"intro\" />
			<p class=\"large\">{$lang['busit_text']}</p>
			<br />
			<a class=\"btn\" href=\"https://www.bus-it.com\">{$lang['more']}</a>
			<div class=\"clearfix\"></div>
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>