<?php
require "../../class/connect.php";
require "../../class/db_sql.php";
require "../../class/q_functions.php";
require "../class/user.php";
require "../../data/dbcache/MemberLevel.php";
$link = db_connect();
$empire = new mysqlquery();
$editor = 1;
eCheckCloseMods('member');
//是否登陆
$user = islogin();
$r = $empire->fetch1("select * from {$dbtbpre}enewsmember_sign where userid='{$user[userid]}'");
$record = stripSlashes($r[record]);
$count = explode("#", $record);
for ($i = 0; $i < count($count); $i++) {
    $d = explode("#", $count[$i]);
    if ($i == 0) {
        $dot = '';
    } else {
        $dot = ',';
    }
    $list .= $dot . '{"signDay":"' . $d[0] . '"}';
}
$today = date('Ymd');
$lastdate = date('Ymd', $r[lastdate]);
if ($today > $lastdate) {
    $btn = '<a href="javascript:void(0);" class="signbtn">马上签到</a>';
} else {
    $btn = '<a href="javascript:void(0);">已连签' . $r[even] . '天</a>';
}
//导入模板
require ECMS_PATH . 'e/template/member/sign.php';
db_close();
$empire = null;