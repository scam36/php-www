<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$domain = api::send('self/domain/list', array('id'=>$_GET['id']));
$domain = $domain[0];

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']} ({$domain['hostname']})</h5></div>
				<form action=\"/panel/domain/add_subdomain_action\" method=\"post\" class=\"mainForm\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />
					<input type=\"hidden\" name=\"domain\" value=\"{$domain['hostname']}\" />
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['subtitle']}</h5></div>
							<div class=\"rowElem noborder\"><label>{$lang['subdomain']}</label><div class=\"formRight\"><strong>http:// </strong><input type=\"text\" name=\"subdomain\" style=\"width: 200px;\" onchange=\"\$('#subdir').text(this.value);\" onkeyup=\"\$('#subdir').text(this.value);\" /><strong> .{$domain['hostname']}</strong></div><div class=\"fix\"></div></div>
							<div class=\"rowElem\"><label>{$lang['folder']}</label><div class=\"formRight\"><strong>{$domain['homeDirectory']}/</strong><strong id=\"subdir\"></strong></div><div class=\"fix\"></div></div>
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
