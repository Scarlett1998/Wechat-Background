<html>
	<title>每日一练</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<head>
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<link rel="stylesheet" type="text/css" href="css/example.css">
	<link rel="stylesheet" type="text/css" href="css/weui.css">	
	<link rel="stylesheet" type="text/css" href="css/weui.min.css">
	</head>
	<style>
		.btn_pos
		{
			padding-top: 25px;
			padding-left: 30px;
			font-family: "微软雅黑";
			font-weight: bold;
			color: #000000;
			padding-left: 80px;;
		}
		.btn_limtset
		{
			padding-top: 40px;
			font-family: "微软雅黑";
			font-weight: bolder;
			color: white;
			width: 80%;
		}
		.infotext{
			color: #000000;
			padding-top: 10px;
			padding-left: 20px;
			font-family:"微软雅黑"
			font-weight: 400;
		}
		.photo
		{
			background-image:url(http://qqcomfun.oss-cn-beijing.aliyuncs.com/wechat_cdn/59cb8048bb15b.jpg);
			background-size: 100% 100%;
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
			<div>
				<input type="hidden" name="quesid" id="quesid">
				<!--题目的编号-->
			</div>
			<div style="width: 90%;padding-top: 30px;padding-left: 20px;">
				<table>
					<tr>
						<td id="quesidtext"></td>
						<td id="questext" class="textlayout"></td>
					</tr>
				</table>
			</div>
			<div class="infotext">
				请在如下四个选择项中作出选择:
			</div>
			<div class="btn_pos">
				<tr>
					<td>选项A:</td><td align="center"><input class="btn_pos" type="radio" name="option" onclick="SetAnswer('A')">
						<span id="select_a"></span></td>
				</tr>
			</div>
			<div class="btn_pos">
				<tr>
					<td>选项B:</td>
					<td><input type="radio" name="option" onclick="SetAnswer('B')">
					<span id="select_b">选项B:</span></td>
				</tr>
			</div>
			<div class="btn_pos">
				<tr>
					<td>选项C:</td>
					<td><input type="radio" name="option" onclick="SetAnswer('C')">
						<span id="select_c">选项C:</span></td>
				</tr>
			</div>
			<div class="btn_pos">
				<tr>
					<td>选项D:</td>
					<td><input type="radio" name="option" onclick="SetAnswer('D')">
						<span id="select_d">选项D:</span></td>
				</tr>
			</div>
			<div style="padding-top: 20px;">
				<tr>
					<td><input align="center" type="button" value="提交答案" style="width: 70%;" class="weui_btn weui_btn_primary" onclick="SendData()"></td>
				</tr>
			</div>
		<script type="text/javascript" src="js/Hash.js"></script>
		<script>
		    var openid="<?php echo $_GET['openid']?>";
		    var testid="<?php echo $_GET['testid']?>";
		    var option,quesid;
		    ajax_test();
		    
		    function SetAnswer(answer)
		    {
		    	option=answer;
		    }
		    
		    function SendData()
		    {
		    	
		    	if(option==null)
		    	{
		    		alert("您尚未作出选择无法提交");
		    	}
		    	else
		    	{
		    		//alert('您的选择为:'+option);
		    		var xmlhttp;
            		xmlhttp=new XMLHttpRequest();
  					xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=testpost",false);
  					var _openid,base,data,_testid,data1;
  					base=new Base64();
  					_openid=base.encode(openid);
  					_testid=base.encode(testid);
  					_dataquesid=base.encode(quesid);
  					_dataanswer=base.encode(option);
  					var publickey=hex_md5(Date.parse(new Date()));
  					var priavatekey=hex_md5(publickey+_openid+publickey);
  					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  					var quesnum=1;
  					xmlhttp.send("openid="+_openid+"&testid="+_testid+"&data[0]=MQ=="+"&data[1][quesid]="+_dataquesid+"&data[1][answer]="+_dataanswer+"&publickey="+publickey+"&privatekey="+priavatekey);
  					//data1=eval("("+xmlhttp.responseText+")");
  					if(option!=null)
  					{
  						alert("您的选择为:"+option+"\n答案提交完成");
  						//window.location.href="index.php?mode=menu&openid="+openid;
  					}		    	 	
		    	}
		   }
		   function ajax_test(){
		   		var xmlhttp;
		   		var ques,optionA,optionB,optionC,optionD;
            	xmlhttp=new XMLHttpRequest();
  				xmlhttp.open("POST","https://www.iw3c.top/wechat/server/?mode=testdata",false);
  				var _openid,_testid,base,data;
  				base=new Base64();
  				_openid=base.encode(openid);
  				_testid=base.encode(testid);
  				var publickey=hex_md5(Date.parse(new Date()));
  				var priavatekey=hex_md5(publickey+_openid+_testid+publickey);
  				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  				xmlhttp.send("openid="+_openid+"&testid="+_testid+"&publickey="+publickey+"&privatekey="+priavatekey);
  				data=eval("("+xmlhttp.responseText+")");
  				console.log(data)
  				if(data['status']==203||data['status']==202)
  				{
  					alert("今日做题完毕");
  					window.location.href="index.php?mode=menu&openid="+openid;
  				}
  				quesid=base.decode(data['data']['1']['quesid']);
  				console.log(quesid);
  				if(quesid!=0)
  				{
  					ques=base.decode(data['data']['1']['ques']);
  					optionA=base.decode(data['data']['1']['optionA']);
  					optionB=base.decode(data['data']['1']['optionB']);
  					optionC=base.decode(data['data']['1']['optionC']);
  					optionD=base.decode(data['data']['1']['optionD']);
  					
  					document.getElementById("questext").innerHTML=ques;
  					document.getElementById("select_a").innerText=optionA;
  				    document.getElementById("select_b").innerText=optionB;
  				    document.getElementById("select_c").innerText=optionC;
  				    document.getElementById("select_d").innerText=optionD;
  					//document.getElementById("questext").innerHTML=optionD;
  				}
  				else
  				{
  					alert('获取失败');
  					window.location.href="index.php?mode=menu&openid="+openid;
  				}
		   }
		</script>
	</body>
</html>