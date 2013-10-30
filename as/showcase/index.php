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
				{$lang['title']}
			</div>
		</div>
		<div class=\"left\">
			<div class=\"container\">
				<h1>{$lang['showcase']}</h1>
				<br />
				<div class=\"showcase\">
					<h2>Phidias</h2>
					<a href=\"http://www.phidias.fr\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/phidias.png\" alt=\"phidias\" /></a>
				</div>
				<div class=\"showcase\">
					<h2>Centre Dentaire</h2>
					<a href=\"http://www.centre-dentaire-marseille.fr\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/cdm.png\" alt=\"cdm\" /></a>
				</div>
				<div class=\"showcase\">
					<h2>Internethic</h2>
					<a href=\"http://www.internethic.com\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/internethic.png\" alt=\"internethic\" /></a>
				</div>
				<div class=\"clearfix\" style=\"height: 20px;\"></div>
				<div class=\"showcase\">
					<h2>Truffi&egrave;res de Rabasse</h2>
					<a href=\"http://www.rabasse.com\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/showcases/tdr.png\" alt=\"tdr\" /></a>
				</div>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<h2>{$lang['projects']}</h2>
				<div style=\"text-align: center;\">
					<a href=\"http://www.bus-it.com\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/projects/busit.png\" alt=\"\" /></a><br />
					<p>{$lang['busit']}</p>
				</div>
				<div style=\"text-align: center;\">
					<a href=\"http://www.olympe.in\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/projects/olympe.png\" alt=\"\" /></a><br />
					<p>{$lang['olympe']}</p>
				</div>		
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>