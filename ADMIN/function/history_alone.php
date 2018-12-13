
               <tr>
              
                <td><?php echo $Id?></td>
                <td><a href="index.php?mode=data&action=show&testname=<?php echo $Test['testname']?>"><?php echo $Test['testid']?></a></td>
                <td>单选题</td>
                <td class="am-hide-sm-only">1</td>
                <td class="am-hide-sm-only"><?php echo $Test['testname']?></td>
                <td><?php
                	$timenum_today=strtotime(date("Y-m-d",time()));
                	$timenum_test=strtotime($Test['testname']);
                	$teststate=$timenum_today-$timenum_test;
                        if($teststate<0) echo "<span style=\"color:green\">准备就绪</span>"; 
                		else if($teststate>0)  echo "<span style=\"color:red\">测试结束</span>"; 
                		else if($teststate==0) echo "<span style=\"color:orange\">正在测试</span>"; 
                	
                	?></td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                     <a href="index.php?mode=data&action=show&testname=<?php echo $Test['testname']?>"> <button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span>查看详情</button></a>
                    </div>
                  </div>
                  
                </td>
              </tr>
            
<?php

?>