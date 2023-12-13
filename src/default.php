<?php
include_once('e/extend/isMobile.php');
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
  <meta name="robots" content="index,follow"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-title" content="黄瓜漫画">
  <link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
  <link rel="icon" type="image/png" sizes="256x256" href="/icon/apple-touch-icon-256x256-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" href="/icon/apple-touch-icon-57x57-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/icon/apple-touch-icon-114x114-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/icon/apple-touch-icon-144x144-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="256x256" href="/icon/apple-touch-icon-256x256-precomposed.png"/>
  <meta name="keywords" content="黄瓜漫画,韩国污漫" />
  <meta name="description" content="黄瓜漫画"/>
  <meta property="og:url" content=""/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="黄瓜漫画"/>
  <meta property="og:description" content="黄瓜漫画"/>
  <meta property="og:image" content="/icon/favicon.png"/>
  <meta property="og:site_name" content="黄瓜漫画"/>
  <title>黄瓜漫画</title>
  <link rel="stylesheet" type="text/css" id="cssfile" href="/skin/theme/bg1.css" /> 
  <style type="text/css">body,html{margin:0;padding:0;height:100%;font-family:microsoft yahei}a{text-decoration:none}.box{top:2%;overflow:hidden;padding:40px 20px 60px;border:2px solid #666;border-radius:30px;background:#fff}.box,.box:before{position:absolute;left:50%}.box:before{top:2%;display:block;width:20%;height:8px;border-radius:15px;background:#999;content:'';transform:translate(-50%,0)}.box iframe{overflow-x:hidden;padding:0 1px 0 0;width:100%;height:100%;border:1px solid #ccc}.box a.refresh{display:block;overflow:hidden;margin:5px auto;width:36px;height:36px;border:1px solid #ccc;border-radius:50%;background:#f9f9f9 url(/skin/theme/refresh.png) no-repeat center center;background-size:20px;text-align:center;opacity:.5}.box a.refresh:hover{background-color:#eee;opacity:1}.main{position:relative;margin:0 auto;width:975pt}.pl,.plm{position:absolute;top:50pt;left:50%;padding:10px 0;width:180px;border-radius:10px;text-align:center}.plm{top:350px}.pl img,.plm img{margin:10px;width:180px}#skin{position:absolute;top:10%;right:50%;padding:0;width:60px;text-align:center}#skin li{position:relative;float:left;width:40px;height:27px;border:1px solid #fff;cursor:pointer;margin-bottom:10px;list-style:none;opacity:.8}#skin li#bg1{background:url(/skin/theme/thumb1.jpg);background-size:100%}#skin li#bg2{background:url(/skin/theme/thumb2.jpg);background-size:100%}#skin li#bg3{background:url(/skin/theme/thumb3.jpg);background-size:100%}#skin li#bg4{background:url(/skin/theme/thumb4.jpg);background-size:100%}#skin li#bg5{background:url(/skin/theme/thumb5.jpg);background-size:100%}#skin li#bg6{background:url(/skin/theme/thumb6.jpg);background-size:100%}#skin li:hover{opacity:1}#skin li.selected i{display:inline-block;width:12px;height:12px;overflow:hidden;background:url(/skin/theme/select.png) no-repeat;background-size:12px;position:absolute;top:-4px;right:-6px}</style>
</head>
<body>
<div class="pl"><img src="/app.png?v1.01"></div><!--<div class="plm"><img src="/ydy.png"></div>-->
<ul id="skin"><li id="bg1" class="selected"><i></i></li><li id="bg2"><i></i></li><li id="bg3"><i></i></li><li id="bg4"><i></i></li><li id="bg5"><i></i></li><li id="bg6"><i></i></li></ul> 
<script type="text/javascript" src="/skin/js/jquery.min.js"></script>
<script type="text/javascript">function GetQueryString(a){a=new RegExp("(^|&)"+a+"=([^&]*)(&|$)");a=window.location.search.substr(1).match(a);return null!=a?unescape(a[2]):null}var myurl=GetQueryString("f");if(null!=myurl&&1<myurl.toString().length){var tg="?f="+GetQueryString("f");$(function(){$.get("/e/member/from/?f="+GetQueryString("f"))})}else tg="";	
/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)&&(window.location.href="/index.php"+tg);document.writeln("<div class='box'><iframe src='/index.php' allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen'  id='myframe' ></iframe><a href='javascript:void(0);' class='refresh' onclick='javascript:refreshFrame();'></a></div>");$(function(){boxSize()});$(window).resize(function(){boxSize()});
function boxSize(){var a=$("body").height()-200,b=$(".box");b.css({height:a,minHeight:640});a=.64*b.height();b.css({width:a,marginLeft:a/2-a-20});$(".pl,.plm").css("margin-left",-(a/2+285));$("#skin").css("margin-right",-(a/2+120))}function refreshFrame(){document.getElementById("myframe").contentWindow.location.reload(!0)}
function switchSkin(a){$("#"+a).addClass("selected").siblings().removeClass("selected");$("#cssfile").attr("href","/skin/theme/"+a+".css");$.cookie("MyCssSkin",a,{path:"/",expires:10})}$(function(){$("#skin li").click(function(){switchSkin(this.id)});var a=$.cookie("MyCssSkin");a&&switchSkin(a)});</script>
<div style="display:none;"><script src="/skin/js/tj.js" language="JavaScript"></script></div>
</body>
</html>
<?
} else { 
   Header("Location:/error.php");
}
?>