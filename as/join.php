<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$_SESSION['ANTISPAM'] = md5(time().'olympe');

$content = "
	<div class=\"box rightcol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
				<div class=\"subhead\">{$lang['subtitle']}</div>
			</div>
		</div>
		<div class=\"left\">
			<div class=\"container\">";
			if( $_GET['secret'] == 'secret' )
			{
				$content .= "
				<form action=\"/join_action\" method=\"post\" id=\"valid\" class=\"mainForm\">
					<input type=\"hidden\" name=\"antispam\" value=\"{$_SESSION['ANTISPAM']}\" />
					<input type=\"hidden\" name=\"code\" value=\"{$_GET['code']}\" />
					<fieldset>
						<label for=\"username\">{$lang['username']}</label>
						<input type=\"text\" value=\"{$_SESSION['JOIN_USER']}\" name=\"username\" />
						<span class=\"help-block\">{$lang['usertip']}</span>
					</fieldset>
					<fieldset>						
						<label for=\"email\">{$lang['email']}</label>
						<input type=\"text\" value=\"".($_GET['email']?"{$_GET['email']}":"{$_SESSION['JOIN_EMAIL']}")."\" name=\"email\" />
					</fieldset>
					<fieldset>	
						<label for=\"submit\">&nbsp;</label>
						<input type=\"submit\" value=\"{$lang['join']}\" ".($_SESSION['JOIN_STATUS']===0?'disabled':'')." />
					</fieldset>
				</form>
				";
			}
			else
			{
				$content .= "
				<p class=\"large\">{$lang['temp']}</p>
				";
			}
		$content .= "
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<h2>{$lang['doc']}</h2>
				<p class=\"large\">{$lang['doc_text']}</p>
				<a class=\"btn\" href=\"/{$GLOBALS['CONFIG']['SITE']}/documents/SYS-CGS.pdf\">{$lang['go']}</a>	
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

unset($_SESSION['JOIN_USER']);
unset($_SESSION['JOIN_EMAIL']);
unset($_SESSION['JOIN_STATUS']);

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>