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
//导入模板
require(ECMS_PATH.'e/template/member/his.php');
db_close();
$empire=null;
?>