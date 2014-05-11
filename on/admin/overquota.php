<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$overquotas = api::send('quota/nearlimit', array('quota'=>'BYTES'));

$content = "
	<div class=\"panel\">
		<div class=\"top\">
				<h1 class=\"dark\">{$lang['title']}</h1>
		</div>
		<div class=\"clear\"></div><br />
		<div class=\"container\">
			<table>
				<tr>
					<th style=\"width: 50px; text-align: center;\">#</th>
					<th>{$lang['username']}</th>
					<th>{$lang['disk']}</th>
					<th>{$lang['max']}</th>
					<th>{$lang['lastupdate']}</th>
					<th style=\"width: 50px; text-align: center;\">{$lang['actions']}</th>
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
					<td style=\"width: 50px; text-align: center;\">
						<a href=\"/admin/overquota/refresh_action?id={$user['id']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/refresh4.png\" alt=\"\" /></a>
					</td>
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
";


$content .= "
			<br /><br />
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>