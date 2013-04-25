<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
	<div class=\"box rightcol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
				<div class=\"subhead\">{$lang['subtitle']}</div>
			</div>
		</div>
		<div class=\"left\">
			<div class=\"container\">
				<p class=\"large\">{$lang['intro']}</p>
				<form action=\"/about/contact_action\" method=\"post\">
					<fieldset>
						<label for=\"name\">{$lang['name']}</label>
						<input type=\"text\" name=\"name\" />
					</fieldset>
					<fieldset>
						<label for=\"email\">{$lang['email']}</label>
						<input type=\"text\" name=\"email\" />
					</fieldset>
					<fieldset>
						<label for=\"subject\">{$lang['company']}</label>
						<input type=\"text\" name=\"company\" />
					</fieldset>
					<fieldset>
						<label for=\"subject\">{$lang['phone']}</label>
						<input type=\"text\" name=\"phone\" />
					</fieldset>
					<fieldset>
						<label for=\"subject\">{$lang['subject']}</label>
						<input type=\"text\" name=\"subject\" />
					</fieldset>
					<fieldset>
						<label for=\"message\">{$lang['message']}</label>
						<textarea rows=\"10\" name=\"message\"></textarea>
					</fieldset>
					<fieldset>
						<label for=\"submit\">&nbsp;</label>
						<input type=\"submit\" value=\"{$lang['send']}\" />
					</fieldset>
				</form>
			</div>
		</div>
		<div class=\"right\">
			<div class=\"container\">
				<h1>{$lang['contact']}</h1>
				<p>
					<span class=\"lightlarge\">{$lang['email']}</span><br />
					<span class=\"large\"><a href=\"mailto: contact@notherservice.com\">contact@anotherservice.com</a></span>
				</p>
				<br />
				<p>
					<span class=\"lightlarge\">{$lang['phone']}</span><br />
					<span class=\"large\">+33.(0)953.935.953</span>
				</p>
				<br />
				<p class=\"large\">
					<span class=\"lightlarge\">{$lang['address']}</span><br />
					S.Y.S SAS - Another Service<br />
					19 chemin de Ch&acirc;teau Gombert<br />
					13013 Marseille
				</p>
				
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>