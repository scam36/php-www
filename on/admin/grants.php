<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$grants = api::send('grant/list');

$content = "
		<div class=\"admin\">
			<div class=\"top\">
				<div class=\"left\" style=\"padding-top: 5px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div class=\"right\">
					<a class=\"button classic\" href=\"#\" onclick=\"$('#new').dialog('open'); return false;\" style=\"width: 180px; height: 22px; float: right;\">
						<img style=\"float: left;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/plus-white.png\" />
						<span style=\"display: block; padding-top: 3px;\">{$lang['add']}</span>
					</a>
				</div>
			</div>
			<div class=\"clear\"></div>
			<div class=\"content\">
				<table>
					<tr>
						<th>{$lang['name']}</th>
						<th style=\"width: 100px; text-align: center;\">{$lang['action']}</th>
					</tr>
";

foreach( $grants as $g )
{
	$content .= "
					<tr>
						<td>{$g['name']}</td>
						<td style=\"width: 100px; text-align: center;\">
							<a href=\"/admin/grants/detail?id={$g['id']}\" title=\"{$lang['manage']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/preview.png\" alt=\"{$lang['manage']}\" /></a>";

	if( security::hasGrant('GRANT_DELETE') )
	{
		$content .= "
											<a href=\"/admin/grants/del_action?id={$g['id']}\"><img class=\"link\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/large/close.png\" alt=\"{$lang['delete']}\" /></a>";
	}
	
	$content .= "
						</td>
					</tr>";
}

$content .= "
				</table>
			</div>
		</div>
		";
					
if( security::hasGrant('GRANT_INSERT') )
{
	$content .= "
		<div id=\"new\" class=\"floatingdialog\">
			<h3 class=\"center\">{$lang['add']}</h3>
			<p style=\"text-align: center;\">{$lang['add_text']}</p>
			<div class=\"form-small\">		
				<form action=\"/admin/grants/add_action\" method=\"post\" class=\"center\">
					<fieldset>
						<input class=\"auto\" type=\"text\" value=\"{$lang['name']}\" name=\"name\" onfocus=\"this.value = this.value=='{$lang['name']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['name']}' : this.value; this.value=='{$lang['name']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						<span class=\"help-block\">{$lang['name_help']}</span>
					</fieldset>
					<fieldset>	
						<input autofocus type=\"submit\" value=\"{$lang['create']}\" />
					</fieldset>
				</form>
			</div>
		</div>";
}

$content .= "
		<script type=\"text/javascript\">
			newFlexibleDialog('new', 550);
		</script>";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>