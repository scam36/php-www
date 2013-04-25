<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$app = api::send('self/app/list', array('id'=>$_GET['id']));
$app = $app[0];

$domains = api::send('self/domains/list');
	
$content = "
	<div class=\"box rightcol\">
		<div class=\"left\">
			<div class=\"container\">
				<h2>{$lang['title']} :: <i>{$app['name']}</i></h2>
				<p class=\"large\">{$lang['intro']}</p>
				<form action=\"/panel/app/add_url_action\" method=\"post\">
					<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />
					<fieldset>
						<label for=\"url\">{$lang['subdomain']}</label>
						<select name=\"url\">";
foreach( $domains as $d )
{
	$content .= "			 <optgroup label=\"{$d['hostname']}\">
								<option value=\"{$d['hostname']}\">{$d['hostname']}</option>
	";

	$subdomains = api::send('self/subdomain/list', array('domain' => $d['hostname']));
	foreach( $subdomains as $s )
		$content .= "			<option value=\"{$s['hostname']}\">{$s['hostname']}</option>";
		
	$content .= " 			</optgroup>";
}

$content .= "
						</select>
					</fieldset>
					<fieldset>
						<label for=\"submit\">&nbsp;</label>
						<input type=\"submit\" value=\"{$lang['add']}\" />
					</fieldset>
				</form>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">	
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>