<?php
if($rtype=="GET")
{
	session_destroy();
    setcookie("timelive","-1","86400");
    include_once "html/login.html";
}
else if($rtype=="AJAX")
{
	
	$sql="select password,salt,state from admininfo where username='{$_POST['username']}'";
	$mysql->query($sql);
	$count=$mysql->db_num_rows();
	if($count==0) exception_out(301,"json");
	else
	{
		include_once "function/hash_password.php";
		$data=$mysql->fetch_array();
		if($data['state']!="PASS") exception_out(303,"json");
		$_password=hash_password($_POST['password'],$data['salt']);
		if($_password!=$data['password']) exception_out(302,"json");
		else 
		{
			 $Json['status']=0;
			 $Json['mes']=NULL;
			 include_once "function/login/login_success.php";
			 login_success($_POST['username']);
			 echo json_encode($Json);	
		}
	}
	
	
}	

?>