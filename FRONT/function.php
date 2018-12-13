<?php
function http_get($url)
{
	$ch = curl_init();
$timeout = 5;
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 1000);
$data= curl_exec($ch);
curl_close($ch);
$Array=json_decode($data,true);
return $Array;
}
?>