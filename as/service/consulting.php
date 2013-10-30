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
				</table>
				<br />
				<h1>{$lang['governance']}</h1>
				<p class=\"large\">{$lang['governance_text']}</p>
				<br />
				<h1>{$lang['manage']}</h1>
				<p class=\"large\">{$lang['manage_text']}</p>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<h2>{$lang['services']}</h2>
				<p class=\"large\">{$lang['services_text']}</p>
				<a class=\"btn\" href=\"/about/contact\">{$lang['contact']}</a>
				<br /><br />
				<h2>{$lang['trust']}</h2>
				<p class=\"large\">{$lang['trust_text']}</p>
				<a class=\"btn\" href=\"/about/reference\">{$lang['more']}</a>
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>