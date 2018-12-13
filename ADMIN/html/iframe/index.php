<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/amazeui.css" />
        <link rel="stylesheet" href="assets/css/core.css" />
        <link rel="stylesheet" href="assets/css/menu.css" />
        <link rel="stylesheet" href="assets/css/server/site.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
	</head>
  <div class="admin">
	<div class="content-page">
		<div class="am-panel am-panel-default">
           <div class="am-panel-bd">
             <p>服务器负载情况</p>
            <div class="server-circle">
                <ul class="row" id="systemInfoList">
                   
                    <li class="col-xs-6 col-sm-3 col-md-3 col-lg-2 mtb20 circle-box text-center cpubox" id="cpubox">
                        <h3 class="c9 f15">CPU使用率</h3>
                        <div class="cicle">
                            <div class="bar bar-left">
                                <div class="bar-left-an bar-an" id="cpubox-left"></div>
                            </div>
                            <div class="bar bar-right">
                                <div class="bar-right-an bar-an" id="cpubox-right"></div>
                            </div>
                            <div class="occupy"><span id="cpubox-usedage">0</span>%</div>
                        </div>
                        <h4 class="c9 f15" id="cpubox-title">获取中: </h4>
                    </li>
                    <li class="col-xs-6 col-sm-3 col-md-3 col-lg-2 mtb20 circle-box text-center membox" id="membox">
                        <h3 class="c9 f15">内存使用率</h3>
                       <div class="cicle">
                            <div class="bar bar-left">
                                <div class="bar-left-an bar-an" id="membox-left"></div>
                            </div>
                            <div class="bar bar-right">
                                <div class="bar-right-an bar-an" id="membox-right"></div>
                            </div>
                            <div class="occupy"><span id="membox-usedage">0</span>%</div>
                            <div class="mem-re-min"></div>
                        </div>
                        <h4 class="c9 f15" id="membox-title">获取中: </h4>
                    </li>
                     <li class="col-xs-6 col-sm-3 col-md-3 col-lg-2 mtb20 circle-box text-center diskbox" id="diskbox">
                        <h3 class="c9 f15">硬盘使用率</h3>
                        <div class="cicle">
                            <div class="bar bar-left">
                                <div class="bar-left-an bar-an" id="diskbox-left"></div>
                            </div>
                            <div class="bar bar-right">
                                <div class="bar-right-an bar-an" id="diskbox-right"></div>
                            </div>
                            <div class="occupy"><span id="diskbox-usedage">0</span>%</div>
                        </div>
                        <h4 class="c9 f15" id="diskbox-title">获取中: </h4>
                    </li>
                      <li class="col-xs-6 col-sm-3 col-md-3 col-lg-2 mtb20 circle-box text-center systembox" >
                        <p><span><img src="assets/img/centos.ico">系统:</span>CentOS  7.5.1804 (Core)</p>
                        <p><span><img src="assets/img/ico-mysql.png">数据库：</span>MySQL 5.5.62</p>
                        <p><span><img src="assets/img/ico-nginx.png">WEB服务器：</span>Nginx 1.8.1</p>
                        <p><span><img src="assets/img/ico-php.png">后端脚本：</span>PHP 5.6.38</p>
                    </li>
                </ul>
            </div>
        
           	</div>
         </div>
         <div class="am-panel am-panel-default">
           <div class="am-panel-bd">
           	  <p>本系统基于Wechat UI,Amaze UI,Echart,Spreedsheet,Ueditor构建。<br/>
           	  	在开发过程中参考并了大量的资料和文章，在这里表示衷心的感谢&nbsp;Thanks:<br/>
           	  	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.bt.cn">BT Panel ServerState Panel</a> <br/> 
           	  	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://tpl.amazeui.org/content.html?4">LingLing template Admin</a> <br/> 
           	  	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.jsdaima.com/webpage/61.html">Login And Reg Demo</a><br/>
           	  	  控制端：Sudem 服务端：Sudem 客户端：Byc <br/>
           	  	  筹划、产品： Ccristallo<br/>
           	  	 BUG、反馈:<a href="https://www.iw3c.top/doc">IW3C实验室项目维护系统</a>
           	  	  
           	</div>
           </div>
	</div>
	</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/html/server_info.js"></script>
	<script type="text/javascript">
       var server_count=null;
       setInterval(server_info,2500);
       //server_info();
	</script>
	