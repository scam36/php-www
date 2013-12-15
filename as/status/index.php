<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
		<div id=\"content\">
			<br /><br /><br />
			<div class=\"title\" style=\"margin-bottom: 15px;\">{$lang['online']}</div>
			<div class=\"subtitle\" style=\"margin-top: 5px; font-size: 15px;\">".date('M d Y H:i')."</div>
			<br />
			<div style=\"width: 800px; margin: 0 auto; color: #ffffff; text-align: center; font-size: 14px; line-height: 20px;\">
				{$lang['monitor']}
			</div>
		</div>
		<div id=\"clouds\">
			<div class=\"container\">
				<div class=\"wrapper\" style=\"padding-top: 40px;\">
					<div style=\"float: left;  width: 550px;\">
						<h2>{$lang['services']}</h2>
						<br />
						<p>{$lang['services_text']}</p>
					</div>
					<div style=\"float: left; margin-left: 50px; width: 450px;\">
						<div class=\"terminal\">
							<div class=\"indicators\">
								<span class=\"circle\"></span>
								<span class=\"circle\"></span>
								<span class=\"circle\"></span>
							</div>
							<div class=\"terminal-text\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/screen1.png\" alt=\"map\" style=\"display: block; padding: 5px 0 0 10px;\" />
							</div>
						</div>
					</div>
					<div class=\"clearfix\"></div>
					<br /><br />
					<div style=\"float: left;  width: 430px;\">
						<div class=\"terminal\">
							<div class=\"indicators\">
								<span class=\"circle\"></span>
								<span class=\"circle\"></span>
								<span class=\"circle\"></span>
							</div>
							<div class=\"terminal-text\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/screen2.png\" alt=\"map\" style=\"display: block; padding: 10px 0 0 10px;\" />
							</div>
						</div>
					</div>
					<div style=\"float: left; margin-left: 120px; width: 550px;\">
						<h2>{$lang['apps']}</h2>
						<br />
						<p>{$lang['apps_text']}</p>
					</div>
				</div>
				<div class=\"clearfix\"></div>
				<br />
				<div class=\"separator light\"></div>		
				<br />
				<div style=\"text-align: center;\">
					<div style=\"display: inline-block; margin-right: 50px; opacity: 0.6;\">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/references/bnpparibas.png\" alt=\"\" />
					</div>
					<div style=\"display: inline-block; margin-right: 50px; opacity: 0.6;\">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/references/bpce.png\" alt=\"\" />
					</div>
					<div style=\"display: inline-block; margin-right: 50px; opacity: 0.6;\">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/references/orlane.png\" alt=\"\" />
					</div>
					<div style=\"display: inline-block; opacity: 0.6;\">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/references/lafourchette.png\" alt=\"\" />
					</div>
				</div>
				<div class=\"clearfix\"></div>
				<div class=\"customers\" style=\"margin-top: 30px;\">
					<blockquote>
						<p>{$lang['quote']}</p>
						<p style=\"font-size: 18px; display: block; margin-top: 10px;\"><i>&mdash; {$lang['quote_author']}</i></p>
					</blockquote>
				</div>
				<div class=\"clearfix\"></div><br />
				<div class=\"separator light\"></div>
				<div style=\"text-align: center;\">
					<a class=\"button\" href=\"/join\" style=\"height: 22px; width: 200px; margin: 0 auto;\">
						<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['signup_now']}</span>
					</a>
					<br />
					<p>{$lang['help']}</p>
				</div>
			</div>
		</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>