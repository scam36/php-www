<?php

if( isset($GLOBALS['lang']) && is_object($GLOBALS['lang']) )
	$GLOBALS['lang']->import(__DIR__ . '/menu.lang');

$menu = "		
						<ul>
							<a href=\"/doc\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc', '/'))===0?"active":"")."\">{$lang['index']}</li></a>
							<li style=\"cursor: auto;\">{$lang['started']}</li>
							<ul>
								<a href=\"/doc/what\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/what', '/'))===0?"active":"")."\">{$lang['what']}</li></a>
								<a href=\"/doc/techno\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/techno', '/'))===0?"active":"")."\">{$lang['techno']}</li></a>
								<a href=\"/doc/info\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/info', '/'))===0?"active":"")."\">{$lang['infos']}</li></a>
								<a href=\"/doc/first\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/first', '/'))===0?"active":"")."\">{$lang['first']}</li></a>
							</ul>
							<li style=\"cursor: auto;\">{$lang['features']}</li>
							<ul>
								<a href=\"/doc/sites\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/sites', '/'))===0?"active":"")."\">{$lang['sites']}</li></a>
								<a href=\"/doc/domains\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/domains', '/'))===0?"active":"")."\">{$lang['domains']}</li></a>
								<a href=\"/doc/databases\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/databases', '/'))===0?"active":"")."\">{$lang['databases']}</li></a>
								<a href=\"/doc/services\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/services', '/'))===0?"active":"")."\">{$lang['services']}</li></a>
							</ul>
							<li style=\"cursor: auto;\">{$lang['account']}</li>
							<ul>
								<a href=\"/doc/quotas\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/quotas', '/'))===0?"active":"")."\">{$lang['quota']}</li></a>
								<a href=\"/doc/tokens\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/tokens', '/'))===0?"active":"")."\">{$lang['tokens']}</li></a>
								<a href=\"/doc/settings\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/settings', '/'))===0?"active":"")."\">{$lang['settings']}</li></a>
								<a href=\"/doc/privacy\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/privacy', '/'))===0?"active":"")."\">{$lang['privacy']}</li></a>
							</ul>							
							<li style=\"cursor: auto;\">{$lang['various']}</li>
							<ul>
								<a href=\"/doc/problems\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/problems', '/'))===0?"active":"")."\">{$lang['problems']}</li></a>
								<a href=\"/doc/directory\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/directory', '/'))===0?"active":"")."\">{$lang['directory']}</li></a>
								<a href=\"/doc/php\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/php', '/'))===0?"active":"")."\">{$lang['php']}</li></a>
								<a href=\"/doc/files\"><li class=\"".(strpos(rtrim($GLOBALS['CONFIG']['PAGE'], '/'), rtrim('/doc/files', '/'))===0?"active":"")."\">{$lang['files']}</li></a>
							</ul>	
						</ul>
";