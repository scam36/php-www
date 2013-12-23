<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
			<div class=\"head-light\">
				<div class=\"container\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
			</div>	
			<div class=\"content\">
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/yann.png\" />
				<h3 class=\"colored\">Yann Autissier</h3>
				<br />
				<p class=\"large\">{$lang['yann']}</p>
				<div class=\"clear\"></div>
				<br />
	
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/thomas.png\" />
				<h3 class=\"colored\">Thomas Brugmans</h3>
				<br />
				<p class=\"large\">{$lang['thomas']}</p>
				<div class=\"clear\"></div>
				<br />
	
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/herve.png\" />
				<h3 class=\"colored\">H&eacute;rv&eacute; Cognet</h3>
				<br />
				<p class=\"large\">{$lang['herve']}</p>
				<div class=\"clear\"></div>
				<br />

				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/gael.png\" />
				<h3 class=\"colored\">Ga&euml;l Frouin</h3>
				<br />
				<p class=\"large\">{$lang['gael']}</p>
				<div class=\"clear\"></div>
				<br />
				
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/sam.png\" />
				<h3 class=\"colored\">Samuel Hassine</h3>
				<br />
				<p class=\"large\">{$lang['sam']}</p>
				<div class=\"clear\"></div>
				<br />

				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/bruno.png\" />
				<h3 class=\"colored\">Bruno Million</h3>
				<br />
				<p class=\"large\">{$lang['bruno']}</p>
				<div class=\"clear\"></div>
				<br />
				
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/thomasm.png\" />
				<h3 class=\"colored\">Thomas Morain</h3>
				<br />
				<p class=\"large\">{$lang['thomasm']}</p>
				<div class=\"clear\"></div>
				<br />

				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/gaetan.png\" />
				<h3 class=\"colored\">Ga&euml;tan Parisse</h3>
				<br />
				<p class=\"large\">{$lang['gaetan']}</p>
				<div class=\"clear\"></div>
				<br />
	
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/quentin.png\" />
				<h3 class=\"colored\">Quentin Scoyer</h3>
				<br />
				<p class=\"large\">{$lang['quentin']}</p>
				<div class=\"clear\"></div>
				<br />
				
				<img class=\"photo\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/team/simon.png\" />
				<h3 class=\"colored\">Simon Uyttendaele</h3>
				<br />
				<p class=\"large\">{$lang['simon']}</p>
				<div class=\"clear\"></div>
				<br />
			</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>