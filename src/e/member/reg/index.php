<?php
/*
require('../../extend/isMobile.php');
if (isMobile()){
require "../../class/connect.php";
require "../../class/db_sql.php";
require "../class/user.php";
$link = db_connect();
$empire = new mysqlquery();
$editor = 1;
eCheckCloseMods('member');
//关闭模块
//验证时间段允许操作
eCheckTimeCloseDo('reg');
//验证IP
eCheckAccessDoIp('register');
$myuserid = (int) getcvar('mluserid');
if ($public_r[register_ok]) {
    exit;
} else {
    if ($myuserid) {
        exit;
} else {
		$str=$_REQUEST['f'];
		$str=str_replace(strstr($str,'/'),'',$str);
		$fromadd=str_replace(strstr($str,'&'),'',$str);
		$randname='u'.rand(10000000,99999999);
		$randname=str_replace("4","8",$randname);		
		$num = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember where username='{$randname}' limit 1");
		if ($num) {
    		$username='u'.rand(10000000,99999999);
		} else {
			$username=$randname;
		} 
		$password=rand(100000,999999);
		$password=str_replace("4","8",$password);
        echo '$(function() {$.ajax({type:"POST",url:"/e/member/doaction.php",data:{ajax:"1",enews:"register",groupid:"1",username:"'.$username.'",password:"'.$password.'",startpass:"'.$password.'",fromadd:"'.$fromadd.'"}})});';
		exit;
    }
}
db_close();
$empire = null;
} else {
    Header("Location:/error.php");
}
*/
?>