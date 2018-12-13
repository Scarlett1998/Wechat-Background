# Wechat-Background
It is about a platform for the the  practice of the knowledge of Chinese Communist 

党知一练 1.0.0.1.Debug_Build20181213002


此版本为第一个迭代版本的Bug修复版本，具有如下基本功能：

【管理后台】

1.注册(审核)，登录

2.支持每日添加一道单选题，并自动分发题目

3.支持查询每日的答题情况，历史答题情况并导出excle报表

4.支持查询每个人的答题历史情况

5.支持向客户端发布通知

6.查看服务器实时运行状态

【客户端】

1.绑定微信账号

2.获取微信账号中的信息

3.每日答题

4.显示后台发送的通知

【CC系统】

1.完全手动的服务器运行状态跳转

build20181213002 BUG修复

修复了管理后台个人信息数据存在错误的bug

修复了客户端提交答案信息到服务器,服务端出错的bug

修复了客户端绑定用户数据出错的bug


【配置信息】

此项目中的配置信息已经被删除。请分别填充完善以下文件夹/文件中的配置信息

ADMIN/conf/ali_oss_conf_public.php

ADMIN/conf/ali_oss_conf_private.php

ADMIN/conf/mysql_conf.php

ADMIN/conf/token_conf.php

ASMIN/assets/ueditor/ueditor.all.js 中 httpsauth 的配置

FRONT/conf.php

SERVER/conf/mysql_conf.php

