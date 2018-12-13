<?php
include_once "conf.php";
include_once "function.php";
$code=$_GET['code'];
$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECERT."&code={$code}&grant_type=authorization_code";
$data=http_get($url);
$access_token=$data['access_token'];
$openid=$data['openid'];
$url="https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
$data=http_get($url);
session_start();
$_SESSION['USER']['openid']=$data['openid'];
$_SESSION['USER']['nickname']=$data['nickname'];
$_SESSION['USER']['sex']=$data['sex'];
$_SESSION['USER']['province']=$data['province'];
$_SESSION['USER']['city']=$data['city'];
$_SESSION['USER']['country']=$data['country'];
$_SESSION['USER']['headimgurl']=$data['headimgurl'];
$_SESSION['USER']['privilege']=$data['privilege'];
$_SESSION['USER']['unionid']=$data['unionid'];
echo "<script>window.location.href='index.php?mode=menu&openid={$openid}';</script>";

?>