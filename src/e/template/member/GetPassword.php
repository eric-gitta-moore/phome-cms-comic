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
  <title>找回密码 - <?=$public_r['add_name']?></title>
</head>
<body class="bodywhite">
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>
找回密码
   <a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
   <a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a></header>
<section class="loginbox">
	<div class="loginCont">
		<div class="login" id="user-get">
			<div>
				<input class="Iput" type='text' name="username" id="getusername" placeholder="用户名" />
			</div>
			<div>
				<input class="Iput"  type='text' name="email" id="getemail" placeholder="注册邮箱">
			</div>
			<div class="key">
				<input name="key" type="text" id="getkey" class="Iput code" placeholder="验证码"><img src="<?=$public_r['newsurl']?>e/ShowKey/?v=getpassword" id="getpasswordshowkey" onclick="edoshowkey('getpasswordshowkey','getpassword','<?=$public_r['newsurl']?>index.php');"  title="看不清楚,点击刷新">
			</div>
			<div class="errmsg" id="errmsg"></div>
			<div class="go">
			<button type="submit" class="Iput" id="pass-sub">提交找回</button>
			</div>
		</div>
		<div class="tishi">提交成功后，我们将发送一封修改密码的邮件到你的注册邮箱，请留意查看~</div>
		<div class="loginHelp line">
		 <p><a href="<?=$public_r['newsurl']?>e/member/register/?groupid=1">注册新账号</a></p>
		</div>
	</div>
</section>
<script src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201903" type="text/javascript"></script>
<script src="<?=$public_r['newsurl']?>skin/js/login.js?v2=201903" type="text/javascript"></script>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
     }
} 
?>
