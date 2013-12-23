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
			<br />
			<h3>{$lang['buy']}</h3>
			<p>{$lang['buy_text']}</p>
			<br />
			<h3>{$lang['create']}</h3>
			<p>{$lang['create_text']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/7.png\" alt=\"7\" />
			<p>{$lang['create_text2']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/9.png\" alt=\"9\" />
			<p>{$lang['create_text3']}</p>
			<blockquote style=\"width: 500px; margin: 0 auto;\">
				<p>
					<span style=\"font-weight: bold;\">{$lang['primary']}</span> ns1.olympe.in - 178.32.167.243<br />
					<span style=\"font-weight: bold;\">{$lang['secondary']}</span> ns2.olympe.in - 178.32.65.67
				</p>
			</blockquote>
			<p>{$lang['create_text4']}</p>
			<img class=\"doc\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/doc/10.png\" alt=\"10\" />
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>