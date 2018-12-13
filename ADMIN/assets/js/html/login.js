function Build_Wait()
{
	alert("此功能暂不可用，敬请期待！");
}
			
			function button_login()
			{
				document.getElementById("input_data").style.display="none";
				document.getElementById("input_wait").style.display="block";
				
				var load_per=document.getElementById("load_per");
				var login_state=document.getElementById("load_state");
				load_per.style.width="20%";
				login_state.innerHTML="<li>初始化登录模块...</li>";
				
				var xmlhttp = new XMLHttpRequest(); 
				xmlhttp.open("POST","index.php?mode=login&rtype=AJAX",false);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				load_per.style.width="40%";
				login_state.innerHTML+="<li>加密本地数据...</li>";
				var username,password;
				username=document.getElementById("username").value;
				password=document.getElementById("password").value;
				if(username=="")
				{
					login_state.innerHTML+="<li><span style=\"color:red\">错误：用户名不能为空</span></li>";
					return false;
				}
				else if(password=="")
				{
					login_state.innerHTML+="<li><span style=\"color:red\">错误：密码不能为空</span></li>";
					return false;
				}
				else
				{
					login_state.innerHTML+="<li>连接到服务器...</li>";
				    load_per.style.width="60%";
				    xmlhttp.send("username="+username+"&password="+password);
				    login_state.innerHTML+="<li>解析返回数据...</li>";
				    load_per.style.width="80%";
				    var data=eval("("+xmlhttp.responseText+")");
				    if(data['status']==301)
				    {
				       login_state.innerHTML+="<li><span style=\"color:red\">错误：用户的用户名不存在</span></li>";
					   return false;
					}
				    else if(data['status']==302)
				    {
				       login_state.innerHTML+="<li><span style=\"color:red\">错误：用户的密码不正确</span></li>";
					   return false;
					}
				    else if(data['status']==303)
				    {
				       login_state.innerHTML+="<li><span style=\"color:red\">错误：用户尚未通过审核</span></li>";
					   return false;
					}
				    
				    else if(data['status']==0)
				    {
				    	login_state.innerHTML+="<li>登录成功，3秒后自动跳转...如果您的浏览器没有自动跳转，请<a href=\"index.php?mode=index\">点击这里</a></li>";
				        load_per.style.width="100%";
				        setTimeout(function(){ window.location.href="index.php?mode=index"; }, 5000);
				    }
				    
				    
				}
			}
			function button_relogin()
			{
				location.reload();
			}