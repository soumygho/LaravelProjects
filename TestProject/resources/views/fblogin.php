<?php
//checking user is looged in or not
session_start();
try
{
$fb = new Facebook\Facebook([
"app_id"=>'245328009230954',
"app_secret"=>'cbeb77937378777f866ae29fd2cc010e',
'default_graph_version' => 'v2.8'
]);
$helper = $fb->getRedirectLoginHelper();
$accessToken = $helper->getAccessToken();
if(isset($accessToken))
{
$_SESSION["fb_access_token"] = (string)$accessToken;
header('Location: http://localhost:8000/profile');
exit;
}
else
{
	header('Location: http://localhost:8000/login'); 
	exit;
}
}
catch(Exception $e)
{
	 echo $e->getMessage();
}
?>