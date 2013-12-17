<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$domain = api::send('self/domain/list', array('id'=>$_GET['id']));
$domain = $domain[0];

if( is_array($domain['aRecord']) )
        $domain['aRecord'] = $domain['aRecord'][0];

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>";

if( security::hasGrant('SELF_SUBDOMAIN_SELECT') )
{
	$subdomains = api::send('self/subdomain/list', array('domain'=>$domain['hostname']));

	$content .= "
				<div class=\"widget first\">
					<div class=\"head\"><h5 class=\"iFrames\">{$lang['subtitle']} {$domain['hostname']}</h5>";

	if( security::hasGrant('SELF_SUBDOMAIN_INSERT') )
	{
		$content .= "
						<div class=\"icon\"><a href=\"/panel/domain/add_subdomain?id={$_GET['id']}\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/add.png\" alt=\"\" /></a></div>";
	}

	$content .= "
					</div>
					<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"subdomainList\">
						<thead>
							<tr>
								<th>{$lang['address']}</th>
								<th>{$lang['record']}</th>
								<th>{$lang['actions']}</th>
							</tr>
						</thead>
						<tbody>";

	if( count($subdomains) > 0 )
	{
		foreach( $subdomains as $s )
		{
			$content .= "
							<tr class=\"gradeA\">
								<td>{$s['hostname']}</td>
								<td>{$s['aRecord']}{$s['cNAMERecord']}</td>
								<td align=\"center\">";

			if( security::hasGrant('SELF_SUBDOMAIN_UPDATE') )
			{
				$content .= "
									<a href=\"/panel/domain/config_subdomain?domain_id={$domain['id']}&domain={$domain['hostname']}&id={$s['id']}\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/settings.png\" alt=\"\" /></a>";
			}
		
			if( security::hasGrant('SELF_SUBDOMAIN_DELETE') )
			{
				$content .= "
									<a href=\"javascript:void(0);\" onclick=\"confirmDelete('{$domain['hostname']}',{$s['id']});\" title=\"\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/close.png\" alt=\"\" /></a>";
			}
		
			$content .= "
								</td>
							</tr>";
		}
	}

	$content .= "
						</tbody>
					</table>
				</div>";
}

if( security::hasGrant('SELF_DOMAIN_UPDATE') )
	$disabled = '';
else
	$disabled = 'disabled';

$content .= "
				<form action=\"/panel/domain/config_action\" method=\"post\" class=\"mainForm\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />
					<input type=\"hidden\" name=\"domain\" value=\"{$domain['hostname']}\" />
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['dns']}</h5></div>
							<div class=\"rowElem noborder\"><label>{$lang['mx1']}</label><div class=\"formRight\"><input type=\"text\" value=\"".str_replace('10 ', '', $domain['mxRecord'][0])."\" name=\"mx1\" {$disabled} /></div><div class=\"fix\"></div></div>
							<div class=\"rowElem\"><label>{$lang['mx2']}</label><div class=\"formRight\"><input type=\"text\" value=\"".str_replace('20 ', '', $domain['mxRecord'][1])."\" name=\"mx2\" {$disabled} /></div><div class=\"fix\"></div></div>
							<div class=\"rowElem\"><label>{$domain['hostname']}</label><div class=\"formRight\"><input type=\"text\" value=\"{$domain['aRecord']}\" name=\"domain_arecord\" {$disabled} /></div><div class=\"fix\"></div></div>
							<input type=\"submit\" value=\"{$lang['update']}\" class=\"greyishBtn submitForm\" {$disabled} />
							<div class=\"fix\"></div>
						</div>
					</fieldset>
				</form>
			</div>
<script type=\"text/javascript\">
	function postInit()
	{
		tablepaging1();
	}
</script>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
