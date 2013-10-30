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
				<h1>{$lang['about']}</h1>
				<img class=\"icon-right\" style=\"border: 3px solid #e5e5e5; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/illustrations/services.png\" alt=\"intro\" />
				<p class=\"large\">{$lang['intro']}</p>
				<hr>
				<h1>{$lang['legal']}</h1>
				<p class=\"large\">{$lang['legal_text']}</p>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<h1>{$lang['info']}</h1>
				<p>
					<span class=\"lightlarge\">{$lang['owner']}</span> :<br /><span class=\"large\">Samuel Hassine</span>
				</p>
				<br />
				<h2>{$lang['sys']}</h2>
				<p class=\"large\">
					<i>SIRET</i> : 52174593500010<br />
					<i>RCS</i> : Marseille B 521 745 935<br />
					<i>Capital social</i> : 10.000 euros
				</p>
				<br />
				<h2>{$lang['address']}</h2>
				<p class=\"large\">
					<strong>S.Y.S SAS - Another Service</strong><br />
					19 chemin de Ch&acirc;teau Gombert<br />
					13013 Marseille
				</p>
				<br />
				<h2>{$lang['legal2']}</h2>
				<p class=\"large\">{$lang['legal2_text']}</p>
				<a class=\"btn\" href=\"/{$GLOBALS['CONFIG']['SITE']}/documents/SYS-CGS.pdf\">{$lang['go']}</a>	
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>