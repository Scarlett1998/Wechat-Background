<?php
		//加载mysql类库文件
   include_once "sdk/mysql/index.php";
  $mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
	$sql="select value from sysinfo where keywords='news'";
	$news_content=$mysql->fetch_array($mysql->query($sql))[0];
	$news_content=base64_decode($news_content);
	if($rtype=="GET")        include_once "html/iframe/news.php";
	else if($rtype=="POST")   
	{
		 $post_content=base64_encode($_POST['news_content']);
		 $sql="update sysinfo set value='{$post_content}'  where keywords='news'";
		 $mysql->query($sql);
		 echo "<script>alert(\"更新通知消息成功！\");window.location.href='index.php?mode=news';</script>";
	}
?>