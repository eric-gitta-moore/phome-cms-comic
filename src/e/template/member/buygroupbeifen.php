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
<title>在线充值  - <?=$public_r['add_name']?></title>
</head>
<body>
  <header class="tophead"> 
   <a href="javascript:history.go(-1);" class="back"></a>掉单请发支付宝订单截图给客服<a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
<a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a>
  </header> 
  <div class="clearfix"></div>
  <section class="block signbox">
  <a href="<?=$public_r['newsurl']?>my/">
    <div class="fl w15"><img src="<?=$userpic?>"></div>
    <div class="fl w73">
        <p>
            <span>账号：<?=$user[username]?><em class="red">权益：<?=$level_r[$user[groupid]][groupname]?> / <?=$user[userfen]?>阅币</em></span><br>
            <span><i>网址：<?=$_SERVER['HTTP_HOST']?></i><em></em></span>
        </p>
    </div>
	</a> 
</section>
<div class="clearfix"></div>
<section class="signtips block" style="font-size:.65em;">
充值ID：<?=$user[userid]?>，登陆账号：<?=$user[username]?>，<?=$mmtis?>
</section>
<div class="clearfix"></div>
<section class="checkBox">
<!--form name="paytofenform" id="payform" action="<?=$public_r['newsurl']?>e/html5pay/index.php" method="post"-->
<form name="paytofenform" id="payform" action="<?=$public_r['newsurl']?>e/newpay/index.php" method="post">
    <ul class="clf"><?=$pays?></ul>
    <div class="paybtnBOX clf">
	<p><font class="red">&darr;&darr;建议使用支付宝(支持花呗)&darr;&darr;</font></p>
	<!--a href="javascript:;" class="alipay"><i></i>充值联系客服Q2144349168</a-->
    <!-- <a href="javascript:;" class="weixinpay"><i></i>微信<em></em></a>  -->
	
	<a href="javascript:;" class="newpay_alipay"><i></i>支付宝<em></em></a>
	<a href="javascript:;" class="newpay_wxpay"><i></i>微信<em></em></a>
    </div>
	<div style="display:none;">
    <input type="hidden" name="pay_orderid" value="<?=$user[userid]?>" /> 
	<input type="hidden" name="pay_amount" value="<?=$money?>" id="money"/>
	<input type="hidden" name="pay_bankcode" value="1" id="type"/>
	<input type="hidden" name="pay_attach" value="<?=$user[userid]?>" />
	<input type="hidden" name="pay_productname" value="B-账号是：<?=$user[username]?>(客服QQ：<?=$public_r['add_qq']?>)">
	<input type="hidden" name="param" value="<?=$user[userid]?>" />
	<input type="submit" name="submit" id="submit">
	</div>
</form>
    <div class="paytips">
		<p class="tips">PS：充值购买为虚拟产品，升级成功后不支持退款！</p>
		<p>1、有问题请直接联系客服QQ处理</p>
		<p>2、如果充值不到账请提供支付宝订单截图给客服</p>
		<p>3、<a href="<?=$public_r['newsurl']?>help/" target="_blank"><b class="red">有问题？点击这里联系客服</b></a></p>
    </div>
</section>
<div class="clearfix"></div>
<div style="height:100px;float:left;display:block;">&nbsp;</div>
<script type="text/javascript" src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201904"></script>
<script type="text/javascript">
$(".checkBox ul li").click(function(){	
	$(this).addClass('selected').siblings().removeClass('selected');
	var value = $(this).attr("money-id");	
	$("#money").val(value);
}); 

$("a.newpay_alipay").click(function(){	
	$("#type").val('1');
	$("#submit").trigger("click");	
});
$("a.newpay_wxpay").click(function(){	
	$("#type").val('2');
	$("#submit").trigger("click");	
});

$("a.alipay").click(function(){	
	if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
		$("#type").val('904');
	} else { 
		$("#type").val('903');
	};
	$("#submit").trigger("click");	
});
$("a.weixinpay").click(function(){	
	if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
		$("#type").val('901');
	} else { 
		$("#type").val('902');
	};
	$("#submit").trigger("click");	
});
</script>
<?php
    require(ECMS_PATH.'e/template/member/footer.php'); 
}else { 
    Header("Location:/error.php");
}   
?>  
    