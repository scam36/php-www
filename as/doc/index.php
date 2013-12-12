<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
	<div class=\"box nocol\">
		<div class=\"header\">
			<div class=\"container\">
				<div class=\"head\">{$lang['title']}</div>
			</div>
		</div>
		<div class=\"container\">		
			<h2>{$lang['intro']}</h2>
			<div style=\"border-left: 3px solid #383838; padding-left: 10px; margin: 40px 0 30px 0;\">
				<a href=\"/doc/first\"><h4 class=\"colored\">{$lang['first']}</h4></a>
				<p>{$lang['first_text']}</p>			
			</div>
			<div style=\"border-left: 3px solid #383838; padding-left: 10px; margin: 20px 0 30px 0;\">
				<a href=\"/doc/concepts\"><h4 class=\"colored\">{$lang['concepts']}</h4></a>
				<p>{$lang['concepts_text']}</p>			
			</div>			
			<div style=\"border-left: 3px solid #383838; padding-left: 10px; margin: 20px 0 30px 0;\">
				<a href=\"/doc/languages\"><h4 class=\"colored\">{$lang['languages']}</h4></a>
				<p>{$lang['languages_text']}</p>			
			</div>
			<div style=\"border-left: 3px solid #383838; padding-left: 10px; margin: 20px 0 30px 0;\">
				<a href=\"/doc/services\"><h4 class=\"colored\">{$lang['services']}</h4></a>
				<p>{$lang['services_text']}</p>			
			</div>				
			<br />
			<h2>{$lang['top']}</h2>
			<br />
			<ul style=\"list-style-type: none; margin: 0; padding: 0;\">
				<div style=\"float: left; width: 500px;\">
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_1']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_2']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_3']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_4']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_5']}</a></li>
				</div>
				<div style=\"float: left; width: 500px; margin-left: 50px;\">
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_1']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_2']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_3']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_4']}</a></li>
					<li style=\"font-size: 18px; padding: 10px 10px 10px 0;\"><a href=\"/doc/faq/1\">{$lang['question_5']}</a></li>
				</div>				
			</ul>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>