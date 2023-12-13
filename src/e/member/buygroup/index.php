<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../class/user.php");
require("../../data/dbcache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//关闭模块
//是否登陆
$user=islogin();
//会员信息
$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='".$user[userid]."' limit 1");
$r=$empire->fetch1("select * from {$dbtbpre}enewsmember where userid='".$user[userid]."' limit 1");
$userpic=$addr['userpic']?$addr['userpic']:$public_r[newsurl].'e/data/images/nouserpic.gif';	
$email = $r[email] ? '': '<i>建议绑定邮箱信息，防止账号丢失<i>';
$edit = $r[edit]==1 ? $email : '密码：'.$addr[startpass].'<em>(建议修改初始密码)</em>';
$tips = $addr[startpass] ? $edit: $email;
$mmtis = $r[edit]==1 ? '密码：*******' : '初始密码：'.$addr[startpass];
//支付类型
$query="select * from {$dbtbpre}enewsbuygroup order by myorder,id";
$sql=$empire->query($query);
$pays='';
//商品列表
while ($r = $empire->fetch($sql)) {
     if ($r[buygroupid] && $level_r[$r[buygroupid]][level] > $level_r[$user[groupid]][level]) {
        continue;
     }
	 $on=''; $ico='';
	 if ($r[myorder]==2){ 
	 $on=' class="selected"';
	 $ico='<div class="ico"></div>'; 
	 }
    $pays.='<li money-id="' . $r[gmoney] . '"'.$on.'>'.$ico.'<div class="name">' . $r[gname] . '</div><div class="needpay">' . nl2br($r[gsay]) . '</div></li>';
}
//默认金额
$mo=$empire->fetch1("select * from {$dbtbpre}enewsbuygroup where myorder='2' limit 1");
$money=$mo[gmoney];
//导入模板
require(ECMS_PATH.'e/template/member/buygroup.php');
db_close();
$empire=null;
?>