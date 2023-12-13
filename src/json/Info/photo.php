<?php
require '../../e/extend/isMobile.php';
if (isMobile()) {
    require "../../e/class/connect.php";
    $link = db_connect();
    $empire = new mysqlquery();
    $time = time();
    $id = $_GET['id'];
    $r = $empire->fetch1("select price from {$dbtbpre}ecms_photo  where id='{$id}'");
    $fr = $empire->fetch1("select morepic from {$dbtbpre}ecms_photo_data_1  where id='{$id}'");
    $morepic = str_replace(PHP_EOL, '', $fr[morepic]);
	$morepic = str_replace(array("\r\n", "\r", "\n", " ", "\r\n\t"), array("", "", "", "", ""),$morepic);
    $morepic = stripSlashes($morepic);
    $count = explode("######", $morepic);
    for ($i = 0; $i < count($count); $i++) {
        $pic = explode("######", $count[$i]);
        if ($i == 0) {
            $dot = '';
        } else {
            $dot = ',';
        }
        $piclist .= $dot . '{"img":"' . $pic[0] . '"}';
    }
    $piclist = $piclist ? '{"data": [{"list": [' . $piclist . ']}]}' : '{"data": [{"list": []}]}';
    header('Content-Type: application/json;charset=utf-8');
    echo $_GET['callback'] . '(' . $piclist . ')';
    exit;
} else {
    Header("Location:/error.php");
}