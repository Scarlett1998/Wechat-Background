<?php
if(ajax_in($_POST,"news"))
{
	$_POST=post_decode($_POST);
	$sql="select value from sysinfo where keywords='news'";
	$mysql->query($sql);
	$news=$mysql->fetch_array()['value'];
	$DATA['news']=base64_decode($news);
	ajax_out(0, $DATA);
	
}
else exception_out(1002);

?>