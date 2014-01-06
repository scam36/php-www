<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<form action=\"/admin/site/unvalid_action\" method=\"post\" class=\"mainForm\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />
					<input type=\"hidden\" name=\"user\" value=\"{$_GET['user']}\" />
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['subtitle']}</h5></div>
							<div class=\"rowElem\">
								<label>{$lang['why']}</label>
								<div class=\"formRight\">
									<select name=\"reason\">
										<option value=\"1\">{$lang['why_1']}</option>
										<option value=\"2\">{$lang['why_2']}</option>
										<option value=\"3\">{$lang['why_3']}</option>
										<option value=\"4\">{$lang['why_4']}</option>
										<option value=\"5\">{$lang['why_5']}</option>
									</select>
								</div>
							</div><div class=\"fix\"></div>
							<input type=\"submit\" value=\"{$lang['alert']}\" class=\"greyishBtn submitForm\" />
							<div class=\"fix\"></div>
						</div>
					</fieldset>
				</form>
			</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
