<?php
include_once "sdk/mysql/index.php";
    $mysql=new php_mysql($mysqlconf['host'],$mysqlconf['user'],$mysqlconf['pass'],$mysqlconf['data'],"conn",$mysqlconf['code']);
$sql="select state,called,mail from admininfo where statetoken='{$_GET['token']}'";
$mysql->query($sql);
if($mysql->db_num_rows()!=0)
{
	$data=$mysql->fetch_array();
	$state=$data['state'];
	if($state=="READY")
	{
		if($_GET['state']=="PASS")
		$sql="update admininfo set state='PASS' where  statetoken='{$_GET['token']}'";
		else
	    $sql="delete from admininfo  where  statetoken='{$_GET['token']}'";	
		//$mysql->query($sql);
		echo "<script>window.location.href='http://www.iw3c.top/wechat/admin/?mode=mail&rtype=GET&mailtype=back&called={$data['called']}&state={$_GET['state']}&mailback={$data['mail']}';</script>";
		
	}
	else exception_out(306,"mes");
}
else exception_out(307,"mes");
?>