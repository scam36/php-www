<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$site = api::send('self/site/list', array('id'=>$_GET['id']));
$site = $site[0];

$content .= "
	<div class=\"panel\">
		<div class=\"container\">
			<h1 class=\"dark\">{$site['hostname']}</h1>
			<img style=\"border: 1px solid #cecece; padding: 10px; border-radius: 3px; float: left; margin-right: 20px;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/sites/?url={$site['hostname']}\" />
			<span class=\"\"></span>
			<div class=\"clear\"></div>
			<form action=\"/panel/settings/update_action\" method=\"post\">
				<fieldset>
					<input type=\"password\" name=\"pass\" />
					<span class=\"help-block\">{$lang['pass_help']}</span>
				</fieldset>
				<fieldset>
					<input type=\"password\" name=\"confirm\" />
					<span class=\"help-block\">{$lang['confirm_help']}</span>
				</fieldset>
				<fieldset>	
					<input autofocus type=\"submit\" value=\"{$lang['update']}\" />
				</fieldset>
			</form>	
		</div>
	</div>
	";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
