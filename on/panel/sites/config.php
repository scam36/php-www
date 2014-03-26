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
		<div class=\"top\">
			<div class=\"left\" style=\"width: 500px;\">
				<span style=\"font-size: 38px; display: block; margin-bottom: 15px;\">{$site['hostname']}</span>
				<span style=\"font-size: 18px; color: #5ac940; display: block; margin-bottom: 10px;\">{$lang['disk']} {$site['size']} {$lang['mb']}</span>
			</div>
			<div class=\"right\" style=\"width: 600px; float: right; text-align: right;\">
				<a class=\"action settings big\" href=\"#\" onclick=\"\">
					{$lang['settings']}
				</a>
				<a class=\"action pass big\" href=\"#\" onclick=\"$('#changepassword').dialog('open'); return false;\">
					{$lang['password']}
				</a>
				<a class=\"action delete big\" href=\"#\" onclick=\"$('#delete').dialog('open'); return false;\">
					{$lang['delete']}
				</a>
			</div>
			<div class=\"clear\"></div><br /><br />
		</div>
		<div class=\"container\">
			<div class=\"left\" style=\"width: 600px; margin-top: 5px;\">
				<h2 class=\"dark\">{$lang['access']}</h2>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/ftp.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['ftp']}</span>
					</span>
					<span style=\"float: right; display: block; width: 390px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\">ftp.olympe.in</span>
				</div>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/user.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['login']}</span>
					</span>
					<span style=\"float: right; display: block; width: 390px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\">{$site['name']}</span>
				</div>
				<br /><br />
				<h2 class=\"dark\">{$lang['urls']}</h2>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/link.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['main']}</span>
					</span>
					<span style=\"float: right; display: block; width: 390px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\"><a href=\"http://{$site['name']}.olympe.in\">{$site['name']}.olympe.in</a></span>
				</div>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/link.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['redirect']}</span>
					</span>
					<span style=\"float: right; display: block; width: 390px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\"><a href=\"http://{$site['name']}.olympe-network.com\">{$site['name']}.olympe-network.com</a></span>
				</div>
				<div class=\"info\" style=\"border-bottom: 1px solid #e5e5e5;\">
					<span style=\"float: left; display: block; width: 200px; font-size: 15px; height: 30px; padding: 10px; \">
						<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/link.png\" alt=\"\" style=\"float: left; display: block;\" />
						<span style=\"float: left; display: block; padding: 4px 5px 5px 10px; color: #de5711;\">{$lang['redirect']}</span>
					</span>
					<span style=\"float: right; display: block; width: 390px; text-align: center; padding: 13px 0 0 0; font-size: 18px; background-color: #f9f9f9; height: 37px;\"><a href=\"http://{$site['name']}.o-n.fr\">{$site['name']}.o-n.fr</a></span>
				</div>
			</div>
			<div class=\"right border\" style=\"width: 340px; padding-left: 60px; margin-left: 40px; margin-top: 5px;\">
				<h2 class=\"dark\">{$lang['view']}</h2>
				<img style=\"border: 1px solid #cecece; padding: 10px; border-radius: 3px;  text-align: right; float: right;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/sites/?url={$site['hostname']}\" />
				<div class=\"clear\"></div><br /><br />
			</div>
			<div class=\"clear\"></div><br />
		</div>
	</div>
	<div id=\"delete\" class=\"floatingdialog\">
		<h3 class=\"center\">{$lang['delete']}</h3>
		<p style=\"text-align: center;\">{$lang['delete_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/sites/del_action\" method=\"get\" class=\"center\">
				<input id=\"id\" type=\"hidden\" value=\"{$site['id']}\" name=\"id\" />
				<fieldset autofocus>	
					<input type=\"submit\" value=\"{$lang['delete_now']}\" />
				</fieldset>
			</form>
		</div>
	</div>
	<div id=\"changepassword\" class=\"floatingdialog\">
		<h3 class=\"center\">{$lang['changepassword']}</h3>
		<p style=\"text-align: center;\">{$lang['changepassword_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/sites/config_action\" method=\"post\" class=\"center\">
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
	</div>
	<div id=\"settings\" class=\"floatingdialog\">
		<h3 class=\"center\">{$lang['settings']}</h3>
		<p style=\"text-align: center;\">{$lang['settings_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/site/config_action\" method=\"post\" class=\"center\">	
				<input type=\"hidden\" name=\"id\" value=\"{$site['id']}\" />
				<fieldset>
					<input type=\"text\" name=\"description\" value=\"".($site['description']?"{$site['description']}":"{$lang['desc']}")."\" style=\"width: 504px;\" />
					<span class=\"help-block\">{$lang['desc_help']}</span>
				</fieldset>
				<fieldset>
					<select name=\"category\" style=\"width: 520px;\">
						<option ".($site['category']==1?"selected":"")." value=\"1\">{$lang['CAT_1']}</option>
						<option ".($site['category']==2?"selected":"")." value=\"2\">{$lang['CAT_2']}</option>
						<option ".($site['category']==3?"selected":"")." value=\"3\">{$lang['CAT_3']}</option>
						<option ".($site['category']==4?"selected":"")." value=\"4\">{$lang['CAT_4']}</option>
						<option ".($site['category']==5?"selected":"")." value=\"5\">{$lang['CAT_5']}</option>
						<option ".($site['category']==6?"selected":"")." value=\"6\">{$lang['CAT_6']}</option>
						<option ".($site['category']==7?"selected":"")." value=\"7\">{$lang['CAT_7']}</option>
						<option ".($site['category']==8?"selected":"")." value=\"8\">{$lang['CAT_8']}</option>
					</select>
					<span class=\"help-block\">{$lang['cat_help']}</span>
				</fieldset>
				<fieldset>	
					<input autofocus type=\"submit\" value=\"{$lang['update']}\" />
				</fieldset>
			</form>
		</div>
	</div>
	<script>
		newFlexibleDialog('settings', 550);
		newFlexibleDialog('changepassword', 550);
		newFlexibleDialog('delete', 550);
	</script>
	";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
