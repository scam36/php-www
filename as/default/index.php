<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
		<div id=\"content\">
			<br /><br /><br />
			<div class=\"title\">{$lang['intro']}</div>
			<div class=\"subtitle\">{$lang['intro_text']}</div>
			<br />
			<div class=\"buttons\">
				<a class=\"learn\" href=\"/service\">{$lang['learn']}</a>
				<a class=\"contact\" href=\"/join\">{$lang['register']}</a>
			</div>
		</div>
		<div id=\"clouds\">
			<div class=\"container\">
				<div class=\"wrapper\">
					<div class=\"column-3-1\">
						<h2>{$lang['services']}</h2>
						<br />
						<img class=\"icon\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/building.png\">
						<h2><a href=\"/service/hosting\">{$lang['hosting']}</a></h2>
						<p class=\"large\">
							{$lang['hosting_text']}
						</p>
						<div class=\"clearfix\"></div>
						<img class=\"icon\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/signPost.png\">
						<h2><a href=\"/service/consulting\">{$lang['consulting']}</a></h2>
						<p class=\"large\">
							{$lang['consulting_text']}
						</p>
						<div class=\"clearfix\"></div>				
					</div>
					<div class=\"column-3-2\">
						<h2>{$lang['open']}</h2>
						<br />
						<img class=\"icon\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/strategy.png\">
						<h2><a href=\"/service/opensource\">{$lang['source']}</a></h2>
						<p class=\"large\">
							{$lang['source_text']}
						</p>
						<div class=\"clearfix\"></div>	
						<img class=\"icon\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/chemical.png\">
						<h2><a href=\"/service/project\">{$lang['projects']}</a></h2>
						<p class=\"large\">
							{$lang['projects_text']}
						</p>
						<div class=\"clearfix\"></div>
					</div>
					<div class=\"column-3-3\">
						<h2>{$lang['showcase']}</h2>
						<div class=\"area\">
							<img class=\"icon\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/bubbles.png\">
							<p class=\"large\">{$lang['showcase_text']}</p>
							<a class=\"button\" href=\"/about/reference\">{$lang['references']}</a>
						</div>
					</div>
				</div>
				<div class=\"clearfix\"></div>
				<div class=\"separator light\"></div>		
				<br />
				<div style=\"text-align: center;\">
					<div style=\"display: inline-block; margin-right: 50px; opacity: 0.6;\">
							<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/references/google.png\" alt=\"\" />
						</div>
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
							<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/references/github.png\" alt=\"\" />
						</div>
					</div>
				</div>
			</div>
		</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>