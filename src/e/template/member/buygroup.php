<?php
if (!defined('InEmpireCMS')) {
    exit();
}
require '../../extend/isMobile.php';
if (isMobile()) {
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
<form name="paytofenform" id="payform" action="#" method="post">
    <ul class="clf"><?=$pays?></ul>
    <div class="paybtnBOX clf">

	<!-- <a href="javascript:;" id="alipay2" class="alipay"><i></i>支付宝（备用）</a> -->
    <a href="javascript:;" id="wxpay1" class="weixinpay"><i></i>微信支付（推荐）</a>
    <a href="javascript:;" id="alipay1" class="alipay" style="line-height: 2.6rem;height: 2.6rem;margin: 20px 10%;"><i></i>支付宝</a>
    <!--<a href="javascript:;" id="" class="alipay" style="line-height: 2.6rem;height: 2.6rem;margin: 20px 10%;"><i></i>支付宝(维护中，请转代充)</a>-->
    <!--<a href="javascript:;" id="nxpay1" class="alipay" style="line-height: 2.6rem;height: 2.6rem;margin: 20px 10%;"><i></i>支付宝</a> -->
    <!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="904"><i></i>支付宝</a>  -->
	<!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="902"><i></i>微信扫码支付</a> -->
	<!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="903"><i></i>支付宝扫码支付</a>  -->
	<!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="906"><i></i>转银行卡</a> -->
	<!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="915"><i></i>支付宝转银行卡</a> -->
	<!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="903"><i></i>平安付支付宝</a> -->
	<!-- <a href="javascript:;" id="yuanxingku1" class="weixinpay yuanxingku1" data-type="903"><i></i>支付宝店员通</a> -->
	<!-- <a href="javascript:;" id="yuanxingku2" class="weixinpay yuanxingku2" data-type="101"><i></i>协议威信扫码支付</a> -->
	<!-- <a href="javascript:;" id="yuanxingku2" class="weixinpay yuanxingku2" data-type="102"><i></i>协议微信识别支付</a> -->
	<!-- <a href="javascript:;" id="yuanxingku2" class="weixinpay yuanxingku2" data-type="103"><i></i>协议支付宝扫码</a> -->
	<!-- <a href="javascript:;" id="yuanxingku2" class="weixinpay yuanxingku2" data-type="104"><i></i>协议支付宝H5支付</a> -->
	<!-- <a href="javascript:;" id="yuanxingku2" class="weixinpay yuanxingku2" data-type="105"><i></i>协议银联APP支付</a> -->
	<!-- <a href="javascript:;" id="wxpay2" class="weixinpay"><i></i>微信扫码</a> -->
    <p><font class="red">如果充值失败 请联系客服邮箱</font></p>
    </div>
	<div style="display:none;">
    <input type="hidden" name="pay_orderid" value="<?=$user[userid]?>" />
	<input type="hidden" name="pay_amount" value="<?=$money?>" id="money"/>
	<input type="hidden" name="pay_bankcode" value="1" id="type"/>
	<input type="hidden" name="pay_attach" value="<?=$user[userid]?>" />
	<input type="hidden" name="pay_productname" value=" <?=$user[username]?>" >
	<input type="hidden" name="param" value="<?=$user[userid]?>" />
	<input type="submit" name="submit" id="submit">
	</div>
</form>
<form name="nxpaytofenform" id="nxpayform" action="#" method="post">
	<div style="display:none;">
	<input type="hidden" name="userid" value="<?=$user[userid]?>" />
	<input type="hidden" name="amount" value="<?=$money?>" id="money1"/>
	<input type="submit" name="submit" id="submit1">
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
	$("#money,#money1").val(value);
});
$("#alipay1").click(function(){
	$("#type").val('alipay');
	$("#payform").attr('action','<?=$public_r['newsurl']?>e/html5pay/index.php');
	$("#submit").trigger("click");
});
$("#nxpay1").click(function(){
	$("#nxpayform").attr('action','<?=$public_r['newsurl']?>e/template/member/paycheck.php');
	$("#submit1").trigger("click");
});
$("#wxpay1").click(function(){
	$("#type").val('wxpay');
	$("#payform").attr('action','<?=$public_r['newsurl']?>e/html5pay/index.php');
	$("#submit").trigger("click");
});
$("#alipay2").click(function(){
	$("#type").val('1');
	$("#payform").attr('action','<?=$public_r['newsurl']?>e/newpay/index.php');
	$("#submit").trigger("click");
});
$("#wxpay2").click(function(){
	$("#type").val('2');
	$("#payform").attr('action','<?=$public_r['newsurl']?>e/newpay/index.php');
	$("#submit").trigger("click");
});
//以下是新加的
//这是固码
$(".yuanxingku1").click(function(){
	var id = $(this).attr("data-type");
	$("#type").val(id);
	$("#payform").attr('action','<?=$public_r['newsurl']?>e/yuanxingku1/dopay.php');
	$("#submit").trigger("click");
});
//以下是协议
$(".yuanxingku2").click(function(){
	var id = $(this).attr("data-type");
	$("#type").val(id);
	$("#payform").attr('action','<?=$public_r['newsurl']?>e/yuanxingku2/show.php');
	$("#submit").trigger("click");
});
</script>
</main>
<?php
require ECMS_PATH . 'e/template/member/footer.php';
} else {
    Header("Location:/error.php");
}
?>
