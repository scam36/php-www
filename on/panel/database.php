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
			<div class=\"left\" style=\"width: 500px; padding-top: 5px;\">
				<h1 class=\"dark\">{$lang['databases']}</h1>
			</div>
			<div class=\"right\">
				<a class=\"button classic\" href=\"#\" onclick=\"$('#new').dialog('open');\" style=\"width: 200px; height: 22px; float: right;\">
					<img style=\"float: left;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/plus-white.png\" />
					<span style=\"display: block; padding-top: 3px;\">{$lang['add']}</span>
				</a>
			</div>
		</div>
		<div class=\"clear\"></div><br /><br />
		<div class=\"container\">
";

$j = 1;
foreach( $databases as $d )
{
	$content .= "
			<div class=\"database ".($j==1?"first":"")."\" onclick=\"$('#database').val('{$d['name']}'); $('#desc').val('{$d['desc']}'); $('#config').dialog('open'); return false;\">
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
		<h3 class=\"center\">{$lang['new']}</h3>
		<p style=\"text-align: center;\">{$lang['new_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/database/add_action\" method=\"post\" class=\"center\">
				<fieldset>
					<input class=\"auto\" type=\"text\" value=\"{$lang['desc']}\" name=\"desc\" onfocus=\"this.value = this.value=='{$lang['desc']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['desc']}' : this.value; this.value=='{$lang['desc']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
					<span class=\"help-block\">{$lang['desc_help']}</span>
				</fieldset>
				<fieldset>
					<input class=\"auto\" type=\"password\" value=\"{$lang['password']}\" name=\"password\" onfocus=\"this.value = this.value=='{$lang['password']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['password']}' : this.value; this.value=='{$lang['password']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
					<span class=\"help-block\">{$lang['password_help']}</span>
				</fieldset>
				<fieldset>
					<select name=\"type\">
						<option value=\"mysql\">MySQL 5.5</option>
						<option value=\"postgresql\">PostgreSQL 9.1</option>
					</select>
					<span class=\"help-block\">{$lang['type_help']}</span>
				</fieldset>
				<fieldset>	
					<input autofocus type=\"submit\" value=\"{$lang['create']}\" />
				</fieldset>
			</form>
		</div>
	</div>
	<div id=\"config\" class=\"floatingdialog\">
		<h3 class=\"center\">{$lang['config']}</h3>
		<p style=\"text-align: center;\">{$lang['config_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/database/config_action\" method=\"post\" class=\"center\">
				<input id=\"database\" type=\"hidden\" name=\"database\" value=\"\" />
				<fieldset>
					<input id=\"desc\" type=\"text\" value=\"\" name=\"desc\" />
					<span class=\"help-block\">{$lang['desc_help']}</span>
				</fieldset>
				<fieldset>
					<input type=\"password\" value=\"\" name=\"password\" />
					<span class=\"help-block\">{$lang['password_help']}</span>
				</fieldset>
				<fieldset>	
					<input autofocus type=\"submit\" value=\"{$lang['update']}\" />
					<input type=\"button\" value=\"{$lang['delete']}\" onclick=\"window.location.href='/panel/database/del_action?database={$d['name']}';\"/>
				</fieldset>
			</form>
		</div>
	</div>	
	<script>
		newDialog('new', 550, 450);
		newDialog('config', 550, 410);
	</script>
";


/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>