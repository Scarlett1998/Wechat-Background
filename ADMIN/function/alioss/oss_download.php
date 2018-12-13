<?php
	require_once 'sdk/aliyun-oss-php-sdk/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
use OSS\Http\RequestCore;
use OSS\Http\ResponseCore;
function oss_download($object)
{

include "conf/ali_oss_conf_private.php";




// 设置URL的有效期为3600秒。
$timeout = 30;
 $endpoint=$httpdownload;
try {$ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint, true);

    // 生成GetObject的签名URL。
    $signedUrl = $ossClient->signUrl($bucket, $object, $timeout);
} catch (OssException $e) {
	  printf(__FUNCTION__ . ": FAILED\n");
    printf($e->getMessage() . "\n");
	return false;}
return $signedUrl;

}
?>