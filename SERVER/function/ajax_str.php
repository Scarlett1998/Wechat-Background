<?php
function ajax_str($data,$mode)
{
	switch($mode)
	{
		case "openid": return $data['openid'];break;
		case "teststate":return $data['openid'];break;
		case "news": return $data['news'];break;
		case "testdata": return $data["openid"].$data['testid'];break;
		case "testpost": return $data["openid"];break;
		case "userinfo": return $data["openid"].$data["userid"].$data["username"];break;
		case "testinfo": return $data["openid"].$data["quesid"].$data['testid'];break;	
	}
}
?>