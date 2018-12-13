<?php
//加载mysql类库文件
   include_once "sdk/mysql/index.php";
   $mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
	if($rtype=="GET")  
	{
		if($_GET['action']=="list") include_once "html/iframe/testlist.php";
		else if($_GET['action']=="insert") 
		{ 
			$sql="select testid,testname from testinfo where Id=(select Max(Id) from testinfo )";
			$testdata=$mysql->fetch_array($mysql->query($sql));
			$poststate="new";$teststate="READY";
			$quesid=md5(time()+rand(1000000,9999999));
		    $testid=substr(strtoupper(md5(time()+rand(1000000,9999999)+time())),0,16);
		    $timenum_today=strtotime(date("Y-m-d",time()));
            $timenum_test=strtotime($testdata['testname']);
            $teststate=$timenum_today-$timenum_test;
			if($teststate<=0)
			{
				
				$insert_time=strtotime($testdata['testname'])+24*3600;
				$insert_date=date("Y-m-d",$insert_time);
			}
			else
			{
				$insert_date=date("Y-m-d",time());
			}
			include_once "html/iframe/test.php";
	    }
		else if($_GET['action']=="change") 
		{
			$testid=$_GET['testid'];
			$poststate="change";
			$sql="select testname from testinfo where testid='{$_GET['testid']}'";
			$testdata=$mysql->fetch_array($mysql->query($sql));
			$insert_date=$testdata['testname'];
			
		    $sql="select quesid,question,optionA,optionB,optionC,optionD,answer,quesabout from quesinfo where testid='{$_GET['testid']}'";
			$testdata=$mysql->fetch_array($mysql->query($sql));
			$testdata['question']=base64_decode($testdata['question']);$testdata['quesabout']=base64_decode($testdata['quesabout']);
			$quesid=$testdata['quesid'];
			include_once "html/iframe/test.php";
		}
	}      
	else if($rtype=="POST")   
	{
	
		$quesid=$_POST['quesid'];$testid=$_POST['testid'];
		$question=base64_encode($_POST['question']);
		$optionA=$_POST['optionA'];$optionB=$_POST['optionB'];$optionC=$_POST['optionC'];$optionD=$_POST['optionD'];$answer=$_POST['answer'];
		$testname=$_POST['insert_date'];$teststate=$_POST['teststate'];
		$quesabout=base64_encode($_POST['quesabout']);
		if($_GET['poststate']=="new")
		{
		   $sql="insert into testinfo (testid,testname) values('{$testid}','{$testname}')";
		   $mysql->query($sql);
		   $sql="insert into quesinfo (quesid,testid,question,optionA,optionB,optionC,optionD,answer,quesabout) values('{$quesid}','{$testid}','{$question}','{$optionA}','{$optionB}','{$optionC}','{$optionD}','{$answer}','{$quesabout}')";
		   $mysql->query($sql);
		    echo "<script>alert(\"新增题库数据成功！\");window.location.href='index.php?mode=test&action=list';</script>";	
		}
		else if($_GET['poststate']=="change")
		{
	       $sql="update quesinfo set quesid='{$quesid}',testid='{$testid}',question='{$question}',optionA='{$optionA}',optionB='{$optionB}',optionC='{$optionC}',optionD='{$optionD}',answer='{$answer}',quesabout='{$quesabout}' where testid='{$_GET['testid']}'";
		    $mysql->query($sql);
		   echo "<script>alert(\"更改题库数据成功！\");window.location.href='index.php?mode=test&action=list';</script>";	
		}
		
		
		
	}
?>