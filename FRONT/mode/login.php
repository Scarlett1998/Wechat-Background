<?php
$wechat_auth="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$call_back}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
echo "<script>window.location.href='{$wechat_auth}';</script>";
?>