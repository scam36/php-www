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
			<p>{$lang['content']}</p>
			<br />
			<p style=\"text-align: center; color: #840000;\">{$lang['content_2']}</p>
		</div>
		<br />
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>