<?php
function getrandchar($length=6)
{
	$str = null;
     $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";//大写字母以及数字
     $max = strlen($strPol)-1;
     
      for($i=0;$i<$length;$i++)
      {
        $str.=$strPol[rand(0,$max)];
      }
      return $str;
}
?>