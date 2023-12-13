<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>信息提示</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
*{padding:0;margin:0}
a{text-decoration:none}
.notfoud-container .img-ico{width:78px;height:60px;background:url(<?=$public_r[newsurl]?>skin/images/smiley.png) center center no-repeat;margin:40px auto;-webkit-background-size:78px 60px;}
.notfoud-container .notfound-p{line-height:22px;font-size:16px;padding-bottom:15px;border-bottom:1px solid #f6f6f6;text-align:center;color:#555}
.notfoud-container .notfound-btn-container{margin:20px auto 0;}
.notfoud-container .notfound-btn-container a{display:block;color:#999;font-size:12px;text-align:center;padding:10px;}
</style>
<?php
if(!$noautourl)
{
?>
<SCRIPT language=javascript>
var secs=1;//3秒
for(i=1;i<=secs;i++) 
{ window.setTimeout("update(" + i + ")", i * 1000);} 
function update(num) 
{ 
if(num == secs) 
{ <?=$gotourl_js?>; } 
else 
{ } 
}
</SCRIPT>
<?
}
?>
</head>
<body>

    <div class="notfoud-container">
        <div class="img-ico"></div>
        <p class="notfound-p"><?=$error?></p>
        <div class="notfound-btn-container">
            <a href="<?=$gotourl?>">如果您的浏览器没有自动跳转，请点击这里</a>
        </div>
    </div>
	
</body>
</html>
