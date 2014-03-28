<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$connector = api::send('busit/connector/list', array('id'=>$_GET['id'], 'lang'=>translator::getLanguage()), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$connector = $connector[0];

$lang['TITLE'] = $lang['busit'] . $connector['connector_name'];
	
$category = api::send('busit/category/list', array('id'=>$connector['connector_category']), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);
$category = $category[0];

$interfaces = api::send('busit/connector/interface/list', array('id'=>$_GET['id'], 'lang'=>translator::getLanguage()), $GLOBALS['CONFIG']['API_USERNAME'].':'.$GLOBALS['CONFIG']['API_PASSWORD']);

if( $security->hasAccess('/panel') )
	$rating = api::send('self/busit/connector/getrate', array('id'=>$_GET['id']));

// temporary during development, should not happen
if( !$interfaces['inputs'] )
	$interfaces['inputs'] = array();
if( !$interfaces['outputs'] )
	$interfaces['outputs'] = array();

if( $connector['rating']['count'] == 0 )
	$connector['rating']['count'] = 1;
	
$content .= "
		<div id=\"storecontainer\">
			<div class=\"store\">
				<div class=\"container\">
					<div class=\"left\">
						<div class=\"logo\">
							<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/connectors/{$connector['connector_id']}.png\" alt=\"{$connector['connector_name']}\" />
						</div>
						<div style=\"float: left; width: 400px;\">
							<h1 class=\"dark\">{$connector['connector_name']}</h1>
							<span class=\"tax\">".($connector['connector_use_price']==0?"{$lang['free']}":"{$connector['connector_use_price']} BIC")."</span>
							<div class=\"clear\"></div>
							<span style=\"font-size: 11px\"><span style=\"font-weight: bold;\">".$lang[$category['category_name']]."</span> - ".date('M d, Y', $connector['connector_date'])."<br />
							<br />
							<a class=\"callout\" href=\"#\" onclick=\"$('#new').dialog('open'); $('input[name=connector]').val('{$connector['connector_id']}'); return false;\">{$lang['add']}</a>
							<br /><br /><br />
							<div class=\"seperator-mini\"></div>
							<div class=\"star\" data-score=\"{$rating['rating_value']}\" data-id=\"{$connector['connector_id']}\"></div>
							<span class=\"label\">{$lang['edited']} {$connector['user_firstname']} {$connector['user_lastname']}</span>
							<div class=\"social\">
								<div class=\"fb-like\" data-href=\"http://www.bus-it.com/store/connector?id={$connector['connector_id']}\" data-width=\"\" data-height=\"\" data-colorscheme=\"light\" data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"true\" data-send=\"false\"></div>
							</div>
							<div class=\"social\">
								<div class=\"g-plusone\" data-size=\"medium\"></div>
							</div>
						</div>
					</div>
					<div class=\"right\">
						<a class=\"action report\" href=\"#\" onclick=\"$('#report').dialog('open'); $('input[name=connector]').val('{$connector['connector_id']}'); return false;\">
							{$lang['report']}
						</a>
						<a class=\"action bug\" href=\"#\" onclick=\"$('#bug').dialog('open'); $('input[name=connector]').val('{$connector['connector_id']}'); return false;\">
							{$lang['bugreport']}
						</a>		
					</div>
				</div>
				<div class=\"clear\"></div>
			</div>
			<div class=\"storelight\">
				<div style=\"float: right;\">
					<h1 class=\"dark thin\">{$lang['rating']}</h1>
					<br />
					<div style=\"background-color: #f2f2f2; width: 360px; height: 120px; padding: 8px 10px 10px 10px;\">
						<div style=\"float: left; width: 150px; text-align: center;\">
							<span style=\"font-size: 4em; text-align: center;\">".round($connector['rating']['value'], 2)."</span>
							<div class=\"bigstar\" data-score=\"{$connector['rating']['value']}\"></div>
							<img style=\"display: inline-block;\" src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/mini-user.png\" />
							<span style=\"color: #a6a6a6; font-size: 12px;\">{$connector['rating']['count']} {$lang['total']}</span>
						</div>
						<div style=\"float: left; width: 180px; text-align: left; margin-left: 15px;\">
							<div style=\"clear: left; height: 25px;\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/star-on.png\" style=\"float: left; display: block; padding-top: 4px;\" />
								<span style=\"float: left; font-size: 12px; margin-left: 10px; display: block; padding-top: 4px; width: 5px;\">5</span>
								<span style=\"margin-left: 10px; width: ".(($connector['rating']['count5']*70/$connector['rating']['count'])==0?"10":"".($connector['rating']['count5']*70/$connector['rating']['count'])."")."%; background-color: #9fc05a; display: block; height: 25px; float: left; text-align: center;\"><span style=\"padding: 4px; display: block; margin: 0 auto; text-align: center;\">{$connector['rating']['count5']}</span></span></span>
							</div>
							<div style=\"clear: left; height: 25px;\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/star-on.png\" style=\"float: left; display: block; padding-top: 4px;\" />
								<span style=\"float: left; font-size: 12px; margin-left: 10px; display: block; padding-top: 4px; width: 5px;\">4</span>
								<span style=\"margin-left: 10px; width: ".(($connector['rating']['count4']*70/$connector['rating']['count'])==0?"10":"".($connector['rating']['count4']*70/$connector['rating']['count'])."")."%; background-color: #add633; display: block; height: 25px; float: left; text-align: center;\"><span style=\"padding: 4px; display: block; margin: 0 auto; text-align: center;\">{$connector['rating']['count4']}</span></span>
							</div>
							<div style=\"clear: left; height: 25px;\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/star-on.png\" style=\"float: left; display: block; padding-top: 4px;\" />
								<span style=\"float: left; font-size: 12px; margin-left: 10px; display: block; padding-top: 4px; width: 5px;\">3</span>
								<span style=\"margin-left: 10px; width: ".(($connector['rating']['count3']*70/$connector['rating']['count'])==0?"10":"".($connector['rating']['count3']*70/$connector['rating']['count'])."")."%; background-color: #ffd834; display: block; height: 25px; float: left; text-align: center;\"><span style=\"padding: 4px; display: block; margin: 0 auto; text-align: center;\">{$connector['rating']['count3']}</span></span>
							</div>
							<div style=\"clear: left; height: 25px;\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/star-on.png\" style=\"float: left; display: block; padding-top: 4px;\" />
								<span style=\"float: left; font-size: 12px; margin-left: 10px; display: block; padding-top: 4px; width: 5px;\">2</span>
								<span style=\"margin-left: 10px; width: ".(($connector['rating']['count2']*70/$connector['rating']['count'])==0?"10":"".($connector['rating']['count2']*70/$connector['rating']['count'])."")."%; background-color: #ffb234; display: block; height: 25px; float: left; text-align: center;\"><span style=\"padding: 4px; display: block; margin: 0 auto; text-align: center;\">{$connector['rating']['count2']}</span></span>
							</div>
							<div style=\"clear: left; height: 25px;\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/star-on.png\" style=\"float: left; display: block; padding-top: 4px;\" />
								<span style=\"float: left; font-size: 12px; margin-left: 10px; display: block; padding-top: 4px; width: 5px;\">1</span>
								<span style=\"margin-left: 10px;width: ".(($connector['rating']['count1']*70/$connector['rating']['count'])==0?"10":"".($connector['rating']['count1']*70/$connector['rating']['count'])."")."%; background-color: #ff8b5a; display: block; height: 25px; float: left; text-align: center;\"><span style=\"padding: 4px; display: block; margin: 0 auto; text-align: center;\">{$connector['rating']['count1']}</span>
							</div>
						</div>						
						<div class=\"clear\"></div>
					</div>
				</div>
				<h1 class=\"dark thin\">{$lang['description']}</h1>
				<p style=\"margin-top: 15px;\">".bbcode::display($connector['translation']['connector_description'])."</p>
				<div class=\"clear\"><br /><br /></div>
				<h1 class=\"dark thin\">{$lang['scheme']}</h1>
				<div class=\"schema\">
					<div style=\"display: block; float: left; margin: 0 10px 0 50px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/arrow_long.png\" /></div>
					<div style=\"display: block; float: left; margin: 10px 20px 0 20px;\"\"><h4 style=\"font-weight: bold;\">{$lang['inputs']}</h4></div>
					<div style=\"display: block; float: left; margin: 0 10px 0 10px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/arrow_long.png\" /></div>
					<div style=\"display: block; float: left; margin: 10px 20px 0 20px;\"><h4 style=\"font-weight: bold;\">{$lang['outputs']}</h4></div>
					<div style=\"display: block; float: left; margin: 0 10px 0 10px;\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/arrow_long.png\" /></div>
					<div class=\"clear\" style=\"margin-bottom: 5px;\"></div>
					<div id=\"connector\" class=\"connector\">
						<div class=\"inputs\" id=\"inputs\">
							<ul>";
	foreach( $interfaces['inputs'] as $key => $value )
	{
		$content .= "
								<li>
									<span style=\"font-weight: bold;\">{$value['name']}</span><br />
									{$value['description']}
									<div class=\"dynamic\"></div>
								</li>
		";
	}
	$content .= "
							</ul>
						</div>
						<div class=\"center\" id=\"center\">
							<div id=\"logo\">
								<img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/connectors/{$connector['connector_id']}_100.png\" alt=\"{$connector['connector_name']}\" />
								<span class=\"description\">".bbcode::display($connector['translation']['connector_promo'])."</span>
							</div>
						</div>
						<div class=\"outputs\" id=\"outputs\">
							<ul>";
	foreach( $interfaces['outputs'] as $key => $value )
	{
		$content .= "
								<li>
									<span style=\"font-weight: bold;\">{$value['name']}</span><br />
									{$value['description']}
									<div class=\"dynamic\"></div>
								</li>
		";
	}
	$content .= "
							</ul>
						</div>
						<div class=\"clear\"></div>
					</div>
				</div>
				<br />
				<div class=\"seperator-light\"></div>
				<div class=\"comments\">
					<h1 class=\"dark thin\">{$lang['comments']}</h1>
					<br />
					<div id=\"disqus_thread\"></div>
					<script type=\"text/javascript\">
						/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						var disqus_developer = 0; // developer mode
						var disqus_shortname = 'busit'; // required: replace example with your forum shortname
						var disqus_identifier = 'Connector - {$connector['connector_name']}';
						var disqus_url = 'https://www.bus-it.com/store/connector?id={$connector['connector_id']}';
						/* * * DON'T EDIT BELOW THIS LINE * * */
						(function() {
							var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
							dsq.src = 'https://' + disqus_shortname + '.disqus.com/embed.js';
							(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						})();
					</script>
				</div>
				<div class=\"clear\"><br /></div>
			</div>
		</div>
		<div id=\"new\" class=\"floatingdialog\">
			<h3 class=\"center\">{$lang['newinstance']}</h3>
			<p style=\"text-align: center;\">{$lang['newinstance_text']}</p>
			<div class=\"form-small\">
";

if( $security->hasAccess('/panel') )
{
	$spaces = api::send('self/busit/space/list');
	
	if( count($spaces) > 0 )
	{
		$content .= "	
				<form action=\"/panel/instance/add_action\" method=\"post\" class=\"center\">
					<input type=\"hidden\" name=\"connector\" value=\"\" />
					<input type=\"hidden\" name=\"form\" value=\"new\" />
					<fieldset>
						<input class=\"auto\" type=\"text\" value=\"{$lang['name']}\" name=\"name\" onfocus=\"this.value = this.value=='{$lang['name']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['name']}' : this.value; this.value=='{$lang['name']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						<span class=\"help-block\">{$lang['name_help']}</span>
					</fieldset>
					<fieldset>
						<select name=\"space\">
		";
		foreach( $spaces as $s )
			$content .= "<option ".($_SESSION['STORE']['SPACE']==$s['space_id']?"selected":"")." value=\"{$s['space_id']}\">{$s['space_name']}</option>";
		$content .= "
						</select>
						<span class=\"help-block\">{$lang['space_help']}</span>
					</fieldset>
					<fieldset>	
						<input autofocus type=\"submit\" value=\"{$lang['create']}\" />
					</fieldset>
				</form>							
		";
	}
	else
		$content .= " <p style=\"text-align: center; margin-top: 10px;\">{$lang['mustspace']}</p>";
}
else
	$content .= " <p style=\"text-align: center; margin-top: 10px;\">{$lang['mustlogged']}</p>";

$content .= "
			</div>
		</div>
		<div id=\"bug\" class=\"floatingdialog\">
			<br />
			<h3 class=\"center\">{$lang['newbug']}</h3>
			<p style=\"text-align: center;\">{$lang['newbug_text']}</p>
			<div class=\"form-small\">
				<form action=\"/store/bugreport_action\" method=\"post\" class=\"center\">
					<input type=\"hidden\" name=\"connector\" value=\"\" />
					<fieldset>
						<input class=\"auto\" type=\"text\"  style=\"width: 400px;\" value=\"{$lang['title']}\" name=\"title\" onfocus=\"this.value = this.value=='{$lang['title']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['title']}' : this.value; this.value=='{$lang['title']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						<span class=\"help-block\">{$lang['title_help']}</span>
					</fieldset>
					<fieldset>
						<textarea class=\"auto\" style=\"width: 400px; height: 150px;\" name=\"content\" onfocus=\"this.value = this.value=='{$lang['content']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['content']}' : this.value; this.value=='{$lang['content']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\">{$lang['content']}</textarea>
						<span class=\"help-block\">{$lang['content_help']}</span>
					</fieldset>
					<fieldset>	
						<input autofocus type=\"submit\" value=\"{$lang['submit']}\" />
					</fieldset>
				</form>							
			</div>
		</div>
		<div id=\"report\" class=\"floatingdialog\">
			<br />
			<h3 class=\"center\">{$lang['newreport']}</h3>
			<p style=\"text-align: center;\">{$lang['newreport_text']}</p>
			<div class=\"form-small\">
				<form action=\"/store/report_action\" method=\"post\" class=\"center\">
					<input type=\"hidden\" name=\"connector\" value=\"\" />
					<fieldset>
						<input class=\"auto\" type=\"text\" style=\"width: 400px;\" value=\"{$lang['title']}\" name=\"title\" onfocus=\"this.value = this.value=='{$lang['title']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['title']}' : this.value; this.value=='{$lang['title']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\" />
						<span class=\"help-block\">{$lang['title_help']}</span>
					</fieldset>
					<fieldset>
						<textarea class=\"auto\" style=\"width: 400px; height: 150px;\" name=\"content\" onfocus=\"this.value = this.value=='{$lang['content']}' ? '' : this.value; this.style.color='#4c4c4c';\" onfocusout=\"this.value = this.value == '' ? this.value = '{$lang['content']}' : this.value; this.value=='{$lang['content']}' ? this.style.color='#cccccc' : this.style.color='#4c4c4c'\">{$lang['content']}</textarea>
						<span class=\"help-block\">{$lang['content_help']}</span>
					</fieldset>
					<fieldset>	
						<input autofocus type=\"submit\" value=\"{$lang['submit']}\" />
					</fieldset>
				</form>							
			</div>
		</div>	
		<script type=\"text/javascript\">
			window.___gcfg = {lang: 'fr'};
		
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
			
			newFlexibleDialog('new', 550);
			newFlexibleDialog('bug', 550);
			newFlexibleDialog('report', 550);
			
			$(function()
			{	
				var inputsh = $(\"#inputs\").height();
				var outputsh = $(\"#outputs\").height();
				var centerh = $(\"#center\").height();
				
				if( inputsh > outputsh )
				{
					if( centerh < inputsh )
					{
						$(\"#logo\").css(\"margin-top\", (inputsh/2-80)+\"px\");
						$(\"#center\").height(inputsh);
					}
				}
				else if( outputsh > inputsh )
				{
					if( centerh < outputsh )
					{
						$(\"#logo\").css(\"margin-top\", (outputsh/2-80)+\"px\");
						$(\"#center\").height(outputsh + 20);
					}
				}
			});
";

if( $_SESSION['INSTANCE']['ERROR'] )
{
	$_SESSION['INSTANCE']['ERROR'] = false;
	$content .= "
			$(document).ready(function() {
				$('input[name=connector]').val('{$connector['connector_id']}');
				$(\"#new\").dialog(\"open\");
				$(\".ui-dialog-titlebar\").hide();
			});
	";
}

$content .= "
		</script>
";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>