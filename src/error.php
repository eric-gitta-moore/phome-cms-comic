<?php
include_once('e/extend/isMobile.php');
if (isMobile()){
	Header("Location:../?f=tx");
} else { 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>哎呀迷路了...页面找不到</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<style>
*{padding:0;margin:0}
.notfoud div.ewm{width:250px;height:250px;background:url(/hmb.png) center center no-repeat;margin:40px auto;-webkit-background-size:250px 250px;}
.notfoud span{width:100%;line-height:34px;font-size:18px;padding-bottom:15px;text-align:center;color:#262b31;display:block;}
.notfoud p{color:#9ca4ac;font-size:12px;line-height:25px;text-align:center;margin:20px auto}
.notfoud p b{color:#f66;font-size:16px}
</style>
</head>
<body>
    <div class="notfoud">
        <div class="ewm"></div>
        <span>使用QQ,UC,百度等<b>手机浏览器</b>扫码观看<br />不支持微信，原因你懂的</span>
        <p>
		    <b>高能提示</b><br />内容可能会引起生理不适<br />请自备纸巾
        </p>
    </div>	
</body>
</html>
<?
} 
?>