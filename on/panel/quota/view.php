<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$bill = api::send('self/bill/list', array('id'=>$_GET['id']));
$bill = $bill[0];
$userinfo = api::send('self/whoami');
$userinfo = $userinfo[0];
	
$status = $bill['status'];
	
$content = "
				<h1>{$lang['title']}</h1>
				<div style=\"float: left; width: 200px; margin: 20px;\">
					<strong>Bus IT SAS</strong><br />
					33 rue Mot<br />
					94120 Fontenay-sous-Bois<br />
					FRANCE
				</div>
				<div style=\"float: right; width: 200px; margin: 20px;\">
					<strong>{$userinfo['firstname']} {$userinfo['lastname']}</strong><br />
					{$userinfo['email']}
				</div>
				<div style=\"clear: both;\"></div>
				<h2>{$bill['name']}</h2>
				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" class=\"tableStatic\">
					<tr>
						<th>{$lang['service']}</th>
						<th>{$lang['description']}</th>
						<th>{$lang['time']}</th>
						<th>{$lang['number']}</th>
						<th>{$lang['price']}</th>
						<th>{$lang['vat']}</th>
						<th>{$lang['total_et']}</th>
					</tr>
";

if( count($bill['services']) > 0 )
{
	$vat = array();
	$credits = 0;
	foreach( $bill['services'] as $s )
	{
		$credits = $credits+($s['count']*$s['credits']);
		$content .= "
					<tr>
						<td>{$s['name']}</td>
						<td>{$s['description']}</td>
		";
		if( $s['from'] > 10000 && $s['to'] > 10000 )
			$content .= "<td>{$lang['from']} ".date('d/m/Y', $s['from'])." {$lang['to']} ".date('d/m/Y', $s['to'])."</td>";
		else
			$content .= "<td></td>";
	
	$content .= "
						<td>{$s['count']}</td>
						<td align=\"right\">".number_format($s['price'], 4, ',', ' ')." &euro;</td>
						<td>".number_format($s['vat'], 3, ',', ' ')."%</td>
						<td align=\"right\">".number_format($s['total'], 3, ',', ' ')." &euro;</td>
					</tr>
		";
	}
}
	
$content .= "
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>{$lang['total_et']}</td>
						<td align=\"right\">".number_format($bill['total_et'], 3, ',', ' ')." &euro;</td>						
					</tr>
";

foreach( $bill['vats'] as $key => $value )
{
	$content .= "
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>{$lang['total_vat']} (".number_format($key, 3, ',', ' ')."%)</td>
						<td align=\"right\">".number_format($value, 3, ',', ' ')." &euro;</td>						
					</tr>
	";
}

$content .= "
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>{$lang['total_it']}</td>
						<td align=\"right\">".number_format($bill['total_it'], 3, ',', ' ')." &euro;</td>						
					</tr>
				</table>
				<br /><br />
";

if( $status == 0 )
{
	$content .= "
				<div style=\"float: right;\">
					<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
						<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />
						<input type=\"hidden\" name=\"business\" value=\"contact@bus-it.com\" />  
						<input type=\"hidden\" name=\"currency_code\" value=\"EUR\">  
						<input type=\"hidden\" name=\"item_name\" value=\"{$bill['services'][0]['count']} x {$bill['services'][0]['description']}\" />
						<input type=\"hidden\" name=\"amount\" value=\"".round($bill['total_it'], 2)."\" />
						<input type=\"hidden\" name=\"return\" value=\"https://www.bus-it.com/panel/quota\" />
						<input type=\"hidden\" name=\"cancel_return\" value=\"https://www.bus-it.com/panel/quota\" />
						<input type=\"hidden\" name=\"notify_url\" value=\"https://www.bus-it.com/ipn_paypal\" />
						<input type=\"hidden\" name=\"custom\" value=\"{$bill['id']} {$bill['user']} {$credits}\" />
						<input style=\"width: 118px; height: 47px;\" type=\"image\" src=\"https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_paynowCC_LG.gif\" border=\"0\" name=\"submit\" />
						<img alt=\"\" border=\"0\" src=\"https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif\" width=\"1\" height=\"1\" />
					</form>
				</div>
	";
}

$content .= "
				<p>{$lang['date']} <strong>" . date('Y-m-d H:i:s', $bill['date']) . "</strong><br />
				{$lang['status']} <strong>[ " . $lang['status_' . $status] . " ] </strong></p>
				<div class=\"clearfix\"></div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>