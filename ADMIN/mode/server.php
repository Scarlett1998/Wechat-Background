<?php
 $fp = popen('top -b -n 1 | grep -E Cpu',"r");//获取CPU使用情况
 $rs = "";while(!feof($fp)){ $rs .= fread($fp,1024);}pclose($fp);
 $cpu_data=substr($rs,8);$temp=explode(",",$cpu_data); $cpu_info = explode("u",$temp[0]);
 $data['cpu']['useage'] =  floatval($cpu_info[0]);
  
 $fp = popen('top -b -n 1 | grep -E Mem',"r");//获取内存使用情况
 $rs = "";while(!feof($fp)){ $rs .= fread($fp,1024);}pclose($fp);
 $mem_data=substr($rs,9);$temp=explode(",",$mem_data); $mem_info[0] = explode("u",$temp[0]);$mem_info[1] = explode("f",$temp[1]);
 $data['mem']['total']=round($mem_info[0][0]/1024);
 $data['mem']['used']= $data['mem']['total']-round($mem_info[1][0]/1024);
 $data['mem']['useage']=round($data['mem']['used']/$data['mem']['total']*100,1);
 
  $fp = popen('df -lh | grep -E "^(/)"',"r"); //获取硬盘使用状态
  $rs = fread($fp,1024);
  pclose($fp);
  $rs = preg_replace("/\s{2,}/",' ',$rs);  //把多个空格换成 “_”
  $hd = explode(" ",$rs);

  $data['disk']['total']=intval(trim($hd[1],'G'))+intval(trim($hd[6],'G'));
  if(preg_match("/G/",$hd[7]))  $data['disk']['used']=$data['disk']['total']-(intval(trim($hd[2],'G'))+intval(trim($hd[7],'G')));
  else $data['disk']['used']=intval(trim($hd[2],'G'))+round(intval(trim($hd[7],'M'))/1024,1);
  $data['disk']['useage']=round($data['disk']['used']/$data['disk']['total']*100,1);
 
  
  $Json['status']=0;
  $Json['mes']=NULL;
  $Json['data']=$data;
  echo json_encode($Json);
?>