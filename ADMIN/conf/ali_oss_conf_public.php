<?php
//共有访问配置文件爱你
// 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
  $id= 'LTAIzTTYH2mLvOWO';          // 请填写您的AccessKeyId。
    $key= 'mqHmlWKGZjYhleZC0KAXtaAre1cFwU';     // 请填写您的AccessKeySecret。
    // $host的格式为 bucketname.endpoint，请替换为您的真实信息。
    $host="https://iw3c-wechat.oss-cn-shanghai.aliyuncs.com";
    $selfhost="https://wechat.oss.iw3c.top";
    //$host = 'https://wechat.oss.iw3c.top';  
    // $callbackUrl为上传回调服务器的URL，请将下面的IP和Port配置为您自己的真实URL信息。
    $callbackUrl = 'https://www.iw3c.top/wechat/admin/index.php?mode=oss&action=callback';
    
    $dir = '';          // 用户上传文件时指定的前缀。
?>