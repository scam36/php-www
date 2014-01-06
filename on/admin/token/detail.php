<?php

if( !defined('PROPER_START') )
{
	header("HTTP/1.0 403 Forbidden");
	exit;
}

$token = api::send('token/list', array('user'=>$_GET['user'], 'token'=>$_GET['token']));
if( count($token) == 0 )
	template::redirect('/admin/user/detail?id='.$_GET['user']);
$token = $token[0];

$content = "
			<div class=\"content\">
				<div class=\"title\"><h5>{$lang['title']} : {$token['name']} ({$token['token']})</h5></div>
				<div class=\"widgets\">
					<div class=\"left\">";

if( security::hasGrant('GRANT_TOKEN_SELECT') )
{
	$tokengrants = api::send('grant/token/list', array('user'=>$_GET['user'], 'token'=>$_GET['token']));
	if( security::hasGrant('GRANT_USER_SELECT') )
		$grants = api::send('grant/user/list', array('user'=>$_GET['user'], 'overall'=>true));
	else
		$grants = $tokengrants;

	$content .= "
						<form action=\"/admin/token/grant_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\">
										<h5 class=\"iKey\">{$lang['grants']}</h5>
									</div>
									<div style=\"max-height: 350px; overflow-y: auto;\">
									<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"tableStatic\">
										<thead>
											<tr>
												<td align=\"center\">{$lang['grantname']}</td>
												<td align=\"center\">{$lang['granted']}</td>
											</tr>
										</thead>
										<tbody>";

	if( security::hasGrant(array('GRANT_TOKEN_INSERT','GRANT_TOKEN_DELETE')) )
		$disabled = '';
	else
		$disabled = 'disabled';

	foreach( $grants as $g )
	{
		$checked = '';
		foreach( $tokengrants as $k )
		{
			if( $g['id'] == $k['id'] )
			{
				$checked = 'checked';
				break;
			}
		}
			
		$content .= "
											<tr class=\"gradeA\">
												<td>{$g['name']}</td>
												<td align=\"center\">
													<input type=\"checkbox\" name=\"grant[]\" value=\"{$g['id']}\" {$disabled} {$checked} />
												</td>
											</tr>";
	}

	$content .= "
										</tbody>
									</table>
									</div>
									<div class=\"fix\"></div>
									<input type=\"hidden\" name=\"user\" value=\"{$_GET['user']}\" />
									<input type=\"hidden\" name=\"token\" value=\"{$_GET['token']}\" />
									<input type=\"submit\" value=\"{$lang['update']}\" {$disabled} class=\"greyishBtn submitForm\" />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>
";

}

$tokendate = '';
if( $token['lease'] > 0 )
	$tokendate = date('j-n-Y', $token['lease']);

$content .= "
					</div>
					
					<div class=\"right\">
						<form action=\"/admin/token/update_action\" method=\"post\" class=\"mainForm\">
							<fieldset>
								<div class=\"widget first\">
									<div class=\"head\"><h5 class=\"iRefresh3\">{$lang['tokeninfo']}</h5></div>
									<div class=\"rowElem\"><label>{$lang['tokenname']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"name\" value=\"{$token['name']}\" /></div>
										<div class=\"fix\"></div>
									</div>
									<div class=\"rowElem\"><label>{$lang['tokenlease']}</label>
										<div class=\"formRight\"><input type=\"text\" name=\"lease\" id=\"lease\" value=\"{$tokendate}\" class=\"datepicker\" /></div>
										<div class=\"fix\"></div>
									</div>
									<input type=\"hidden\" name=\"user\" value=\"{$_GET['user']}\" />
									<input type=\"hidden\" name=\"token\" value=\"{$_GET['token']}\" />
									<input type=\"submit\" value=\"{$lang['update']}\" class=\"greyishBtn submitForm\" ".(security::hasGrant('TOKEN_UPDATE')?'':'disabled')." />
									<div class=\"fix\"></div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>";

/* ========================== OUTPUT PAGE ========================== */
$template->output($content);

?>