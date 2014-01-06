<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$content = "
		<div class=\"head-light\">
			<div class=\"container\">
				<div style=\"float: left; width: 500px;\">
					<h1 class=\"dark\">{$lang['title']}</h1>
				</div>
				<div style=\"float: right; width: 500px;\">
					<a class=\"button classic\" href=\"/doc\" style=\"float: right; height: 22px; width: 150px; margin: 0 auto;\">
						<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['back']}</span>
					</a>
				</div>
				<div class=\"clear\"></div>
			</div>
		</div>
		<div class=\"content\">		
			<p class=\"large\">{$lang['intro_text']}</p>
			<br />
			<table>
				<tr>
					<th>{$lang['service']}</th>
					<th>{$lang['name']}</th>
					<th>{$lang['info']}</th>
					<th>{$lang['version']}</th>
				</tr>
				<tr>
					<td style=\"text-align: center;\"><a href=\"/doc/mysql\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-mysql.png\" style=\"width: 50px;\" alt=\"MySQL\"></a></td>
					<td><a href=\"/doc/mysql\">MySQL</a></td>
					<td>{$lang['db']}</td>
					<td>5.5</td>
				</tr>
				<tr>
					<td style=\"text-align: center;\"><a href=\"/doc/pgsql\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-postgresql.png\" style=\"width: 50px;\" alt=\"PostgeSQL\"></a></td>
					<td><a href=\"/doc/pgsql\">PostgreSQL</a></td>
					<td>{$lang['db']}</td>
					<td>9.1</td>
				</tr>
				<tr>
					<td style=\"text-align: center;\"><a href=\"/doc/rails\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-mongodb.png\" style=\"width: 50px;\" alt=\"MongoDB\"></a></td>
					<td><a href=\"/doc/rails\">MongoDB</a></td>
					<td>{$lang['key']}</td>
					<td>{$lang['soon']}</td>
				</tr>	
				<tr>
					<td style=\"text-align: center;\"><a href=\"/doc/redis\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-redis.png\" style=\"width: 50px;\" alt=\"Redis\"></a></td>
					<td><a href=\"/doc/redis\">Redis</a></td>
					<td>{$lang['key']}</td>
					<td>{$lang['soon']}</td>
				</tr>	
				<tr>
					<td style=\"text-align: center;\"><a href=\"/doc/redis\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-memcached.png\" style=\"width: 50px;\" alt=\"Memcached\"></a></td>
					<td><a href=\"/doc/redis\">MemCached</a></td>
					<td>{$lang['key']}</td>
					<td>{$lang['soon']}</td>
				</tr>
				<tr>
					<td style=\"text-align: center;\"><a href=\"/doc/rabbitmq\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/services/icon-rabbitmq.png\" style=\"width: 50px;\" alt=\"RabbitMQ\"></a></td>
					<td><a href=\"/doc/rabbitmq\">RabbitMQ</a></td>
					<td>{$lang['queue']}</td>
					<td>{$lang['soon']}</td>
				</tr>	
			</table>
		</div>
		<div class=\"clearfix\"></div><br />
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>