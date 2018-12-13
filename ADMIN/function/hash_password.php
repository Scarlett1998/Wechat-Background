<?php
function hash_password($pass,$salt)
{
	$_pass=md5(sha1($pass).md5($salt).sha1($pass.$salt).md5($pass.$salt).md5($salt).sha1($pass));
	$_pass=strtoupper($_pass);
	return $_pass;
}
?>