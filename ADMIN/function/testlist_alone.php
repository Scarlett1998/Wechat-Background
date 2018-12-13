
               <tr>
              
                <td><?php echo $Id?></td>
                <td><a href="index.php?mode=test&action=change&testid=<?php echo $Test['testid']?>"><?php echo $Test['testid']?></a></td>
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
                      <button onclick="url_jump(this)"url="index.php?mode=test&action=change&testid=<?php echo $Test['testid']?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    </div>
                  </div>
                </td>
              </tr>
            
