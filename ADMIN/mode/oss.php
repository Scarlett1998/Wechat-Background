<?php
if($_GET['action']=="auth")        include_once "sdk/aliyun-oss-appserver-php/php/get.php";
else if($_GET['action']=="callback") include_once "sdk/aliyun-oss-appserver-php/php/callback.php";
?>