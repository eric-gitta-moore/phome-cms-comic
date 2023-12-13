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
  <meta name="keywords" content="黄瓜漫画,韩国污漫画" />
  <meta name="description" content="黄瓜漫画,韩国污漫画"/>
  <meta property="og:url" content="/index.php"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="黄瓜漫画"/>
  <meta property="og:description" content="黄瓜漫画,韩国污漫画"/>
  <meta property="og:image" content="/icon/favicon.png"/>
  <meta property="og:site_name" content="黄瓜漫画"/> 
  <title>黄瓜漫画</title>
  <style>#applink{display:none;}</style>
  <link href="/skin/css/base.css?v3=2019050999975" rel="stylesheet" type="text/css">
</head>
<body class="index"> 
<main id="left">
<header class="tophead clf">
<div id="headerbox">
	<div id="headerbox">
		<a href="/index.php" class="logo" id="waplink"></a>
	<a href="javascript:void(0);" class="logo" id="applink"></a>
			<div class="tabBtn"><span>
	<a href="/index.php" class="on" id="waplink">首页</a>
	<a href="javascript:void(0);" class="on" id="applink">首页</a>
			<a href="/cate">连载</a>
			<a href="/top">排行</a></span>
		</div>
		<a class="tsign" href="javascript:void(0);">&nbsp;</a>
	</div>
</div>
</header>
<div class="clearfix"></div>
<section class="block indexso">
<div id="searchbox" class="clf">
<form action="/e/search/" method="post" name="searchform" id="searchform">
	<input type="hidden" name="show" value="keyboard,title,smalltext,comic" />
	<input type="hidden" name="tbname" value="comic" />
	<input type="hidden" name="tempid" value="1" />
	<input type="text" class="fl searchInput" name="keyboard" value="" placeholder="关键词，漫画名，作者"/>
</form>
</div>
</section>
<div class="clearfix"></div>
<div class="ht120"></div>
<section class="focusbox bt5" style="background:#fff"> 
   <div class="focus_con"></div> 
   <div class="focus_pic"> 
    <ul> 
	    </ul> 
   </div> 
</section>
<!--
</section>
<div class="clearfix"></div>
提示：为响应“净网2019行动”，本站将于2019.8.14日0点暂停访问，<br />
已充值用户的积分和VIP不受影响，请不必担心，<br />
恢复访问后可继续正常使用。<br />
更多疑问请联系客服微信：
<a href='/e/member/buygroup/' target='_blank'>gougoumanhua</a>
</section>
-->
<div class="clearfix"></div>
<section class="block" style="padding:10px 0;">
	<ul class="btnList clf">
		<li><a href="/cate/?status=end" class="bg03"></a>完本</li>
		<li><a href="/cate/?status=even" class="bg01"></a>连载</li>
		<li><a href="/top/" class="bg05"></a>热榜</li>
		<li><a href="/e/member/buygroup/" class="bg04"></a><b class="red">充值</b></li>
		<li class="app"><a href="javascript:void(0);" class="bg08"></a>APP下载</li>
	</ul>
</section>
  <div class="clearfix"></div>
  <section class="showaddiv"> 
        <a  href="/help/"><img src="/skin/images/help.png"/> </a> 
</section> 
<div class="clearfix"></div>
  <section class="block">
    <div class="titleBar clf"><i class="fl">强档推荐</i></div>
    <div><ul class="book_list03 clf">	</ul></div>
    <a href="/top/" class="morebtn">查看更多</a>
  </section>
<div class="clearfix"></div>
    <section class="block">
    <div class="titleBar clf"><i class="fl">恋爱</i></div>
    <div><ul class="book_list01 clf"></ul></div>
    <a href="/cate/?type=61" class="morebtn">查看更多</a>
  </section>
  <div class="clearfix"></div>
  <section class="block">
    <div class="titleBar clf"><i class="fl">日韩漫画</i></div>
    <div><ul class="book_list01 clf"></ul></div>
    <a href="/cate/?type=62" class="morebtn">查看更多</a>
  </section>
  <div class="clearfix"></div>
  <section class="block">
    <div class="titleBar clf"><i class="fl">校园</i></div>
    <div><ul class="book_list01 clf"></ul></div>
    <a href="/cate/?type=63" class="morebtn">查看更多</a>
  </section>
  <div class="clearfix"></div>
  <section class="block">
    <div class="titleBar clf"><i class="fl">热门追更</i></div>
    <div><ul class="book_list01 clf"></ul></div>
    <a href="/hot/" class="morebtn">查看更多</a>
  </section>
  <div class="clearfix"></div>
  <section class="block">
    <div class="titleBar clf"><i class="fl">新番发布</i></div>
    <div><ul class="book_list01 clf"></ul></div>
    <a href="/new/" class="morebtn">查看更多</a>
  </section>
  <div class="clearfix"></div>
<section class="showaddiv"> 
        <a href="/e/member/buygroup/"> <img src="/skin/images/vip.png" /> </a> 
</section> 
<div class="clearfix"></div>
<section class="block">
  <div class="titleBar wb10 clf">
	<i class="fl">刚刚更新</i>
  </div>
  <ul class="book_list" id="novelList"></ul>
  <a href="javascript:void(0);" class="morebtn" id="loading" onclick="LoadMore()">点击加载更多</a>
</section>
<div class="clearfix"></div>
<div class="h50"></div>
<div class="clearfix"></div>
<script type="text/html" id="litemptop">
    <li class="clf">
        <a href="{nlink}" class="fl"><img class="lazyload" src="/skin/images/cover.jpg" data-src="{img}">{age}<p>{up}</p></a>
        <div class="fr">
            <b class="booktitle"><a href="{nlink}">{name}</a></b>
            <div class="bookdesc"><a href="{nlink}">{summary}</a></div>
            <div class="bookcat clf">
                <p class="fl">
				    <span class="tcIcon">{tc}</span>
					<span class="wirteIcon">{author}</span>				
				</p>
                <p class="fr tag {jindu}">{upstate}</p>
            </div>
        </div>
    </li>
</script>
<div class='t-popup sign-box hide'>
	<div class='sign-popup'>	
	    <div class="heart"></div>
		<div class="box">
		<h3>签到有礼</h3>
		<p>已连续签到<b class="even">0</b>天</p>
		<p class="img"></p>
		<p class="tips">每日签到奖励18阅币</p>
		<p class="min">连续签到奖励更多</p>
		<span class="but"><a href="javascript:void(0);" class="sign">签到</a></span>
		</div>
		<a href="javascript:void(0);"  class="close">&nbsp;</a>
	</div>		
</div>
<div class="clearfix"></div>
<div class="h50"></div>
</main>
<nav class="footnav clf">
<a href="/index.php" id="waplink"><span class="m01">首页</span></a>
<a style="cursor:pointer;" id="applink"><span class="m01">首页</span></a>
<a href="/cate/" id="cate"><span class="m03">分类</span></a>
<a href="/top/"  id="top"><span class="m02">排行</span></a >
<a href="/fav/" id="fav"><span class="m05">书架</span></a>
<a href="/user/" id="user"><span class="m04">我的</span><i></i></a>
</nav>
<script src="/skin/js/jquery.min.js?v3=2020" type="text/javascript"></script>
<script src="/skin/js/index.js?v3=2019050550998767559" type="text/javascript"></script>
<script src="/skin/js/focus.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/sign.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/so.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/tj.js?v2=201904" type="text/javascript"></script>
<script src="/e/extend/html.php" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
 if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {  
   $("li.app").click(function(){balert()}); //iOS点击提示
   //setTimeout(function(){balert()},1000); //iOS进入提示
  } else if (/(Android)/i.test(navigator.userAgent)) {
   $("li.app").click(function(){window.location.href="/"}); //安卓点击访跳转
  } else {
      window.frames.length!=parent.frames.length||(window.location.href="/default.php"); //PC访问跳转
   $("li.app").click(function(){window.location.href="#PC跳转链接"}); //PC点击访跳转
 };
});
</script>
</body>
</html>
<?
} else { 
   Header("Location:/error.php");
}
?>