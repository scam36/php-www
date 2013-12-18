<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( $_POST['name'] )
{
	$user = api::send('user/select', array('user'=>$_POST['name']));
	if( count($user) == 0 )
		template::redirect('/admin');
	
	if( count($user) > 1 )
	{
		$content = "
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
								<th>{$lang['ip']}</th>
								<th>{$lang['action']}</th>
							</tr>
						</thead>
						<tbody>";
foreach( $user as $u )
{
	$content .= "
							<tr class=\"gradeA\">
								<td><a href=\"/admin/user/detail?id={$u['id']}\">{$u['name']}</a></td>
								<td>".date('j/n/Y', $u['date'])."</td>
								<td>{$u['ip']}</td>
								<td align=\"center\">
									<a href=\"/admin/user/detail?id={$u['id']}\" title=\"{$lang['manage']}\" class=\"btn14 mr5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/preview.png\" alt=\"{$lang['manage']}\" /></a>
								</td>
							</tr>";
}

$content .= "
						</tbody>
					</table>
				</div>
			</div>
";
	$template->output($content);
	
	}
	else
		$template->redirect('/admin/user/detail?id='.$user[0]['id']);
}
elseif( $_POST['site'] )
{
	$site = api::send('site/select', array('site'=>$_POST['site']));
	if( count($site) == 0 )
		template::redirect('/admin');
		
	$template->redirect('/admin/user/detail?id='.$site[0]['user']['id']);
}
elseif( $_POST['domain'] )
{
	$domain = api::send('domain/select', array('domain'=>$_POST['domain']));
	if( count($domain) == 0 )
		template::redirect('/admin');
		
	$template->redirect('/admin/user/detail?id='.$domain[0]['user']['id']);
}
else
	template::redirect('/admin');

?>
