<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$database = api::send('self/database/list', array('database'=>$_GET['database']));
$database = $database[0];

$content .= "
	<div class=\"panel\">
		<div class=\"top\">
			<div class=\"left\" style=\"padding-top: 5px; width: 700px;\">
				<h1 class=\"dark\">{$lang['database']} {$database['name']}</h1>
			</div>
			<div class=\"right\" style=\"width: 400px;\">
				<a class=\"button classic\" href=\"#\" onclick=\"$('#name').val('{$database['name']}'); $('#delete').dialog('open'); return false;\" style=\"width: 180px; height: 22px; float: right;\">
					<span style=\"display: block; padding-top: 3px;\">{$lang['delete']}</span>
				</a>
			</div>
		</div>
		<div class=\"clear\"></div><br /><br />
		<div class=\"container\">
			<div style=\"width: 500px; float: left;\">
				<h3 class=\"colored\">{$lang['change_pass']}</h3>
				<form action=\"/panel/databases/password_action\" method=\"post\">
					<input type=\"hidden\" name=\"database\" value=\"".security::encode($_GET['database'])."\" />
					<fieldset>
						<input type=\"password\" name=\"pass\" style=\"width: 400px;\" />
						<span class=\"help-block\">{$lang['password']}</span>
					</fieldset>
					<fieldset>
						<input type=\"password\" name=\"confirm\" style=\"width: 400px;\" />
						<span class=\"help-block\">{$lang['password2']}</span>
					</fieldset>
					<fieldset>
						<input type=\"submit\" value=\"{$lang['update']}\" />
					</fieldset>
				</form>
			</div>
			<div style=\"width: 420px; float: right;\">
				<h3 class=\"colored\">{$lang['change_info']}</h3>
				<form action=\"/panel/databases/config_action\" method=\"post\">
					<input type=\"hidden\" name=\"database\" value=\"".security::encode($_GET['database'])."\" />
					<fieldset>
						<input type=\"text\" name=\"description\" value=\"{$database['desc']}\" style=\"width: 400px;\" />
						<span class=\"help-block\">{$lang['description_help']}</span>
					</fieldset>
					<fieldset>
						<select disabled name=\"\" style=\"width: 415px;\">
							<option value=\"\">MySQL</option>
							<option value=\"\">PostgreSQL</option>
						</select>
						<span class=\"help-block\">{$lang['type_help']}</span>
					</fieldset>
					<fieldset>
						<input type=\"submit\" value=\"{$lang['update']}\" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div id=\"delete\" class=\"floatingdialog\">
		<h3 class=\"center\">{$lang['delete']}</h3>
		<p style=\"text-align: center;\">{$lang['delete_text']}</p>
		<div class=\"form-small\">		
			<form action=\"/panel/databases/del_action\" method=\"get\" class=\"center\">
				<input id=\"name\" type=\"hidden\" value=\"\" name=\"name\" />
				<fieldset autofocus>	
					<input type=\"submit\" value=\"{$lang['delete_now']}\" />
				</fieldset>
			</form>
		</div>
	</div>
	<script>
		newFlexibleDialog('delete', 550);
	</script>	
	";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
