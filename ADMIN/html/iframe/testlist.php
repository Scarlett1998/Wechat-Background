<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>后台模板</title>
		<link rel="stylesheet" href="assets/css/amazeui.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/core.css" />
		<link rel="stylesheet" href="assets/css/menu.css" />
		<link rel="stylesheet" href="assets/css/index.css" />
		<link rel="stylesheet" href="assets/css/admin.css" />
		<link rel="stylesheet" href="assets/css/page/typography.css" />
		<link rel="stylesheet" href="assets/css/page/form.css" />
	</head>
	<body>

		<!-- Start right Content here -->
		<div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="card-box">
					
					  
					  <!-- Row start -->
					  	<div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
               <th class="table-id">ID</th><th class="table-title">题库编号</th><th class="table-type">题库类别</th><th class="table-num">题目数量</th><th class="table-date">分发时间</th><th class="table-state">题库状态</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
             <?php 
             	if(!isset($_GET['page']))
             	{
             	  $sql="select count(*) from testinfo ";
             	  $total=$mysql->fetch_array($mysql->query($sql))[0];
             	  $page=1;	
             	}
             	  else{$page=$_GET['page'];$total=$_GET['total'];}
             	  $Id=$page*10-9;$limit_l=$page*10-10;$limit_r=$limit_l+10;
             	  $sql="select * from testinfo limit {$limit_l},{$limit_r} ";
             	  $mysql->query($sql);
             	  while($Test=$mysql->fetch_array())
             	{ include "function/testlist_alone.php";  $Id++;}
             	  
             	  
             ?>
           
              </tbody>
            </table>
            <div class="am-cf">
              共 <?php echo $total?>条记录
              	<?php $pageall=ceil($total/10);?>
              <div class="am-fr">
                <ul class="am-pagination">
            <?php 
            $page_l=$page-1;$page_r=$page+1;
            if($page!=1)echo "<li ><a href=\"index.php?mode=test&action=testlist&page={$page_l}&total={$total}\">«</a></li>";
            if($pageall<=6)
            {
            	 for($i=1;$i<=$pageall;$i++)
               {
            	if($i==$page) $class="class=\"am-active\"";
            	else $class="";
            	echo "<li {$class}><a href=\"index.php?mode=test&action=testlist&page={$i}&total={$total}\">$i</a></li>";
               }
            }
            else
            {
            	if($page>3)$i=$page-3;else $i=1;
            	if($page+3>$pageall)$$pagemax=$pageall;else $pagemax=$page+3;
            	 for($i;$i<=$pagemax;$i++)
              {
            	if($i==$page) $class="class=\"am-active\"";
            	else $class="";
            	echo "<li {$class}><a href=\"index.php?mode=test&action=testlist&page={$i}&total={$total}\">$i</a></li>";
               }
            }
           
            if($page!=$pageall)echo "<li ><a href=\"index.php?mode=test&action=testlist&page={$page_r}&total={$total}\">«</a></li>";
                  ?>
                
                </ul>
              </div>
            </div>
            <hr />
            <p>1.0版本中暂时只支持单选题的形式，而且每个题库中只能输入一题。后期我们将逐步开放多选、判断、填空、简答题和多题输入功能。</p>
          </form>
        </div>

      </div>
					  <!-- Row end -->
					  
					</div>
				
				
				
				
				</div>
			

			</div>
		</div>
		<!-- end right Content here -->
	
	
		<script>
			function url_jump(button)
			{
				var url=button.getAttribute("url");
				window.location.href=url;
			}
		</script>
		<script type="text/javascript" src="assets/js/jquery-2.1.0.js" ></script>
		<script type="text/javascript" src="assets/js/amazeui.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js" ></script>
		<script type="text/javascript" src="assets/js/blockUI.js" ></script>
	</body>
	
</html>
