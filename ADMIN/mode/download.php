<?php
include_once "sdk/mysql/index.php";
include_once "function/alioss/oss_upload.php";
include_once "function/alioss/oss_download.php";
$mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
$testid=$_GET['testid'];
$sql="select testname,testdataurl,testdataurl_s from testinfo  where testid='{$testid}'";
$urldata=$mysql->fetch_array($mysql->query($sql));
if($urldata['testdataurl_s']=="OK") 
{
	$url=oss_download($urldata['testdataurl']);
	echo "<script>window.location.href='{$url}'</script>";
	
}
else
{
	$sql="select answer from quesinfo where testid='{$testid}'";

    $ans=$mysql->fetch_array($mysql->query($sql))['answer'];
 $sql="select openid,userid,username from userinfo";
		$mysql->query($sql);$i=1;
		while($temp=$mysql->fetch_array())
		{
			$users[$i]=$temp;
			$i++;
		}
		$a=$b=$c=$d=0;
		// a 答题正确
		// b 答题错误
		// c 答题等待
		// d 没有答题
		foreach($users as $user)
		{
			//判断用户是否答题
			 $sql="select teststate,posttime,testtime from TestState where testid='{$testid}' and openid='{$user['openid']}'";
			$mysql->query($sql);
			if($mysql->db_num_rows()==0){$d++;$table_undo[$d]=$user;}
			else
			{
				$state=$mysql->fetch_array();
				if($state['teststate']=="READ")
				{
					$c++;
					$table_doing[$c]=$user;
				}
				else
				{
					 $sql="select userans from QuesWrong where openid='{$user['openid']}' and testid='{$testid}'";
					$mysql->query($sql);
                    if($mysql->db_num_rows()==0)
                    {
                    	$a++;$table_right[$a]=$user;$table_right[$a]['ans']=$ans;
                    	$table_right[$a]['posttime']=$state['posttime'];
                        $table_right[$a]['time']=strtotime($state['posttime'])-strtotime($state['testtime']);
                    }
                    else
                    {
                    	$b++;
                    	$data=$mysql->fetch_array();
                    	$table_wrong[$b]=$user;
                    	$table_wrong[$b]['ans']=$data['userans'];
                    	$table_wrong[$b]['posttime']=$state['posttime'];
                    	$table_wrong[$b]['time']=strtotime($state['posttime'])-strtotime($state['testtime']);
                    }
					
				}
			}
		}
		$id=1;
		if(count($table_right)!=0)
		foreach($table_right as $table)
		{  
			$DATA[$id]['ID']=$id;
			$DATA[$id]['userid']=$table['userid'];
			$DATA[$id]['username']=$table['username'];
			$DATA[$id]['state']="回答正确";
			$DATA[$id]['ans']=$ans;
			$DATA[$id]['posttime']=$table['posttime'];
			$DATA[$id]['time']=$table['time'];
		    $id++;
		}
		if(count($table_wrong)!=0)
		foreach($table_wrong as $table)
		{
			$DATA[$id]['ID']=$id;
			$DATA[$id]['userid']=$table['userid'];
			$DATA[$id]['username']=$table['username'];
			$DATA[$id]['state']="回答错误";
			$DATA[$id]['ans']=$table['ans'];
			$DATA[$id]['posttime']="-";
			$DATA[$id]['time']="-";
		    $id++;
		}
		if(count($table_doing)!=0)
		foreach($table_doing as $table)
		{
			$DATA[$id]['ID']=$id;
			$DATA[$id]['userid']=$table['userid'];
			$DATA[$id]['username']=$table['username'];
			$DATA[$id]['state']="正在答题/放弃答题";
			$DATA[$id]['ans']="-";
			$DATA[$id]['posttime']="-";
			$DATA[$id]['time']="-";
		    $id++;
		}
		if(count($table_undo)!=0)
		foreach($table_undo as $table)
		{
			$DATA[$id]['ID']=$id;
			$DATA[$id]['userid']=$table['userid'];
			$DATA[$id]['username']=$table['username'];
			$DATA[$id]['state']="尚未答题";
			$DATA[$id]['ans']="-";
			$DATA[$id]['posttime']="-";
			$DATA[$id]['time']="-";
		    $id++;
		}    
		  include_once "sdk/PhpSpreadsheet/autoload.php";
		  $Excle = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
           $Excle->setReadDataOnly(TRUE);
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('DataMOde.xlsx');
             $worksheet = $spreadsheet->getActiveSheet();
             //设置工作表标题名称
             $worksheet->setTitle("MainData");
			
			 //表头
             //设置单元格内容
             //第一个参数是列，第二个参数是行
             $worksheet->setCellValueByColumnAndRow(1, 1, '答题情况统计表');  //标题
             $worksheet->setCellValueByColumnAndRow(1, 2, 'ID');
             $worksheet->setCellValueByColumnAndRow(2, 2, '学号');
             $worksheet->setCellValueByColumnAndRow(3, 2, '姓名');
             $worksheet->setCellValueByColumnAndRow(4, 2, '答题状态');
             $worksheet->setCellValueByColumnAndRow(5, 2, '回答答案');
			 $worksheet->setCellValueByColumnAndRow(6, 2, '答题时间');
			 $worksheet->setCellValueByColumnAndRow(7, 2, '答题耗时');
			 
             //合并单元格
             $worksheet->mergeCells('A1:G1');
            
             $styleArray = [
             'font' => [
             'bold' => true
             ],
             'alignment' => [
             'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
             ],
             ];			
			
             //设置单元格样式
             $worksheet->getStyle('A1')->applyFromArray($styleArray)->getFont()->setSize(28);
             $worksheet->getStyle('A2:G2')->applyFromArray($styleArray)->getFont()->setSize(14);
		
			 for ($i=0; $i<=$id; $i++) {
			 	
              $j = $i + 3; //从表格第3行开始
              
			  
              $worksheet->setCellValueByColumnAndRow(1, $j, $DATA[$i]['ID']);
              $worksheet->setCellValueByColumnAndRow(2, $j, $DATA[$i]['userid']);
			  $worksheet->setCellValueByColumnAndRow(3, $j, $DATA[$i]['username']);
			  $worksheet->setCellValueByColumnAndRow(4, $j, $DATA[$i]['state']);
			  $worksheet->setCellValueByColumnAndRow(5, $j, $DATA[$i]['ans']);
			  $worksheet->setCellValueByColumnAndRow(6, $j,$DATA[$i]['posttime']);
			  $worksheet->setCellValueByColumnAndRow(7, $j,$DATA[$i]['time']);
             }
			
           $styleArrayBody = [
           'borders' => [
           'allBorders' => [
           'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
           'color' => ['argb' => '666666'],
           ],
           ],
           'alignment' => [
           'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
           ],
           ];
           
            //添加所有边框/居中
            $e=$j-1;
            $worksheet->getStyle('A1:G'.$e)->applyFromArray($styleArrayBody);
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $strrand= strtoupper(md5(uniqid(microtime(true),true))).strtoupper(md5(strtoupper(md5(uniqid(microtime(true),true)))));
            $writer->save('Temp/Data_'.$strrand.".xlsx");
			
			$object="Excle/xlsx/".date("Ymd")."/".date("His")."/".$strrand.".xlsx";
			 $path='Temp/Data_'.$strrand.".xlsx";
			if(oss_upload($object,$path))
			{
				$url=oss_download($object);
				if($urldata['testname']!=date("Y-m-d"))
				$testdataurl_s="OK";
				else 	$testdataurl_s="";
				$sql="update testinfo set testdataurl='{$object}',testdataurl_s='{$testdataurl_s}' where testid='{$testid}'";
				$mysql->query($sql);
				echo "<script>window.location.href='{$url}'</script>";
			}
			
			
			

}
?>