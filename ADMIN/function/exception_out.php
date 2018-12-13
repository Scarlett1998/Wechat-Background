<?php
function exception_out($code,$type="mesjump",$log="")
//tpye：
//       mes     弹出窗口
//       mesjump 弹出窗口，返回上一页
//       json    JSON消息 
//       jsonlog 带日志信息的json
{
	if($type=="json")
	{
		$Json['status']=$code;
		$Json['mes']=base64_encode($_SESSION['exception'][$code]);
		echo json_encode($Json);
	}
	if($type=="jsonlog")
	{
		$Json['status']=$code;
		$Json['mes']=base64_encode($_SESSION['exception'][$code]);
		$Json['log']=$log;
		echo json_encode($Json);
	}
	else if($type=="mes")
	{
		echo "<script>alert(\"错误:{$code}==>{$_SESSION['exception'][$code]}\");</script>";
	}
	else if($type=="mesjump")
	{
		echo "<script>alert(\"错误:{$code}==>{$_SESSION['exception'][$code]}\");history.go(-1);location.reload();</script>";
	}
}
?>