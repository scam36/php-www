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
			<p>{$lang['intro_text']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/6.png\" alt=\"1\" />
			<br />
			<a href=\"/doc/domains\"><h3>{$lang['domains']}</h3></a>
			<p class=\"large\">{$lang['domains_text']}</p>
			<a href=\"/doc/domains\"><img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/7.png\" alt=\"1\" /></a>
			<br />
			<a href=\"/doc/emails\"><h3>{$lang['emails']}</h3></a>
			<p class=\"large\">{$lang['emails_text']}</p>
			<a href=\"/doc/emails\"><img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/8.png\" alt=\"1\" /></a>
			<br />
			<p class=\"large\" style=\"text-align: center;\">
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