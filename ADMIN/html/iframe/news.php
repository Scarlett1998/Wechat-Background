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
           	  <p>发布系统通知</p>
           	  <p>本页面编辑的通知信息将会在客户端首页显示,受设备差异影响，您在此处编辑的通知消息在手机端可能略有差异</p>
              <form  action="index.php?mode=news&rtype=POST" method="post"><table border="0"><tr><td align="left">
           	     <textarea name="news_content" id="content"><?php echo $news_content ?></textarea>
           	     <script type="text/javascript" src="assets/js/html/rand_string.js"></script>
                 <script type="text/javascript"src="assets/ueditor/ueditor.config.js"></script>  
                 <script type="text/javascript"src="assets/ueditor/ueditor.all.js"></script> 
                 <script type="text/javascript"> var ue=UE.getEditor('content');  </script> 
                 </td></tr><tr><td align="center"><hr/><button type="submit" align="right" class="am-btn am-btn-success am-round" style="align:center;width: 40%;">提交</button>
           	 </td></tr></table> </form>
           	</div>
           </div>
	</div>
</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>

	
	