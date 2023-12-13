<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!--code.start-->?php
require('../e/extend/isMobile.php');
if (isMobile()){
?<!--code.end-->
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
  <meta name="apple-mobile-web-app-title" content="<?=$public_r['add_name']?>">
  <link rel="shortcut icon" type="image/x-icon" href="[!--news.url--]icon/favicon.ico">
  <link rel="icon" type="image/png" sizes="256x256" href="[!--news.url--]icon/apple-touch-icon-256x256-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" href="[!--news.url--]icon/apple-touch-icon-57x57-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="[!--news.url--]icon/apple-touch-icon-114x114-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="[!--news.url--]icon/apple-touch-icon-144x144-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="256x256" href="[!--news.url--]icon/apple-touch-icon-256x256-precomposed.png"/>
<main id="left">
  <meta name="keywords" content="[!--pagedescription--]" />
  <meta name="description" content="[!--pagedescription--]"/>
  <meta property="og:url" content="<?=$public_r['add_url']?>/[!--pagekeywords--]"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="[!--pagetitle--]-<?=$public_r['add_name']?>"/>
  <meta property="og:description" content="[!--pagedescription--]"/>
  <meta property="og:image" content="[!--news.url--]icon/favicon.png"/>
  <meta property="og:site_name" content="<?=$public_r['add_name']?>"/> 
<title>[!--pagetitle--]-<?=$public_r['add_name']?></title>
<style>#applink{display:none;}</style>
<link href="[!--news.url--]skin/css/base.css?v3=20190507" rel="stylesheet" type="text/css">
</head>
<body>
<header class="tophead">
<div id="headerbox">
	<a href="<?=$public_r['add_waplink']?>" id="waplink" class="logo"></a>
	<a href="<?=$public_r['add_applink']?>" id="applink" class="logo"></a>
		<div class="tabBtn"><span>
			<a href="<?=$public_r['add_waplink']?>" id="waplink">首页</a>
		    <a href="<?=$public_r['add_applink']?>" id="applink">首页</a>
			<a href="[!--news.url--]cate">连载</a>
			<a href="[!--news.url--]top" class="on">排行</a></span>
		</div>
	<a class="tsign" href="/e/member/sign/">&nbsp;</a>
</div>
</header>
<div class="clearfix"></div>
<section class="block indexso">
<div id="searchbox" class="clf">
<form action="[!--news.url--]e/search/" method="post" name="searchform" id="searchform">
	<input type="hidden" name="show" value="keyboard,title,smalltext,comic" />
	<input type="hidden" name="tbname" value="comic" />
	<input type="hidden" name="tempid" value="1" />
	<input type="text" class="fl searchInput" name="keyboard" value="" placeholder="关键词，漫画名，作者"/>
</form>
</div>
</section>
<div class="clearfix"></div>
<section class="focusbox bt5" style="border-bottom:0px;"> 
   <div class="focus_con"><?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('comic',5,18,1,'firsttitle=1 and titleimg!=""');
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?><a href="javascript:void(0);"><?=$bqno?></a><?php
}
}
?></div> 
   <div class="focus_pic"> 
    <ul> 
	<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('comic',5,18,1,'firsttitle=1 and titleimg!=""');
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
		<li><a href="<?=$bqsr['titleurl']?>"><img src="<?=$bqr['titleimg']?>" width="100%" height="100%"/></a></li>
	<?php
}
}
?>
    </ul> 
   </div> 
</section>
<section class="block">
 <div class="tabBar clf">
        <a class="fl taboff" id="diggtop" href="[!--news.url--]top">推荐榜</a>
        <a class="fl taboff" id="id" href="[!--news.url--]new">新番榜</a>
        <a class="fl taboff" id="onclick" href="[!--news.url--]hot">热门榜</a>
		<a class="fl taboff" id="favnum" href="[!--news.url--]rank">收藏榜</a>
    </div>
<ul class="book_list" id="novelList">
<? @sys_GetEcmsInfo('comic',10,0,0,18,5,1,'','favnum DESC');?>
</ul>
<a href="javascript:void(0);" class="morebtn" id="loading" onclick="LoadMore()">点击加载更多</a>
</section>
<script type="text/html" id="litemp">
    <li class="clf">
        <a href="{nlink}" class="fl"><img class="lazyload" src="[!--news.url--]skin/images/cover.jpg" data-src="{img}">{age}<p>{up}</p></a>
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
<? @sys_GetAd(1);?> 
<div class="h50"></div>
</main>
<div class="h50"></div>
<nav class="footnav clf">
<a href="<?=$public_r['add_waplink']?>" id="waplink"><span class="m01">首页</span></a>
<a href="<?=$public_r['add_applink']?>" id="applink"><span class="m01">首页</span></a>
<a href="[!--news.url--]cate/" id="cate"><span class="m03">分类</span></a>
<a href="[!--news.url--]top/" id="top"><span class="m02">排行</span></a >
<a href="[!--news.url--]fav/" id="fav"><span class="m05">书架</span></a>
<a href="[!--news.url--]user/" id="user"><span class="m04">我的</span><i></i></a>
</nav>
<script type="text/javascript">
if(navigator.userAgent.indexOf("Html5Plus") > -1){  
   document.writeln("<style>#waplink{display:none;}#applink{display:inline-block;}</style>");
   document.writeln("<link href=\'[!--news.url--]skin/css/html5plus.css?v3=20190507\' rel=\'stylesheet\' type=\'text/css\'>");
}  
</script>
<script src="[!--news.url--]skin/js/jquery.min.js?v2=201904" type="text/javascript"></script>
<script src="[!--news.url--]skin/js/so.js?v2=201904" type="text/javascript"></script>
<script src="[!--news.url--]skin/js/tj.js?v2=201904" type="text/javascript"></script>
<script>$(function(){$.get("[!--news.url--]e/member/login/status.php?in=1",function(a,b){1==a&&$(".footnav #user").addClass("in")})});</script>


<input type="hidden" value="[!--pagekeywords--]" id="order"/>
<script src="[!--news.url--]skin/js/focus.js?v2=201905" type="text/javascript"></script>
<script src="[!--news.url--]skin/js/rank.js?v2=201905" type="text/javascript"></script>
<script>$("#cate,#[!--pagekeywords--]").addClass("selected");</script>
</body>
</html>
<!--code.start-->? } else { 
    Header("Location:/error.php");
}
?<!--code.end-->