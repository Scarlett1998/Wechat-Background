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
				 <div class="admin-content-body">
		<div class="am-g">
		<!-- 搜索用户信息-->
      	 <div class="am-u-sm-6 am-u-end" style="height: 15%;">
             <div class="am-panel am-panel-default" style="height: 15%;">
               <div class="am-panel-bd">
               	<p>请在这这里输入您要查询的学生的学号</p>
               	<table class="am-table am-table-striped am-table-hover table-main" id="table_search">
               		<tr><td>学号</td><td><input type="text" id="userid"></td></tr>
          
           	      </table>
           	      <div align="center"> <button type="button" class="am-btn am-btn-success am-round" onclick="SearchUserInfo()">搜索用户信息</button></div>
           	   </div>
             </div>
            
				
        </div>
          <div class="am-u-sm-6 am-u-end" style="height: 15%;">
            <div class="am-panel am-panel-default" >
               <div class="am-panel-bd">
               	<p>用户个人信息<br/>
               		<span style="font-size: smaller;">部分信息采集自微信客户端</span>
               	</p>
           	     <table class="am-table am-table-striped am-table-hover table-main" id="table_info">
           	     	<tr><td>学号</td><td id="_userid"></td></tr>
           	        <tr><td>姓名</td><td id="username"></td></tr>
           	        <tr><td>性别</td><td id="usersex"></td></tr>
           	        <tr><td>微信昵称</td><td id="usernickname"></td></tr>
           	        <tr><td>微信头像</td><td ><img id="userheadimgurl"></td></tr>
           	        <tr><td>地址</td><td id="userlocal"></td></tr>
           	        </table>
           	   </div>
             </div>
				
        </div>
        </div>
				<div class="am-panel am-panel-default">
               <div class="am-panel-bd">
               	<table class="am-table am-table-striped am-table-hover table-main">
               		<thead>
               			<tr>
               				<th class="table-id">ID</th>
               				<th class="table-testid">考试编号</th>
               				<th class="table-testname">考试时间</th>
               				<th class="table-state">答题状态</th>
               				<th class="table-ans">回答答案</th>
               				<th class="table-time">答题时间</th>
               				<th class="table-timeused">答题耗时</th>
               			</tr>
               		</thead>
               		<tbody id="tablecontent">
               			
               		</tbody>
               	</table>
           	   </div>
              </div>
              
				 <script>
             	
             	
             	function SearchUserInfo()
             	{
             		var userid=document.getElementById("userid").value;
             		if(userid=="") alert("学号信息不能为空！");
             		else
             		{
             			var xmlhttp;
             			xmlhttp=new XMLHttpRequest();
             			xmlhttp.open("POST","index.php?mode=data&rtype=AJAX",false);
             			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             			xmlhttp.send("userid="+userid);
             			data=JSON.parse(xmlhttp.responseText);
                      if(data['status']==301)alert("指定的用户不存在!");
                      else
                      {document.getElementById("_userid").innerText=data['user']['userid'];
             			document.getElementById("username").innerText=data['user']['username'];
             			document.getElementById("usersex").innerText=data['user']['sex'];
             			document.getElementById("usernickname").innerText=data['user']['nickname'];
             			document.getElementById("userheadimgurl").src=data['user']['headimgurl'];
             			document.getElementById("userlocal").innerText=data['user']['country']+data['user']['province']+data['user']['city'];
             			var id=1;var imax=data['testall'];
             		    var content="";
             			for(var i=0;i<=imax;i++)
             			{
             				content=content+"<tr><td>"+id+"</td><td>"+data['test'][i]['testid']+"</td><td>"+data['test'][i]['testname']+"</td><td>"+data['test'][i]['state']+"</td><td>"+data['test'][i]['answer']+"</td><td>"+data['test'][i]['anstime']+"</td><td>"+data['test'][i]['time']+"</td></tr>"
             			    id++;
             			}
             			document.getElementById("tablecontent").innerHTML=content;
             			
                      }
             			
             		}
             	}
             </script>