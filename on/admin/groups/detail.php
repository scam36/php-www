<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$group = api::send('group/list', array('id'=>$_GET['id']));
if( count($group) == 0 )
	template::redirect('/admin/groups');
$group = $group[0];

$content = "
		<div class=\"admin\">
			<div class=\"top\">
				<div class=\"left\" style=\"padding-top: 5px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div class=\"right\">
					<a class=\"button classic\" href=\"#\" onclick=\"$('#new').dialog('open'); return false;\" style=\"width: 180px; height: 22px; float: right;\">
						<img style=\"float: left;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/plus-white.png\" />
						<span style=\"display: block; padding-top: 3px;\">{$lang['add']}</span>
					</a>
				</div>
			</div>
			<div class=\"clear\"></div><br />
			<div class=\"container\">
				<div style=\"width: 350px; float: left;\">
";

if( security::hasGrant('GRANT_GROUP_SELECT') )
{
	$groupgrants = api::send('grant/group/list', array('group'=>$_GET['id']));
	if( security::hasGrant('GRANT_SELECT') )
		$grants = api::send('grant/list');
	else
		$grants = $groupgrants;
	
	$content .= "
						<form action=\"/admin/groups/grant_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget\">
									<div class=\"head\">
										<h5 class=\"iKey\">{$lang['grants']}</h5>
										<div class=\"icon\"><input type=\"checkbox\" name=\"foo\" value=\"bar\" /></div>
									</div>
									<div style=\"max-height: 350px; overflow-y: auto;\">
									<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\" id=\"grantList\">
										<thead>
											<tr>
												<td align=\"center\">{$lang['grantname']}</td>
												<td align=\"center\">{$lang['granted']}</td>
											</tr>
										</thead>
										<tbody>";

	if( security::hasGrant(array('GRANT_GROUP_INSERT','GRANT_GROUP_DELETE')) )
		$disabled = '';
	else
		$disabled = 'disabled';

	foreach( $grants as $g )
	{
		$checked = '';
		foreach( $groupgrants as $k )
		{
			if( $g['id'] == $k['id'] )
			{
				$checked = 'checked';
				break;
			}
		}
		
		$content .= "
											<tr class=\"gradeA\">
												<td>{$g['name']}</td>
												<td align=\"center\">
													<input type=\"checkbox\" name=\"grant[]\" value=\"{$g['id']}\" {$disabled} {$checked} />
												</td>
											</tr>";
	}

	$content .= "
										</tbody>
									</table>
									</div>
									<div class=\"fix\"></div>
									<input type=\"hidden\" name=\"id\" value=\"{$group['id']}\" />
									<input type=\"submit\" value=\"{$lang['update']}\" {$disabled} class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>";
}

$content .= "
					</div>
					
					<div class=\"right\">";
					
if( security::hasGrant('GROUP_UPDATE') )
{
	$content .= "
						<form action=\"/admin/groups/update_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\"><h5 class=\"iRefresh3\">{$lang['rename']}</h5></div>
									<div class=\"rowElem\"><label>{$lang['name']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"name\" /></div>
										<div class=\"fix\"></div>
									</div>
									<input type=\"hidden\" name=\"id\" value=\"{$group['id']}\" />
									<input type=\"submit\" value=\"{$lang['rename']}\" class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>";
}

$content .= "
					</div>
				</div>
			</div>";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>