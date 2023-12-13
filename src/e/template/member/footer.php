<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<script type="text/javascript">
if(navigator.userAgent.indexOf("Html5Plus") > -1){  
   document.writeln("<style>#waplink{display:none;}#applink{display:inline-block;}</style>");
   document.writeln("<link href=\'<?=$public_r['newsurl']?>skin/css/html5plus.css?v3=20190507\' rel=\'stylesheet\' type=\'text/css\'>");
}  
</script>
<script type="text/javascript" src="<?=$public_r['newsurl']?>skin/js/tj.js?v2=201905"></script>
<div class="h50"></div>
<nav class="footnav clf">
<a href="<?=$public_r['add_waplink']?>" id="waplink"><span class="m01">首页</span></a>
<a href="<?=$public_r['add_applink']?>" id="applink"><span class="m01">首页</span></a>
<a href="<?=$public_r['newsurl']?>cate/"><span class="m03">分类</span></a>
<a href="<?=$public_r['newsurl']?>top/"><span class="m02">排行</span></a >
<a href="<?=$public_r['newsurl']?>fav/"><span class="m05">书架</span></a>
<a href="<?=$public_r['newsurl']?>user/" id="user" class="selected in"><span class="m04">我的</span></a>
</nav>
</body>
</html>