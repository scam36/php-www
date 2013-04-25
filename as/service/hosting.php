<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
	<div class=\"box rightcol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
				<div class=\"subhead\">{$lang['subtitle']}</div>
			</div>
		</div>
		<div class=\"left\">
			<div class=\"container\">
				<h2>{$lang['description']}</h2>
				<p class=\"large\">{$lang['description_text']}</p>
				<br />
				<table class=\"offer\">
					<tr>
						<td>
							<h2>{$lang['offer_1_title']}</h2>
							<p>{$lang['offer_1_desc']}</p>
						</td>
						<td>
							<h2>{$lang['offer_2_title']}</h2>
							<p>{$lang['offer_2_desc']}</p>
						</td>
					</tr>
					<tr>
						<td>
							<h2>{$lang['offer_3_title']}</h2>
							<p>{$lang['offer_3_desc']}</p>
						</td>
						<td>
							<h2>{$lang['offer_4_title']}</h2>
							<p>{$lang['offer_4_desc']}</p>
						</td>
					</tr>
					<tr>
						<td>
							<h2>{$lang['offer_5_title']}</h2>
							<p>{$lang['offer_5_desc']}</p>
						</td>
						<td>
							<h2>{$lang['offer_6_title']}</h2>
							<p>{$lang['offer_6_desc']}</p>
						</td>
					</tr>
					<tr>
						<td>
							<h2>{$lang['offer_7_title']}</h2>
							<p>{$lang['offer_7_desc']}</p>
						</td>
						<td>
							<h2>{$lang['offer_8_title']}</h2>
							<p>{$lang['offer_8_desc']}</p>
						</td>
					</tr>
				</table>
				<br />
				<p class=\"large\">{$lang['explain']}</p>
				<br />
				<h2>{$lang['addons']}</h2>
				<br />
				<table class=\"offer\">
					<tr>
						<th>{$lang['service']}</th>
						<th>{$lang['offer_1']}</th>
						<th>{$lang['offer_2']}</th>
						<th>{$lang['offer_3']}</th>
					</tr>
					<tr>
						<td>{$lang['domains']}</td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
					</tr>
					<tr>
						<td>{$lang['mailbox']}</td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
					</tr>
					<tr>
						<td>{$lang['agenda']}</td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
					</tr>
					<tr>
						<td>{$lang['ssl_standard']}</td>
						<td>19 &euro; / {$lang['month']}</td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
					</tr>
					<tr>
						<td>{$lang['ssl_wildcard']}</td>
						<td>79 &euro; / {$lang['month']}</td>
						<td>79 &euro; / {$lang['month']}</td>
						<td><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/notifications/yes.png\" alt=\"\" /></td>
					</tr>
					<tr>
						<td>{$lang['disk']}</td>
						<td>1Go</td>
						<td>10Go</td>
						<td>50Go</td>
					</tr>
					<tr>
						<td>{$lang['trafic']}</td>
						<td>{$lang['unlimited']}</td>
						<td>{$lang['unlimited']}</td>
						<td>{$lang['unlimited']}</td>
					</tr>
					<tr>
						<td>{$lang['repositories']}</td>
						<td>{$lang['all']}</td>
						<td>{$lang['all']}</td>
						<td>{$lang['all']}</td>
					</tr>
					<tr>
						<td>{$lang['ssh']}</td>
						<td>{$lang['scp']}</td>
						<td>{$lang['scp']}</td>
						<td>{$lang['scp']}</td>
					</tr>
					<tr>
						<td>{$lang['antiddos']}</td>
						<td>99 &euro; / {$lang['month']}</td>
						<td>99 &euro; / {$lang['month']}</td>
						<td>99 &euro; / {$lang['month']}</td>
					</tr>
					<tr>
						<td>{$lang['uptime']}</td>
						<td>99%</td>
						<td>99,5%</td>
						<td>99,9%</td>
					</tr>
					<tr>
						<td>{$lang['gti']}</td>
						<td>48 {$lang['hours']}</td>
						<td>24 {$lang['hours']}</td>
						<td>4 {$lang['hours']}</td>
					</tr>
					<tr>
						<td>{$lang['support']}</td>
						<td>100 &euro; / {$lang['hour']}</td>
						<td>100 &euro; / {$lang['hour']}</td>
						<td>100 &euro; / {$lang['hour']}</td>
					</tr>
					<tr>
						<td>{$lang['support_hno']}</td>
						<td>200 &euro; / {$lang['hour']}</td>
						<td>200 &euro; / {$lang['hour']}</td>
						<td>200 &euro; / {$lang['hour']}</td>
					</tr>
				</table>
				<br /><br />
				<h2>{$lang['more_disk']}</h2>
				<br />
				<table class=\"offer\">
					<tr>
						<td>
							<h2>{$lang['dd_1_title']}</h2>
							<p>{$lang['dd_1_desc']}</p>
						</td>
						<td>
							<h2>{$lang['dd_2_title']}</h2>
							<p>{$lang['dd_2_desc']}</p>
						</td>
					</tr>
					<tr>
						<td>
							<h2>{$lang['dd_3_title']}</h2>
							<p>{$lang['dd_3_desc']}</p>
						</td>
						<td>
							<h2>{$lang['dd_4_title']}</h2>
							<p>{$lang['dd_4_desc']}</p>
						</td>
					</tr>
					<tr>
						<td>
							<h2>{$lang['dd_5_title']}</h2>
							<p>{$lang['dd_5_desc']}</p>
						</td>
						<td>
							<h2>{$lang['dd_6_title']}</h2>
							<p>{$lang['dd_6_desc']}</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<div style=\"text-align: center;\">
					<a href=\"http://www.openstack.org\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/techno/openstack.png\" alt=\"\" /></a>
					<a href=\"http://www.cloudfoundry.org\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/techno/cloudfoundry.png\" alt=\"\" /></a>
					<a href=\"http://www.ceph.com\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/techno/ceph.png\" alt=\"\" /></a><br />
				</div>
				<br /><br />
				<h2>{$lang['reasons']}</h2>
				<ul class=\"rightmenu\">
					<li>
						<h3 class=\"colored\">{$lang['op']}</h3>
						<p>{$lang['op_text']}</p>
					</li>
					<li>
						<h3 class=\"colored\">{$lang['apps']}</h3>
						<p>{$lang['apps_text']}</p>
					</li>
					<li>
						<h3 class=\"colored\">{$lang['services']}</h3>
						<p>{$lang['services_text']}</p>
					</li>
					<li>
						<h3 class=\"colored\">{$lang['scale']}</h3>
						<p>{$lang['scale_text']}</p>
					</li>
				</ul>
				<br />
				<h2>{$lang['try']}</h2>
				<p class=\"large\">{$lang['try_text']}</p>
				<br />
				<a class=\"btn\" href=\"/join\">{$lang['now']}</a>
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>