function server_info()
{
	if(server_count==null) server_count=1; else server_count++;
	console.log(new Date()+" 第"+server_count+"次刷新服务器状态信息");
	var xmlhttp = new XMLHttpRequest(); 
	xmlhttp.open("GET","index.php?mode=login_check&rtype=AJAX",false);
	xmlhttp.send();
	var data=eval("("+xmlhttp.responseText+")");
	if(data['status']==0)
	{
		xmlhttp = new XMLHttpRequest(); 
	    xmlhttp.open("GET","index.php?mode=server&rtype=AJAX",false);
	    xmlhttp.send();
	    data=eval("("+xmlhttp.responseText+")");
	    {
	    	var pub_arr = [{val:100,color:'#dd2f00'},{val:90,color:'#ff9900'},{val:70,color:'#20a53a'},{val:30,color:'#20a53a'}];
	    	var  _cpubox="cpubox";
	    	var  _membox="membox";
	    	var  _diskbox="diskbox";
	    	set_val(_cpubox,{usage:data['data']['cpu']['useage'],title:' Intel(R) Xeon(R) CPU E5-2670 v2 @ 2.50GH 32 核心',items:pub_arr});
            set_val(_membox, {usage:data['data']['mem']['useage'], items: pub_arr, title: data['data']['mem']['used'] + '/' + data['data']['mem']['total'] + '(MB)' });
	        set_val(_diskbox,{usage:data['data']['disk']['useage'],title:data['data']['disk']['used'] + '/' + data['data']['disk']['total'] + '(GB)' ,items:pub_arr});
	    }
	}
	else if(data['status']==305)
	{
	  alert("会话超时，请重新登录！");
	  window.location.href="index.php?mode=login";
	}
	
}
function set_val(li,obj){
	
			//obj.usage = parseInt(obj.usage)
			
			
			var deg=(obj.usage/100*360)-135;
		    
			if(obj.usage > 50) {
				 deg=((obj.usage-50)/100*360)-135;
				setTimeout(function(){document.getElementById(li+"-right").style="transform:rotate(45deg);transition:transform  linear;"},10)
				setTimeout(function(){document.getElementById(li+"-left").style="transform:rotate("+deg+"deg);transition:transform  linear;";},10)
			} else {
				setTimeout(function(){document.getElementById(li+"-left").style="transform:rotate(-135deg);transition:transform  linear;"},10)
				setTimeout(function(){document.getElementById(li+"-right").style="transform:rotate("+deg+"deg);transition:transform  linear;";},10)
			}
			if(obj.items){
				var item = {};
				for (var i=0;i<obj.items.length;i++) {
					if(obj.usage<=obj.items[i].val) {
						item = obj.items[i];
						continue;
					}
					break;
				}
				if(item.title) obj.title = item.title;
				if(item.color) obj.color = item.color;
			}
			if(obj.color)
			{
				document.getElementById(li+"-left").style=document.getElementById(li+"-left").style+"border-color:transparent transparent;"+obj.color +" "+ obj.color;
				document.getElementById(li+"-right").style=document.getElementById(li+"-right").style+obj.color +" "+ obj.color+"border-color:transparent transparent;";
				//console.log(document.getElementById(li+"-usedage"));
				document.getElementById(li+"-usedage").style="color:"+obj.color;
			}
			if(obj.title) document.getElementById(li+"-title").innerText=obj.title;
			document.getElementById(li+"-usedage").innerText=obj.usage;
		}
