<?php
function ajax_in($data,$mode)
{
	$publickey=$data['publickey'];
	$privatekey=$data['privatekey'];
	$strdata=ajax_str($data,$mode);
    $str=$publickey.$strdata.$publickey;
	$_privatekey=md5($str);
	if($privatekey==$_privatekey)  	return TRUE;
    else return FALSE;
}


?>