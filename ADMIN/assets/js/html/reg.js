function Build_Wait()
{
	alert("此功能暂不可用，敬请期待！");
}


function button_reg()
{
	document.getElementById("input_data").style.display="none";
	document.getElementById("input_wait").style.display="block";
				
	var load_per=document.getElementById("load_per");
	var login_state=document.getElementById("load_state");
	load_per.style.width="12.5%";
	login_state.innerHTML="<li>初始化注册模块...</li>";
	var xmlhttp = new XMLHttpRequest(); 
	xmlhttp.open("POST","index.php?mode=reg&rtype=AJAX",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	load_per.style.width="25%";
	login_state.innerHTML+="<li>加密本地数据...</li>";
	var username=document.getElementById("username").value;
	var called=document.getElementById("called").value;
	var password=document.getElementById("password").value;
	var repassword=document.getElementById("repassword").value;
	var mail=document.getElementById("mail").value;
	if(username=="")
	{login_state.innerHTML+="<li><span style=\"color:red\">错误：用户名不能为空</span></li>";return false;}
	else if(password==""){login_state.innerHTML+="<li><span style=\"color:red\">错误：密码不能为空</span></li>";return false;}
	else if(repassword==""){login_state.innerHTML+="<li><span style=\"color:red\">错误：验证密码不能为空</span></li>";return false;}
    else if(password!=repassword){login_state.innerHTML+="<li><span style=\"color:red\">错误：两次输入的密码不一致</span></li>";return false;}
    else if(called==""){login_state.innerHTML+="<li><span style=\"color:red\">错误：真实姓名不能为空</span></li>";return false;}
    else if(mail==""){login_state.innerHTML+="<li><span style=\"color:red\">错误：邮箱不能为空</span></li>";return false;}
    else
    {
    	login_state.innerHTML+="<li>连接到用户服务器...</li>";
	    load_per.style.width="37.5%";
	    base=new Base64();
	    //called=base.encode(called);
	    xmlhttp.send("username="+username+"&password="+password+"&called="+called+"&mail="+mail);
	    login_state.innerHTML+="<li>解析返回数据...</li>";
		load_per.style.width="50%";
	    var data=eval("("+xmlhttp.responseText+")");
	    if(data['status']==304)
	    {login_state.innerHTML+="<li><span style=\"color:red\">错误：指定的用户已经存在</span></li>";return false;}
	    else if(data['status']==0)
	    {
	    	load_per.style.width="62.5%";
	    	var token=data['data']['token'];
	    	xmlhttp = new XMLHttpRequest();
	    	xmlhttp.open("GET","index.php?mode=mail&rtype=AJAX&mailtype=reg&token="+token,false);
	    	xmlhttp.send();
	    	login_state.innerHTML+="<li>连接到邮件服务器...</li>";
	        load_per.style.width="90%";
	        login_state.innerHTML+="<li>解析返回数据...</li>";
	        var data=eval("("+xmlhttp.responseText+")");
	        if(data['status']==1003)
	        {login_state.innerHTML+="<li><span style=\"color:red\">错误：邮件发送失败！请与技术支持人员联系！</span></li>";return false;}
	        else if(data['status']==0)
	        {
	        	login_state.innerHTML+="<li>注册成功,请等待管理人员审核，审核通过后系统将邮件告知...如果您的浏览器没有自动跳转，请<a href=\"index.php?mode=login\">点击这里</a></li>";
				load_per.style.width="100%";
				 setTimeout(function(){ window.location.href="index.php?mode=login"; }, 5000);
	        }
	        
	    	
	    }
	    
    }
}
    
    function button_rereg()
	{
				location.reload();
	}
