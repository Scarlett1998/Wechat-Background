<?php
function post_decode($data)
{
	$_data=$data;
	foreach($data as $key=>$value)
	{
		if($key!="privatekey"&&$key!="publickey")
        {
           if(gettype($value)!="array")
		  $_data[$key]=base64_decode($value);
          else $_data[$key]=array_debase64($value);
        }
	
       
	}
	return $_data;
	
}
function array_debase64($data)
{
      foreach($data as $key=>$value)
	    {
	      if(gettype($value)!="array")
		  $_data[$key]=base64_decode($value);
          else $_data[$key]=array_debase64($value);
	    }
     return $_data;
}
?>