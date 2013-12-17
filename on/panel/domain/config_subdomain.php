<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$subdomain = api::send('self/subdomain/list', array('id'=>$_GET['id'], 'domain'=>$_GET['domain']));
$subdomain = $subdomain[0];

$content .= "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<form action=\"/panel/domain/config_subdomain_action\" method=\"post\" class=\"mainForm\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />
					<input type=\"hidden\" name=\"domain\" value=\"{$_GET['domain']}\" />
					<input type=\"hidden\" name=\"domain_id\" value=\"{$_GET['domain_id']}\" />
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['subtitle']}</h5></div>
							<div class=\"rowElem\"><label>{$lang['record']}</label><div class=\"formRight\"><input type=\"text\" name=\"record\" value=\"{$subdomain['aRecord']}{$subdomain['cNAMERecord']}\" /></div><div class=\"fix\"></div></div>
							<input type=\"submit\" value=\"{$lang['update']}\" class=\"greyishBtn submitForm\" />
							<div class=\"fix\"></div>
						</div>
					</fieldset>
				</form>
			</div>
	";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
