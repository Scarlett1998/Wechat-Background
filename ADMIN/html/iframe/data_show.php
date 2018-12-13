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
		<script type="text/javascript" src="assets/js/echarts_4.2.0-rc.2.js"></script>
		<script type="text/javascript" src="assets/js/echarts_theme_macarons.js"></script>
        <script type="text/javascript" src="assets/js/echarts_theme_infographic.js"></script>
		<script type="text/javascript" src="assets/js/echarts_theme_shine.js"></script>
		<script type="text/javascript" src="assets/js/echarts_theme_roma.js"></script>
	
	</head>
  <div class="admin">
	<div class="content-page">
		<div class="am-panel am-panel-default">
           <div class="am-panel-bd">
           <p>答题情况简表</p>
            <div id="answerdata_table">
               <table border="0" width="100%" height="100%"><tr>
               	  <!-- 答题总体情况-->
               	 	<td width="25%"> <div id="answer_all" style="width: 100%;height:200px;"></div></td>
                   <!-- 答题正确情况-->
               	 	<td width="25%"> <div id="answer_right" style="width: 100%;height:200px;"></div></td>	
                    <!-- 答题答案情况-->
                    <td width="25%"> <div id="answer_data" style="width: 100%;height:200px;"></div></td>
               	    <!-- 答题时间情况-->
               	    <td width="25%"> <div id="answer_time" style="width: 100%;height:200px;"></div></td>
                     </tr></table>
                       
                      
                 
            </div>
        
           	</div>
         </div>
         <!-- 下载答题情况详细数据-->
         <div class="am-panel am-panel-default">
           <div class="am-panel-bd">
           	<p>点击下方的下载报表数据按钮可以下载当前答题情况的EXCLE统计文件报表。<br/>请注意：历史答题情况的报表文件数据不会实时更新。相反，今日的答题情况会实时更新数据</p>
           		<a target="_blank" href="index.php?mode=download&testid=<?php echo $testid ?>"><button type="button">下载数据报表文件</button></a>
           	</div>
           </div>
              <!-- 答题情况列表-->
         <div class="am-panel am-panel-default">
           <div class="am-panel-bd">
           	
           	    <?php include_once "function/data_table_list.php"?>
           	</div>
           </div>
	</div>
	</div>
    <?php include_once "function/data_echart_js.php"?>
</body>
</html>
	
	