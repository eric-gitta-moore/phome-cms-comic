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
<title>漫画收藏  - <?=$public_r['add_name']?></title>
</head>
<body>
	<main id="left">
  <header class="tophead"> 
   <a href="javascript:history.go(-1);" class="back"></a> 
   我的书架
   <a href="<?=$public_r['add_waplink']?>" class="home01" id="waplink"></a>
   <a href="<?=$public_r['add_applink']?>" class="home01" id="applink"></a>
  </header> 
  <section class="block"> 
  <div class="tabBar tabBar2 clf">
	<a href="javascript:void(0);" class="fl taboff selected">漫画收藏</a>
	<a href="<?=$public_r['newsurl']?>his/"  class="fl taboff">浏览足迹</a>
</div>
   <ul class="history_list bt5" id="novelList"></ul> 
   <a href="javascript:void(0);" class="morebtn" id="loading" onclick="LoadMore(1)"></a> 
  </section> 
  <script type="text/html" id="litemp">
    <li id="list-{id}">    
        <a href="{nlink}" class="fl">{age}<img class="lazyload" src="<?=$public_r['newsurl']?>skin/images/cover.jpg" data-src="{img}"><p>{tc}</p></a>
        <a href="{nlink}" class="fr">
            <span class="name">{name}{upstate}</span>
			<span class="txt">更新日：{up}</span>
            <span class="txt">{pro}</span>
			<span class="txt">已更新至第：{ind} 话</span>
        </a>
		{del}
    </li>
</script> 
<section class="showaddiv"> 
        <a  href="<?=$public_r['newsurl']?>e/member/buygroup/"> <img src="<?=$public_r['newsurl']?>skin/images/vip.png" /> </a> 
</section> 		 
<div class="h50"></div>
<div class="spinner">
	<div class="double-bounce1"></div>
	<div class="double-bounce2"></div>
</div>
<div class="h50"></div>
</main>
<nav class="footnav clf">
<a href="<?=$public_r['add_waplink']?>" id="waplink"><span class="m01">首页</span></a>
<a href="<?=$public_r['add_applink']?>" id="applink"><span class="m01">首页</span></a>
<a href="<?=$public_r['newsurl']?>cate/"><span class="m03">分类</span></a>
<a href="<?=$public_r['newsurl']?>top/" ><span class="m02">排行</span></a >
<a href="<?=$public_r['newsurl']?>fav/" class="selected"><span class="m05">书架</span></a>
<a href="<?=$public_r['newsurl']?>user/" id="user" class="in"><span class="m04">我的</span><i></i></a>
</nav>
<script type="text/javascript">
if(navigator.userAgent.indexOf("Html5Plus") > -1){  
   document.writeln("<style>#waplink{display:none;}#applink{display:inline-block;}</style>");
   document.writeln("<link href=\'<?=$public_r['newsurl']?>skin/css/html5plus.css?v3=20190507\' rel=\'stylesheet\' type=\'text/css\'>");
}  
</script>
<script src="<?=$public_r['newsurl']?>skin/js/jquery.min.js?v2=201903" type="text/javascript"></script>
<script src="<?=$public_r['newsurl']?>skin/js/favlist.js?v2=201903" type="text/javascript"></script>
<script src="<?=$public_r['newsurl']?>skin/js/tj.js?v2=201903" type="text/javascript"></script>
</body>
</html>
<? } else { 
    Header("Location:/error.php");
}
?>