<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$sites = api::send('site/list', array('valid'=>2));

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<div class=\"widgets\">
					<div class=\"left\">
						<form action=\"/admin/search_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\"><h5 class=\"iPreview\">{$lang['search']}</h5></div>
									<div class=\"rowElem\"><label>{$lang['name']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"name\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['site']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"site\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['domain']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"domain\" /></div>
										<div class=\"fix\"></div>
									</div>
									<input type=\"submit\" value=\"{$lang['go']}\" class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>
					</div>
						<script type=\"text/javascript\">
							function tablepaging()
							{
								oTable1 = \$('#siteList').dataTable({
									\"bJQueryUI\": true,
									\"sPaginationType\": \"full_numbers\",
									\"sDom\": '<\"\"f>t<\"F\"lp>'
								});
							};
						</script>";
					
if( security::hasGrant('SITE_SELECT') )
{
	$content .= "
					<script type=\"text/javascript\">
						function confirmDelete(id, user)
						{
							jConfirm(\"{$lang['confirm_text']}\", \"{$lang['confirm_title']}\", function(r)
							{
								if( r )
									window.location.href = window.location.protocol+'//'+window.location.host+'/admin/site/del_action?id='+id+'&user='+user;
							});
							return false;
						}
					</script>
					<div class=\"right\">
						<div class=\"widget first\">
							<div class=\"head\">
								<h5 class=\"iPreview\">{$lang['invalids']}</h5>
							</div>
							<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"siteList\">
								<thead>
									<tr>
										<th>{$lang['site']}</th>
										<th>{$lang['status']}</th>
										<th>{$lang['actions']}</th>
									</tr>
								</thead>
								<tbody>";
	foreach( $sites as $s )
	{
		$s['explain'] = unserialize($s['explain']);
		if( count($s['explain']['replies'])%2 == 1)
		{
			$status = "replied";
			$color = "green";
		}
		else
		{
			$status = "pending";
			$color = "red";
		}
	
		$content .= "
									<tr class=\"gradeA\">
										<td><a href=\"http://{$s['hostname']}\">{$s['name']}</a></td>
										<td><strong class=\"{$color}\">[ {$lang[$status]} ]</strong></td>
										<td align=\"center\">
											<a href=\"/admin/site/alert?id={$s['id']}\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/color/pencil.png\" alt=\"\" /></a>
											<a href=\"/admin/site/valid_action?id={$s['id']}\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/color/thumb-up.png\" alt=\"\" /></a>";

		if( security::hasGrant('SITE_DELETE') )
		{
			$content .= "
											<a href=\"javascript:void(0);\" onclick=\"confirmDelete({$s['id']}, {$s['user']['id']});\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/color/cross.png\" alt=\"\" /></a>";
		}
			
		$content .= "
										</td>
									</tr>";
	}

	$content .= "
								</tbody>
							</table>
						</div>
					</div>
	";
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