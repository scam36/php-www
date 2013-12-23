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
			<div class=\"left\" style=\"width: 600px; margin-top: 5px;\">
				<h1 class=\"dark\">{$site['hostname']}</h1>
				<br />
				<h2 class=\"dark thin\">{$lang['infos']}</h2>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/link.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['access']}</span>
					</span>
					<span style=\"float: right; display: block; width: 330px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\"><a href=\"http://{$site['hostname']}\">{$lang['access_text']}</a></span>
				</div>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/ftp.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['ftp']}</span>
					</span>
					<span style=\"float: right; display: block; width: 330px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\">ftp.olympe.in</span>
				</div>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/user.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['login']}</span>
					</span>
					<span style=\"float: right; display: block; width: 330px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\">{$site['name']}</span>
				</div>
				<br /><br />
				<h2 class=\"dark thin\">{$lang['directory']}</h2>
				<form action=\"/panel/site/config_action\" method=\"post\">
					<input type=\"hidden\" name=\"id\" value=\"{$site['id']}\" />
					<fieldset>
						<input type=\"text\" name=\"description\" value=\"".($site['description']?"{$site['description']}":"{$lang['desc']}")."\" style=\"width: 450px;\" />
						<span class=\"help-block\">{$lang['desc_help']}</span>
					</fieldset>
					<fieldset>
						<select name=\"category\" style=\"width: 468px;\">
							<option value=\"1\">{$lang['CAT_1']}</option>
							<option value=\"2\">{$lang['CAT_2']}</option>
							<option value=\"3\">{$lang['CAT_3']}</option>
							<option value=\"4\">{$lang['CAT_4']}</option>
							<option value=\"5\">{$lang['CAT_5']}</option>
							<option value=\"6\">{$lang['CAT_6']}</option>
							<option value=\"7\">{$lang['CAT_7']}</option>
							<option value=\"8\">{$lang['CAT_8']}</option>
						</select>
						<span class=\"help-block\">{$lang['cat_help']}</span>
					</fieldset>
					<fieldset>	
						<input autofocus type=\"submit\" value=\"{$lang['update']}\" />
					</fieldset>
				</form>	
			</div>
			<div class=\"right border\" style=\"width: 340px; padding-left: 60px; margin-left: 40px; margin-top: 5px;\">
				<h1 class=\"dark\" style=\"text-align: right; font-size: 20px; color: #007b31; font-weight: 200;\"><span style=\"color: #6c6c6c\">{$site['homeDirectory']}</span> {$site['size']} {$lang['mb']}</h1>
				<br />
				<img style=\"border: 1px solid #cecece; padding: 10px; border-radius: 3px;  text-align: right; float: right;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/sites/?url={$site['hostname']}\" />
				<div class=\"clear\"></div><br /><br />
				<h2 class=\"dark thin\">{$lang['password']}</h2>
				<form action=\"/panel/site/config_action\" method=\"post\">
					<input type=\"hidden\" name=\"id\" value=\"{$site['id']}\" />
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
			<div class=\"clear\"></div><br />
		</div>
	</div>
	";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
