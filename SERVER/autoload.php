<?php
//加载配置文件
include_once "conf/mysql_conf.php";
include_once "conf/exception_conf.php";
$_SESSION['Exception']=$exception_conf;
//加载mysql类库文件
include_once "sdk/mysql/index.php";
$mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
//加载函数文件
include_once "function/autoload.php";

switch($mode)
{
	case "openid":
	 include_once   "mode/openid.php" ;
		break;
		
	case "news":
	 include_once   "mode/news.php" ;
		break;
		
	case "testdata":
	 include_once   "mode/testdata.php" ;
		break;
		
	case "teststate":
	   include_once "mode/teststate.php";
	    break;
	
	case "testpost":
	   include_once "mode/testpost.php";
	    break;
		
	case "userinfo":
	     include_once "mode/userinfo.php";
	     break;

	
	case "testinfo":
	      include_once "mode/testinfo.php";
	      break;
		  
	default: 
		   exception_out(1001);
		   break;  
		
		
		
}

?>