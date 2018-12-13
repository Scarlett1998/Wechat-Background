<?php
function token_check($key,$token,$conf,$mode="session")
{
	$_token=md5(sha1($key).$conf[$mode].md5($key).sha1($tkey.$conf[$mode]));
	if($_token==$token) return TRUE;
	else return FALSE;
}
function token_make($key,$conf,$mode="session")
{
	return $_token=md5(sha1($key).$conf[$mode].md5($key).sha1($tkey.$conf[$mode]));
}
?>