<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../class/user.php");
require "../".LoadLang("pub/fun.php");
require("../../data/dbcache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//关闭模块
//是否登陆
$user=islogin();
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=100;//每页显示条数
$page_line=10;//每页显示链接数
$offset=$page*$line;//总偏移量
$totalquery="select count(*) as total from {$dbtbpre}enewsbuybak where userid='$user[userid]'";
$num=$empire->gettotal($totalquery);//取得总条数
$query="select * from {$dbtbpre}enewsbuybak where userid='$user[userid]'";
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
while($r=$empire->fetch($sql)){
     $list.='<tr height="25"><td>'.$r[userdate].'天</td><td>'.$r[cardfen].'</td><td><b>￥'.$r[money].'</b></td><td><em>'.$r[buytime].'</em></td></tr>';
};
//会员信息
$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='".$user[userid]."' limit 1");
$userpic=$addr['userpic']?$addr['userpic']:$public_r[newsurl].'e/data/images/nouserpic.gif';	
$email = $r[email] ? '': 'Tips：建议绑定邮箱信息，防止账号丢失';
//导入模板
require(ECMS_PATH.'e/template/member/buybak.php');
db_close();
$empire=null;
?>