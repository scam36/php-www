<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
		<div class=\"head-light\">
			<div class=\"container\">
				<div style=\"float: left; width: 500px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div style=\"float: right; width: 500px;\">
					<a class=\"button classic\" href=\"/doc\" style=\"float: right; height: 22px; width: 150px; margin: 0 auto;\">
						<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['back']}</span>
					</a>
				</div>
				<div class=\"clear\"></div>
			</div>
		</div>	
		<div class=\"content\">
			<div style=\"float: left; width: 500px;\">
				<h2 class=\"dark\">{$lang['addresses']}</h2>
				<table>
					<tr>
						<th>{$lang['service']}</th>
						<th>{$lang['address']}</th>
					</tr>
					<tr>
						<td>{$lang['webmail']}</td>
						<td><a href=\"https://webmail.olympe.in\">https://webmail.olympe.in</a></td>
					</tr>
					<tr>
						<td>{$lang['cloud']}</td>
						<td><a href=\"https://cloud.olympe.in\">https://cloud.olympe.in</a></td>
					</tr>
					<tr>
						<td>{$lang['pma']}</td>
						<td><a href=\"https://pma.olympe.in\">https://pma.olympe.in</a></td>
					</tr>
					<tr>
						<td>{$lang['ppa']}</td>
						<td><a href=\"https://pma.olympe.in\">https://ppa.olympe.in</a></td>
					</tr>
					<tr>
						<td>{$lang['stats']}</td>
						<td><a href=\"https://stats.olympe.in\">https://stats.olympe.in</a></td>
					</tr>				
				</table>
				<br /><br />
				<h2 class=\"dark\">{$lang['contact']}</h2>
				<table>
					<tr>
						<th>{$lang['service']}</th>
						<th>{$lang['address']}</th>
					</tr>
					<tr>
						<td>{$lang['status']}</td>
						<td><a href=\"https://www.olympe.in/status\">https://www.olympe.in/status</a></td>
					</tr>
					<tr>
						<td>{$lang['community']}</td>
						<td><a href=\"https://community.olympe.in\">https://community.olympe.in</a></td>
					</tr>
					<tr>
						<td>{$lang['incident']}</td>
						<td><a href=\"mailto:hosting@olympe.in\">hosting@olympe.in</a></td>
					</tr>
					<tr>
						<td>{$lang['doc']}</td>
						<td><a href=\"https://www.olympe.in/doc\">https://www.olympe.in/doc</a></td>
					</tr>			
				</table>
			</div>
			<div style=\"float: right; width: 500px;\">
				<h2 class=\"dark\">{$lang['dns']}</h2>
				<table>
					<tr>
						<th>{$lang['serv']}</th>
						<th>{$lang['host']}</th>
						<th>{$lang['ip']}</th>
					</tr>
					<tr>
						<td>{$lang['ns1']}</td>
						<td>ns1.olympe.in</td>
						<td>178.32.167.243</td>
					</tr>
					<tr>
						<td>{$lang['ns2']}</td>
						<td>ns2.olympe.in</td>
						<td>178.32.65.67</td>
					</tr>
				</table>
				<br /><br />
				<h2 class=\"dark\">{$lang['connection']}</h2>
				<table>
					<tr>
						<th>{$lang['service']}</th>
						<th>{$lang['host']}</th>
						<th>{$lang['port']}</th>
					</tr>
					<tr>
						<td>{$lang['ftp']}</td>
						<td>ftp.olympe.in</td>
						<td>21</td>
					</tr>
					<tr>
						<td>{$lang['sftp']}</td>
						<td>ftp.olympe.in</td>
						<td>22</td>
					</tr>
					<tr>
						<td>{$lang['ssh']}</td>
						<td>olympe.in</td>
						<td>22</td>
					</tr>
					<tr>
						<td>{$lang['mysql']}</td>
						<td>sql.olympe.in</td>
						<td>3306</td>
					</tr>
					<tr>
						<td>{$lang['pgsql']}</td>
						<td>sql.olympe.in</td>
						<td>5432</td>
					</tr>
					<tr>
						<td>{$lang['smtp']}</td>
						<td>mail.olympe.in</td>
						<td>25 / 465</td>
					</tr>
					<tr>
						<td>{$lang['pop']}</td>
						<td>mail.olympe.in</td>
						<td>110 / 995</td>
					</tr>
					<tr>
						<td>{$lang['imap']}</td>
						<td>mail.olympe.in</td>
						<td>143 / 993</td>
					</tr>						
				</table>
			</div>
		</div>
		<div class=\"clear\"></div><br />
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>