<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$user = api::send('user/list', array('id'=>$_GET['id']));
if( count($user) == 0 )
	template::redirect('/admin');
$user = $user[0];

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']} : {$user['name']}</h5></div>
				<div class=\"widgets\">
					<div class=\"left\">";

if( security::hasGrant('SITE_SELECT') )
{
	$sites = api::send('site/list', array('user'=>$_GET['id']));
	
	$content .= "	
						<div class=\"widget\">
							<div class=\"head\">
								<h5 class=\"iFiles\">{$lang['sites']}</h5>
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\">
								<thead>
									<tr>
										<td align=\"center\">{$lang['site']}</td>
										<td align=\"center\">{$lang['size']}</td>
										<td align=\"center\">{$lang['action']}</td>
									</tr>
								</thead>
								<tbody>";

	foreach( $sites as $s )
	{		
		$content .= "
									<tr class=\"gradeA\">
										<td><a href=\"http://{$s['hostname']}\">{$s['hostname']}</a></td>
										<td><strong><strong class=\"blue\">".str_pad($s['size'], 4, "0", STR_PAD_LEFT)." {$lang['mb']}</strong></strong></td>
										<td>
											<a href=\"/admin/site/delete?id={$s['id']}\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/close.png\" alt=\"\" /></a>
										</td>
									</tr>";
	}

	$content .= "
								</tbody>
							</table>
						</div>
	";
}
					
if( security::hasGrant('GROUP_USER_SELECT') )
{
	$usergroups = api::send('group/user/list', array('user'=>$_GET['id']));
	if( security::hasGrant('GROUP_SELECT') )
		$groups = api::send('group/list');
	else
		$groups = $usergroups;

	$content .= "
						<form action=\"/admin/user/join_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\">
										<h5 class=\"iUsers\">{$lang['groups']}</h5>
									</div>
									<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\" id=\"groupList\">
										<thead>
											<tr>
												<td align=\"center\">{$lang['groupname']}</td>
												<td align=\"center\">{$lang['member']}</td>
											</tr>
										</thead>
										<tbody>";

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
											<tr class=\"gradeA\">
												<td>{$g['name']}</td>
												<td align=\"center\">
													<input type=\"checkbox\" name=\"group[]\" value=\"{$g['id']}\" {$disabled} {$checked} />
												</td>
											</tr>";
	}

	$content .= "
										</tbody>
									</table>
									<div class=\"fix\"></div>
									<input type=\"hidden\" name=\"id\" value=\"{$user['id']}\" />
									<input type=\"submit\" value=\"{$lang['update']}\" {$disabled} class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>";
}

if( security::hasGrant('DOMAIN_SELECT') )
{
	$domains = api::send('domain/list', array('user'=>$_GET['id']));
	
	if( count($domains) > 0 )
	{
		foreach( $domains as $d )
		{
			$content .= "
						<div class=\"widget\">
							<div class=\"head\">
								<h5 class=\"iKey\">{$lang['accounts']} {$d['hostname']}</h5>
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\" id=\"grantList\">
								<thead>
									<tr>
										<td align=\"center\">{$lang['mail']}</td>
										<td align=\"center\">{$lang['size']}</td>
									</tr>
								</thead>
								<tbody>";

			$accounts = api::send('account/list', array('domain'=>$d['hostname'], 'user'=>$_GET['id']));

			if( count($accounts) > 0 )
			{	
				foreach($accounts as $a)
				{
					$content .= "
									<tr class=\"gradeA\">
										<td>{$a['name']}</td>
										<td>{$a['size']} {$lang['mb']}</td>
									</tr>";
				}
			}
			
			$content .= "
								</tbody>
							</table>
						</div>
			";
		}
	}
}

$content .= "</div>";

if( security::hasGrant('USER_SELECT') )
{
	$content .= "					
					<div class=\"right\">
						<form action=\"/admin/user/update_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\"><h5 class=\"iRefresh3\">{$lang['userinfo']}</h5></div>
									<div class=\"rowElem\"><label>{$lang['pass']}</label>
										<div class=\"formRight\"><input type=\"password\" name=\"pass\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['confirm']}</label>
										<div class=\"formRight\"><input type=\"password\" name=\"confirm\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['email']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"email\" value=\"{$user['email']}\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['firstname']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"firstname\" value=\"{$user['firstname']}\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['lastname']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"lastname\" value=\"{$user['lastname']}\" /></div>
										<div class=\"fix\"></div>
									</div>
									<input type=\"hidden\" name=\"id\" value=\"{$user['id']}\" />
									<input type=\"submit\" value=\"{$lang['update']}\" class=\"greyishBtn submitForm\" ".(security::hasGrant('USER_UPDATE')?'':'disabled')." />
									<input type=\"button\" onclick=\"javascript: window.location.href='/admin/user/delete?id={$user['id']}';\" value=\"{$lang['delete']}\" {$disabled} class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>";
}

if( security::hasGrant('TOKEN_SELECT') )
{
	$tokens = api::send('token/list', array('user'=>$_GET['id']));
	
	$content .= "
						<script type=\"text/javascript\">
							function promptToken(id)
							{
								jPrompt(\"{$lang['tokenname']}\", '', \"{$lang['addtoken']}\", function(r)
								{
									if( r )
										window.location.href = window.location.protocol+'//'+window.location.host+'/admin/token/add_action?user={$_GET['id']}&name='+escape(r);
								});
								
								return false;
							}
						</script>
						<div class=\"widget\">
							<div class=\"head\">
								<h5 class=\"iKey\">{$lang['token']}</h5>";
	
	if( security::hasGrant('TOKEN_INSERT') )
	{
		$content .= "<div class=\"icon\"><a href=\"javascript:void(0);\" onclick=\"promptToken()\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/add.png\" alt=\"\" /></a></div>
		<div class=\"icon\"><a href=\"/admin/user/promote_action?user={$_GET['id']}\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/pacman.png\" alt=\"\" /></a></div>";
	}
	
	$content .= "
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\" id=\"userList\">
								<thead>
									<tr>
										<td align=\"center\">{$lang['tokenname']}</td>
										<td align=\"center\">{$lang['tokenvalue']}</td>
										<td align=\"center\">{$lang['action']}</td>
									</tr>
								</thead>
								<tbody>";

	foreach( $tokens as $t )
	{
		$content .= "
									<tr class=\"gradeA\">
										<td>{$t['name']}</td>
										<td>{$t['token']}</td>
										<td align=\"center\">
											<a href=\"/admin/token/apply?user={$user['name']}&token={$t['token']}\" title=\"{$lang['apply']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/arrowUp.png\" alt=\"{$lang['apply']}\" /></a>";
		
		if( security::hasGrant('TOKEN_UPDATE') )
		{
			$content .= "
											<a href=\"/admin/token/detail?user={$_GET['id']}&token={$t['token']}\" title=\"{$lang['update']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/refresh3.png\" alt=\"{$lang['update']}\" /></a>";
		}
		
		if( security::hasGrant('TOKEN_DELETE') )
		{
			$content .= "
											<a href=\"/admin/token/del_action?user={$_GET['id']}&token={$t['token']}\" title=\"{$lang['delete']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/close.png\" alt=\"{$lang['delete']}\" /></a>";
		}
		
		$content .= "
										</td>
									</tr>";
	
	}

	$content .= "
								</tbody>
							</table>
						</div>";
}

if( security::hasGrant('QUOTA_USER_SELECT') )
{
	$userquotas = api::send('quota/user/list', array('user'=>$_GET['id']));
	if( security::hasGrant('QUOTA_SELECT') )
		$quotas = api::send('quota/list');
	else
		$quotas = $userquotas;

	$content .= "
				<script type=\"text/javascript\">
					function delQuota(id)
					{
						jConfirm(\"{$lang['delquota_text']}\", \"{$lang['delquota_title']}\", function(r)
						{
							if( r )
								window.location.href = window.location.protocol+'//'+window.location.host+'/admin/user/del_quota_action?quota='+id+'&user={$_GET['id']}&redirect=/admin/user/detail%3Fid%3D{$_GET['id']}';
						});
						return false;
					}
					
					function setQuota(id, max, used)
					{
						var quotaMax = 0;
						var quotaUsed = 0;
						var promptCode = \"<form class=\\\"mainForm\\\">\"+
							\"<label style=\\\"width: 80px;\\\">{$lang['quota_used']}</label>\"+
							\"<div class=\\\"loginInput\\\"><input type=\\\"text\\\" name=\\\"quota_used_spinner\\\" id=\\\"quota_used_spinner\\\" value=\\\"\"+used+\"\\\" /></div>\"+
							\"<div class=\\\"fix\\\"></div>\"+
							\"<label style=\\\"width: 80px;\\\">{$lang['quota_max']}</label>\"+
							\"<div class=\\\"loginInput\\\"><input type=\\\"text\\\" name=\\\"quota_max_spinner\\\" id=\\\"quota_max_spinner\\\" value=\\\"\"+max+\"\\\" /></div>\"+
							\"<div class=\\\"fix\\\"></div></form>\";
						jConfirm(promptCode, \"{$lang['setquota_title']}\", function(r)
						{
							if( r )
								window.location.href = window.location.protocol+'//'+window.location.host+'/admin/user/set_quota_action?quota='+id+'&user={$_GET['id']}&max='+quotaMax+'&used='+quotaUsed+'&redirect=/admin/user/detail%3Fid%3D{$_GET['id']}';
						});
						
						$(\"#quota_max_spinner\").spinner(
						{
							decimals: 0,
							min: 0,
							max: 100000
						});
						
						$(\"#quota_used_spinner\").spinner(
						{
							decimals: 0,
							min: 0,
							max: 100000
						});
						
						$(\"#popup_ok\").one( 'remove', function(ev)
						{
							if( ev.target === this )
							{
								quotaMax = $(\"#quota_max_spinner\").val();
								quotaUsed = $(\"#quota_used_spinner\").val();
							}
						});
					}
					
					function addQuota(id)
					{
						var quotaMax = 0;
						var promptCode = \"<form class=\\\"mainForm\\\">\"+
							\"<label style=\\\"width: 80px;\\\">{$lang['quota_max']}</label>\"+
							\"<div class=\\\"loginInput\\\"><input type=\\\"text\\\" name=\\\"quota_max_spinner\\\" id=\\\"quota_max_spinner\\\" /></div>\"+
							\"<div class=\\\"fix\\\"></div></form>\";
						jConfirm(promptCode, \"{$lang['addquota_title']}\", function(r)
						{
							if( r )
								window.location.href = window.location.protocol+'//'+window.location.host+'/admin/user/add_quota_action?quota='+id+'&user={$_GET['id']}&max='+quotaMax+'&redirect=/admin/user/detail%3Fid%3D{$_GET['id']}';
						});
						
						$(\"#quota_max_spinner\").spinner(
						{
							decimals: 0,
							min: 0,
							max: 100000
						});
						
						$(\"#popup_ok\").one( 'remove', function(ev)
						{
							if( ev.target === this )
								quotaMax = $(\"#quota_max_spinner\").val();
						});
					}
				</script>
				<div class=\"widget\">
					<div class=\"head\">
						<h5 class=\"iChart8\">{$lang['quota']}</h5>
					</div>
					<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tableStatic\" style=\"width: 100%;\">
						<thead>
							<tr>
								<td style=\"width: 100px;\">{$lang['quotaname']}</td>
								<td>{$lang['quotavalue']}</td>
								<td style=\"width: 100px;\">{$lang['action']}</td>
							</tr>
						</thead>
						<tbody>";
	
	$disabled = array('add'=>'', 'del'=>'', 'set'=>'');
	if( !security::hasGrant('QUOTA_USER_INSERT') )
		$disabled['add'] = 'disabled';
	if( security::hasGrant('QUOTA_USER_DELETE') )
		$disabled['del'] = 'disabled';
	if( security::hasGrant('QUOTA_USER_UPDATE') )
		$disabled['set'] = 'disabled';

	foreach( $quotas as $q )
	{
		$current = null;
		foreach( $userquotas as $uq )
		{
			if( $uq['id'] == $q['id'] )
			{
				$current = $uq;
				break;
			}
		}

		$content .= "
							<tr>
								<td>{$q['name']}</td>
								<td>
									<div style=\"position: relative; width: 100%;\">
										<div style=\"float: left; width: 100%; font-weight: bold; font-size: 10px; margin-top: -1px; text-align: center; position: absolute;\">".($current==null?0:$current['used'])." / ".($current==null?0:$current['max'])."</div>
										<div id=\"progressbar_{$q['id']}\"></div>
									</div>
								</td>
								<td align=\"center\">";
		
		if( $current == null )
		{
			$content .= "
									<a href=\"javascript:void(0);\" onclick=\"addQuota({$q['id']});\" title=\"{$lang['addquota']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/add.png\" alt=\"{$lang['addquota']}\" {$disabled['add']} /></a>";
		}
		else
		{
			$content .= "
									<a href=\"javascript:void(0);\" onclick=\"setQuota({$q['id']}, ".($current==null?0:$current['max']).", ".($current==null?0:$current['used']).");\" title=\"{$lang['update']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/refresh3.png\" alt=\"{$lang['update']}\" {$disabled['set']} /></a>
									<a href=\"javascript:void(0);\" onclick=\"delQuota({$q['id']});\" title=\"{$lang['delete']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/close.png\" alt=\"{$lang['delete']}\" {$disabled['del']} /></a>";
		}
		
		$content .= "
								</td>
							</tr>";
	}
	
	$content .= "
							<script type=\"text/javascript\">
								function setProgress()
								{";

	foreach( $quotas as $q )
	{
		$current = null;
		foreach( $userquotas as $uq )
		{
			if( $uq['id'] == $q['id'] )
			{
				$current = $uq;
				break;
			}
		}
		
		$content .= "
									$( \"#progressbar_{$q['id']}\" ).progressbar({value: ".($current==null?0:$current['used']/$current['max']*100)."});";
	}
	
	$content .= "
								}
							</script>
						</tbody>
					</table>
				</div>
				<input type=\"button\" onclick=\"javascript: window.location.href='/admin/quota/refresh_action?id={$user['id']}';\" value=\"{$lang['refresh']}\" class=\"greyishBtn submitForm\" />";
}

if( security::hasGrant('DOMAIN_SELECT') )
{
	$domains = api::send('domain/list', array('user'=>$_GET['id']));
	
	$content .= "	
						<div class=\"widget\">
							<div class=\"head\">
								<h5 class=\"iGlobe\">{$lang['domains']}</h5>
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\">
								<thead>
									<tr>
										<td align=\"center\">{$lang['domain']}</td>
										<td align=\"center\">{$lang['directory']}</td>
									</tr>
								</thead>
								<tbody>";

	foreach( $domains as $d )
	{
		$content .= "
									<tr class=\"gradeA\">
										<td>{$d['hostname']}</td>
										<td>{$d['homeDirectory']}</td>
									</tr>";
	}

	$content .= "
								</tbody>
							</table>
						</div>
	";
}

if( security::hasGrant('DATABASE_SELECT') )
{
	$databases = api::send('database/list', array('user'=>$_GET['id']));
	
	$content .= "	
						<div class=\"widget\">
							<div class=\"head\">
								<h5 class=\"iFiles\">{$lang['databases']}</h5>
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\">
								<thead>
									<tr>
										<td align=\"center\">{$lang['database']}</td>
										<td align=\"center\">{$lang['type']}</td>
									</tr>
								</thead>
								<tbody>";

	foreach( $databases as $d )
	{
		$content .= "
									<tr class=\"gradeA\">
										<td>{$d['name']}</td>
										<td>{$d['type']}</td>
									</tr>";
	}

	$content .= "
								</tbody>
							</table>
						</div>
	";
}

$content .="
					</div>
				</div>
			</div>
			
			// TODO : SUBDOMAINS & SITES & APPS & ACCOUNTS
			
<script type=\"text/javascript\">
	function postInit()
	{
		setProgress();
	}
</script>";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>