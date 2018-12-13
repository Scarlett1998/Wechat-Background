 <table class="am-table am-table-striped am-table-hover table-main">
 <thead>
<tr>
<th class="table-id">ID</th><th class="table-userid">学号</th><th class="table-name">姓名时间</th><th class="table-state">答题状态</th><th class="table-ans">回答答案</th><th class="table-time">答题时间</th><th class="table-timeused">答题耗时</th>
</tr>
</thead>
<tbody>
	<?//$ans中存放着当前题库/题目的正确答案
		$sql="select openid,userid,username from userinfo";
		$mysql->query($sql);$i=1;
		while($temp=$mysql->fetch_array())
		{
			$users[$i]=$temp;
			$i++;
		}
		$a=$b=$c=$d=0;
		// a 答题正确
		// b 答题错误
		// c 答题等待
		// d 没有答题
		foreach($users as $user)
		{
			//判断用户是否答题
			 $sql="select teststate,posttime,testtime from TestState where testid='{$testid}' and openid='{$user['openid']}'";
			$mysql->query($sql);
			if($mysql->db_num_rows()==0){$d++;$table_undo[$d]=$user;}
			else
			{
				$state=$mysql->fetch_array();
				if($state['teststate']=="READ")
				{
					$c++;
					$table_doing[$c]=$user;
				}
				else
				{
					 $sql="select userans from QuesWrong where openid='{$user['openid']}' and testid='{$testid}'";
					$mysql->query($sql);
                    if($mysql->db_num_rows()==0)
                    {
                    	$a++;$table_right[$a]=$user;$table_right[$a]['ans']=$ans;
                    	$table_right[$a]['posttime']=$state['posttime'];
                        $table_right[$a]['time']=strtotime($state['posttime'])-strtotime($state['testtime']);
                    }
                    else
                    {
                    	$b++;
                    	$data=$mysql->fetch_array();
                    	$table_wrong[$b]=$user;
                    	$table_wrong[$b]['ans']=$data['userans'];
                    	$table_wrong[$b]['posttime']=$state['posttime'];
                    	$table_wrong[$b]['time']=strtotime($state['posttime'])-strtotime($state['testtime']);
                    }
					
				}
			}
		}
		$id=1;
		if(count($table_right)!=0)
		foreach($table_right as $table)
		{  
			echo "<tr><td>{$id}</td><td>{$table['userid']}</td><td>{$table['username']}</td><td><span style=\"color:green\">回答正确</span></td><td>{$ans}</td><td>{$table['posttime']}</td><td>{$table['time']}</td>";
		   $id++;
		}
		if(count($table_wrong)!=0)
		foreach($table_wrong as $table)
		{
			echo "<tr><td>{$id}</td><td>{$table['userid']}</td><td>{$table['username']}</td><td><span style=\"color:orange\">回答错误</span></td><td>{$table['ans']}</td><td>{$table['posttime']}</td><td>{$table['time']}</td>";
		    $id++;
		}
		if(count($table_doing)!=0)
		foreach($table_doing as $table)
		{
			echo "<tr><td>{$id}</td><td>{$table['userid']}</td><td>{$table['username']}</td><td><span style=\"color:purple\">正在答题/放弃答题</span></td><td>-</td><td>-</td><td>-</td>";
		    $id++;
		}
		if(count($table_undo)!=0)
		foreach($table_undo as $table)
		{
			echo "<tr><td>{$id}</td><td>{$table['userid']}</td><td>{$table['username']}</td><td><span style=\"color:red\">尚未答题</span></td><td>-</td><td>-</td><td>-</td>";
		    $id++;
		}
	?>
</tbody>
</table>