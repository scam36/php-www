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
			<p>
				<span class=\"intro\">{$lang['intro_1']}</span><br /><br />
				<span class=\"intro\">{$lang['intro_2']}</span>
			</p>
			<br />
			<img class=\"icon\" style=\"border: 3px solid #e5e5e5; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/illustrations/hosting.png\" alt=\"intro\" />
			<h1>{$lang['offer']}</h1>
			<p class=\"large\">{$lang['hosting']}</p>
			<br />
			<h3>{$lang['saas']}</h3>
			<br />
			<p class=\"large\">{$lang['saas_text']}</p>
			<br />
			<a class=\"btn\" href=\"/service/hosting\">{$lang['more']}</a>
			<div class=\"clearfix\"></div>
			<br />
			<img class=\"icon-right\" style=\"border: 3px solid #e5e5e5; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/illustrations/cloud.png\" alt=\"intro\" />
			<h1>{$lang['consulting']}</h1>
			<p class=\"large\">{$lang['consulting_text']}</p>
			<br />
			<h3>{$lang['consulting2']}</h3>
			<br />
			<p class=\"large\">{$lang['consulting2_text']}</p>
			<br />
			<a class=\"btn\" href=\"/service/consulting\">{$lang['more']}</a>
		</div>
	</div>

	<div class=\"clearfix\"></div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>