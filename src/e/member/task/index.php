<?php
require("../../class/connect.php");
require("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//关闭模块
//是否登陆
$user=islogin();
$r=ReturnUserInfo($user[userid]);
//会员信息
$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='".$user[userid]."' limit 1");
$userpic=$addr['userpic']?$addr['userpic']:$public_r[newsurl].'e/data/images/nouserpic.gif';	
$email = $r[email] ? '': 'Tips：建议绑定邮箱信息，防止账号丢失';
//导入模板
require(ECMS_PATH.'e/template/member/task.php');
db_close();
$empire=null;
?>