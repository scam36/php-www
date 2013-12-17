<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$databases = api::send('self/database/list');

$content = "
	<div class=\"panel\">
		<div class=\"top\">
			<div class=\"left\" style=\"width: 550px;\">
				<h1 class=\"dark\" style=\"padding-top: 7px;\">{$lang['databases']}</h1>
				<blockquote><p>{$lang['subtitle']}</p></blockquote>
			</div>
			<div class=\"right\" style=\"width: 550px; float: right; text-align: right;\">
				<a class=\"action addidentity big\" href=\"#\" onclick=\"$('#new').dialog('open'); return false;\">
					{$lang['add']}
				</a>				
			</div>
			<div class=\"clear\"></div>
		</div>
		<div class=\"clear\"></div>
		<br /><br />
		<div class=\"container\">
";

$j = 1;
foreach( $databases as $d )
{
	$content .= "
			<div class=\"database ".($j==1?"first":"")."\" onclick=\"window.location.href='/panel/database/config?id={$d['name']}';\">
				<img style=\"float: left; margin: 10px 15px 0 0;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-{$d['type']}.png\" />
				<span class=\"name\" style=\"margin-top: 25px;\">{$d['name']}</span><br />
				<span class=\"subname\">{$d['desc']}</span>
			</div>
	";
	
	$j++;
	
	if( $j == 5 )
		$j = 1;
}

	$content .= "
		</div>		
	</div>
	<div id=\"new\" class=\"floatingdialog\">
		<h3 class=\"center\">{$lang['newidentity']}</h3>
		<p style=\"text-align: center;\">{$lang['newidentity_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/identity/add_action\" method=\"post\" class=\"center\">
				<fieldset>
					<input class=\"auto\" type=\"text\" value=\"{$lang['name']}\" name=\"name\" onfocus=\"this.value = this.value=='{$lang['name']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['name']}' : this.value; this.value=='{$lang['name']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
					<span class=\"help-block\">{$lang['name_help']}</span>
				</fieldset>
				<fieldset>	
					<input autofocus type=\"submit\" value=\"{$lang['create']}\" />
				</fieldset>
			</form>
		</div>
	</div>	
	<script>
		newDialog('new', 550, 290);
	</script>
";


/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>