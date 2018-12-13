<script type="text/javascript">
echart_all();
echart_right();
echart_data();
echart_time();
function echart_all()
{
    var myChart = echarts.init(document.getElementById('answer_all'),'macarons');
    var option = 
    { 
    title: { text: '答题完成情况', x:'center' }, 
    tooltip : { trigger: 'item', formatter: "{a} <br/>{b} : {c} ({d}%)" },
    legend: { orient : 'vertical', x : 'left', data:['答题成功','正在答题','尚未登录'] },
    calculable: true,
   series : [ { name:'答题完成情况', type:'pie', radius : '55%', center: ['50%', '60%'], data:[ {value:<?php echo $USER['undo']?>, name:'尚未登录'}, {value:<?php echo $USER['doing']?>, name:'正在答题'}, , {value:<?php echo $USER['done']?>, name:'答题成功'} ] } ]  
    };
    myChart.setOption(option);
}
function echart_right()
{
    var myChart = echarts.init(document.getElementById('answer_right'),'shine');
    var option = 
    { 
    title: { text: '答题正确率', x:'center' }, 
    tooltip : { trigger: 'item', formatter: "{a} <br/>{b} : {c} ({d}%)" },
    legend: { orient : 'vertical', x : 'left', data:['正确','错误'] },
    calculable: true,
   series : [ { name:'答题完成情况', type:'pie', radius : '55%', center: ['50%', '60%'], data:[ {value:<?php echo $ANS['right']?>, name:'正确'}, {value:<?php echo $ANS['wrong']?>, name:'错误'},] } ]  
    };
    myChart.setOption(option);
} 
function echart_data()
{
    var myChart = echarts.init(document.getElementById('answer_data'),'roma');
    var option = 
    { 
    title: { text: '答案选择情况', x:'center' }, 
    tooltip : { trigger: 'item', formatter: "{a} <br/>{b} : {c} ({d}%)" },
    legend: { orient : 'vertical', x : 'left', data:['A','B','C','D'] },
    calculable: true,
   series : [ { name:'答案选择情况', type:'pie', radius : '55%', center: ['50%', '60%'], data:[ {value:<?php echo $ANS['A']?>, name:'A'}, {value:<?php echo $ANS['B']?>, name:'B'}, {value:<?php echo $ANS['C']?>, name:'C'}, {value:<?php echo $ANS['D']?>, name:'D'} ] } ]  
    };
    myChart.setOption(option);
}  
function echart_time()
{
    var myChart = echarts.init(document.getElementById('answer_time'),'vintage');
    var option = 
    { 
    title: { text: '答题用时情况', x:'center' }, 
    tooltip : { trigger: 'item', formatter: "{a} <br/>{b} : {c} ({d}%)" },
    legend: { orient : 'vertical', x : 'left', data:['0-10s','10-20s','20-30s','30-40s','40-50s','50-60s','60s以上'], },
    calculable: true,
   series : [ { name:'答题用时情况', type:'pie', radius : '55%', center: ['50%', '60%'], data:[ {value:<?php echo $TIME['10']?>, name:'0-10s'}, {value:<?php echo $TIME['20']?>, name:'10-20s'}, {value:<?php echo $TIME['30']?>, name:'20-30s'},{value:<?php echo $TIME['40']?>, name:'30-40s'}, {value:<?php echo $TIME['50']?>, name:'40-50s'}, {value:<?php echo $TIME['60']?>, name:'50-60s'},{value:<?php echo $TIME['MORE']?>, name:'60s以上'}  ] } ]  
    };
    myChart.setOption(option);
}                    
</script>