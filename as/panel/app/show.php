<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$app = api::send('self/app/list', array('id'=>$_GET['id']));
$app = $app[0];

$running = false;
$memory = 0;
$disk = 0;
$memoryu = 0;
$disku = 0;
foreach( $app['instances'] as $i )
{
	if( $i['state'] == 'RUNNING' )
		$running = true;
	$memory = $memory+$i['memory']['quota'];
	$memoryu = $memoryu+$i['memory']['usage'];
	$disk = $disk+$i['disk']['quota'];
	$disku = $disku+$i['disk']['usage'];
}
$memory = round($memory/1024/1024);
$memoryu = round($memoryu/1024);
$disk = round($disk/1024/1024);
$disku = round($disku/1024/1024);
$instances = count($app['instances']);
	
$content = "
	<div class=\"box nocol\">
		<div class=\"container\">
			<div style=\"float: left; width: 450px; margin-right: 40px;\">
				<h2>{$lang['title']} :: {$app['name']}</h2>
				<span class=\"lightlarge\"><strong>{$lang['pers']}</strong> {$app['homeDirectory']}/files</span>
				<br />
				<br />
				<h3 class=\"colored\">{$lang['infos']}</h3>
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
							<a href=\"/panel/app/memory_less_action?id={$app['id']}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowDown.png\" alt=\"\" /></a>
							<a href=\"/panel/app/memory_plus_action?id={$app['id']}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowUp.png\" alt=\"\" /></a>
						</td>
					</tr>
					<tr>
						<td>{$lang['number']}</td>
						<td><span class=\"large\">{$instances}</span> {$lang['instance']}</td>
						<td align=\"center\">
							<a href=\"/panel/app/instance_less_action?id={$app['id']}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowDown.png\" alt=\"\" /></a>
							<a href=\"/panel/app/instance_plus_action?id={$app['id']}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/arrowUp.png\" alt=\"\" /></a>
						</td>
					</tr>
					<tr>
						<td>{$lang['disk_eph']}</td>
						<td><span class=\"large\">{$disku}Mo</span> / {$disk}Mo</td>
						<td align=\"center\">
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
			<div style=\"float: left; width: 450px;\">
				<div style=\"text-align: right;\">
					<a href=\"/panel/app/start_action?id={$app['id']}\" class=\"btn pill-left ".($running?"active":"")."\">{$lang['start']}</a><a href=\"/panel/app/stop_action?id={$app['id']}\" class=\"btn pill-right ".($running?"":"active")."\">{$lang['stop']}</a>
					<a href=\"/panel/app/restart_action?id={$app['id']}\" class=\"btn icon\">{$lang['restart']}</a>
				</div>
				<br />
				<br />
				<h3 class=\"colored\">{$lang['instances']}</h3>
				<br />
				<table>
					<tr>
						<th>{$lang['id']}</th>
						<th>{$lang['cpu']}</th>
						<th>{$lang['mem']}</th>
						<th>{$lang['disk']}</th>
						<th >{$lang['status']}</th>
					</tr>
";
$j = 0;
foreach( $app['instances'] as $i )
{
	$mem = round($i['memory']['quota']/1024/1024);
	$memu = round($i['memory']['usage']/1024);
	$dsk = round($i['disk']['quota']/1024/1024);
	$dsku = round($i['disk']['usage']/1024/1024);
	if( $i['state'] == 'RUNNING' )
		$running = true;
	else
		$running = false;
		
	$content .= "
					<tr>
						<td><span class=\"large\">#{$j}</span></td>
						<td>{$i['cpu']['usage']}% / {$i['cpu']['quota']} cores</td>
						<td>{$memu}Mo / {$mem}Mo</td>
						<td>{$dsku}Mo / {$dsk}Mo</td>
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
			<div style=\"float: left; width: 450px; margin-right: 40px;\">
				<h3 class=\"colored\">{$lang['uris']}</h3>
				<br />
				<table>
					<tr>
						<th>{$lang['url']}</th>
						<th>{$lang['actions']}</th>
					</tr>
		";
		if( $app['uris'] )
		{
			foreach( $app['uris'] as $url )
			{		
				$content .= "
						<tr>
							<td><a href=\"http://{$url}\">{$url}</a></td>
							<td align=\"center\">
								<a href=\"/panel/app/del_url_action?id={$app['id']}&url={$url}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
							</td>
						</tr>
				";
			}
		}
		$content .= "
				</table>
				<br />
				<a class=\"btn\" href=\"/panel/app/add_url?id={$app['id']}\">{$lang['add_url']}</a>
			</div>
			<div style=\"float: left; width: 450px;\">	
				<h3 class=\"colored\">{$lang['services']}</h3>
				<br />
				<table>
					<tr>
						<th>{$lang['name']}</th>
						<th>{$lang['actions']}</th>
					</tr>
";
$j = 0;
if( $app['services'] )
{
	foreach( $app['services'] as $s )
	{	
		$content .= "
						<tr>
							<td>{$s}</td>
							<td align=\"center\">
								<a href=\"/panel/app/del_service_action?id={$app['id']}&service={$s}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
							</td>
						</tr>
		";
	}
}
$content .= "
				</table>
				<br />
				<a class=\"btn\" href=\"/panel/app/add_service?id={$app['id']}\">{$lang['add_service']}</a>
			</div>
			<div class=\"clearfix\"></div>
			<br />
			<div>
				<h3 class=\"colored\">{$lang['envs']}</h3>
				<br />
				<table>
					<tr>
						<th>{$lang['name']}</th>
						<th>{$lang['domain']}</th>
						<th>{$lang['actions']}</th>
					</tr>
		";
		if( $app['envs'] )
		{
			foreach( $app['envs'] as $e )
			{
				$domain = array_reverse(explode('/', $app['homeDirectory']));
				$domain = str_replace(array("{$app['name']}/Apps/", "/dns/", "/"), array("", "", "."), implode('/', $domain));
				
				$content .= "
						<tr>
							<td>{$e}</td>
							<td>{$e}.{$domain}</td>
							<td align=\"center\">
								<a href=\"/panel/app/del_env_action?id={$app['id']}&env={$e}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/close.png\" alt=\"\" /></a>
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
			<h3 class=\"colored\">{$lang['infos']}</h3>
			<br />
			<pre>{$lang['git']} ssh://anotherservice.com{$app['homeDirectory']}.git
			</pre>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>