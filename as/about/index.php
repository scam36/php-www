<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
	<div class=\"box rightcol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
			</div>
		</div>
		<div class=\"left\">
			<div class=\"container\">
				<h1>{$lang['about']}</h1>
				<p class=\"large\">{$lang['intro']}</p>
				<hr>
				<h1>{$lang['legal']}</h1>
				<p class=\"large\">{$lang['legal_text']}</p>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				yrdy
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>