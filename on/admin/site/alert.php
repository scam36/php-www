<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$site = api::send('site/list', array('id'=>$_GET['id']));
$site = $site[0];

$site['explain'] = unserialize($site['explain']);
$reason = $site['explain']['alert']['reason'];
$message = $lang['alert_'.$reason];
	
if( count($site['explain']['replies'])%2 == 1)
{
	$status = "replied";
	$color = "green";
}
else
{
	$status = "pending";
	$color = "red";
}
	
$content = "
			<script type=\"text/javascript\">
				function confirmDelete(id1, id2)
				{
					jConfirm(\"{$lang['confirm_text']}\", \"{$lang['confirm_title']}\", function(r)
					{
						if( r )
							window.location.href = window.location.protocol+'//'+window.location.host+'/admin/site/del_action?id='+id1+'&user='+id2;
					});
					return false;
				}
			</script>
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<br />
				<a href=\"/admin/site/valid_action?id={$_GET['id']}\" title=\"\" class=\"btnIconLeft mr10 mt5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/check.png\" alt=\"\" class=\"icon\" /><span>{$lang['valid']}</span></a>
				<a href=\"javascript:void(0);\" onclick=\"confirmDelete({$_GET['id']},{$site['user']['id']});\" title=\"\" class=\"btnIconLeft mr10 mt5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/close.png\" alt=\"\" class=\"icon\" /><span>{$lang['delete']}</span></a>
				<br />
                <div class=\"widget first\">
					<div class=\"head\"><h5 class=\"iHelp\">{$lang['subtitle']} {$site['name']}</h5></div>
					<div class=\"supTicket nobg\">
						<div class=\"issueType\">
							<span class=\"issueInfo\">{$lang['alert']}</span>
                            <span class=\"issueNum\">[ #{$site['id']} ]</span>
                            <div class=\"fix\"></div>
						</div>
						<div class=\"issueSummary\">
							<a href=\"#\" title=\"\" class=\"floatleft\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/alert.png\" alt=\"\" /></a>
							<div class=\"ticketInfo\">
								<ul>
									<li><a href=\"http://{$site['hostname']}\" title=\"\">{$site['hostname']}</a></li>
                                    <li class=\"even\"><strong class=\"{$color}\">[ {$lang[$status]} ]</strong></li>
                                    <li>".(is_numeric($reason)?"{$message}":"{$reason}")."</li>
                                    <li class=\"even\">".date('Y-m-d H:i:s', $site['explain']['alert']['date'])."</li>
                                </ul>
                                <div class=\"fix\"></div>
                            </div>
                            <div class=\"fix\"></div>
						</div> 
					</div>";

if( count($site['explain']['replies']) > 0 )
{
	foreach( $site['explain']['replies'] as $r )
	{
		$author = $r['author'];
		$content .= "
					<div class=\"supTicket nobg\">
						<div class=\"issueType\">
							<span class=\"issueInfo\">{$lang['reply']}</span>
                            <span class=\"issueNum\">[ #{$site['id']} ]</span>
                            <div class=\"fix\"></div>
						</div>
						<div class=\"issueSummary\">
							<a href=\"#\" title=\"\" class=\"floatleft\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/reply.png\" alt=\"\" /></a>
							<div class=\"ticketInfo\">
								<ul>
									<li><a href=\"http://{$site['hostname']}\" title=\"\">{$site['hostname']}</a></li>
                                    <li class=\"even\">{$lang[$author]}</li>
                                    <li>{$r['message']}</li>
                                    <li class=\"even\">".date('Y-m-d H:i:s', $r['date'])."</li>
                                </ul>
                                <div class=\"fix\"></div>
                            </div>
                            <div class=\"fix\"></div>
						</div> 
					</div>
		";
	}
}

$content .= "
				</div>
";

if( $status == 'replied' )
{
	$content .= "
				<form action=\"/admin/site/reply_action\" method=\"post\" class=\"mainForm\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />
					<fieldset>
						<div class=\"widget\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['reply']}</h5></div>
							<div class=\"rowElem noborder\"><label>{$lang['message']}</label><div class=\"formRight\"><textarea style=\"height: 250px;\" type=\"text\" name=\"message\"></textarea></div><div class=\"fix\"></div></div>
							<input type=\"submit\" value=\"{$lang['now']}\" class=\"greyishBtn submitForm\" />
							<div class=\"fix\"></div>
						</div>
					</fieldset>
				</form>
	";
}

$content .= "
			</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
