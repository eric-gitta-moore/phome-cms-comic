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
//关闭模块
//是否登陆
$user = islogin();
$r = $empire->fetch1("select * from {$dbtbpre}enewsmember where userid='" . $user[userid] . "' limit 1");
//附表
$addr = $empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='" . $r[userid] . "' limit 1");
$userdate = 0;
//时间
$day = 0;
$hour =  0;
$minute =  0;
if ($r[userdate]) {
    $userdate = $r[userdate] - time();
    if ($userdate <= 0) {
        $userdate = 0;
		$day = 0;
    	$hour =  0;
    	$minute =  0;
    } else {
    $day = floor($userdate / 86400);
    $hour = floor(($userdate-86400 * $day)/3600);
    $minute = floor(($userdate-86400 * $day-3600 * $hour)/60);
    }
}
//提示修改密码
$past = '';
$pasbox = '';
if ($addr[startpass]) {
    if ($r[edit] == 0) {
        $past = '<a class="pastips"  href="' . $public_r['newsurl'] . 'e/member/EditInfo/EditSafeInfo.php">防止一键注册会员账号丢失，注意！！保存自己账号密码</a>';
        $pasbox = '<div class="clearfix"></div><section class="signtips block" style="margin:15px 3% 10px;"><strong>保存账号：' . $user[username] . '</strong><strong>初始密码：' . $addr[startpass] . '</strong><a href="' . $public_r['newsurl'] . 'e/member/EditInfo/EditSafeInfo.php">[修改密码]</a></section><div class="clearfix"></div>';
    }
}
//个人信息
$userpic = $addr['userpic'] ? $addr['userpic'] : $public_r['newsurl'] . 'skin/images/user.png';
$email = $r[email] ? substr_replace($r[email], '****', 3, 4) : '<em> 邮箱：用于找回密码，建议绑定</em>';
$qq = $addr[oicq] ? substr_replace($addr[oicq], '****', 3, 4) : '<em>QQ账号：绑定可用QQ号登陆</em>';
$phone = $addr[phone] ? substr_replace($addr[phone], '****', 3, 4) : '<em>手机号：绑定可用手机号登陆</em>';
//是否有短消息
$havemsg = "无";
if ($user[havemsg]) {
    $havemsg = "<a href='" . $public_r['newsurl'] . "e/member/msg/' target=_blank><font color=red>您有新消息</font></a>";
}
//注册时间
$registertime = eReturnMemberRegtime($r['registertime'], "Y-m-d H:i:s");
//导入模板
require ECMS_PATH . 'e/template/member/my.php';
db_close();
$empire = null;