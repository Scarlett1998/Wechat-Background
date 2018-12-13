<?php
function login_success($username)
{
	setcookie("timelive",time()+86400,86400);
	setcookie("key",getrandchar(128),86400);
	$token_cookie=token_make($_SESSION['key'],$token_conf,"cookie");
	setcookie("token",$token_cookie,86400);
	setcookie("username",$username,86400);
	$_SESSION['username']=$username;
	$_SESSION['key']=getrandchar(128);
	$_SESSION['token']['session']=token_make($_SESSION['key'],$token_conf);
	$_SESSION['timealive']=time()+600;
	$_SESSION['cookiepass']=TRUE;
}
?>