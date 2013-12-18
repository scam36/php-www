<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$site = api::send('site/list', array('id'=>$_POST['id']));
$site = $site[0];

$user = api::send('user/list', array('id'=>$site['user']['id']));
$user = $user[0];

switch( $_POST['reason'] )
{
	case '1':
		$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['delete']}</h5></div>
				<div class=\"widget first\">
					<div class=\"head\"><h5 class=\"iList\">{$lang['delete_it']}</h5></div>
					<div class=\"body\">
						<a href=\"/admin/site/del_action?id={$_POST['id']}&user={$_POST['user']}\" title=\"\" class=\"btnIconLeft mr10 mt5\"><img src=\"/{$GLOBALS['CONFIG']['SITE']}/images/icons/dark/chart5.png\" alt=\"\" class=\"icon\" /><span>{$lang['now']}</span></a>
					</div>
				</div>
			</div>
		";
		
		$template->output($content);
	break;
	case '2':
	case '3':
	case '4':
		$explain = array(
			'alert'=> array(
				'reason'=>$_POST['reason'],
				'date'=>time()
			)
		);
		$explain = serialize($explain);
		
		api::send('site/update', array('id'=>$_POST['id'], 'valid'=>2, 'explain'=>$explain));
		mail($user['email'], $lang['subject'], $lang['core'], "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Olympe <no-reply@olympe.in>\r\n");
		template::redirect('/admin');
	break;
	case '5':
		if( $_POST['message'] )
		{
			$explain = array(
				'alert'=> array(
					'reason'=>$_POST['message'],
					'date'=>time()
				)
			);
			$explain = serialize($explain);
			api::send('site/update', array('id'=>$_POST['id'], 'valid'=>2, 'explain'=>$explain));
			mail($user['email'], $lang['subject'], $lang['core'], "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Olympe <no-reply@olympe.in>\r\n");
			template::redirect('/admin');
		
		}
		else
		{
			$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['reason']}</h5></div>
				<form action=\"/admin/site/unvalid_action\" method=\"post\" class=\"mainForm\">
					<input type=\"hidden\" name=\"id\" value=\"{$_POST['id']}\" />
					<input type=\"hidden\" name=\"user\" value=\"{$_POST['user']}\" />
					<input type=\"hidden\" name=\"reason\" value=\"5\" />					
					<fieldset>
						<div class=\"widget first\">
							<div class=\"head\"><h5 class=\"iList\">{$lang['explain']}</h5></div>
							<div class=\"rowElem noborder\"><label>{$lang['message']}</label><div class=\"formRight\"><textarea style=\"height: 250px;\" type=\"text\" name=\"message\"></textarea></div><div class=\"fix\"></div></div>
							<input type=\"submit\" value=\"{$lang['post']}\" class=\"greyishBtn submitForm\" />
							<div class=\"fix\"></div>
						</div>
					</fieldset>
				</form>
			</div>
			";
			$template->output($content);
		}
	break;
}

?>
