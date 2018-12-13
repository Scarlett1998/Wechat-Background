<?php
if(ajax_in($_POST,"userinfo"))
{
		$_POST=post_decode($_POST);
	$sql="select username from userinfo where userid='{$_POST['userid']}'";
	$mysql->query($sql);
	if($mysql->db_num_rows()!=0)
	{
		$_username=$mysql->fetch_array()['username'];
		if($_username==$_POST['username'])
		exception_out(102);
		else exception_out(101);
		
	}
	else 
	{
		$user=$_SESSION['USER'];
		if($user['sex']==1)$sex="男";else if($user['sex']==2)$sex="女";else $sex="未知";
		$session_user=",'{$user['nickname']}','{$sex}','{$user['province']}','{$user['city']}','{$user['country']}','{$user['headimgurl']}','{$user['privilege']}','{$user['unionid']}'";
		$sql="insert into userinfo (openid,userid,username,nickname,sex,province,city,country,headimgurl,privilege,unionid) values('{$_POST['openid']}',{$_POST['userid']},'{$_POST['username']}'{$session_user})";
		$mysql->query($sql);
		$DATA['userstate']=TRUE;
		ajax_out(0, $DATA);
	}
	
	
}
else exception_out(1002);
?>