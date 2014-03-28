<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$connectors = api::send('site/list', array('directory'=>1, 'ordered'=>'site_score', 'start'=>0, 'limit'=>24), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

$content = "
		<div class=\"directory\">
			<div class=\"container\">
				<h1 class=\"dark\">{$lang['top']}</h1>
				<br />
";

foreach( $connectors as $c )
{
	$content .= "
				<a href=\"/directory/site?id={$c['id']}\">
					<div class=\"site\" >
						<div class=\"thumbshot\">
							<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/sites/?url={$c['url']}\" />
						</div>
						<div class=\"text\">
							<span class=\"name\">{$c['title']}</span>
							<span class=\"editor\">{$c['user']}</span>
							<br />
							<div class=\"star\" data-score=\"{$c['rating']['rating']}}\" data-id=\"{$c['id']}\"></div>
						</div>
					</div>
				</a>
	";
}

$content .= "
				<div class=\"clear\"></div>
			</div>
		</div>";

/* ========================== OUTPUT PAGE ========================== */
echo $content;

?>