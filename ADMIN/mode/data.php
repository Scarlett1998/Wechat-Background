<?php

	

if(!isset($_GET['rtype']))$_GET['rtype']="GET";
if($_GET['rtype']=="GET")
{
     include_once "sdk/mysql/index.php";
$mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
if($_GET['action']=="show"||$_GET['action']=="today")
{if(!isset($_GET['testname'])) $_GET['testname']=date("Y-m-d",time());
 $testname=$_GET['testname'];
$sql="select testid from testinfo where testname='{$testname}'";
$testid=$mysql->fetch_array($mysql->query($sql))['testid'];

// 搜索参加本次考试的人 TEST[state]
$sql="select count(*) from userinfo";
$USER['all']=$mysql->fetch_array($mysql->query($sql))[0];
$sql="select openid,teststate,testtime,posttime from TestState where testid='{$testid}'";
$mysql->query($sql);$i=1;$j=0;
$TIME['10']=$TIME['20']=$TIME['30']=$TIME['40']=$TIME['50']=$TIME['60']=$TIME['MORE']=0;
while($temp=$mysql->fetch_array())
{
	$USER[$i]=$temp;
	if($temp['teststate']=="DONE")
	{
		$j++;
		$time_start=strtotime($temp['testtime']);
	    $time_end=strtotime($temp['posttime']);
		$time=$time_end-$time_start;
	    
	if($time>=0&&$time<10)$TIME['10']++;
	else if($time>=10&&$time<20)$TIME['20']++;	
	else if($time>=20&&$time<30)$TIME['30']++;	
	else if($time>=30&&$time<40)$TIME['40']++;	
	else if($time>=40&&$time<50)$TIME['50']++;	
	else if($time>=50&&$time<60)$TIME['60']++;
	else if($time>=60)$TIME['MORE']++;	
	}
	$USER["DONE"][$j]['openid']=$temp['openid'];
	
		
	$i++;
	
}

$USER['done']=$j;$USER['doing']=$i-$j-1;$USER['do']=$i-1;$USER['undo']=$USER['all']-$USER['do'];

// 检索答题正确率 
$sql="select count(*) from QuesRight where testid='{$testid}'";
$ANS['right']=$mysql->fetch_array($mysql->query($sql))[0];
$sql="select count(*) from QuesWrong where testid='{$testid}'";
$ANS['wrong']=$mysql->fetch_array($mysql->query($sql))[0];

//检索选项
$ANS['A']=$ANS['B']=$ANS['C']=$ANS['D']=0;
$sql="select answer from quesinfo where testid='{$testid}'";
$ans=$mysql->fetch_array($mysql->query($sql))[0];
$ANS[$ans]=$ANS['right'];
$sql="select userans from QuesWrong where testid='{$testid}'";
$mysql->query($sql);
while($temp=$mysql->fetch_array())
{
    $ANS[$temp['userans']]++;  
}

include_once "html/iframe/data_show.php";

}
else if($_GET['action']=="history")
{
	include_once "html/iframe/data_history.php";
}
else if($_GET['action']=="people")
{
	include_once "html/iframe/data_people.php";
}
}
//AJAX模式
else if($_GET['rtype']=="AJAX")
{
	//搜索用户的个人信息
	$sql="select * from userinfo where userid='{$_POST['userid']}'";
	$mysql->query($sql);

	if($mysql->db_num_rows()==0)exception_out(301,"json");
	else
	{
		$userdata=$mysql->fetch_array();//存放用户个人信息
		
		//搜索历史的测试数据
		$sql="select testid,testname from testinfo";
		$mysql->query($sql);$t=0;
		while($temp=$mysql->fetch_array())
		{   
			$timetoday=strtotime(date("Y-m-d",time()));
			$timetoday=strtotime(date("Y-m-d",time()));
			if(strtotime($temp['testname'])<=$timetoday)
            {
              $tests[$t]=$temp;
			  $t++;
            }
		}
		$t=0;
		foreach($tests as $test)
		{
			
		//对每次测试搜索正确答案
		$sql="select answer from quesinfo where testid='{$test['testid']}'";
		$ans=$mysql->fetch_array($mysql->query($sql))['answer'];
		
		//对每次测试搜索用户的答题状态
	$sql="select teststate,testtime,posttime from TestState where testid='{$test['testid']}' and openid='{$userdata['openid']}'";
	    $mysql->query($sql);
	    if($mysql->db_num_rows()==0)$teststate="UNDO";
	    else
	    {
	    	 $temp=$mysql->fetch_array();
             $teststate=$temp['teststate'];
	    	if($teststate=="DONE")
	    	{
                $anstime=$temp['posttime'];
                $time=strtotime($temp['posttime'])-strtotime($temp['testtime']);
	    		//搜索用户的错题数据
	    		$sql="select userans from QuesWrong where testid='{$test['testid']}' and openid='{$userdata['openid']}'";
	    		$mysql->query($sql);
	    		 if($mysql->db_num_rows()==0){$teststate="RIGHT";$answer=$ans;}
	    		 else 
	    		 {
	    		 	$teststate="WRONG";
	    		 	$answer=$mysql->fetch_array()['userans'];
	    		 }
	    		
	    	}
	    }
	    $DATA['test'][$t]['testid']=$test['testid'];
	    $DATA['test'][$t]['testname']=$test['testname'];
	    switch($teststate)
	    {
	    	case "RIGHT": $teststate="<span style=\"color:green\">回答正确</span>"; break;
	    	case "WRONG": $teststate="<span style=\"color:orange\">回答错误</span>";break;
	    	case "READ": $teststate="<span style=\"color:orange\">正在答题/放弃答题</span>";break;
	    	case "UNDO": $teststate="<span style=\"color:orange\">尚未答题</span>";break;
	    }
	    $DATA['test'][$t]['state']=$teststate;
	    if($answer==null)$answer="-";
	    $DATA['test'][$t]['answer']=$answer;
	    if($anstime==null)$anstime="-";
        $DATA['test'][$t]['anstime']=$anstime;
        if($time==null)$time="-";
        $DATA['test'][$t]['time']=$time;
	    $t++;
	    $answer=$anstime=$time=null;
		}
		$DATA['testall']=$t-1;
		$DATA['user']=$userdata;
		echo json_encode($DATA);	
	}

}
?>