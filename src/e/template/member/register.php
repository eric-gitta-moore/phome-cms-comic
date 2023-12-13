<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
$myuserid=(int)getcvar('mluserid');
if($myuserid){
	Header("Location:/my");
}else{
	require('../../extend/isMobile.php');
    if (isMobile()){
	//检查IP是否有注册渠道
	$fromip=egetip();
	$fromr=$empire->fetch1("select * from {$dbtbpre}enewsmember_from where fip='{$fromip}' order by ftime desc limit 1");
	if ($fromr[userid]) {
		$fromadd=$fromr[userid];
	}else {
        $fromadd='';
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
     <title>注册会员账号 - <?=$public_r['add_name']?></title>
</head>
<body class="bodywhite">
<main id="left">
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>
注册
<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a>
</header>
<section class="loginbox">
	<div class="loginCont">
		<div class="login" id="user-reg">
			<div>
				<input class="Iput" type="text" name="username" id="regname" placeholder="用户名，建议使用手机或QQ号容易记住" />
			</div>
			<?php if($public_r['regacttype']==1){?>
			<div>
				<input class="Iput" type="text" name="email" id="regemail" placeholder="激活邮箱" value="" />
			</div>
			<?php } ?>
			<div>
				<input class="Iput"  type="password" name="password" id="regpass" placeholder="登陆密码，请牢记">
			</div>
			 <?php if($public_r['regkey_ok']){?>
			<div class="key">
				<input name="key" type="text" id="regkey" class="Iput" placeholder="验证码"><img src="<?=$public_r['newsurl']?>e/ShowKey/?v=reg" name="zcKeyImg" id="zcKeyImg" onclick="zcKeyImg.src='<?=$public_r['newsurl']?>e/ShowKey/?v=reg&amp;t='+Math.random()" title="看不清楚,点击刷新">	
			</div>
			<?php } ?>
			<p class="errmsg" id="errmsg" style="margin-top:-15px;"></p>
			<div class="go">
			<input type="hidden" name="fromadd" id="regfrom" value="<?=$fromadd?>">
			<button type="submit" class="Iput" id="reg-sub">一键注册</button>
			</div>
		</div>
		<div class="loginHelp">
	 	   <p><a href="<?=$public_r['newsurl']?>user/">已有账号，马上登陆</a></p>
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
} 
?>
