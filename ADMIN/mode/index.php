<?php
	if($_GET['t']=="show")
	include_once "html/index.html";
	else 
    {
    	if($_GET['action']=="iframe")
    	{
    		include_once "html/iframe/index.php";
    	}
    	else
    	{

    	    $adminname="桑泽寰";
    	    include_once "html/part/index_header.html" ; //加载网页的header
            include_once "html/part/index_admininfo.php"; 
            include_once "html/part/index_sidebar.html";
            include_once "html/part/index_content.php";
            include_once "html/part/index_navbar.html";
    	}
    	
        
    }
?>