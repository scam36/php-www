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
				<div class=\"left\">
					<h4>{$lang['send']}</h4>
					<p>{$lang['send_text']}</p>
					<br />
					<form action=\"/about/contact_action\" method=\"post\">
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\" type=\"text\" name=\"name\" value=\"{$lang['name']}\" onfocus=\"this.value = this.value=='{$lang['name']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['name']}' : this.value; this.value=='{$lang['name']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						</fieldset>
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\"type=\"text\" name=\"email\" value=\"{$lang['email']}\" onfocus=\"this.value = this.value=='{$lang['email']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['email']}' : this.value; this.value=='{$lang['email']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						</fieldset>
						<fieldset>
							<input class=\"auto\" style=\"width: 300px;\" type=\"text\" name=\"subject\" value=\"{$lang['subject']}\" onfocus=\"this.value = this.value=='{$lang['subject']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['subject']}' : this.value; this.value=='{$lang['subject']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						</fieldset>
						<fieldset>
							<textarea class=\"auto\" style=\"width: 300px;\" rows=\"10\" name=\"message\" onfocus=\"this.value = this.value=='{$lang['message']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['message']}' : this.value; this.value=='{$lang['message']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\">{$lang['message']}</textarea>
						</fieldset>
						<fieldset>
							<input type=\"submit\" value=\"{$lang['send_now']}\" />
						</fieldset>
					</form>
				</div>
				<div class=\"right border\">
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
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>