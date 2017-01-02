<?php
session_start();
try
{
if(isset($_SESSION["fb_access_token"]))
{
$accesstoken  = (string)$_SESSION["fb_access_token"];
$fb = new Facebook\Facebook([
"app_id"=>'245328009230954',
"app_secret"=>'cbeb77937378777f866ae29fd2cc010e',
'default_graph_version' => 'v2.8'
]);
// Response example.
$res = $fb->get('/me',$accesstoken);
 
$node = $res->getGraphObject()->asArray();
 
echo "user data obtained : ".$node['id'];
echo "user name obtained : ".$node['name'];
$res = $fb->get( '/me/picture?type=large&redirect=false',$accesstoken);
 
$picture = $res->getGraphObject();
 
echo "<img src='".$picture['url']."'/>";
// string(3) "123"
 
// Functional-style!

}
}
catch(Exception $e)
{
	echo $e->getMessage();
}
?>