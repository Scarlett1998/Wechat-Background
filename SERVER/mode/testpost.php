<?php
if(ajax_in($_POST,"testpost"))
{

		$_POST=post_decode($_POST);
  $testid=$_POST['testid'];

	echo  $sql="select teststate from TestState where openid='{$_POST['openid']}' and testid='{$testid}'";
	 $mysql->query($sql);
	 $teststate=$mysql->fetch_array()['teststate'];
	 if($teststate!="READ"&$teststate!=null) exception_out(202);
	 else
	 {
	 	$time=date("Y-m-d H:i:s");
	 	$sql="update TestState set teststate='DONE',posttime='{$time}' where openid='{$_POST['openid']}' and testid='{$testid}'";
	    $mysql->query($sql);
  ;
		 $imax=$_POST['data'][0];
		for($i=1;$i<=$imax;$i++)
		{
      
			$sql="select answer from quesinfo where quesid='{$_POST['data'][$i]['quesid']}'";
			$mysql->query($sql);
			$answer=$mysql->fetch_array()[0];
			if($answer==$_POST['data'][$i]['answer'])
			{
			 $sql="insert into QuesRight (openid,quesid,testid) values('{$_POST['openid']}','{$_POST['data'][$i]['quesid']}','{$testid}')";
				$mysql->query($sql);
			}
			else
			{
			 $sql="insert into QuesWrong (openid,quesid,testid,userans) values('{$_POST['openid']}','{$_POST['data'][$i]['quesid']}','{$testid}','{$_POST['data'][$i]['answer']}')";
				$mysql->query($sql);
			}	
		}
		$DATA['res']=TRUE;
		ajax_out(0, $DATA);
		
	 }
	
}
else exception_out(1002);
?>