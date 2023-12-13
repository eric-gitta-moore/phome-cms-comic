<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
require('../../extend/isMobile.php');
if (isMobile()){
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
 <head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
    <style>#applink{display:none;}</style>
  <link href="<?=$public_r['newsurl']?>skin/css/base.css?v3=20190507" rel="stylesheet" type="text/css">
    <main id="left">
     <title>会员中心 - <?=$public_r['add_name']?></title>
</head>
<body>  
   <section class="userinfo clf"> 
   <div class="cover"> <img src="<?=$userpic?>" /> </div> 
   <div class="name"> 
    <span class="id"><?=$user[username]?></span> 
    <span> <i class="u<?=$r[groupid]?>"><?=$level_r[$r[groupid]][groupname]?></i> </span> 
   </div> 
   <div class="userBG-<?=$r[groupid]?>"></div> 
   <a href="javascript:history.go(-1);" class="back">返回</a> 
   <a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php" class="setting">设置</a>
  </section>
  	<?=$past?>
	<div class="clearfix"></div>
    <?=$pasbox?>  
	<div class="clearfix"></div>
	<section class="block"> 
   <ul class="fun_list">  
   	<li><a href="<?=$public_r['newsurl']?>e/member/buygroup/"><i class="fun14"></i><span>VIP有效期：<b><?=$day?></b><small>天</small><b><?=$hour?></b><small>小时</small><b><?=$minute?></b><small>分</small><strong class="red">充值/补单</strong></span> </a> </li> 
	<li><a href="<?=$public_r['newsurl']?>e/member/buygroup/"><i class="fun01"></i><span>阅读币：<b><?=$r[userfen]?></b> 枚<strong class="red">购买</strong></span> </a> </li> 
	<li><a href="<?=$public_r['add_fby']?>" target="_blank"><i class="fun02"></i><span>最新网址：<?=$_SERVER['HTTP_HOST']?>/?f=<?=$r[userid]?></span></a></li> 
	</ul>
	</section>
	  	<div class="clearfix"></div>
	<section class="block"> 
   <ul class="fun_list"> 
    <li><a href="<?=$public_r['newsurl']?>e/member/sign/"><i class="fun08"></i><span>每日签到奖励</span></a></li> 	
	<li><a href="<?=$public_r['newsurl']?>e/member/task/"><i class="fun13"></i><span>分享推广/赚取阅币</span></a></li> 
	<li><a href="javascript:myTips('保存好自己账号密码');"><i class="fun12"></i><span style="color:#999">站内信息</span></a></li>
	<!--<li><a href="<?=$public_r['add_fby']?>" target="_blank"><i class="fun02"></i><span class="red">老司机福利</span></a> </li> -->
   </ul> 
  </section>
	<div class="clearfix"></div>	
    <section class="block"> 
   <ul class="fun_list">  
   	<li><a href="<?=$public_r['newsurl']?>e/member/buybak/"><i class="fun03"></i> <span>充值记录 / 订单</span></a> </li> 
    <li><a href="<?=$public_r['newsurl']?>fav/"><i class="fun09"></i><span>我收藏的漫画</span> </a> </li> 
	<li><a href="<?=$public_r['newsurl']?>his/"><i class="fun10"></i><span>浏览记录</span></a> </li> 
   </ul> 
  </section>
     <div class="clearfix"></div>
    <section class="block"> 
   <ul class="fun_list">  
     <li><a href="<?=$public_r['newsurl']?>e/member/EditInfo/"><i class="fun07"></i> <span><?=$email?></span> </a></li> 
	<li><a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php"><i class="fun15"></i><span>修改密码</span></a></li>
   </ul> 
  </section>
    <div class="clearfix"></div>
	  <!--
    <section class="block"> 
	<ul class="fun_list">  
	<li><a href="<?=$public_r['newsurl']?>e/member/EditInfo/"><i class="fun05"></i> <span><?=$qq?></span> </a></li> 
	<li><a href="<?=$public_r['newsurl']?>e/member/EditInfo/"><i class="fun06"></i> <span><?=$phone?></span> </a></li> 
   </ul> 
  </section>
    <div class="clearfix"></div>
  -->
    <section class="block"> 
   <ul class="fun_list">  
	<li><a href="<?=$public_r['newsurl']?>help/"><i class="fun04"></i> <span>联系客服：提供App付款记录和本页截图</span></a></li> 
   </ul> 
  </section>
   <section class="block">
   <a href="<?=$public_r['newsurl']?>e/member/login/login.php" class="morebtn" style="color:#f14526;">退出 / 切换账户</a>
  </section>
  <div class="clearfix"></div>
  <div class="h50"></div>
    <div class="clearfix"></div>
    </main>
<script type="text/javascript" src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201905"></script>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
}
?>