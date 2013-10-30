<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
	<div class=\"box rightcol\">
		<div class=\"left\">
			<div class=\"container\">
				<h2>{$lang['title']}</h2>
				<p class=\"large\">{$lang['intro']}</p>
				<form action=\"/panel/domain/add_alias_action\" method=\"post\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['domain']}\" />
					<fieldset>
						<label>{$lang['domain']}</label>
						<input type=\"text\" name=\"domain\" />
						".(isset($_GET['e'])?"<span class=\"help-block\" style=\"color: #bc0000;\">{$lang['error']}</span>":"")."
					</fieldset>
					<fieldset>
						<label>{$lang['type']}</label>
						<select name=\"type\">
							<option value=\"permanent\">Permanente</option>
							<option value=\"transparent\">Transparente</option>
						</select>
					</fieldset>
					<fieldset>
						<label></label>
						<input type=\"submit\" value=\"{$lang['create']}\" />
					</fieldset>
				</form>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<h2>{$lang['doc']}</h2>
				<p class=\"large\">{$lang['doc_text']}</p>
				<a class=\"btn\" href=\"https://projets.anotherservice.com/projects/as-panel/wiki/Gerer_vos_noms_de_domaines\">{$lang['go']}</a>
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
