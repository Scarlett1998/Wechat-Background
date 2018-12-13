<html>
	<title>用户信息完善</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<head>
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<link rel="stylesheet" type="text/css" href="css/example.css">
	<link rel="stylesheet" type="text/css" href="css/weui.css">	
	<link rel="stylesheet" type="text/css" href="css/weui.min.css">
	</head>
	<style>
		.allpage
		{
			background-image:url(http://qqcomfun.oss-cn-beijing.aliyuncs.com/wechat_cdn/2.jpg);
			background-size: 100% 100%;
			width: 100%;
			height: 100%;
		}
		.firstmodel
		{
			width: 100%;
			height: 25%;
		}
	</style>
<body>
	<div class="allpage">
		<div class="firstmodel">
		</div>
		<div style="text-align: center; width: 70%; height: 40%;">
			<table style="width: 100%;text-align: center;height: 50%;" align="center">
				<tr>
					<td colspan="2">您的信息尚未录入，请完善信息</td>
				</tr>
				<tr>
					<td>学号:</td>
					<td><input type="text" id="stunum" style="width: auto;height: auto;"></td>
				</tr>
				<tr>
					<td>姓名:</td>
					<td><input type="text" id="stuname" style="width: auto;height: auto;"></td>
				</tr>
			</table>
		</div>
		<div>
			<input class="weui_btn  weui_btn_primary" align="center" type="button" value="确认" onclick="sendinfo()" />
		</div>
	</div>
	<script type="text/javascript" src="js/Hash.js"></script>
	<script>
		var openid="<?php echo $_GET['openid'] ?>";//当用户不存在时跳转到此页并接收openid的数据
		function sendinfo()
		{
			var userid= document.getElementById('stunum').value;
			var username=document.getElementById('stuname').value;
			var xmlhttp;
            xmlhttp=new XMLHttpRequest();
  			xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=userinfo",false);
  			var _openid,_userid,_username,base;
  			base=new Base64();
  			_openid=base.encode(openid);
  			_userid=base.encode(userid);
  			_username=base.encode(username);
  			var publickey=hex_md5(Date.parse(new Date()));
  			var priavatekey=hex_md5(publickey+_openid+_userid+_username+publickey);
  			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  			//ajax_base64_send(xmlhttp,"openid="+_openid+"&publickey="+publickey+"&privatekey="+priavatekey);
  			ajax_base64_send(xmlhttp,"openid="+_openid+"&userid="+_userid+"&username="+_username+"&publickey="+publickey+"&privatekey="+priavatekey);
  			var data;
  			data=eval("("+xmlhttp.responseText+")");
  			if(data['data']['userstate'])
  			{
  				alert('信息录入成功');
  				window.location.href="index.php?mode=menu&openid="+openid;
  			}
  			else
  			{
  			  	alert('信息录入失败'); 
  			  	window.location.href="index.php?mode=menu";
  			 }
		}
	</script>
</body>
</html>
<?php

?>