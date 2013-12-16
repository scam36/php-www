<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$news = api::send('news/select', array(), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

$content = "
	<div class=\"box nocol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
			</div>
		</div>
		<div class=\"container\">
";

if( count($news) > 0 )
{
	foreach( $news as $n )
	{
		$content .= "
			<div class=\"blogentry\">
				<a href=\"/blog/view?id={$n['id']}\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/news/{$n['id']}.png\" class=\"icon\" /></a>
				<a href=\"/blog/view?id={$n['id']}\"><h3 class=\"colored\">{$n['title']}</h3></a>
				<br />
				<p class=\"large\">{$n['description']}</p>
				<div style=\"float: left;\">
					<div class=\"social\">
						<div class=\"fb-like\" data-href=\"https://www.anotherservice.com/blog/view?id=32\" data-width=\"\" data-height=\"\" data-colorscheme=\"light\" data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"true\" data-send=\"false\"></div>
					</div>
					<div class=\"social\">
						<div class=\"g-plusone\" data-size=\"medium\"></div>
					</div>
				</div>
				<a class=\"btn\" style=\"float: right;\" href=\"/blog/view?id={$n['id']}\">{$lang['read']}</a>
				<div class=\"clearfix\"></div>
			</div>";
	}
}

$content .= "
			<script type=\"text/javascript\">
				window.___gcfg = {lang: 'fr'};
			
				(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>