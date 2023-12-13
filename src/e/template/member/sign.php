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
     <title>签到打卡 - <?=$public_r['add_name']?></title>
</head>
<body>
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>签到打卡<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a></header>
<div class="clearfix"></div>
<div class="container">
<div class="img"><img src="<?=$public_r['newsurl']?>skin/images/sign_bg.png" /></div>
	<div class="calendar">
		<div class="calenbox">
			<div id="calendar"></div>
		</div>
		<div class="btn"><?=$btn?></div>
	</div>
<div class="clearfix"></div>
<div class="singtext">
    <h2>奖励说明</h2>
	<div class="box">
		<p><i>1</i>每日签到，奖励<?=$public_r['add_reward']?>阅币</p>
		<p><i>7</i>连续七天，奖励<?=$public_r['add_sign7']?>阅币</p>
		<p><i>15</i>连续十五天，奖励<?=$public_r['add_sign15']?>阅币</p>
		<p><i>30</i>连续三十天，奖励<?=$public_r['add_sign30']?>阅币</p>
		<p class="last">提示：连签奖励如果间断则重新计算</p>
	</div>
</div>
</div>
<div class="clearfix"></div>
<div class='t-popup sign-box hide'>
	<div class='sign-popup'>	
	    <div class="heart"></div>
		<div class="box">
		<h3>签到有礼</h3>
		<p>已连续签到<b class="even">0</b>天</p>
		<p class="img"></p>
		<p class="tips">每日签到奖励<?=$public_r['add_reward']?>阅币</p>
		<p class="min">连续签到奖励更多</p>
		<span class="but"><a href="javascript:void(0);" class="sign">签到</a></span>
		</div>
		<a href="javascript:void(0);"  class="close">&nbsp;</a>
	</div>		
</div>
<div class="clearfix"></div>
<script type="text/javascript" src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201903"></script>
<script type="text/javascript" src="<?=$public_r['newsurl']?>skin/js/sign.js?v2=20190310"></script>
<script type="text/javascript" src="<?=$public_r['newsurl']?>skin/js/calendar.js?v2=20190310"></script>
<script>
$(function(){
  var signList=[<?=$list?>];
   calUtil.init(signList);
});
</script>
</main>
<?php
require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
}
?>