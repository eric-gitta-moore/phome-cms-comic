<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
require('../../extend/isMobile.php');
if (isMobile()){
$userpic=$addr['userpic']?$addr['userpic']:$public_r['newsurl'].'skin/images/user.png';	
$email = $r[email] ? 'value="'.$r[email].'"': 'placeholder="密码找回邮箱"';
$qq = $addr[oicq] ? 'value="'.$addr[oicq].'"': 'placeholder="联系QQ"';
$phone = $addr[phone] ? 'value="'.$addr[phone].'"': 'placeholder="绑定手机号"';	
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
     <title>修改个人信息 - <?=$public_r['add_name']?></title>
</head>
<body class="bodywhite">
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>
个人信息
<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a></header>
<section class="loginbox">
	<div class="loginCont">
		<div class="login" style="background:url(<?=$userpic?>) center 20px no-repeat;background-size: 64px;">
		<div class="h10 clearfix"></div>
			<div>
				<input class="Iput" type="text" name="phone" id="phone" <?=$phone?> />
			</div>
			<div>
				<input class="Iput" name="oicq" type="text" id="oicq" <?=$qq?>/>
			</div>
			<div>
				<input class="Iput" name="email" type="text" id="email" <?=$email?> />
			</div>
			<div class="errmsg"><span id="errmsg"><em class="pink">请填写准确信息，将作为找回订单和密码凭证</em></span></div>
			<div class="h10 clearfix"></div>
			<div class="go">
			<button type="submit" class="Iput w50" id="edit-sub">确认修改</button>
			</div>
		</div>
		<div class="loginHelp line">
		 <p><a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php">修改登陆密码</a></p>
		</div>
	</div>
</section>
<script src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201903" type="text/javascript"></script>
<script src="<?=$public_r['newsurl']?>skin/js/useredit.js?v2=201903" type="text/javascript"></script>
 </main>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
}
?>