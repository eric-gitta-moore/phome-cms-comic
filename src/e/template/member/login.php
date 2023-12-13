<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
require('../../extend/isMobile.php');
if (isMobile()){
//检查IP是否有注册渠道
$fromip = egetip();
$fromr = $empire->fetch1("select * from {$dbtbpre}enewsmember_from where fip='{$fromip}' order by ftime desc limit 1");
if ($fromr[userid]) {
    $fromadd = $fromr[userid];
} else {
    $fromadd = '';
}
//随机生成账号
$randname = 'u' . rand(1000000, 9999999);
$randname = str_replace("4", "8", $randname);
$num = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember where username='{$randname}' limit 1");
if ($num) {
    $username = 'u' . rand(10000000, 99999999);
} else {
    $username = $randname;
}
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
     <title>会员帐号登录 - <?=$public_r['add_name']?></title>
</head>
<body class="bodywhite">
<main id="left">
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>
登录
<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a>
</header>
<section class="loginbox">
	<div class="loginCont">
		<div class="login" id="user-login">
			<div>
				<input class="Iput" type='text' name='logusername' id='logusername' placeholder="登陆账号" />
			</div>
			<div>
				<input class="Iput" name='logpassword' type='password' id='logpassword' placeholder="密码">
			</div>
			 <?php if($public_r['loginkey_ok']){?>
			<div class="key">
				<input name="key" type="text" id="logkey" class="Iput code" placeholder="验证码"><img src="<?=$public_r['newsurl']?>e/ShowKey/?v=login" name="logKeyImg" id="logKeyImg" onclick="logKeyImg.src='<?=$public_r['newsurl']?>e/ShowKey/?v=login&amp;t='+Math.random()" title="看不清楚,点击刷新">
			</div>
			<?php } ?>
			<p class="errmsg" id="errmsg" style="margin-top:-15px;"></p>
			<div class="go">
			<button type="submit" class="Iput" id="login-sub">立即登录</button>
			</div>
			<!--
			<div class="go">
				<button type="submit" class="Iput yellow"  onclick="location.href='<?=$public_r['newsurl']?>e/member/register/?groupid=1'">3秒注册会员</button>
			</div>
			-->
			<?php if($myuserid){} else {?>
			<div class="go">
				<div style="display:none;">
					<input type="hidden" name="fromadd" id="regfrom" value="<?=$fromadd?>" />
					<input type="hidden" name="username" id="regname" value="<?=$username?>" />
					<input type="hidden" name="password" id="regpass" value="123456">
					<span id="errmsg"></span>
				</div>
			<button type="submit" id="reg-sub-zd" class="Iput yellow">没有账号？一键注册</button>			
			</div>
			<?php } ?>
		</div>
		<div class="loginHelp">
	 	   <p><a href="<?=$public_r['newsurl']?>e/member/GetPassword/">忘记登陆密码？</a></p>
		    <p><a href="/e/member/register/?groupid=1" class="reg">注册新账号</a></p>
		</div>
	</div>
</section>
</main>
<script src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201904" type="text/javascript"></script>
<script src="<?=$public_r['newsurl']?>skin/js/login.js?v2=201904" type="text/javascript"></script>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
} 
?>
