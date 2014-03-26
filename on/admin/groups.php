<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$groups = api::send('group/list');

$content = "
		<div class=\"admin\">
			<div class=\"top\">
				<div class=\"left\" style=\"padding-top: 5px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div class=\"right\">
					<a class=\"button classic\" href=\"#\" onclick=\"$('#new').dialog('open');\" style=\"width: 180px; height: 22px; float: right;\">
						<img style=\"float: left;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/plus-white.png\" />
						<span style=\"display: block; padding-top: 3px;\">{$lang['add']}</span>
					</a>
				</div>
			</div>
			<div class=\"clear\"></div><br /><br />
			<div class=\"content\">
				<table>
					<tr>
						<th>{$lang['name']}</th>
						<th style=\"width: 100px; text-align: center;\">{$lang['action']}</th>
					</tr>";
					
foreach( $groups as $g )
{
	$content .= "
					<tr>
						<td>{$g['name']}</td>
						<td style=\"width: 100px; text-align: center;\">
							<a href=\"/admin/groups/detail?id={$g['id']}\" title=\"{$lang['manage']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/preview.png\" alt=\"{$lang['manage']}\" /></a>";

	if( security::hasGrant('GROUP_DELETE') )
	{
		$content .= "
											<a href=\"/admin/groups/del_action?id={$g['id']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/close.png\" alt=\"{$lang['delete']}\" /></a>";
	}
	
	$content .= "
						</td>
					</tr>";
}

$content .= "
				</table>
						</div>
					</div>
						<script type=\"text/javascript\">
							function tablepaging()
							{
								oTable1 = \$('#groupList').dataTable({
									\"bJQueryUI\": true,
									\"sPaginationType\": \"full_numbers\",
									\"sDom\": '<\"\"f>t<\"F\"lp>'
								});
							};
						</script>";
					
if( security::hasGrant('GROUP_INSERT') )
{
	$content .= "
					<div class=\"right\">
						<form action=\"/admin/group/add_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\"><h5 class=\"iAdd\">{$lang['add']}</h5></div>
									<div class=\"rowElem\"><label>{$lang['name']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"name\" /></div>
										<div class=\"fix\"></div>
									</div>
									<input type=\"submit\" value=\"{$lang['add']}\" class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>
					</div>";
}

$content .= "
				</div>
			</div>
<script type=\"text/javascript\">
	function postInit()
	{
		try { tablepaging(); } catch ( e ) { }
	}
</script>";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>