<?php
	require_once 'sdk/aliyun-oss-php-sdk/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
function oss_upload($object,$filePath)
{


include "conf/ali_oss_conf_private.php";
try{
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
      $ossClient->uploadFile($bucket, $object, $filePath);
} 
catch(OssException $e) {
	   printf(__FUNCTION__ . ": FAILED\n");
    printf($e->getMessage() . "\n");
    return false;
}
return true;
}
?>