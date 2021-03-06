<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$userinfo = api::send('self/user/list');
$userinfo = $userinfo[0];

$quotas =  api::send('self/quota/user/list');
$sites =  api::send('self/site/list');

foreach( $quotas as $q )
{
	if( $q['name'] == 'BYTES' )
		$quota = $q;
}

$percent = $quota['used']*100/$quota['max'];

if( $quota['used'] >= 1024 )
	$quota['used'] = round($quota['used']/1024, 2) . " {$lang['gb']}";
else
	$quota['used'] = "{$quota['used']} {$lang['mb']}";

if( $quota['max'] >= 1024 )
	$quota['max'] = round($quota['max']/1024, 2) . " {$lang['gb']}";
else
	$quota['max'] = "{$quota['max']} {$lang['mb']}";
	
$content = "
	<div class=\"panel\">
		<div class=\"top\">
			<div class=\"left\" style=\"width: 500px;\">
				<img style=\"width: 60px; height: 60px; float: left; margin: 5px 10px 0px 0px; display: block;\" src=\"".(file_exists("{$GLOBALS['CONFIG']['SITE']}/images/users/{$userinfo['id']}.png")?"/{$GLOBALS['CONFIG']['SITE']}/images/users/{$userinfo['id']}.png":"/{$GLOBALS['CONFIG']['SITE']}/images/users/user.png")."\" />
				<h1 class=\"dark title\">".security::get('USER')."</h1>
				<h2 class=\"dark title\">".($userinfo['firstname']?"{$userinfo['firstname']} {$userinfo['lastname']}":"{$lang['nolastname']}")."</h2>
			</div>
			<div class=\"right\" style=\"width: 460px;\">
				<span style=\"block; float: left; padding-top: 7px; font-size: 18px; color: #878787;\">{$lang['disk2']}</span>
				<div style=\"float: right;\">
					<div class=\"fillgraph\" style=\"margin-top: 10px;\">
						<small style=\"width: {$percent}%;\"></small>
					</div>
					<span class=\"quota\"><span style='font-weight: bold;'>{$quota['used']}</span> {$lang['of']} {$quota['max']}. <a href=\"/panel/messages\">{$lang['request']}</a>.</span>
				</div>
			</div>
			<div class=\"clear\"></div>
		</div>
		<br />
		<div class=\"sites\">
			<div class=\"sitescontent\">
				<div style=\"width: 1080px; padding: 10px; background-color: #ffffff; opacity: 0.6; border-radius: 5px; margin-bottom: 20px;\">
					<img style=\"display: block; float: left; margin-right: 10px;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/donation.png\" />
					<span style=\"font-size: 18px; display: block; float: left;\">{$lang['help']} <a href=\"/org/help\">{$lang['help_text']}</a> !</span><br /><br />
					<span style=\"font-size: 12px; color: #ff8827; display: block; float: left; padding-top: 10px;\"\">{$lang['thanks']} <span style=\"font-weight: bold;\">{$lang['thanks2']}</span>.</span>
					<div class=\"clear\"></div>
				</div>
				<div class=\"site newsite\" id=\"newsite\">
					<div id=\"addsite\">
						<a href=\"#\" onclick=\"showForm(); return false;\" class=\"button classic\" style=\"margin: 0 auto; margin-top: 97px; padding: 10px 0 0 0; height: 40px; width: 50px; text-align: center;\">
							<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/plus-white-big.png\" />
						</a>
					</div>
					<div id=\"formsite\" style=\"display: none; position: relative; padding: 30px 10px 10px 10px;\">
						<a href=\"#\" style=\"display: block; position: absolute; top: 5px; left: 5px;\" onclick=\"showNew(); return false;\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowLeft.png\" alt=\"\" /></a>
						<div class=\"form-small\">		
							<form action=\"/panel/sites/add_action\" method=\"post\" class=\"center\">
								<fieldset style=\"padding-top: 10px;\">
									<input class=\"auto\" type=\"text\" value=\"{$lang['name']}\" name=\"subdomain\" onfocus=\"this.value = this.value=='{$lang['name']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['name']}' : this.value; this.value=='{$lang['name']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
									<span class=\"help-block\">{$lang['tipsite']}</span>
								</fieldset>
								<fieldset>
									<input class=\"auto\" type=\"password\" value=\"{$lang['password']}\" name=\"password\" onfocus=\"this.value = this.value=='{$lang['password']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['password']}' : this.value; this.value=='{$lang['password']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
									<span class=\"help-block\">{$lang['tippassword']}</span>
								</fieldset>
								<fieldset>	
									<input autofocus type=\"submit\" value=\"{$lang['create']}\" style=\"width: 120px;\" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
";

if( count($sites) == 0 )
{
	$content .= "<div class=\"new\">
					<div class=\"bullet\"></div>
					<div class=\"text\">
						<span class=\"title\">{$lang['welcome']}</span>
						{$lang['welcome_text']}
					</div>
				</div>
	";
}
else
{
	$count = count($sites);
	$i = 1;
	
	foreach( $sites as $s )
	{
		if( $i == $count )
			$last = "style=\"margin-right: 0;\"";
			
		$i++;
		
		if( !$s['size'] )
			$s['size'] = 0;
			
		$content .= "
				<div class=\"site\" {$last} onclick=\"window.location.href='/panel/sites/config?id={$s['id']}'; return false;\">
					<div class=\"normal\">
						<span style=\"font-size: 16px; font-weight: bold; display: block; margin-bottom: 5px;\">{$s['hostname']}</span>
						<span style=\"color: #9a9a9a; font-size: 12px; display: block; margin-bottom: 20px;\">{$lang['disk']} {$s['size']} {$lang['mb']}</span></span>
						<div class=\"thumbshot\">
							<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/sites/?url={$s['hostname']}\" />
						</div>
					</div>
				</div>
		";
	}
}

$content .= "
			<div class=\"clear\"></div>
			</div>
		</div>	
	</div>
	<script>
		function showForm()
		{
			var options = {};
			$(\"#addsite\").css(\"display\", \"none\");
			$(\"#formsite\").show(\"fade\", options, 200);
			$(\"#newsite\").css(\"background-color\", \"#ffffff\");
			
		}
		function showNew()
		{
			var options = {};
			$(\"#formsite\").css(\"display\", \"none\");
			$(\"#addsite\").show(\"fade\", options, 200);
			$(\"#newsite\").css(\"background\", \"rgba(0, 0, 0, 0.05)\");
		}
	</script>";


/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>