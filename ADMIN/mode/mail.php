<?php
 include_once 'sdk/aliyun-php-sdk-core/Config.php';
 use Dm\Request\V20151123 as Dm;
//需要设置对应的region名称，如华东1（杭州）设为cn-hangzhou，新加坡Region设为ap-southeast-1，澳洲Region设为ap-southeast-2。
 $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "LTAI4a0FXkUcfVPX", "RIfAJZ0Pz8bN9rekPRyFZeQyzHYjkk");        
    //新加坡或澳洲region需要设置服务器地址，华东1（杭州）不需要设置。
    //$iClientProfile::addEndpoint("ap-southeast-1","ap-southeast-1","Dm","dm.ap-southeast-1.aliyuncs.com");
    //$iClientProfile::addEndpoint("ap-southeast-2","ap-southeast-2","Dm","dm.ap-southeast-2.aliyuncs.com");
    $client = new DefaultAcsClient($iClientProfile);    
    $request = new Dm\SingleSendMailRequest();     
    //新加坡或澳洲region需要设置SDK的版本，华东1（杭州）不需要设置。
    //$request->setVersion("2017-06-22");

if($_GET['mailtype']=="reg"&&$rtype=="AJAX")
{
	
	$sql="select * from admininfo where statetoken='{$_GET['token']}'";
	$mysql->query($sql);
	$data=$mysql->fetch_assoc();
	$data['token']=$_GET['token'];
	$request->setAccountName("noreply@jcparty.wechat.iw3c.top");
    $request->setFromAlias("党知一练项目组");
    $request->setAddressType(1);
    $request->setTagName("JCpartyWechat");
    $request->setReplyToAddress("false");
    $request->setToAddress("sang8052@qq.com");
    //可以给多个收件人发送邮件，收件人之间用逗号分开,若调用模板批量发信建议使用BatchSendMailRequest方式
    //$request->setToAddress("邮箱1,邮箱2");
    $request->setSubject("用户注册申请");
	$timenow=date("Y-m-d H:i:s");
	$body="<p>最高管理人员：</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$data['called']}&nbsp;于{$timenow}注册了用户名为&nbsp;{$data['username']}&nbsp;的账号，申请成为微信党知一练系统的管理员，注册邮箱地址{$data['mail']},&nbsp;密码校验代码:&nbsp;{$data['salt']}。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请点击下面的两个按钮，对本次申请做出批复。系统将自动发送邮件到他的邮箱{$data['mail']},告知其您的审核结果</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.iw3c.top/wechat/admin/?mode=admin&token={$data['token']}&state=PASS\"><input type=\"button\" value=\"批准注册申请\"></a>&nbsp;&nbsp;&nbsp;<a href=\"http://www.iw3c.top/wechat/admin/?mode=admin&token={$data['token']}&state=DENY\"><input type=\"button\" value=\"驳回注册申请\"></a></p>";
    $request->setHtmlBody($body);  
	try {
           $log = $client->getAcsResponse($request);
           $Json['status']=0;
	       $Json['mes']=NULL;
	       $Json['data']['log']=$log;
	       echo json_encode($Json); 
        }
      catch (ClientException  $e) 
      {
      	$ERROR="Code:".$e->getErrorCode()."----Message:".$e->getErrorMessage();  
		exception_out(1003,"jsonlog",$ERROR);
	  }
	  
	  catch (ServerException  $e) 
	  {
	  	$ERROR="Code:".$e->getErrorCode()."----Message:".$e->getErrorMessage();  
		exception_out(1003,"jsonlog",$ERROR);
	  }
  
	
} 
   
else if($_GET['mailtype']=="back"&&$rtype=="GET")
{
	$request->setAccountName("noreply@jcparty.wechat.iw3c.top");
    $request->setFromAlias("党知一练项目组");
    $request->setAddressType(1);
    $request->setTagName("JCpartyWechat");
    $request->setReplyToAddress("false");
    $request->setToAddress($_GET['mailback']);
    //可以给多个收件人发送邮件，收件人之间用逗号分开,若调用模板批量发信建议使用BatchSendMailRequest方式
    //$request->setToAddress("邮箱1,邮箱2");
    $request->setSubject("注册申请审核结果");
	$nowtime=date("Y-m-d H:i:s");
	if($_GET['state']=="PASS") $state="批准";
	else $state="驳回";
	$body="尊敬的用户{$_GET['called']},您好：管理人员于{$nowtime}审核了您的注册申请。经过慎重研究决定：{$state}您的的注册请求。您的账户将从即刻起激活(删除)！";
    $request->setHtmlBody($body);  
	try {
           $log = $client->getAcsResponse($request);
           echo "<script>alert(\"操作成功！\");</script>";
        }
      catch (ClientException  $e) 
      {
      	$ERROR="Code:".$e->getErrorCode()."----Message:".$e->getErrorMessage();  
		exception_out(1003,"mes");
	  }
	  
	  catch (ServerException  $e) 
	  {
	  	$ERROR="Code:".$e->getErrorCode()."----Message:".$e->getErrorMessage();  
		exception_out(1003,"mes");
	  }
  
}	
	
	
	
	
	
	
	
	
	
	
	
	

?>