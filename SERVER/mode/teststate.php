<?php

if(ajax_in($_POST,"teststate"))
{
	$_POST=post_decode($_POST);
	$date=date("Y-m-d");
	$sql="select testid from testinfo where testname='{$date}'";
	$mysql->query($sql);
    if($mysql->db_num_rows()==0) exception_out(1004);
    else
    {
      $testid=$mysql->fetch_array()['testid'];
	  $sql="select teststate from TestState where openid='{$_POST['openid']}' and testid='{$testid}'";
	  $mysql->query($sql);
	  if($mysql->db_num_rows()!=0)
	  $state=$mysql->fetch_array()['teststate'];
	  else $state="READY";
	  $data['testid']=$testid;$data['state']=$state;
	  ajax_out(0, $data);
    }
	
	
}
else exception_out(1002);
?>