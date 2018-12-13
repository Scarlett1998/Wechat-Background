<?php
include_once "conf.php";
if($_GET['mode']==""||!isset($_GET['mode'])) $mode="login";
else $mode=$_GET['mode'];

switch($mode)
{
	
	case "login":
	//echo AUTH_URL;
	echo "<script>window.location.href='".AUTH_URL."';</script>";
	break;
	
	
	case "menu" :
	include_once "mode/menu.php";
	break;
	
	case "test":
	include_once "mode/test.php";
	break;
	
	case "quesinfo":
	include_once "mode/quesinfo.php";
	break;
	
	case "userinfo":
	include_once "mode/userinfo.php";
	break;
	
	case "history":
	include_once "mode/history.php";
	break;
	
	
	default:
	echo "<script>alert(\"参数出错！没有找到对应的模块\");window.location.href='index.php';</script>";
		
}

?>