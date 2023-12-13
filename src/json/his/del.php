<?php
require "../../e/class/connect.php";
require "../../e/member/class/user.php";
$link = db_connect();
$empire = new mysqlquery();
$type =  $_GET['type'];
$id = $_GET['id'];
$myuserid = (int) getcvar('mluserid');
if ($myuserid) {
    if ($type == 1) {
        $sql = $empire->query("delete from  {$dbtbpre}enewsmember_hislog where userid='{$myuserid}' and id='{$id}' and cid='1' limit 1");
        $code = 'yes';
    }  else {
        $code = 'error';
    }
} else {
    $code = 'error';
}
header('Content-Type: application/x-javascript;charset=utf-8');
echo $code;
exit;