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
  <title>重设密码 - <?=$public_r['add_name']?></title>
</head>
<body class="bodywhite">
<header class="tophead">
   <a href="<?=$public_r['add_waplink']?>" class="back" id="waplink"></a>
   <a href="<?=$public_r['add_applink']?>" class="back" id="applink"></a>
重设密码
   <a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
   <a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a>
</header>
<section class="loginbox">
	<div class="loginCont">
		<div class="login">
			<div>
				<input class="Iput" name="newpassword" type="text" id="newpassword" placeholder="新密码" />
			</div>
			<div class="errmsg"><span id="errmsg"><em class="tishi">Tips：请牢记新密码</em></span></div>
			<div class="go">
			<button type="submit" class="Iput pink" id="pass-edit">确定修改</button>
			</div>
		</div>
	</div>
</section>
<input name="id" type="hidden" id="id" value="<?=$r[id]?>">
<input name="tt" type="hidden" id="tt" value="<?=$r[tt]?>">
<input name="cc" type="hidden" id="cc" value="<?=$r[cc]?>">
<script src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201903" type="text/javascript"></script>
<script src="<?=$public_r['newsurl']?>skin/js/login.js?v2=201903" type="text/javascript"></script>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
     }
} 
?>
