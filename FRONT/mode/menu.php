<html>
	<title>每日一题</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<head>
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<link rel="stylesheet" type="text/css" href="css/example.css">
	<link rel="stylesheet" type="text/css" href="css/weui.css">	
	<link rel="stylesheet" type="text/css" href="css/weui.min.css">
	</head>
	<style>
			.btn_menu
			{
				width: 80%;
				height: 30%;
				padding-left: 40px;
				padding-top: 70px;
			}
			.firstpage
			{
				width: 100%;
				height: 90%;
				/*background-image: url(../weui-master/dist/example/images/logo.png);*/
			}
			.photo
			{
				width: 100%;
				height: 100%;
				background-image:url(http://qqcomfun.oss-cn-beijing.aliyuncs.com/wechat_cdn/2.jpg);
				background-size: 100% 100%;
				background-repeat:no-repeat; 
				-moz-background-size:100% 100%;
			}
			.putin
			{
				width: 100%;
				height: 28%;
			}
			</style>
	<body class="photo">
		<!-- 占位DIV Start-->
		<div class="putin"></div> 
		<!-- 占位DIV End-->
		<!-- 通知消息 Start-->
		<div style="width: 80%; height: 35%; padding-left: 25px;padding-right: 20px;" align="center">
			<table><tr><td id="shownews" align="center">
			</td></tr></table>
		</div>
	  <!--通知消息 End-->
	  <!-- 按钮 Start-->
	  <div class="btn_menu">
	  	<input onclick="StartTest()" type="button" value="开始做题" class="weui_btn weui_btn_primary" align="center" />
	  	<input onclick="TestHistory()" type="button" value="做题记录" class="weui_btn  weui_btn_primary" align="center" />
		<footer style="color: gray;font-size: smaller;text-align-last: center;">Copyright 2018 © iw3c.cc All Right Reserved.<br/><a href="http://http://www.miitbeian.gov.cn">苏ICP备16064625号-2</a>  </footer>
	  </div>
	    <!-- 按钮 End-->
	<script type="text/javascript" src="js/Hash.js"></script>
	<script>
		var button_test;
		var testid;
		var openid="<?php echo $_GET['openid'] ?>";
		
		//ajax 获得用户当天是否已经做题 ,并写入全局变量
		
		LoadPage();
		
		
		function StartTest()
		{
		  if(button_test!="READY")
		  alert("您今天已经参加过每日一练了，请明天再试");
		  else window.location.href='index.php?mode=test&openid='+openid+'&testid='+testid;
		  //var href='index.php?mode=test&openid='+openid+'&testid='+testid;
		  //console.log(href);
		}
		
		function TestHistory()
		{
			alert("此功能暂未开放，敬请期待！");
		}
		function LoadPage()
		{	
			ajax_openid();
			ajax_news();
			ajax_test();
		}
		
		
		function ajax_news()
		{
			var xmlhttp;
            xmlhttp=new XMLHttpRequest();
  			xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=news",true);
  			var news="123456";
  			var base;base=new Base64();
  			var publickey=hex_md5(Date.parse(new Date()));
  			var priavatekey=hex_md5(publickey+news+publickey);
  			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  			xmlhttp.onreadystatechange=function()
            {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                  {
                  	data=eval("("+xmlhttp.responseText+")");
                  	if(data['status']!=0)
  			        {
  				       data['msg']=base.decode(data['msg']);
  				       alert("错误:"+data['msg']);
  			        }
  			        else
  			        {
  			        	data['data']['news']=base.decode(data['data']['news']);
                  	    document.getElementById("shownews").innerHTML=data['data']['news'];//首界面的消息公告
  			        }
                  	
                  }
                  
            }
  			xmlhttp.send("news="+news+"&publickey="+publickey+"&privatekey="+priavatekey);
		}
		
		function ajax_test()
		{
			var xmlhttp;
            xmlhttp=new XMLHttpRequest();
  			xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=teststate",true);
  		    var _openid,base;
  			base=new Base64();
  			_openid=base.encode(openid);
  			var publickey=hex_md5(Date.parse(new Date()));
  			var priavatekey=hex_md5(publickey+_openid+publickey);
  			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  			xmlhttp.onreadystatechange=function()
            {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                  {
                  	data=eval("("+xmlhttp.responseText+")");
                  	if(data['status']!=0)
  			        {
  				       data['msg']=base.decode(data['msg']);
  				       alert("错误:"+data['msg']);
  			        }
  			        else
  			        {
  			        	button_test=base.decode(data['data']['state']);
  			        	testid=base.decode(data['data']['testid']);
  			        }
                  	
                  }
                  
            }
  			xmlhttp.send("openid="+_openid+"&publickey="+publickey+"&privatekey="+priavatekey);
		}
		
		
		function ajax_openid()
		{
			var xmlhttp;
            xmlhttp=new XMLHttpRequest();
  			xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=openid",false);
  			
  			var _openid,base;
  			base=new Base64();
  			_openid=base.encode(openid);
  			var publickey=hex_md5(Date.parse(new Date()));
  			var priavatekey=hex_md5(publickey+_openid+publickey);
  			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  			xmlhttp.send("openid="+_openid+"&publickey="+publickey+"&privatekey="+priavatekey);
  			
  			var data;
  			data=eval("("+xmlhttp.responseText+")");
  			if(data['status']!=0)
  			{  
  				data['msg']=base.decode(data['msg']);
  				alert("错误:"+data['msg']);
  			}
  			else
  			{
  				
  				if(base.decode(data['data']['userid'])==0)
  				window.location.href="index.php?mode=userinfo&openid="+openid;
  				else return true;	
  		    }
		}

	</script>
	 </body>
</html>