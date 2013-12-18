<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$site = api::send('site/list', array('id'=>$_POST['id']));
$site = $site[0];

$site['explain'] = unserialize($site['explain']);
$reason = $site['explain']['alert']['reason'];
$message = $lang['alert_'.$reason];

if( $site['explain']['replies'] )
	$replies = $site['explain']['replies'];
else
	$replies = array();

$replies[] = array(
	'message'=>$_POST['message'],
	'author'=>'team',
	'date'=>time()
);

$explain = array(
	'alert'=> array(
		'reason'=>$site['explain']['alert']['reason'],
		'date'=>$site['explain']['alert']['date']
	),
	'replies'=> $replies
);
$explain = serialize($explain);
			
api::send('site/update', array('id'=>$_POST['id'], 'explain'=>$explain));

if( isset($_GET['redirect']) )
	template::redirect($_GET['redirect']);
else
	$template->redirect('/admin');

?>
