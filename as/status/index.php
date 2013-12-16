<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$fh = fopen('http://api.uptimerobot.com/getMonitors?apiKey=u102417-82bbcad11f83f7381f66421f&format=json&customUptimeRatio=7-30-365&logs=1', 'r');
$response = stream_get_contents($fh);
fclose($fh);

$response = json_decode(str_replace(array('jsonUptimeRobotApi(', ')'), array('', ''), $response), true);

foreach( $response['monitors'] as $m )
{
	if( $m[0]['id'] == '775978448' )
	{
		$expl = explode('-', $m[0]['customuptimeratio']);
		$up7 = $expl[0];
		$up30 = $expl[1];
		$up365 = $expl[2];
		
		$logs = $m[0]['log'];
	}
}

$content = "
		<div id=\"content\">
			<br /><br />
			<div class=\"title\" style=\"margin-bottom: 15px;\">{$lang['online']}</div>
			<div class=\"subtitle\" style=\"margin-top: 5px; font-size: 15px;\">".date('M d Y H:i')."</div>
			<br />
			<div style=\"width: 800px; margin: 0 auto; color: #ffffff; text-align: center; font-size: 14px; line-height: 20px;\">
				{$lang['monitor']}
			</div>
			<br /><br /><br />
			<div style=\"float: left;\">
				<div class=\"fillgraph\">
					<div class=\"fill\" style=\"width: {$up30}%;\"></div>
				</div>
				<span style=\"color: #ffffff; text-align: center; display: block; margin: 0 auto; margin-top: 5px; font-size: 14px;\">{$lang['30days']} <span style=\"font-weight: bold;\">{$up30}%</span></span>
			</div>
			<div style=\"float: right;\">
				<div class=\"fillgraph\">
					<div class=\"fill\" style=\"width: {$up365}%;\"></div>
				</div>
				<span style=\"color: #ffffff; text-align: center; display: block; margin: 0 auto; margin-top: 5px; font-size: 14px;\">{$lang['365days']} <span style=\"font-weight: bold;\">{$up365}%</span></span>
			</div>
		</div>
		<div id=\"clouds\">
			<div class=\"container\" style=\"background-color: #f0f0f0;\">
				<div class=\"wrapper\" style=\"padding-top: 40px;\">
					<div style=\"float: left; width: 500px;\">
						<h3>{$lang['last7days']}</h3>
						<br />
";

for( $i = 0; $i < 7; $i++ )
{
	$current = strtotime(date('Y-m-d',strtotime('-' . $i . ' days')).' 00:00:00');
	$currentend = strtotime(date('Y-m-d',strtotime('-' . ($i-1) . ' days')).' 00:00:00');
	
	$dated = date('d', strtotime(date('Y-m-d',strtotime('-' . $i . ' days')).' 00:00:00'));
	$datem = date('M', strtotime(date('Y-m-d',strtotime('-' . $i . ' days')).' 00:00:00'));
	
	$problems = array();
	foreach( $logs as $l )
	{
		$time = strtotime($l['datetime']);
		if( $time > $current && $time < $currentend )
			$problems[] = array('type'=>$l['type'], 'timestamp'=>$time);
	}
		
	$content .= "
						<div style=\"clear: left; padding: 10px 15px 0px 15px; margin: 0; background-color: #ffffff; \">
							<span class=\"smalldate ".(count($problems)>0?"yellow":"")."\">{$dated}<br />{$datem}</span>
							<span style=\"display: block; float: left; padding: 0 0px 0px 20px; width: 300px;\">
	";

if( count($problems) > 0 )
{
	foreach( $problems as $p )
	{
		$content .= "
								<span style=\"font-size: 13px; display: block;\">".date('H:i', $p['timestamp'])." CET</span>
								<span style=\"font-size: 11px; display: block; margin: 5px 0 10px 0;\">".$lang['status_' . $p['type']]."</span>
		";
	}
}	
else
	$content .= "{$lang['24up']}<span style=\"font-size: 12px; margin-top: 8px; display: block;\">{$lang['allrunning']}</span>";

$content .= "
							
							</span>
							<div class=\"clearfix\"></div>
						</div>
						<div class=\"clearfix\"></div>
						
	";
}

$content .= "
					</div>
					<div style=\"float: right; width: 500px;\">
						<h3>{$lang['paasstats']}</h3>
						<br />
						<div style=\"text-align: center;\">
							<img src=\"http://munin.anotherservice.com/AS-Nodes/anotherservice.com/traffic-day.png\">
							<br /><br />
							<img src=\"http://munin.anotherservice.com/AS-Nodes/anotherservice.com/cpu-day.png\">
							<br /><br />
							<img src=\"http://munin.anotherservice.com/AS-Nodes/anotherservice.com/memory-day.png\">
						</div>
					</div>
				</div>			
				<div class=\"clearfix\"></div>
			</div>
		</div>
		
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>