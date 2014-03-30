<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$databases2 = api::send('self/database/list');
$sites2 =  api::send('self/site/list');
$domains2 = api::send('self/domain/list');

$me = api::send('self/whoami', array('quota'=>true));
$me = $me[0];

foreach( $me['quotas'] as $q )
{
	switch( $q['name'] )
	{
		case 'BYTES':
			$disk['used'] = $q['used'];
			$disk['max'] = $q['max'];
		break;
		case 'SITES':
			$sites['used'] = $q['used'];
			$sites['max'] = $q['max'];
		break;
		case 'DATABASES':
			$databases['used'] = $q['used'];
			$databases['max'] = $q['max'];
		break;
		case 'MAILS':
			$mails['used'] = $q['used'];
			$mails['max'] = $q['max'];
		break;
	}
}

$percent_disk = $disk['used']*100/$disk['max'];
$percent_sites = $sites['used']*100/$sites['max'];
$percent_databases = $databases['used']*100/$databases['max'];
$percent_mails = $mails['used']*100/$mails['max'];

if( $percent_disk > 100 )
	$percent_disk = 100;
			
if( $disk['used'] >= 1024 )
	$disk['used'] = round($disk['used']/1024, 2) . " {$lang['gb']}";
else
	$disk['used'] = "{$disk['used']} {$lang['mb']}";
if( $disk['max'] >= 1024 )
	$disk['max'] = round($disk['max']/1024, 2) . " {$lang['gb']}";
else
	$disk['max'] = "{$disk['max']} {$lang['mb']}";	

$content = "
		<div class=\"panel\">
			<div class=\"top\">
				<div class=\"left\" style=\"padding-top: 5px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div class=\"right\">
					<a class=\"button classic\" href=\"https://community.olympe.in\" style=\"width: 200px; height: 22px; float: right;\">
						<img style=\"float: left;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/plus-white.png\" />
						<span style=\"display: block; padding-top: 3px;\">{$lang['more']}</span>
					</a>		
				</div>
			</div>
			<div class=\"clear\"></div><br /><br />
			<div class=\"container\">
				<div style=\"float: left; width: 500px;\">
					<span style=\"block; float: left; padding-top: 7px; font-size: 18px; color: #878787;\">{$lang['disk']}</span>
					<div style=\"float: right;\">
						<div class=\"fillgraph\" style=\"margin-top: 10px;\">
							<small style=\"width: {$percent_disk}%;\"></small>
						</div>
						<span class=\"quota\"><span style='font-weight: bold;'>{$disk['used']}</span> {$lang['of']} {$disk['max']}.</span>
					</div>
					<div class=\"clear\"></div><br />
					<span style=\"block; float: left; padding-top: 7px; font-size: 18px; color: #878787;\">{$lang['sites']}</span>
					<div style=\"float: right;\">
						<div class=\"fillgraph\" style=\"margin-top: 10px;\">
							<small style=\"width: {$percent_sites}%;\"></small>
						</div>
						<span class=\"quota\"><span style='font-weight: bold;'>{$sites['used']}</span> {$lang['of']} {$sites['max']}.</span>
					</div>
				</div>
				<div style=\"float: right; width: 500px;\">
					<span style=\"block; float: left; padding-top: 7px; font-size: 18px; color: #878787;\">{$lang['databases']}</span>
					<div style=\"float: right;\">
						<div class=\"fillgraph\" style=\"margin-top: 10px;\">
							<small style=\"width: {$percent_databases}%;\"></small>
						</div>
						<span class=\"quota\"><span style='font-weight: bold;'>{$databases['used']}</span> {$lang['of']} {$databases['max']}.</span>
					</div>
					<div class=\"clear\"></div><br />
					<span style=\"block; float: left; padding-top: 7px; font-size: 18px; color: #878787;\">{$lang['mails']}</span>
					<div style=\"float: right;\">
						<div class=\"fillgraph\" style=\"margin-top: 10px;\">
							<small style=\"width: {$percent_mails}%;\"></small>
						</div>
						<span class=\"quota\"><span style='font-weight: bold;'>{$mails['used']}</span> {$lang['of']} {$mails['max']}.</span>
					</div>
				</div>
				<div class=\"clear\"></div><br />
				<p>* {$lang['explain']}</p>
				<br /><br />
				<h2 class=\"dark\">{$lang['sizes']}</h2>
				<table>
					<tr>
						<th style=\"text-align: center; width: 40px;\">#</th>
						<th>{$lang['name']}</th>
						<th>{$lang['type']}</th>
						<th>{$lang['path']}</th>
						<th>{$lang['size']}</th>
					</tr>
					<tr>
						<td style=\"text-align: center; width: 40px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/ftp.png\" style=\"width: 30px;\" /></td>
						<td>{$lang['cloud']}</td>
						<td>{$lang['cloud_type']}</td>
						<td>/dns/in/olympe/Users/".security::get('USER')."</td>
						<td>0 {$lang['mb']}</td>
					</tr>
";

foreach( $sites2 as $s )
{
	$content .= "
					<tr>
						<td style=\"text-align: center; width: 40px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/ipv6.png\" style=\"width: 30px;\" /></td>
						<td>{$s['hostname']}</td>
						<td>{$lang['site']}</td>
						<td>{$s['homeDirectory']}</td>
						<td>{$s['size']} {$lang['mb']}</td>
					</tr>
	";
}

foreach( $databases2 as $d )
{
	$content .= "
					<tr>
						<td style=\"text-align: center; width: 40px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-{$d['type']}.png\" style=\"width: 30px;\" /></td>
						<td>{$d['name']}</td>
						<td>{$lang['database']} {$d['type']}</td>
						<td>/databases/{$d['name']}</td>
						<td>{$d['size']} {$lang['mb']}</td>
					</tr>
	";
}

foreach( $domains2 as $d )
{
	$users = api::send('self/account/list', array('domain'=>$d['hostname']));
	
	foreach( $users as $u )
	{
		$content .= "
					<tr>
						<td style=\"text-align: center; width: 40px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/user.png\" style=\"width: 30px;\" /></td>
						<td>{$u['mail']}</td>
						<td>{$lang['user']}</td>
						<td>{$u['homeDirectory']}</td>
						<td>{$u['size']} {$lang['mb']}</td>
					</tr>
		";
	}
}

$content .= "
				</table>
			</div>
		</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
