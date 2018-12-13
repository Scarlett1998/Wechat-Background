<?php
if(ajax_in($_POST,"testdata"))
{
		$_POST=post_decode($_POST);
	$sql="select testname from testinfo where testid='{$_POST['testid']}'";
	$mysql->query($sql);
	if($mysql->db_num_rows()!=0)
	{
		$testtime=$mysql->fetch_array()[0];
	    $_testtime=date("Y-m-d");
	    if($testtime!=$_testtime) exception_out(203);
		else
		{   $testid=$_POST['testid'];
	        $sql="select teststate from TestState where openid='{$_POST['openid']}' and testid='{$testid}'";
	        $mysql->query($sql);
	        if($mysql->db_num_rows()!=0) exception_out(203);
			else
			{
				$time=date("Y-m-d H:i:s");
				$sql="insert TestState set teststate='READ',testtime='{$time}' ,openid='{$_POST['openid']}', testid='{$testid}'";
				$mysql->query($sql);
				$sql="select quesid,question,optionA,optionB,optionC,optionD from quesinfo where testid='{$_POST['testid']}'";
			    $mysql->query($sql);$i=1;
			    while($data=$mysql->fetch_array())
			    {
				;
				   $DATA[$i]['ques']=base64_decode($data['question']);
                   $DATA[$i]['quesid']=$data['quesid'];
				   $DATA[$i]['optionA']=$data['optionA'];
				   $DATA[$i]['optionB']=$data['optionB'];
				   $DATA[$i]['optionC']=$data['optionC'];
				   $DATA[$i]['optionD']=$data['optionD'];	
				  
				   $i++;
			    }
			$DATA[0]=$i-1;
            
			ajax_out(0, $DATA);
			}
		
			
		}
	}
	else exception_out(204);
	
	
}
else exception_out(1002);
?>
