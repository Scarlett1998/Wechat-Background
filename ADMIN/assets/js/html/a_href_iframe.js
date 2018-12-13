function iframe_jump(iframe)
{
	var xmlhttp = new XMLHttpRequest(); 
	xmlhttp.open("GET","index.php?mode=login_check&rtype=AJAX",false);
	xmlhttp.send();
	var data=eval("("+xmlhttp.responseText+")");
	if(data['status']==0)
	{
		title=iframe.getAttribute("page_title");
		//console.log(title);
		url= iframe.getAttribute("iframe_url");
	    document.getElementById("iframe_mian").src=url;
	    //console.log(document.getElementById("iframe_title").innerText);
	    document.getElementById("iframe_title").innerText=title;
	    console.log("Iframe的URL："+url);
	}
	else if(data['status']==305)
	{
	  alert("会话超时，请重新登录！");
	  window.location.href="index.php?mode=login";
	}
	
	
}
