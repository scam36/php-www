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
			<br />
			<p class=\"large\">{$lang['intro_text']}</p>
			<br />
				<h3 class=\"colored\">{$lang['available']}</h3>
				<br />
				<div style=\"width: 500px; float: left;\">
					<table>
						<tr>
							<th>{$lang['language']}</th>
							<th>{$lang['name']}</th>
							<th>{$lang['framework']}</th>
							<th>{$lang['version']}</th>
						</tr>
						<tr>
							<td><a href=\"/doc/php\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-php.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/php\">PHP</a></td>
							<td>Web</td>
							<td>5.4.9</td>
						</tr>
						<tr>
							<td><a href=\"/doc/php\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-php.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/php\">PHP</a></td>
							<td>Web</td>
							<td>5.2.17</td>
						</tr>	
						<tr>
							<td><a href=\"/doc/rails\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-rubyrails.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/rails\">Ruby</a></td>
							<td>Rails</td>
							<td>4.0.2</td>
						</tr>	
						<tr>
							<td><a href=\"/doc/sinatra\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-rubysinatra.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/sinatra\">Ruby</a></td>
							<td>Sinatra</td>
							<td>{$lang['soon']}</td>
						</tr>	
						<tr>
							<td><a href=\"/doc/tomcat\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-javatomcat.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/tomcat\">JAVA</a></td>
							<td>Tomcat</td>
							<td>{$lang['soon']}</td>
						</tr>
					</table>
				</div>
				<div style=\"width: 500px; float: right;\">
					<table>
						<tr>
							<th>{$lang['language']}</th>
							<th>{$lang['name']}</th>
							<th>{$lang['framework']}</th>
							<th>{$lang['version']}</th>
						</tr>
						<tr>
							<td><a href=\"/doc/django\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-pythondjango.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/django\">Python</a></td>
							<td>Django</td>
							<td>{$lang['soon']}</td>
						</tr>
						<tr>
							<td><a href=\"/doc/wsgi\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-pythonwsgi.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/wsgi\">Python</a></td>
							<td>WSGI</td>
							<td>{$lang['soon']}</td>
						</tr>	
						<tr>
							<td><a href=\"/doc/java\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-java.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/java\">Java</a></td>
							<td>-</td>
							<td>1.7.0</td>
						</tr>	
						<tr>
							<td><a href=\"/doc/ruby\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-ruby.png\" style=\"width: 50px;\" alt=\"Ruby\"></a></td>
							<td><a href=\"/doc/ruby\">Ruby</a></td>
							<td>-</td>
							<td>1.9.3</td>
						</tr>	
						<tr>
							<td><a href=\"/doc/nodejs\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/languages/icon-nodejs.png\" style=\"width: 50px;\" alt=\"Ruby\"></td>
							<td><a href=\"/doc/nodejs\">NodeJS</td>
							<td>-</td>
							<td>{$lang['soon']}</td>
						</tr>	
					</table>			
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>