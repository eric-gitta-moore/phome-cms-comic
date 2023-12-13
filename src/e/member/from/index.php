<?php
require "../../class/connect.php";
require "../class/user.php";
$link = db_connect();
$empire = new mysqlquery();
$myuserid = (int) getcvar('mluserid');
if ($myuserid) {
    //已登陆用户终止执行
    exit;
} else {
    $str = str_replace(strstr($str, '/'), '', $_REQUEST['f']);
    $fromadd = str_replace(strstr($str, '&'), '', $str);
    if ($fromadd) {
        $ftime = time();
        $uid = $fromadd;
        $fip = egetip();
        $atime = date("YmdH");
        $num = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_from where fip='{$fip}' and userid='{$uid}' and atime='{$atime}'");
        if ($num) {
            //重复IP和渠道，一小时内只录入一条记录
            exit;
        } else {
            $empire->query("insert into {$dbtbpre}enewsmember_from(userid,fip,ftime,atime) values('{$uid}','{$fip}','{$ftime}','{$atime}');");
            exit;
        }
    } else {
        //没有渠道
        exit;
    }
}
db_close();
$empire = null;