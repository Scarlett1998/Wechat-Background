<?php

//获得网页请求方式 GET POST AJAX
if(isset($_GET['rtype'])&&$_GET['rtype']!="")$rtype=$_GET['rtype'];
else $rtype="GET";
//获得网页请求模块 
if(isset($_GET['mode'])&&$_GET['mode']!="")$mode=$_GET['mode'];
else $mode="index";
//加载数据库配置文件
include_once "conf/mysql_conf.php";
//加载保存信息配置文件
include_once "conf/exception_conf.php";
//加载token配置文件
include_once "conf/token_conf.php";
include_once "function/getrandchar.php";
include_once "function/token_check.php";
include_once "function/login/autoload.php";
include_once "function/exception_out.php";
$_SESSION['exception']=$exception_conf;
if($rtype!="AJAX")
{
	//免登陆逻辑区域
    if($mode=="login")           include_once "mode/login.php";
	else if($mode=="forget")     echo "<script>alert(\"请与管理人员sang8052@qq.com联系获得您重置密码操作的授权代码\");window.location.href='index.php?mode=passreset';</script>";
	else if($mode=="passreset")  include_once "mode/passreset.php";
	else if($mode=="reg")        include_once "mode/reg.php";
	else if($mode=="admin")      include_once "mode/admin.php";
	else if($mode=="mail")       include_once "mode/mail.php";
	else if($mode=="error")      include_once "mode/error.php";  
	else if($mode=="oss")        include_once "mode/oss.php";
	
	else
	{
		//尝试使用cookie登录系统
	    
        if(isset($_COOKIE)&&$_SESSION['cookiepass']!=TRUE)
        {
        	if($_COOKIE['timelive']<=time()) login_fail(2);
			else
			{
				$_SESSION['username']=$_COOKIE['username'];
	            $_SESSION['key']=$_COOKIE['key'];
	            $_SESSION['token']['cookie']=$_COOKIE['token'];
	            if(token_check($_SESSION['key'],$_SESSION['token']['cookie'],$token_conf,"cookie")) login_success($username);
	            else login_fail(0);
			}
	        
        } 
       
		if(login_check())
		{
			switch($mode)
			{
				case "index":
					include_once "mode/index.php";break;
				case "test":
				    include_once "mode/test.php";break;
				case "data":
				    include_once "mode/data.php"; break;
				case "news":
				    include_once "mode/news.php"; break;
				case "download":
				    include_once "mode/download.php";break;
				default:
				    include_once "mode/error.php"; 
			}
			
		}

	}
	

}
else
{

	//加载mysql类库文件

    include_once "sdk/mysql/index.php";
    $mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
	//免登陆逻辑区域
	include_once "function/exception_out.php";
	if($mode=="login")             
	include_once "mode/login.php";
	else if($mode=="mail")          include_once "mode/mail.php";
	else if($mode=="reg")           include_once "mode/reg.php";    
	else if($mode=="login_check")   include_once "mode/login_check.php";
	else if($mode=="server")	    include_once "mode/server.php"; 
	else if($mode=="download")      include_once "mode/download.php";
	else if($mode=="data")          include_once "mode/data.php";
	else exception_out(1001,"json");
	             
    
}
?>