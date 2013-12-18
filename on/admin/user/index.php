<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$users = api::send('user/list', array('fast'=>1, 'quota'=>1));

$content = "
			<script type=\"text/javascript\">
				function confirmDelete(id)
				{
					jConfirm(\"{$lang['confirm_text']}\", \"{$lang['confirm_title']}\", function(r)
					{
						if( r )
							window.location.href = window.location.protocol+'//'+window.location.host+'/admin/user/del_action?id='+id;
					});
					return false;
				}
			</script>
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
						<div class=\"widget first\">
							<div class=\"head\">
								<h5 class=\"iUsers\">{$lang['user']}</h5>
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"userList\">
								<thead>
									<tr>
										<th>{$lang['name']}</th>
										<th>{$lang['date']}</th>
										<th>{$lang['disk']}</th>
										<th>{$lang['max']}</th>
										<th>{$lang['action']}</th>
									</tr>
								</thead>
								<tbody>";
foreach( $users as $u )
{
	$disk_used = 'N/A';
	$disk_max = 'N/A';
	foreach( $u['quotas'] as $q )
	{
		if( $q['id'] == 13 ) // BYTES
		{
			$disk_used = str_pad($q['used'], 4, "0", STR_PAD_LEFT);
			$disk_max = str_pad($q['max'], 4, "0", STR_PAD_LEFT);
			break;
		}
	}
	
	$content .= "
									<tr class=\"gradeA\">
										<td>{$u['name']}</td>
										<td>".date('Y-m-d', $u['date'])."</td>
										<td>{$disk_used}</td>
										<td>{$disk_max}</td>
										<td align=\"center\">
											<a href=\"/admin/user/detail?id={$u['id']}\" title=\"{$lang['manage']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/preview.png\" alt=\"{$lang['manage']}\" /></a>";

	if( security::hasGrant('USER_DELETE') )
	{
		$content .= "
											<a href=\"javascript:void(0);\" onclick=\"confirmDelete({$u['id']});\" title=\"{$lang['delete']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/close.png\" alt=\"{$lang['delete']}\" /></a>";
	}
	
	$content .= "
										</td>
									</tr>";
}

$content .= "
								</tbody>
							</table>
						</div>
						<script type=\"text/javascript\">
							function tablepaging()
							{
								oTable1 = \$('#userList').dataTable({
									\"bJQueryUI\": true,
									\"sPaginationType\": \"full_numbers\",
									\"sDom\": '<\"\"f>t<\"F\"lp>'
								});
							};
						</script>";
					
if( security::hasGrant('USER_INSERT') )
{
	$content .= "
						<form action=\"/admin/user/add_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\"><h5 class=\"iAdd\">{$lang['add']}</h5></div>
									<div class=\"rowElem\"><label>{$lang['name']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"name\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['pass']}</label>
										<div class=\"formRight\"><input type=\"password\" name=\"pass\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['confirm']}</label>
										<div class=\"formRight\"><input type=\"password\" name=\"confirm\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['email']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"email\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['firstname']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"firstname\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['lastname']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"lastname\" /></div>
										<div class=\"fix\"></div>
									</div>
									<input type=\"submit\" value=\"{$lang['add']}\" class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>";
}

$content .= "
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