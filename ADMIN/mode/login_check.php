<?php
 if(login_check(false))
{ 
	$Json['status']=0;
    $Json['mes']=NULL;
    echo json_encode($Json);	
}
else exception_out(305,"json");
	


  
?>