<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
			<h2>{$lang['title']}</h2>
			<p class=\"large\">{$lang['subtitle']}</p>
			<br />
			<form action=\"/panel/quota/buy_action\" method=\"post\">
				<fieldset>
					<label>{$lang['service']}</label>
					<select name=\"service\">
						<option value=\"1\">{$lang['pack_1']}</option>
						<option value=\"2\">{$lang['pack_2']}</option>
						<option value=\"3\">{$lang['pack_3']}</option>
					</select>
				</fieldset>
				<fieldset>
					<label>{$lang['number']}</label>
					<input name=\"number\" type=\"text\" value=\"1\" />
				</fieldset>
				<fieldset>
					<label>&nbsp;</label>
					<input type=\"submit\" value=\"{$lang['buy']}\" />
				</fieldset>
			</form>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>