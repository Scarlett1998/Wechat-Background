<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/amazeui.css" />
        <link rel="stylesheet" href="assets/css/core.css" />
        <link rel="stylesheet" href="assets/css/menu.css" />
        <link rel="stylesheet" href="assets/css/server/site.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
	</head>
  <div class="admin">
	<div class="content-page">
		
         <div class="am-panel am-panel-default">
           <div class="am-panel-bd">
           	  <p>新增题库数据</p>
           	  <p>本页面编辑的通知信息将会在客户端首页显示,受设备差异影响，您在此处编辑的通知消息在手机端可能略有差异。<br/>
           	  	 题库编号和题库分发时间由系统自动生成,您无需更改。
           	  </p>
              <form  action="index.php?mode=test&rtype=POST&testid=<?php echo $_GET['testid'] ?>&poststate=<?php echo $poststate ?>" method="post"><table border="0">
              	<!-- 隐藏变量赋值 -->
              	<input type="hidden" name="teststate" value="<?php echo $teststate ?>">
              	<input type="hidden" name="quesid" value="<?php echo $quesid ?>">
              	<!-- 赋值结束-->
              	<tr><td align="left" > <p>题库编号:</p><input type="text" name="testid" readonly="readonly" style="background-color:rgb(235, 235, 228) ;" value="<?php echo $testid ?>"></td><td align="left" > <p>题库分发时间:</p><input type="text" name="insert_date" readonly="readonly" style="background-color:rgb(235, 235, 228);" value="<?php echo $insert_date ?>"></td></tr>
              	<tr><td align="left" colspan="2" >
              	 <p>题目题干:</p>
           	     <textarea name="question" id="content_question"><?php echo $testdata['question'] ?></textarea>
           	     <script type="text/javascript" src="assets/js/html/rand_string.js"></script>
                 <script type="text/javascript"src="assets/ueditor/ueditor.config.js"></script>  
                 <script type="text/javascript"src="assets/ueditor/ueditor.all.js"></script> 
                 <script type="text/javascript"> var ue1=UE.getEditor('content_question',{elementPathEnabled:false}); ue1.ready(function() {ue1.setHeight(100);});  </script> 
                 </td></tr>
                 	<tr><td align="left" > <p>A选项:</p><input type="text" name="optionA"  value="<?php echo $testdata['optionA'] ?>"></td><td align="left" > <p>C选项:</p><input  type="text" name="optionC" value="<?php echo $testdata['optionB'] ?>"></td></tr>
                 	<tr><td align="left" > <p>B选项:</p><input type="text" name="optionB"  value="<?php echo $testdata['optionC'] ?>"></td><td align="left" > <p>D选项:</p><input  type="text" name="optionD"  value="<?php echo $testdata['optionD'] ?>"></td></tr>
                  <tr><td colspan="2" align="left"><p style="color: red;">正确答案</p><input type="radio" name="answer" value="A" <?php if($testdata['answer']=="A") echo "checked=\"checked\"";?> >A&nbsp;&nbsp;<input type="radio" name="answer" value="B"  <?php if($testdata['answer']=="B") echo "checked=\"checked\"";?>  >B&nbsp;&nbsp;<input type="radio" name="answer" value="C" <?php if($testdata['answer']=="C") echo "checked=\"checked\""?>>C&nbsp;&nbsp;<input type="radio" name="answer" value="D" <?php if($testdata['answer']=="D") echo "checked=\"checked\""?>>D&nbsp;&nbsp;</td></tr>
                 	<tr><td align="left" colspan="2" >
              	    <p>题目解析:</p>
           	       <textarea name="quesabout" id="content_quesabout"><?php echo $testdata['quesabout'] ?></textarea>
           
                   <script type="text/javascript"> var ue2=UE.getEditor('content_quesabout',{elementPathEnabled:false}); ue2.ready(function() {ue2.setHeight(100);});  </script> 
                   </td></tr>
                 <tr><td colspan="2" align="center"><hr/><button type="submit"  align="right" class="am-btn am-btn-success am-round" style="align:center;width: 40%;">提交</button></td></tr></table> 
                </form>
           	</div>
           </div>
	</div>
</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
