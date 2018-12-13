<?php
function login_fail($code)
{
	$mes[0]="客户端数据异常，请重新登录！";     //cookie 认证失败
	$mes[1]="会话超时，请重新登录！";         //session 认证超时
	$mes[2]="请先登录系统！";              //空登录
	$mes[3]="服务器数据异常，请重新登录！";     //session 认证出现错误
	echo "<script>alert(\"{$mes[$code]}\");window.location.href='index.php?mode=login';</script>";
	
}
?>