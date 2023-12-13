<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
require('../../extend/isMobile.php');
if (isMobile()){
$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='".$user[userid]."' limit 1");
$r=$empire->fetch1("select * from {$dbtbpre}enewsmember where userid='".$user[userid]."' limit 1");
$userpic=$addr['userpic']?$addr['userpic']:$public_r['newsurl'].'skin/images/user.png';	
if ($addr[startpass]){ 
   if ($r[edit]==0){
      $passval='<div style="display:none;"><input name="oldpassword" id="oldpassword" type="text" value="'.$addr[startpass].'" /></div>';
	} else {
		$passval='<div><input class="Iput" name="oldpassword"  id="oldpassword" type="password" placeholder="原密码" /></div>';
	}   
}else {
		$passval='<div><input class="Iput" name="oldpassword"  id="oldpassword" type="password" placeholder="原密码" /></div>';
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
  <main id="left">
     <title>修改登陆密码 - <?=$public_r['add_name']?></title>
</head>
<body class="bodywhite">
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>
密码安全
<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a></header>
<section class="loginbox">
	<div class="loginCont">
		<div class="login" style="background:url(<?=$userpic?>) center 20px no-repeat;background-size: 64px;">
		<div class="ename"><?=$r[username]?></div>
		<div class="h10 clearfix"></div>
			<?=$passval?>
			<div>
				<input class="Iput" name='password' type='text' id='password' placeholder="新密码"/>
			</div>
			<div class="errmsg"><span id="errmsg"><em class="pink">保存好自己账号密码！绑定邮箱 方便找回密码</em></span></div>
			<div class="errmsg"><span id="errmsg"><em class="pink">请牢记新密码，如忘记密码请通过邮箱取回</em></span></div>
			<div class="h10 clearfix"></div>
			<div class="go">
			<button type="submit" class="Iput w50" id="safe-sub">确认修改</button>
			</div>
		</div>
		<div class="loginHelp line">
		 <p><a href="<?=$public_r['newsurl']?>e/member/EditInfo/">点击绑定邮箱，手机</a></p>
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