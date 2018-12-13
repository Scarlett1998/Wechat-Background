<?php

if($rtype=="GET")
{
   session_destroy();
   setcookie("timelive","-1","86400");
   include_once "html/reg.html";
}
else if($rtype=="AJAX")
{
	
	$sql="select count(*) from admininfo where username='{$_POST['username']}'";
	$mysql->query($sql);
    $num=$mysql->fetch_array()[0];
	if($num!=0) exception_out(304,"json");
	else
	{
		include_once "function/hash_password.php";
		include_once "function/getrandchar.php";
		$salt=getrandchar(6);
		$password=hash_password($_POST['password'],$salt);
		$token=getrandchar(64);
		//$_POST['called']=base64_decode($_POST['called']);
		$sql="insert into admininfo (username,called,password,salt,state,statetoken,mail) values('{$_POST['username']}','{$_POST['called']}','{$password}','{$salt}','READY','$token','{$_POST['mail']}')";
	    $mysql->query($sql);
		$Json['status']=0;
		$Json['mes']=NULL;
		$Json['data']['token']=$token;
		echo json_encode($Json);
	}
	
	
}	

?>