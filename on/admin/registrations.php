<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$users = api::send('user/list', array('limit' => 50, 'order'=>'user_date', 'order_type'=>'DESC'));

$content = "
	<div class=\"panel\">
		<div class=\"top\">
			<h1 class=\"dark\">{$lang['title']}</h1>
		</div>
		<br />
		<div class=\"container\">
			<table>
				<tr>
					<th style=\"width: 40px; text-align: center;\">#</th>
					<th>{$lang['username']}</th>
					<th>{$lang['email']}</th>
					<th>{$lang['ip']}</th>
					<th>{$lang['date']}</th>
				</tr>
";

$i = 0;

if( security::hasGrant('QUOTA_USER_SELECT') )
{
foreach( $users as $u )
{
	$content .= "
				<tr>
					<td style=\"width: 40px; text-align: center;\"><a href=\"/admin/users/detail?id={$u['id']}\"><img style=\"width: 30px; height: 30px;\" src=\"".(file_exists("{$GLOBALS['CONFIG']['SITE']}/images/users/{$u['id']}.png")?"/{$GLOBALS['CONFIG']['SITE']}/images/users/{$u['id']}.png":"/{$GLOBALS['CONFIG']['SITE']}/images/users/user.png")."\" /></a></td>
					<td><a href=\"/admin/users/detail?id={$u['id']}\">{$u['name']}</a></td>
					<td>{$u['email']}</td>
					<td>{$u['ip']}</td>
					<td>".date($lang['dateformat'], $u['date'])."</td>
				</tr>
	";
}
}

$content .= "
			</table>
			<br /><br />
		</div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>