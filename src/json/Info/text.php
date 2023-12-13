<?php
require '../../e/extend/isMobile.php';
if (isMobile()) {
    require "../../e/class/connect.php";
    $link = db_connect();
    $empire = new mysqlquery();
    $editor = 1;
    $id = $_GET['id'];
    $fr = $empire->fetch1("select newstext from {$dbtbpre}ecms_news_data_1  where id='{$id}'");
    header('Content-Type: application/json;charset=utf-8');
    echo $_GET['callback'] . '({"data": [{"newstext": [{"txt":" ' . $fr[newstext] .  '"}]}]})';
    exit;
} else {
    Header("Location:/error.php");
}
