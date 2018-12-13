<?php


//定义微信公众号的APPID
define("APPID",                          "");

//定义微信公众号的APPSECERT
define("APPSECERT",                      "");

//定义微信授权的回调地址	
define("_CALLBACK_URL",                   "");
$CALLBACK_URL=urlencode(_CALLBACK_URL);
define("CALLBACK_URL",                   $CALLBACK_URL);

//定义微信授权时的响应方式  
//snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
define("AUTH_TYPE",                      "snsapi_userinfo");

//定义授权请求地址
$url=sprintf("https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=10#wechat_redirect",APPID,CALLBACK_URL,AUTH_TYPE);
define("AUTH_URL",                       $url);
?>