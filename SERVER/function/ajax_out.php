
<?php
function ajax_out($code,$data)
{
	$Json["status"]=$code;
	if($code!=0) $Json['mes']=base64_encode($_SESSION['Exception'][$code]);
	else $Json['mes']=NULL;
	if($data!=NULL)
	{
	
		foreach($data as $key=>$value)
	    {
	      if(gettype($value)!="array")
		  $_data[$key]=base64_encode($value);
          else $_data[$key]=array_base64($value);
	    }
	}
	$Json['data']=$_data;
	$Json['publickey']=md5(time());
	$Json['privatekey']=md5($Json['publickey'].$Json["code"].$Json['publickey']."www.iw3c.cc");
	echo json_encode($Json);
}

function array_base64($data)
{
      foreach($data as $key=>$value)
	    {
	      if(gettype($value)!="array")
		  $_data[$key]=base64_encode($value);
          else $_data[$key]=array_base64($value);
	    }
     return $_data;
}
?>