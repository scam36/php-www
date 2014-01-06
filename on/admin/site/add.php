<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$sites = api::send('self/site/list');

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<form action=\"/panel/domain/add_action\" method=\"post\" class=\"mainForm\">
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['subtitle']}</h5></div>
							<div class=\"rowElem noborder\"><label>{$lang['domain']}</label><div class=\"formRight\"><input type=\"text\" name=\"domain\" /></div><div class=\"fix\"></div></div>
							<div class=\"rowElem\">
								<label>{$lang['site']}</label>
								<div class=\"formRight\">
									<select name=\"subdomain\">
";

if( count($sites) > 0 )
{
	foreach( $sites as $s )
		$content .= "							<option value=\"{$s['name']}\">{$s['hostname']}</option>";
}

$content .= "
									</select>
								</div>
							</div>
							<div class=\"rowElem\"><label>{$lang['folder']}</label><div class=\"formRight\"><input type=\"text\" name=\"dir\" /></div><div class=\"fix\"></div></div>
							<input type=\"submit\" value=\"{$lang['create']}\" class=\"greyishBtn submitForm\" />
							<div class=\"fix\"></div>
						</div>
					</fieldset>
				</form>
			</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
