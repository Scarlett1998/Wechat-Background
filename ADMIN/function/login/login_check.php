<?php
function login_check($jump=TRUE)
{ 
	if($jump)
	{
		if(!isset($_SESSION['username'])||$_SESSION['username']=="")
	   {login_fail(2);return false;}
	   else
	   {
		
		   if(!token_check($_SESSION['key'],$_SESSION['token']['session'],$token_conf))
		   {login_fail(3);return false;}
		   else
		   {
			 if($_SESSION['timealive']<time())
			 {login_fail(1);return false;}
		     else
		   	 {
		   		$_SESSION['timealive']=time()+600;
		   		return true;
		   	 }
		   }
	   }
	}
	else
	{
	   if(!isset($_SESSION['username'])||$_SESSION['username']=="")return false;
	   else
	   {
		
		   if(!token_check($_SESSION['key'],$_SESSION['token']['session'],$token_conf))return false;
		   else
		   {
			 if($_SESSION['timealive']<time())return false;
		     else
		   	 {
		   		$_SESSION['timealive']=time()+600;
		   		return true;
		   	 }
		   }
	   }
	}
	
	
}
?>