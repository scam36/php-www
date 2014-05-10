<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$users = api::send('user/list', array('limit' => 10, 'order'=>'user_date', 'order_type'=>'DESC'));
$overquotas = api::send('quota/nearlimit', array('quota'=>'BYTES'));

$content = "
	<div class=\"admin\">
		<div class=\"top\">
			<div class=\"left\" style=\"padding-top: 5px;\">
				<h1 class=\"dark\">{$lang['title']}</h1>
			</div>

		</div>
		<div class=\"clear\"></div><br />
		<div class=\"container\">
			<div>
				<h3 class=\"colored\">{$lang['overquota']}</h3>
				<table>
					<tr>
						<th style=\"width: 10%; text-align: center;\">#</th>
						<th style=\"width: 30%; text-align: center;\">{$lang['username']}</th>
						<th style=\"width: 10%; text-align: center;\">{$lang['disk']}</th>
						<th style=\"width: 10%; text-align: center;\">{$lang['max']}</th>
						<th style=\"width: 30%; text-align: center;\">{$lang['lastupdate']}</th>
						<th style=\"width: 10%; \">&nbsp;</th>
					</tr>
";

$i = 0;

if( security::hasGrant('QUOTA_USER_SELECT') )
{
foreach( $overquotas as $o )
{
	$user = api::send('user/list', array('id'=>$o['id']));
	$user = $user[0];
	
	$size = $user['size'];
	$size = $o['quotas']['used']-$size;
	
	if ( $size >= $o['quotas']['max'] )  
	{
	$content .= "
					<tr>
						<td style=\"width: 40px; text-align: center;\"><a href=\"/admin/users/detail?id={$o['id']}\"><img style=\"width: 30px; height: 30px;\" src=\"".(file_exists("{$GLOBALS['CONFIG']['SITE']}/images/users/{$o['id']}.png")?"/{$GLOBALS['CONFIG']['SITE']}/images/users/{$o['id']}.png":"/{$GLOBALS['CONFIG']['SITE']}/images/users/user.png")."\" /></a></td>
						<td><a href=\"/admin/users/detail?id={$o['id']}\">{$o['name']}</a></td>
						<td>{$size}</td>
						<td>{$o['quotas']['max']}</td>
						<td>".date($lang['dateformat'], $user['last'])."</td>
						<td><div style=\"float: right; width: 40px;\">
						<a class=\"button classic\" href=\"/admin/overquota/refresh_action?id={$user['id']}\" style=\"width: 22px; height: 22px; float: right;\">
						<img style=\"float: left;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/refresh-white.png\" alt=\"\" />
						</a>
						</div></td>
					</tr>
	";

	$i++;
	}
	
		//if( $o['quotas']['used'] <= "4000" )
		if ( $i > 49 )
		break;
}
}

$content .= "
				</table>
			</div>
";


$content .= "

			<div class=\"clear\"></div>
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>