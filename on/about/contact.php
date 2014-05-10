<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

if( $security->hasAccess('/panel') )
	$user = security::get('USER');

$content = "
			<div class=\"head-light\">
				<div class=\"container\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
			</div>	
			<div class=\"content\">
				<div class=\"left\">
					<h4>{$lang['send']}</h4>
					<p>{$lang['send_text']}</p>
					<br />
					<form action=\"/about/contact_action\" method=\"post\" id=\"contact\">
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\" type=\"text\" name=\"name\" placeholder=\"{$lang['name']}\" />
						</fieldset>
		";
		
if(!$user) {
	$content .= "
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\" type=\"text\" name=\"account\" placeholder=\"{$lang['account']}\" />
						</fieldset>
	";
}

$content .= "		
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\"type=\"text\" name=\"email\" id=\"email\" placeholder=\"{$lang['email']}\" />
						</fieldset>
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\" type=\"text\" name=\"subject\" placeholder=\"{$lang['subject']}\" />
						</fieldset>
						<fieldset>
							<textarea class=\"auto\" style=\"width: 300px;\" rows=\"10\" name=\"message\" placeholder=\"{$lang['message']}\"></textarea>
						</fieldset>
						<fieldset>
							<input type=\"submit\" value=\"{$lang['send_now']}\" />
						</fieldset>
					</form>
				</div>
				<div class=\"right border\">
					<a style=\"width: 250px; height: 22px; margin-bottom: 20px;\" onclick=\"$('#report').dialog('open');\" href=\"#\" class=\"button classic\">
						<img src=\"/on/images/warning.png\" style=\"float: left; height:98%;\" alt=\"\" />
						<span style=\"display: block; padding-top: 3px;\">{$lang['report']}</span>
					</a>
				
					<h4>{$lang['infos']}</h4>
					<p>Paris, France</p>
					<p><a href=\"mailto: contact@olympe.in\">contact@olympe.in</a></p>
					<p>#olympe@irc.freenode.net</p>
					<br />
					<h4>{$lang['meet']}</h4>
					<p>{$lang['meet_text']}</p>
					<div style=\"width: 330px; height: 330px;\">
						<iframe width=\"330\" height=\"330\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=40%2Bbis%2Brue%2BFaubourg%2BPoissoni%C3%A8re%2C%2BParis&ie=UTF8&z=5&t=m&iwloc=near&output=embed\"></iframe>
					</div>
				</div>
				<div class=\"clear\"></div>
				<br /><br />
			</div>
			
			<div id=\"report\" class=\"floatingdialog\">
				<h3 class=\"center\">{$lang['report']}</h3>
				<p style=\"text-align: justify; font-size:13px; line-height:20px;\">{$lang['report_text']}</p>
			</div>
			<div id=\"email_check\" class=\"floatingdialog center\">
				<img src=\"/on/images/icons/notifications/error.png\">
				<br>
				<p>{$lang['email_wrong']}</p>
			</div>
			<script>
				newFlexibleDialog('report', 800);
				newFlexibleDialog('email_check', 250);
				
				$('form#contact').submit(function() {
					var input = $('#email', this);
					var re = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
					var is_email = re.test(input.val());
					if(!is_email) { 
						$('#email_check').dialog('open');
						return false; 
					}
				});
			</script>
";

if( isset($_GET['report']) )
{
	$content .= "<script type=\"text/javascript\">
					$(document).ready(function() {
						$(\"#report\").dialog(\"open\");
						$(\".ui-dialog-titlebar\").hide();
					});
				</script>
	";
}

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>