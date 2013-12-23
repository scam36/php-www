<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
		<div class=\"head-light\">
			<div class=\"container\">
				<div style=\"float: left; width: 500px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div style=\"float: right; width: 500px;\">
					<a class=\"button classic\" href=\"/doc\" style=\"float: right; height: 22px; width: 150px; margin: 0 auto;\">
						<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['back']}</span>
					</a>
				</div>
				<div class=\"clear\"></div>
			</div>
		</div>	
		<div class=\"content\">		
			<p>{$lang['intro']}</p>
			<br />
			<h3>{$lang['panel']}</h3>
			<p>{$lang['panel_text']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/1.png\" alt=\"1\" />
			<br />
			<h3>{$lang['site']}</h3>
			<p>{$lang['site_text']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/2.png\" alt=\"2\" />
			<p>{$lang['site_text2']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/3.png\" alt=\"3\" />
			<br />
			<h3>{$lang['publish']}</h3>
			<p class=\"large\">{$lang['publish_text']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/4.png\" alt=\"4\" />
			<p class=\"large\">{$lang['publish_text2']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/5.png\" alt=\"5\" />
			<br />
			<p style=\"text-align: center;\">
					{$lang['end']}<br /><br />
					<a class=\"button classic\" href=\"/doc\" style=\"height: 22px; width: 150px; margin: 0 auto;\">
						<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['back']}</span>
					</a>
			</p>
		</div>
		<div class=\"clearfix\"></div><br />
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>