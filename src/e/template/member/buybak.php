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
     <title>充值记录 - <?=$public_r['add_name']?></title>
</head>
<body>
<header class="tophead"><a href="javascript:history.go(-1);" class="back"></a>
充值记录
<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a></header>
<div class="clearfix"></div>
<section class="block signbox" style="border-bottom:#ddd solid 1px;">
  <a href="<?=$public_r['newsurl']?>my/">
    <div class="fl w15"><img src="<?=$userpic?>"></div>
    <div class="fl w73">
        <p>
            <span><?=$level_r[$user[groupid]][groupname]?>： <?=$user[username]?></span> （<span class="red"><?=$user[userfen]?>阅币</span>）<br>
            <span class="red"><?=$email?></span>
        </p>
    </div>
	</a> 
</section>
<div class="clearfix"></div>
    <? if($num){?>
    <table width="100%" border="0" align="center" class="buybak bt5">
        <tr class="thead" height="25"> 
		    <td width="15%">VIP卡</td>
		    <td width="15%">点数</td>
            <td width="10%">金额</td>
            <td width="30%">购买时间</td>
        </tr>
		<?=$list?>
    </table>
	<?} else {?>
	<div class="clearfix"></div>
	<div class="h50"></div>
	<div class="clearfix"></div>
    <div class="notfoud">
	    <i></i>
        <p>暂无充值记录</p>
        <div>
            <a href="<?=$public_r['newsurl']?>e/member/buygroup/">加入VIP</a>
        </div>
    </div>
	<?}?>
<div class="h50 clearfix"></div>
 </main>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
}
?>