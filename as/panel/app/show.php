<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$app = api::send('self/app/list', array('id'=>$_GET['id'], 'extended'=>1));
$app = $app[0];

if( !$_GET['branch'] && !$_SESSION['DATA'][$app['id']]['branch'] )
	$_SESSION['DATA'][$app['id']]['branch'] = 'master';
else if( $_GET['branch'] )
	$_SESSION['DATA'][$app['id']]['branch'] = $_GET['branch'];

$running = false;
$memory = 0;
$memoryu = 0;
$instances = 0;
foreach( $app['branches'][$_SESSION['DATA'][$app['id']]['branch']]['instances'] as $i )
{
	if( $i['state'] == 'RUNNING' )
		$running = true;
	$memory = $memory+$i['memory']['quota'];
	$memoryu = $memoryu+$i['memory']['usage'];
	$instances++;
}

$content = "
	<div class=\"box nocol\">
		<div class=\"container\">
			<div style=\"float: left; width: 550px; margin-right: 40px;\">
				<h2>{$lang['title']} {$app['name']}</h2>
				<br />
				<br />
				<h3 class=\"colored\">{$lang['uris']}</h3>
				<br />
				<table>
					<tr>
						<th>{$lang['url']}</th>
						<th>{$lang['branch']}</th>
						<th>{$lang['actions']}</th>
					</tr>
		";
		
		foreach( $app['branches'] as $key => $value )
		{
			if( $value['urls'] )
			{
				foreach( $value['urls'] as $u )
				{		
					$content .= "
					<tr>
						<td><a href=\"http://{$u}\">{$u}</a></td>
						<td>{$key}</a></td>
						<td align=\"center\">
							<a href=\"/panel/app/del_url_action?id={$app['id']}&url={$u}&branch={$key}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
						</td>
					</tr>
					";
				}
			}
		}
		
		$content .= "
				</table>
				<br />
				<a class=\"btn\" href=\"/panel/app/add_url?id={$app['id']}\">{$lang['add_url']}</a>
			</div>
			<div style=\"float: left; width: 470px;\">
				<div style=\"text-align: right;\">
";

foreach( $app['branches'] as $key => $value )
	$content .= "<a href=\"/panel/app/show?id={$app['id']}&branch={$key}\" class=\"btn ".($key==$_SESSION['DATA'][$app['id']]['branch']?"active":"")."\">{$key}</a>&nbsp;&nbsp;&nbsp;";

$content .= "
				</div>
				<br />
				<br />
				<h3 class=\"colored\">{$lang['envs']}</h3>
				<br />
				<table>
					<tr>
						<th>{$lang['branch']}</th>
						<th>{$lang['actions']}</th>
					</tr>
		";
		if( $app['branches'] )
		{
			foreach( $app['branches'] as $key => $value )
			{		
				$content .= "
					<tr>
						<td>{$key}</a></td>
						<td align=\"center\">
							<a href=\"/panel/app/del_env_action?id={$app['id']}&env={$key}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
						</td>
					</tr>
				";
			}
		}
		$content .= "
				</table>
				<br />
				<a class=\"btn\" href=\"/panel/app/add_env?id={$app['id']}\">{$lang['add_env']}</a>		
			</div>
			<div class=\"clearfix\"></div>
			<br />
			<br />
			<div style=\"float: left; width: 550px; margin-right: 40px;\">
				<h2>{$lang['branch']} ".security::encode($_SESSION['DATA'][$app['id']]['branch'])."</h2>
				<br />
				<table>
					<tr>
						<th>{$lang['info']}</th>
						<th>{$lang['data']}</th>
						<th>{$lang['actions']}</th>
					</tr>
					<tr>
						<td>{$lang['memory']}</td>
						<td><span class=\"large\">{$memoryu}Mo</span> / {$memory}Mo</td>
						<td align=\"center\">
							<a href=\"/panel/app/memory_less_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowDown.png\" alt=\"\" /></a>
							<a href=\"/panel/app/memory_plus_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowUp.png\" alt=\"\" /></a>
						</td>
					</tr>
					<tr>
						<td>{$lang['number']}</td>
						<td><span class=\"large\">{$instances}</span> {$lang['instance']}</td>
						<td align=\"center\">
							<a href=\"/panel/app/instance_less_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowDown.png\" alt=\"\" /></a>
							<a href=\"/panel/app/instance_plus_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowUp.png\" alt=\"\" /></a>
						</td>
					</tr>
					<tr>
						<td>{$lang['disk_persistant']}</td>
						<td><span class=\"large\">{$app['size']}Mo</span></td>
						<td align=\"center\">
						</td>
					</tr>
				</table>
			</div>
			<div style=\"float: left; width: 470px;\">
				<div style=\"text-align: right;\">
					<a href=\"/panel/app/rebuild_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" class=\"btn\">{$lang['rebuild']}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/panel/app/start_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" class=\"btn pill-left ".($running?"active":"")."\">{$lang['start']}</a><a href=\"/panel/app/stop_action?id={$app['id']}&branch=".security::encode($_SESSION['DATA'][$app['id']]['branch'])."\" class=\"btn pill-right ".($running?"":"active")."\">{$lang['stop']}</a>
				</div>
				<br />
				<table>
					<tr>
						<th>{$lang['id']}</th>
						<th>{$lang['cpu']}</th>
						<th>{$lang['mem']}</th>
						<th >{$lang['status']}</th>
					</tr>
";
$j = 0;
foreach( $app['branches'][$_SESSION['DATA'][$app['id']]['branch']]['instances'] as $i )
{
	if( $i['state'] == 'RUNNING' )
		$running = true;
	else
		$running = false;
		
	$content .= "
					<tr>
						<td><span class=\"large\">#{$j}</span></td>
						<td>{$i['cpu']['usage']}% / {$i['cpu']['quota']} core</td>
						<td>{$i['memory']['usage']}Mo / {$i['memory']['quota']}Mo</td>
						<td>".($running?"<div class=\"state running\"><div class=\"state-content\">{$lang['running']}</div></div>":"<div class=\"state stopped\"><div class=\"state-content\">{$lang['stopped']}")."</div></div></td>
					</tr>
	";
	$j++;
}
$content .= "
				</table>
			</div>
			<div class=\"clearfix\"></div>
			<br />
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>