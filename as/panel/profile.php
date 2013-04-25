<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content .= "
	<div class=\"box nocol\">
		<div class=\"container\">
			<h2>{$lang['title']}</h2>
			<br />
			<div style=\"width: 48%; float: left;\">";
			
if( security::hasGrant('SELF_SELECT') )
{
	$userinfo = api::send('self/whoami');
	$userinfo = $userinfo[0];
	
	if( security::hasGrant('SELF_UPDATE') )
		$disabled = '';
	else
		$disabled = 'disabled';

	if( security::hasGrant('SELF_UPDATE') )
	{
		$content .= "
				<h3 class=\"colored\">{$lang['change_pass']}</h3>
				<br />
				<form action=\"/panel/profile/action_update\" method=\"post\">
					<fieldset>
						<label>{$lang['password']}</label>
						<input type=\"password\" name=\"pass\" />
					</fieldset>
					<fieldset>
						<label>{$lang['password2']}</label>
						<input type=\"password\" name=\"confirm\" />
					</fieldset>
					<fieldset>
						<label></label>
						<input type=\"submit\" value=\"{$lang['update']}\" />
					</fieldset>
				</form>";
	}
	
	$content .= "
			</div>
			<div style=\"width: 48%; float: left;\">
				<h3 class=\"colored\">{$lang['change_info']}</h3>
				<br />
				<form action=\"/panel/profile/action_update\" method=\"post\">
					<fieldset>
						<label>{$lang['firstname']}</label>
						<input type=\"text\" name=\"firstname\" value=\"{$userinfo['firstname']}\" {$disabled} />
					</fieldset>
					<fieldset>
						<label>{$lang['lastname']}</label>
						<input type=\"text\" name=\"lastname\" value=\"{$userinfo['lastname']}\" {$disabled} />
					</fieldset>
					<fieldset>
						<label>{$lang['email']}</label>
						<input type=\"text\" name=\"email\" value=\"{$userinfo['email']}\" {$disabled} />
					</fieldset>
					<fieldset>
						<label></label>
						<input type=\"submit\" value=\"{$lang['update']}\" {$disabled} />
					</fieldset>
				</form>
			</div>
			<div class=\"clearfix\"></div>";
}

if( security::hasGrant('SELF_TOKEN_SELECT') )
{
	$tokens = api::send('self/token/list');
	
	$content .= "
			<h2>{$lang['tokens']}</h2>
			<table>
				<tr>
					<th>{$lang['name']}</th>
					<th>{$lang['token']}</th>
					<th>{$lang['actions']}</th>
				</tr>
	";
	
	foreach( $tokens as $t )
	{
		$content .= "
				<tr>
					<td>{$t['name']}</td>
					<td>{$t['token']}</td>
					<td align=\"center\">";

		if( security::hasGrant('SELF_TOKEN_UPDATE') )
		{
			$content .= "
						<a href=\"/panel/token/detail?token={$t['token']}\" title=\"{$lang['update']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/refresh3.png\" alt=\"{$lang['update']}\" /></a>";
		}
		
		if( security::hasGrant('SELF_TOKEN_DELETE') )
		{
			$content .= "
						<a href=\"/panel/token/del_action?token={$t['token']}');\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>";
		}
		
		$content .= "
					</td>
				</tr>";
	}

	$content .= "		
			</table>
			<br />
			<a class=\"btn\" href=\"/panel/token/add\">{$lang['add']}</a>
		</div>
	</div>";
}

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
