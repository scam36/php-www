<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$domains = api::send('self/domain/list');

$content = "
			<div class=\"panel\">
				<div class=\"top\">
					<div class=\"left\" style=\"padding-top: 5px;\">
						<h1 class=\"dark\">{$lang['title']}</h1>
					</div>
					<div class=\"right\">

					</div>
				</div>
				<div class=\"clear\"></div><br /><br />
				<div class=\"container\">
					<table>
						<tr>
							<th></th>
							<th>{$lang['domain']}</th>
							<th>{$lang['arecord']}</th>
							<th>{$lang['home']}</th>
							<th>{$lang['actions']}</th>
						</tr>
";

if( count($domains) > 0 )
{
	foreach($domains as $d)
	{
		$arecord = "";
		if( is_array($d['aRecord']) )
		{
			$i = 1;
			$max = count($d['aRecord']);
			foreach( $d['aRecord'] as $a )
			{
				if( $i == $max )
					$arecord .= "{$a}";
				else
					$arecord .= "{$a}, ";
					
				$i++;
			}
		}
		else
			$arecord = $d['aRecord'];
		
		$content .= "
				<tr>
					<td style=\"text-align: center; width: 40px;\"><a href=\"/panel/user/list?domain={$d['hostname']}\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/domain.png\" /></td>
					<td><span style=\"font-weight: bold;\">{$d['hostname']}</span></td>
					<td><span class=\"lightlarge\">{$arecord}</a></td>
					<td>{$d['homeDirectory']}</td>
					<td style=\"width: 35px; text-align: center;\">
						<a href=\"/panel/user/list?domain={$d['hostname']}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/small/settings.png\" alt=\"\" /></a>
					</td>
				</tr>
		";
	}
}
	
$content .= "
						</tbody>
					</table>
				</div>
			</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
