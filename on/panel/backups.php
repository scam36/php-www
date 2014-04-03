<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$backups = api::send('self/backup/list');
$sites = api::send('self/site/list');
$databases = api::send('self/database/list');

$content = "
			<div class=\"panel\">
				<div class=\"top\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div class=\"clear\"></div><br />
				<div class=\"container\">
";

if( count($backups) > 0 )
{
	$content .= "
					<table>
						<tr>
							<th style=\"text-align: center; width: 40px;\">#</th>
							<th>{$lang['type']}</th>
							<th>{$lang['name']}</th>
							<th>{$lang['date']}</th>
							<th style=\"width: 100px; text-align: center;\">{$lang['actions']}</th>
						</tr>";

	foreach( $backups as $b )
	{		
		$content .= "
						<tr>
							<td style=\"text-align: center; width: 40px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/{$b['type']}.png\" /></td>
							<td>".$lang['type_' . $b['type']]."</td>
							<td><span style=\"font-weight: bold;\">{$b['title']}</span></td>
							<td>".date($lang['dateformat'], $b['date'])."</td>
							<td style=\"width: 100px; text-align: center;\">
								<a href=\"{$b['url']}\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/download2.png\" alt=\"\" /></a>
								<a href=\"#\" onclick=\"$('#id').val('{$b['id']}'); $('#delete').dialog('open'); return false;\" title=\"\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/close.png\" alt=\"\" /></a>
							</td>
						</tr>
		";
	}
	
	$content .= "
					</table>
	";
}
else
{
	$content .= "
					<span style=\"font-size: 16px;\">{$lang['nobackup']}</span><br /><br />
					<a class=\"button classic\" href=\"/doc/backups\" style=\"width: 140px;\">
						<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['doc']}</span>
					</a>";
	
}

$content .= "
				</div>
			</div>
			<div id=\"new\" class=\"floatingdialog\">
				<h3 class=\"center\">{$lang['new']}</h3>
";
if( count($sites) > 0 )
{
	$content .= "
				<p style=\"text-align: center;\">{$lang['new_text']}</p>
				<div class=\"form-small\">		
					<form action=\"/panel/domains/add_action\" method=\"post\" class=\"center\">
						<fieldset>
							<input class=\"auto\" type=\"text\" value=\"{$lang['name']}\" name=\"domain\" onfocus=\"this.value = this.value=='{$lang['name']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['name']}' : this.value; this.value=='{$lang['name']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
							<span class=\"help-block\">{$lang['tipname']}</span>
						</fieldset>
						<fieldset>
							<select name=\"subdomain\">";
	foreach( $sites as $s )
	{
		$content .= "
								<option value=\"{$s['name']}\">{$s['hostname']}</option>";
	}

	$content .= "							
							</select>
							<span class=\"help-block\">{$lang['tipsite']}</span>
						</fieldset>
						<fieldset>
							<input class=\"auto\" type=\"text\" value=\"{$lang['folder']}\" name=\"dir\" onfocus=\"this.value = this.value=='{$lang['folder']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['folder']}' : this.value; this.value=='{$lang['folder']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
							<span class=\"help-block\">{$lang['foldertip']}</span>
						</fieldset>
						<fieldset autofocus>
							<input type=\"submit\" value=\"{$lang['create']}\" />
						</fieldset>
					</form>
				</div>
	";
}
else
{
	$content .= "
				<p style=\"text-align: center;\">{$lang['nosite']}</p>
	";
}

$content.= "
			</div>
			<div id=\"delete\" class=\"floatingdialog\">
				<h3 class=\"center\">{$lang['delete']}</h3>
				<p style=\"text-align: center;\">{$lang['delete_text']}</p>
				<div class=\"form-small\">		
					<form action=\"/panel/backups/del_action\" method=\"get\" class=\"center\">
						<input id=\"id\" type=\"hidden\" value=\"\" name=\"id\" />
						<fieldset autofocus>	
							<input type=\"submit\" value=\"{$lang['delete_now']}\" />
						</fieldset>
					</form>
				</div>
			</div>
			<script>
				newFlexibleDialog('new', 550);
				newFlexibleDialog('delete', 550);
			</script>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>
