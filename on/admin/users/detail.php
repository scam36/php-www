<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( strlen($_GET['id']) < 1 )
	template::redirect('/admin');

$user = api::send('user/list', array('id'=>$_GET['id']));

if( count($user) == 0 )
	template::redirect('/admin');
$user = $user[0];

$content = "
		<div class=\"admin\">
			<div class=\"top\">
				<div class=\"left\" style=\"width: 600px; padding-top: 5px;\">
					<h1 class=\"dark\">{$lang['title']} : {$user['name']}</h1>
				</div>
				<div class=\"right\" style=\"width: 400px;\">
					<a class=\"button classic\" href=\"#\" onclick=\"$('#user').val('{$user['id']}'); $('#delete').dialog('open'); return false;\" style=\"width: 180px; height: 22px; float: right;\">
						<span style=\"display: block; padding-top: 3px;\">{$lang['delete']}</span>
					</a>
				</div>
			</div>
			<div class=\"clear\"></div><br />
			<div class=\"container\">
				<div style=\"width: 700px; float: left;\">
					<h2 class=\"dark\">{$lang['sites']}</h2>
					<table>
						<tr>
							<th>{$lang['url']}</th>
							<th>{$lang['size']}</th>
							<th style=\"width: 50px; text-align: center;\">{$lang['actions']}</th>
						</tr>
";

if( security::hasGrant('SITE_SELECT') )
{
	$sites = api::send('site/list', array('user'=>$_GET['id']));
	
	foreach( $sites as $s )
	{		
		$content .= "
						<tr>
							<td><a href=\"http://{$s['hostname']}\">{$s['hostname']}</a></td>
							<td>{$s['size']} {$lang['mb']}</td>
							<td style=\"width: 50px; text-align: center;\">
								<a href=\"/admin/sites/delete?id={$s['id']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
							</td>
						</tr>";
	}
}

$content .= "
					</table>
					<br /><br />
					<h2 class=\"dark\">{$lang['databases']}</h2>
					<table>
						<tr>
							<th>{$lang['type']}</th>
							<th>{$lang['database']}</th>
							<th>{$lang['size']}</th>
							<th style=\"width: 50px; text-align: center;\">{$lang['actions']}</th>
						</tr>
";
		
if( security::hasGrant('DATABASE_SELECT') )
{
	$databases = api::send('database/list', array('user'=>$_GET['id']));
	
	foreach( $databases as $d )
	{		
		$content .= "
						<tr>
							<td>{$d['type']}</td>
							<td>{$d['name']}</td>
							<td>{$d['size']} {$lang['mb']}</td>
							<td style=\"width: 50px; text-align: center;\">
								<a href=\"/admin/databases/delete?id={$d['name']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
							</td>
						</tr>";
	}
}

$content .= "
					</table>
					<br /><br />
";

if( security::hasGrant('TOKEN_SELECT') )
{
	$tokens = api::send('token/list', array('user'=>$_GET['id']));
	
	$content .= "
				<h2 class=\"dark\">{$lang['tokens']}</h2>
				<table>
					<tr>
						<th>{$lang['tokenname']}</th>
						<th>{$lang['tokenvalue']}</th>
						<th style=\"width: 100px; text-align: center;\">{$lang['actions']}</th>
					</tr>
	";

	foreach( $tokens as $t )
	{
		$content .= "
					<tr>
						<td>{$t['name']}</td>
						<td>{$t['token']}</td>
						<td style=\"width: 100px; text-align: center;\">
		";
		
		if( security::hasGrant('TOKEN_UPDATE') )
		{
			$content .= "
							<a href=\"/admin/tokens/detail?user={$_GET['id']}&token={$t['token']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/settings.png\" alt=\"{$lang['update']}\" /></a>";
		}
		
		if( security::hasGrant('TOKEN_DELETE') )
		{
			$content .= "
							<a href=\"/admin/tokens/del_action?user={$_GET['id']}&token={$t['token']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"{$lang['delete']}\" /></a>";
		}
		
		$content .= "
						</td>
					</tr>";
	}

	$content .= "
				</table>";
}

$content .= "<br /><br />";

if( security::hasGrant('QUOTA_USER_SELECT') )
{
	$userquotas = api::send('quota/user/list', array('user'=>$_GET['id']));

	$content .= "
				<h2 class=\"dark\">{$lang['quotas']}</h2>
				<table>
					<tr>
						<th style=\"width: 100px;\">{$lang['quotaname']}</th>
						<th>{$lang['quotavalue']}</th>
						<th style=\"width: 50px; text-align: center;\">{$lang['actions']}</th>
					</tr>
						";
	
	$disabled = array('add'=>'', 'del'=>'', 'set'=>'');
	if( !security::hasGrant('QUOTA_USER_INSERT') )
		$disabled['add'] = 'disabled';
	if( security::hasGrant('QUOTA_USER_DELETE') )
		$disabled['del'] = 'disabled';
	if( security::hasGrant('QUOTA_USER_UPDATE') )
		$disabled['set'] = 'disabled';

	foreach( $userquotas as $u )
	{
		if( $u['max'] != 0 )
			$percent = $u['used']*100/$u['max'];
		
		if( $percent > 100 )
			$percent = 100;
			
		$content .= "
					<tr>
						<td>{$u['name']}</td>
						<td style=\"width: 300px;\">
							<div class=\"fillgraph\" style=\"margin-top: 10px;\">
								<small style=\"width: {$percent}%;\"></small>
							</div>
							<span class=\"quota\"><span style='font-weight: bold;'>{$u['used']}</span> {$lang['of']} {$u['max']}</span>
						</td>
						<td style=\"width: 50px; text-align: center;\">
							<a href=\"#\" onclick=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/settings.png\" alt=\"{$lang['update']}\" /></a>
						</td>
					</tr>
		";
	}
	
	$content .= "
				</table>
				<br />
				<a class=\"button classic\" href=\"/admin/quotas/refresh_action?id={$user['id']}\" style=\"width: 180px;\">
					<span style=\"display: block; padding-top: 3px;\">{$lang['refresh']}</span>
				</a>
	";
}

$content .= "
			</div>
			<div style=\"width: 350px; float: right;\">
			";


if( security::hasGrant('USER_SELECT') )
{
	$content .= "			
				<h2 class=\"dark\">{$lang['infos']}</h2>
				<form action=\"/admin/users/update_action\" method=\"post\">
					<input type=\"hidden\" name=\"id\" value=\"{$user['id']}\" />
					<fieldset>
						<input style=\"width: 300px;\" type=\"password\" name=\"pass\" />
						<span class=\"help-block\">{$lang['pass_help']}</span>
					</fieldset>
					<fieldset>
						<input style=\"width: 300px;\" type=\"password\" name=\"confirm\" />
						<span class=\"help-block\">{$lang['confirm_help']}</span>
					</fieldset>
					<fieldset>
						<input style=\"width: 300px;\" type=\"text\" name=\"email\" value=\"{$user['email']}\" />
						<span class=\"help-block\">{$lang['email_help']}</span>
					</fieldset>
					<fieldset>
						<input style=\"width: 300px;\" type=\"text\" name=\"firstname\" value=\"{$user['firstname']}\" />
						<span class=\"help-block\">{$lang['firstname_help']}</span>
					</fieldset>
					<fieldset>
						<input style=\"width: 300px;\" type=\"text\" name=\"lastname\" value=\"{$user['lastname']}\" />
						<span class=\"help-block\">{$lang['lastname_help']}</span>
					</fieldset>
					<fieldset>
						<input type=\"submit\" value=\"{$lang['update']}\" />
					</fieldset>
				</form>";
}

$content .= "
				<br />
";

if( security::hasGrant('GROUP_USER_SELECT') )
{
	$usergroups = api::send('group/user/list', array('user'=>$_GET['id']));
	if( security::hasGrant('GROUP_SELECT') )
		$groups = api::send('group/list');
	else
		$groups = $usergroups;

	$content .= "
					<h2 class=\"dark\">{$lang['groups']}</h2>
					<form action=\"/admin/users/join_action\" method=\"post\">
						<table>
							<tr>
								<th>{$lang['groupname']}</th>
								<th>{$lang['member']}</th>
							</tr>
	";

	if( security::hasGrant(array('GROUP_USER_INSERT','GROUP_USER_DELETE')) )
		$disabled = '';
	else
		$disabled = 'disabled';

	foreach( $groups as $g )
	{
		$checked = '';
		foreach( $usergroups as $g2 )
		{
			if( $g['id'] == $g2['id'] )
			{
				$checked = 'checked';
				break;
			}
		}

		$content .= "
						<tr>
							<td>{$g['name']}</td>
							<td align=\"center\">
								<input type=\"checkbox\" name=\"group[]\" value=\"{$g['id']}\" {$disabled} {$checked} />
							</td>
						</tr>";
	}

	$content .= "
					</table>
					<input type=\"hidden\" name=\"id\" value=\"{$user['id']}\" />
					<br />
					<input type=\"submit\" value=\"{$lang['update']}\" {$disabled} />
				</form>";
}

$content .= "
			</div>
			<div class=\"clear\"></div><br />
		</div>
		<div id=\"delete\" class=\"floatingdialog\">
			<h3 class=\"center\">{$lang['delete']}</h3>
			<p style=\"text-align: center;\">{$lang['delete_text']}</p>
			<div class=\"form-small\">		
				<form action=\"/admin/users/del_action\" method=\"post\" class=\"center\">
					<input id=\"user\" type=\"hidden\" value=\"\" name=\"user\" />
					<fieldset autofocus>	
						<input type=\"submit\" value=\"{$lang['delete_now']}\" />
					</fieldset>
				</form>
			</div>
		</div>
		<script>
			newFlexibleDialog('delete', 550);
		</script>	
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>