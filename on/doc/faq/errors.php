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
			<p>{$lang['intro']}</p>
			<code>define('ERROR_LOG_FILE', 'error.log');</code>
			<br />
			<p>{$lang['intro2']}</p>
			<code>[Wed, 15 May 2013 19:22:15 +0000] WARNING (2): Creating default object from empty value<br />
        at get_comment_type() in www/wp-content/themes/mystique/lib/widgets.php on line 216<br />
        at SidebarTabsWidget->widget() in www/wp-includes/widgets.php on line 182<br />
        at WP_Widget->display_callback() as runtime code<br />
        at call_user_func_array() in www/wp-includes/widgets.php on line 891<br />
        at dynamic_sidebar() in www/wp-content/themes/mystique/sidebar.php on line 14<br />
        at require_once() in www/wp-includes/theme.php on line 1086<br />
        at load_template() in www/wp-includes/theme.php on line 1062<br />
        at locate_template() in www/wp-includes/general-template.php on line 92<br />
        at get_sidebar() in www/wp-content/themes/mystique/index.php on line 32<br />
        at include() in www/wp-includes/template-loader.php on line 43<br />
        at require_once() in www/wp-blog-header.php on line 16<br />
        at require() in www/index.php on line 18</code>
			<br />
			<p>{$lang['intro3']}</p>
			<code>define('ERROR_LOG_ALL', true);</code>
			<br />
			<p>{$lang['intro4']}</p>
			<br />
			<p style=\"text-align: center;\">
				<a class=\"button classic\" href=\"/doc\" style=\"height: 22px; width: 150px; margin: 0 auto;\">
					<span style=\"display: block; font-size: 18px; padding-top: 3px;\">{$lang['back']}</span>
				</a>
			</p>
		</div>
		<div class=\"clearfix\"></div><br />
	</div>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>