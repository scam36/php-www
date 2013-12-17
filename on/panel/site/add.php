<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<div class=\"nNote nInformation\"><p>{$lang['desc']}</p></div>
				<form action=\"/panel/site/add_action\" method=\"post\" class=\"mainForm\">
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['subtitle']}</h5></div>
							<div class=\"rowElem noborder\"><label>{$lang['subdomain']}</label><div class=\"formRight\"><input type=\"text\" name=\"subdomain\" value=\"{$_SESSION['subdomain']}\" class=\"rightDir\" title=\".olympe.in\" /></div><div class=\"fix\"></div></div>
							<div class=\"rowElem\"><label>{$lang['password']}</label><div class=\"formRight\"><input type=\"password\" name=\"password\" /></div><div class=\"fix\"></div></div>
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
