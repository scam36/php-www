<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$scount = api::send('site/list', array('count'=>1));
$ucount = api::send('user/list', array('count'=>1));
$dcount = api::send('domain/list', array('count'=>1));

// First graph
$startTime = strtotime("-1 month");
$endTime = time();
$users = api::send('user/list', array('from'=>$startTime, 'to'=>$endTime, 'fast'=>1));
$numbers = array();
$sum = count($users);
$min = $ucount['count']-$sum;

for( $i = $startTime; $i <= $endTime-(3600*24); $i=$i+(3600*24) )
{
	$numbers[$i] = $min;
	foreach( $users as $u )
	{
		if( $u['date'] > $i && $u['date'] < $i+(3600*24))
			$numbers[$i]++;
	}
	$min = $numbers[$i];
}
$daysmax = count($numbers);

// Second graph
$startTime2 = strtotime("-1 year");
$endTime2 = time();
$users2 = api::send('user/list', array('from'=>$startTime, 'to'=>$endTime, 'fast'=>1));
$numbers2 = array();
$sum2 = count($users2);
$min2 = $ucount['count']-$sum2;
for( $i = $startTime2; $i <= $endTime2-(3600*24*30.5); $i=$i+(3600*24*30.5) )
{
	$numbers2[$i] = $min2;
	foreach( $users as $u )
	{
		if( $u['date'] > $i && $u['date'] < $i+(3600*24*30.5) )
			$numbers2[$i]++;
	}
	$min2 = $numbers2[$i];
}
$daysmax2 = count($numbers2);

$content = "
			<div class=\"content\">
				<script type=\"text/javascript\">
					function graphicGen() {
						var number = [];
";

foreach( $numbers as $key => $value )
{
	$content .= "
						number.push([".($key*1000).", {$value}]);
	";
}
$numbermax = $value+20;

 $content .= "
						var number2 = [];
";

foreach( $numbers2 as $key => $value )
{
	$content .= "
						number2.push([".($key*1000).", {$value}]);
	";
}
$numbermax2 = $value+20;

 $content .= "
						var plot = $.plot($(\".chart\"),
						[ { data: number, label: \"{$lang['users_number']}\" } ], {
							series: {
								lines: { show: true },
								points: { show: true }
							},
							grid: { hoverable: true, clickable: true },
							yaxis: { tickDecimals: 0, min: 0, max: {$numbermax} },
							xaxis: { mode: 'time' }
							
						});
	
						var plot2 = $.plot($(\".chart2\"),
						[ { data: number2, label: \"{$lang['users_number']}\" } ], {
							series: {
								lines: { show: true },
								points: { show: true }
							},
							grid: { hoverable: true, clickable: true },
							yaxis: { tickDecimals: 0, min: 0, max: {$numbermax2} },
							xaxis: { mode: 'time' }
							
						});
					}
				</script>
				<div class=\"title\"><h5>{$lang['title']}</h5></div>
				<div class=\"stats\">
					<ul>
						<li><a href=\"/admin/user\" class=\"count grey\" title=\"\">{$ucount['count']}</a><span>{$lang['users']}</span></li>
						<li><a href=\"/admin/site\" class=\"count grey\" title=\"\">{$scount['count']}</a><span>{$lang['sites']}</span></li>
						<li class=\"last\"><a href=\"/admin/domain\" class=\"count grey\" title=\"\">{$dcount['count']}</a><span>{$lang['domains']}</span></li>
					</ul>
					<div class=\"fix\"></div>
				</div>
				<div class=\"widget first\">
					<div class=\"head\"><h5 class=\"iGraph\">{$lang['graph_users']}</h5></div>
					<div class=\"body\">
						<div class=\"chart\"></div>
					</div>
				</div>
				<div class=\"widget first\">
					<div class=\"head\"><h5 class=\"iGraph\">{$lang['graph_users2']}</h5></div>
					<div class=\"body\">
						<div class=\"chart2\"></div>
					</div>
				</div>
			</div>
<script type=\"text/javascript\">
	function postInit()
	{
		try { graphicGen(); } catch ( e ) { }
	}
</script>
";



/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>