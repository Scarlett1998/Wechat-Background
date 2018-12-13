<?php
if(ajax_in($_POST,"testinfo"))
{
		$_POST=post_decode($_POST);
	$sql="select quesid from QuesRight where openid='{$_POST['openid']}' and testid='{$testid}'";
	$mysql->query($sql);$i=1;
	while($date=$mysql->fetch_array())
	{
		$right[$i]=$data;
		$i++;
	}
	$sql="select quesid,userans from QuesWrong where openid='{$_POST['openid']}' and testid='{$testid}'";
	$mysql->query($sql);
	while($date=$mysql->fetch_array())
	{
		$wrong[$i]=$data;
		$i++;
	}
	$DATA[0]=$i-1;
	$imax=$DATA[0];$i=1;
	foreach($right as $data)
	{
		$sql="select * from question where quesid='{$data['quesid']}'";
		$mysql->query($sql);
		$_data=$mysql->fetch_array();
		 $DATA[$i]['quesid']=base64_encode($_data['quesid']);
	     $DATA[$i]['ques']=base64_encode($_data['question']);
		 $DATA[$i]['optionA']=base64_encode($_data['optionA']);
	     $DATA[$i]['optionB']=base64_encode($_data['optionB']);
		 $DATA[$i]['optionC']=base64_encode($_data['optionC']);
		 $DATA[$i]['optionD']=base64_encode($_data['optionD']);	
		 $DATA[$i]['AnswerRight']=base64_encode($_data['answer']);
		 $DATA[$i]['AnswerPOST']=base64_encode($_data['answer']);
		 $DATA[$i]['state']=TRUE;
		 $DATA[$i]['quesabout']=base64_encode($_data['quesabout']);
		 $i++;
		 
	}
    foreach($wrong as $data)
	{
		$sql="select * from question where quesid='{$data['quesid']}'";
		$mysql->query($sql);
		$_data=$mysql->fetch_array();
		 $DATA[$i]['quesid']=base64_encode($_data['quesid']);
	     $DATA[$i]['ques']=base64_encode($_data['question']);
		 $DATA[$i]['optionA']=base64_encode($_data['optionA']);
	     $DATA[$i]['optionB']=base64_encode($_data['optionB']);
		 $DATA[$i]['optionC']=base64_encode($_data['optionC']);
		 $DATA[$i]['optionD']=base64_encode($_data['optionD']);	
		 $DATA[$i]['AnswerRight']=base64_encode($_data['answer']);
		 $DATA[$i]['AnswerPOST']=base64_encode($data['userans']);
		 $DATA[$i]['state']=FALSE;
		 $DATA[$i]['quesabout']=base64_encode($_data['quesabout']);
		 $i++;
		 
	}
	ajax_out(0,$DATA);
}
else exception_out(1002);
?>