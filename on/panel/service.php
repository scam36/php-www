<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
		<div class=\"panel\">
			<div class=\"top\">
				<div class=\"left\" style=\"padding-top: 5px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div class=\"right\">
				</div>
			</div>
			<div class=\"clear\"></div><br />
			<div class=\"container\">
				<div style=\"float: left; width: 510px;\">
					<h2 class=\"dark\">{$lang['stats']}</h2>
					<p>{$lang['stats_text']}</p>
				</div>
				<div style=\"float: right; width: 510px;\">
					<h2 class=\"dark\">{$lang['cloud']}</h2>
					<p>{$lang['cloud_text']}</p>
				</div>		
			</div>
		</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
