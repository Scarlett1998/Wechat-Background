<?php

if(ajax_in($_POST,"openid"))
{
		$_POST=post_decode($_POST);
	$sql="select userid,username from userinfo where openid='{$_POST['openid']}'";
	$mysql->query($sql);
	if($mysql->db_num_rows()==0)
	{$DATA['userid']=0;$DATA['username']="";}
	else $DATA=$mysql->fetch_assoc();
	ajax_out(0,$DATA);
}
else exception_out(1002);
?>