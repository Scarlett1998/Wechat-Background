<html>
	<title>问题解析</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<head>
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<link rel="stylesheet" type="text/css" href="css/example.css">
	<link rel="stylesheet" type="text/css" href="css/weui.css">	
	<link rel="stylesheet" type="text/css" href="css/weui.min.css">
	</head>
	<style>
		.allpage{
			width: 100%;
			height: 100%;
		}
		.photo
		{
				background-image:url(http://qqcomfun.oss-cn-beijing.aliyuncs.com/wechat_cdn/59cb8048bb15b.jpg);
				background-size: 100% 100%;
		
		}
		.title
		{
			font-weight:bolder;
			padding-top:20px ;
		}
		.textlayout
		{
			word-wrap:break-word;
			word-break:break-all;
			padding-left: 20px; 
			padding-right: 20px; 
			padding-top: 20px;"
		}
	</style>
	<body class="photo">
		<div class="allpage">
		<div>
			<div style="width: 100%;height: 30%;padding-top: 50px;" align="center">
			<table>
			<tr><td align="center" class="title">原题重现</td></tr>
			<tr><td id="requestext" class="textlayout"></td></tr>sdgs
			<tr><td>选项A:</td><td id="select_a"></td></tr>
			<tr><td>选项B:</td><td id="select_b"></td></tr>
			<tr><td>选项C:</td><td id="select_c"></td></tr>
			<tr><td>选项D:</td><td id="select_d"></td></tr>
			</table>
			</div>
		<div align="center" style="padding-top: 20px;">
			<tr><td style="font-size: 22;font-weight: bolder;">标准答案:</td><td id="AnswerRight"></td></tr>
			<br />
			<tr><td style="font-size: 22;font-weight: bolder;">您的选择:</td><td id="myoption"></td></tr>
		</div>
		<div align="center">
			<table>
			<tr><td align="center" style="font-weight:bolder;padding-top: 30px;">原题解析</td></tr>
			<tr><td class="textlayout" id="quesabout">
			</td></tr></table>
		</div>
		</div>
		<script type="text/javascript" src="js/Hash.js"></script>
		<script>
			var openid="<?php echo $_GET['openid']?>";
		    var testid="<?php echo $_GET['testid']?>";
		    var option="<?php echo $_GET['option'] ?>";
			ajax_test();
			//ajax_testinfo();
			function ajax_test(){
		   		var xmlhttp;
		   		var ques,optionA,optionB,optionC,optionD;
            	xmlhttp=new XMLHttpRequest();
  				xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=testinfo",false);
  				var _openid,_testid,base,data;
  				base=new Base64();
  				_openid=base.encode(openid);
  				_testid=base.encode(testid);
  				var publickey=hex_md5(Date.parse(new Date()));
  				var priavatekey=hex_md5(publickey+_openid+_testid+publickey);
  				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  				xmlhttp.send("openid="+_openid+"&testid="+_testid+"&publickey="+publickey+"&privatekey="+priavatekey);
  				data=eval("("+xmlhttp.responseText+")");
  				console.log(data);
  				quesid=base.decode(data['data']['1']['quesid']);
  				console.log(quesid);
  				if(quesid!=0)
  				{
  					ques=base.decode(data['data']['1']['ques']);
  					optionA=base.decode(data['data']['1']['optionA']);
  					optionB=base.decode(data['data']['1']['optionB']);
  					optionC=base.decode(data['data']['1']['optionC']);
  					optionD=base.decode(data['data']['1']['optionD']);
  					
  					document.getElementById("requestext").innerHTML=ques;
  					document.getElementById("select_a").innerText=optionA;
  				    document.getElementById("select_b").innerText=optionB;
  				    document.getElementById("select_c").innerText=optionC;
  				    document.getElementById("select_d").innerText=optionD;
  				    document.getElementById("myoption").innerHTML=option;
  				    document.getElementById("AnswerRight").innerHTML=base.decode(data['data']['AnswerRight']);
   					document.getElementById("quesabout").innerHTML=base.decode(data['data']['quesabout']);
  				}
  				else
  				{
  					alert('获取失败');
  					window.location.href="index.php?mode=menu";
  				}
		   }
  			function ajax_testinfo()
  			{
  				var xmlhttp;
            	xmlhttp=new XMLHttpRequest();
  				xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=testinfo",false);
  				var base;base=new Base64();
  				var _openid,_testid,base,data;
  				base=new Base64();
  				_openid=base.encode(openid);
  				_testid=base.encode(testid);
  				var publickey=hex_md5(Date.parse(new Date()));
  				var priavatekey=hex_md5(publickey+_openid+_testid+publickey);
  				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  				xmlhttp.send("openid="+_openid+"&testid="+_testid+"&publickey="+publickey+"&privatekey="+priavatekey);
  				data=eval("("+xmlhttp.responseText+")");
   				document.getElementById("AnswerRight").innerHTML=base.decode(data['data']['AnswerRight']);
   				document.getElementById("quesabout").innerHTML=base.decode(data['data']['quesabout']);
  			}
		</script>
	</body>
</html>
<?php
?>