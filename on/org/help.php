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
			<div style=\"float: left; width: 520px;\">
				<h2 class=\"dark\">{$lang['you']}</h2>
				<p>{$lang['you_text']}</p>
			</div>
			<div style=\"float: right; width: 480px; text-align: right;\">
				<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/pages/reunion.png\" style=\"float: left; display: block; padding: 10px; border: 1px solid #d1d1d1; border-radius: 3px;\" />
			</div>
			<div class=\"clear\"></div>
			<br /><br />
			<div style=\"float: left;  width: 400px;\">
				<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/goodies/logo-normal.png\" style=\"display: block; padding: 10px; border: 1px solid #d1d1d1; border-radius: 3px; margin-left: 20px;\" />
			</div>
			<div style=\"float: left; width: 560px;\">
				<h2 class=\"dark\">{$lang['logo']}</h2>
				<p>{$lang['logo_text']}</p>
			</div>
			<div class=\"clear\"></div>
			<br /><br />
			<h2 class=\"dark\">{$lang['donation']}</h2>
			<p>{$lang['donation_text']}</p>
			<br /><br />
			<div style=\"text-align: center;\">
				<a class=\"button classic\" href=\"#\" style=\"height: 22px; width: 200px; margin: 0 auto;\">
					<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['donation']}</span>	
				</a>
			</div>
			<br /><br />
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>