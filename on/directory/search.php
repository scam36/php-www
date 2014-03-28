<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$connectors = api::send('busit/connector/list', array('keyword'=>$_GET['keyword'], 'start'=>0, 'limit'=>250), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

$content = "
		<div class=\"store\">
			<div class=\"container\">
				<h1 class=\"dark\">{$lang['search']} ".security::encode($_GET['keyword'])."</h1>
				<br />
";

foreach( $connectors as $c )
{
	$content .= "
				<a href=\"/store/connector?id={$c['connector_id']}\">
					<div class=\"connector\" >
						<div class=\"image\" style=\"background: url('/{$GLOBALS['CONFIG']['SITE']}/images/connectors/{$c['connector_id']}_100.png') no-repeat center center;\">
							<div class=\"hover\"></div>
						</div>
						<div class=\"text\">
							<span class=\"name\">{$c['connector_name']}</span>
							<span class=\"editor\">{$c['user_firstname']} {$c['user_lastname']}</span>
							<br />
							<span class=\"users\"><span class=\"number\">{$c['users']['count']}</span> {$lang['users']}</span>
							<span class=\"price\">".($c['connector_use_price']==0?"{$lang['free']}":"{$c['connector_use_price']} BIC")."</span>
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