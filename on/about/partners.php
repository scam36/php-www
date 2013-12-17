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
			<h1>{$lang['references']}</h1>
			<p class=\"large\">{$lang['references_text']}</p>
			<br />
			<a href=\"http://www.anotherservice.com\">
				<div class=\"reference white\" style=\"background-color: #ffffff;\">
					<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/anotherservice.png\" alt=\"\" />
				</div>
			</a>
			<a href=\"http://www.interxion.fr\">
				<div class=\"reference white\" style=\"background-color: #fcfdff;\">
					<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/interxion.png\" alt=\"\" />
				</div>
			</a>
			<a href=\"http://www.internethic.com\">
				<div class=\"reference black\" style=\"background-color: #1c1c1c;\">
					<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/internethic.png\" alt=\"\" />
				</div>
			</a>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>