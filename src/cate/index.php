<?php
require('../e/extend/isMobile.php');
if (isMobile()){ $t=$_GET['type'];if($t==61){ $t61=' class="red"';} elseif($t==62){ $t62=' class="red"';} elseif($t==63){ $t63=' class="red"';} elseif($t==64){ $t64=' class="red"';} elseif($t==65){ $t65=' class="red"';} elseif($t==66){ $t67=' class="red"';} elseif($t==67){ $t67=' class="red"';} elseif($t==68){ $t68=' class="red"';} elseif($t==69){ $t69=' class="red"';} elseif($t==70){ $t70=' class="red"';} elseif($t==71){ $t71=' class="red"';} else{ $type=' class="red"';} $s=$_GET['status'];$even='';$end='';$status='';if($s=='end'){ $end=' class="red"';$s='2';} elseif($s=='even'){ $even=' class="red"';$s='1';} else{ $status=' class="red"';$s='0';} $a=$_GET['age'];$adult='';$age='';if($a==18){ $adult=' class="red"';$a='18';} else{ $age=' class="red"';$a='0';} 
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
  <meta name="keywords" content="黄瓜漫画,韩国漫画,无删减污漫,无码韩漫" />
  <meta name="description" content="最新韩国污漫画在线免费阅读，观看无码无遮掩无删减正版韩漫污漫"/>
  <meta property="og:url" content="/cate"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="最新污漫画,韩国漫画,无删减污漫,无码韩漫-黄瓜漫画"/>
  <meta property="og:description" content="最新韩国污漫画在线免费阅读，观看无码无遮掩无删减正版韩漫污漫"/>
  <meta property="og:image" content="/icon/favicon.png"/>
  <meta property="og:site_name" content="黄瓜漫画"/> 
<title>最新污漫画,韩国漫画,无删减污漫,无码韩漫-黄瓜漫画</title>
<style>#applink{display:none;}</style>
<link href="/skin/css/base.css?v3=20190507" rel="stylesheet" type="text/css">
</head>
<body>
<main id="left">
<header class="tophead">
<div id="headerbox">
	<a href="/index.php" class="logo" id="waplink"></a>
	<a href="" class="logo" id="applink"></a>
		<div class="tabBtn"><span>
			<a href="/index.php" id="waplink">首页</a>
			<a href="" id="applink">首页</a>
			<a href="/cate" class="on">连载</a>
			<a href="/top">排行</a></span>
		</div>
	<a class="searchBtn01" id="searchBtn"></a>
</div>
<div id="searchbox" class="clf" style="display:none">
	<input type="text" class="fl w80 searchInput" id="keywords" placeholder="输入 名称作者关键字 搜索"/>
	<a class="cancleBtn fl w20" id="cancleBtn">取消</a>
</div>
</header>
<section class="block">
<div class="titleBar catetitle clf">
	<i class="fl">分类筛选</i>
</div>
<div class="catebox">
<span>题材：</span>
<dd>
<a href="javascript:void(0);" <?=$type?> onclick="SelClass(this,0)">全部</a>
<a href="javascript:void(0);" <?=$t61?> onclick="SelClass(this,61)" data-classid="61">剧情</a>
<a href="javascript:void(0);" <?=$t62?> onclick="SelClass(this,62)" data-classid="62">恋爱</a>
<a href="javascript:void(0);" <?=$t63?> onclick="SelClass(this,63)" data-classid="63">校园</a>
<a href="javascript:void(0);" <?=$t64?> onclick="SelClass(this,64)" data-classid="64">冒险</a>
<a href="javascript:void(0);" <?=$t65?> onclick="SelClass(this,65)" data-classid="65">恐怖</a>
<a href="javascript:void(0);" <?=$t66?> onclick="SelClass(this,66)" data-classid="66">惊悚</a>
<a href="javascript:void(0);" <?=$t67?> onclick="SelClass(this,67)" data-classid="67">BL</a>
<a href="javascript:void(0);" <?=$t68?> onclick="SelClass(this,68)" data-classid="68">搞笑</a>
<a href="javascript:void(0);" <?=$t69?> onclick="SelClass(this,69)" data-classid="69">动作</a>
<a href="javascript:void(0);" <?=$t70?> onclick="SelClass(this,70)" data-classid="70">科幻</a>
<a href="javascript:void(0);" <?=$t71?> onclick="SelClass(this,71)" data-classid="71">古风</a>
<a href="javascript:void(0);" <?=$t72?> onclick="SelClass(this,72)" data-classid="72">其他</a>
</dd>
</div>
<div class="catebox checkcatebox" data-str="up">
<span>更新：</span>
<dd>
<a href="javascript:void(0);"  class="red" data-value="0">全部</a>
<a href="javascript:void(0);" data-value="1">周一</a>
<a href="javascript:void(0);" data-value="2">周二</a>
<a href="javascript:void(0);" data-value="3">周三</a>
<a href="javascript:void(0);" data-value="4">周四</a>
<a href="javascript:void(0);" data-value="5">周五</a>
<a href="javascript:void(0);" data-value="6">周六</a>
<a href="javascript:void(0);" data-value="7">周日</a>
</dd>
</div>
<div class="catebox checkcatebox" data-str="age">
<span>年龄：</span>
<dd>
<a href="javascript:void(0);" <?=$age?> data-value="0">全部</a>
<a href="javascript:void(0);" data-value="17">青少年<em>(0)</em></a>
<a href="javascript:void(0);" <?=$adult?> data-value="18">成年<em>(0)</em></a>
</dd>
</div>
<div class="catebox checkcatebox" data-str="status">
<span>状态：</span>
<dd>
<a <?=$status?> data-value="0">全部</a>
<a <?=$even?> data-value="1">连载中<em>(0)</em></a>
<a <?=$end?> data-value="2">已完结<em>(0)</em></a>
</dd>
</div>
<!--<div class="catebox cateorder checkcatebox" data-str="order">
<span>排序：</span>
<dd>
<a href="javascript:void(0);" class="red" data-value="lastdotime">刚更新</a>
<a href="javascript:void(0);" data-value="diggtop">推荐榜</a>
<a href="javascript:void(0);" data-value="onclick">最热门</a>
<a href="javascript:void(0);" data-value="favnum">收藏量</a>
</dd>
</div>-->
</section>
<section class="block">
<div class="titleBar wb10 clf">
	<i class="fl">筛选列表</i>
</div>
<ul class="book_list" id="novelList"></ul>
<a href="javascript:void(0);" class="morebtn" id="loading" onclick="LoadMore()">点击加载更多</a>
</section>
<script type="text/html" id="litemp">
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
<section class="showaddiv"> 
        <a href="/e/member/buygroup/"> <img src="/skin/images/vip.png" /> </a> 
</section><div class="h50"></div>
</main>
<div class="h50"></div>
<nav class="footnav clf">
<a href="/index.php" id="waplink"><span class="m01">首页</span></a>
<a href="" id="applink"><span class="m01">首页</span></a>
<a href="/cate/" id="cate"><span class="m03">分类</span></a>
<a href="/top/" id="top"><span class="m02">排行</span></a >
<a href="/fav/" id="fav"><span class="m05">书架</span></a>
<a href="/user/" id="user"><span class="m04">我的</span><i></i></a>
</nav>
<script type="text/javascript">
if(navigator.userAgent.indexOf("Html5Plus") > -1){  
   document.writeln("<style>#waplink{display:none;}#applink{display:inline-block;}</style>");
   document.writeln("<link href='/skin/css/html5plus.css?v3=20190507' rel='stylesheet' type='text/css'>");
}  
</script>
<script src="/skin/js/jquery.min.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/so.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/tj.js?v2=201904" type="text/javascript"></script>
<script>$(function(){$.get("/e/member/login/status.php?in=1",function(a,b){1==a&&$(".footnav #user").addClass("in")})});</script>


<script>
if (window.frames.length != parent.frames.length) { 
document.writeln(" <style>.catebox dd{white-space: normal;padding-right:0px;}</style>");
} 
$("#cate").addClass("selected");var tid = '<?=$t?>';var st = '<?=$s?>';var age = '<?=$a?>';</script>
<script src="/skin/js/cate.js?v2=201904" type="text/javascript"></script>
</body>
</html>
<?
} else { 
    Header("Location:/error.php");
}
?>