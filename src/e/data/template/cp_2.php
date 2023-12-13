<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?></td>
        </tr>
      </table></td>
</tr>
</table>
<div class="h50"></div>
<nav class="footnav clf">
<a href="<?=$public_r['add_waplink']?>" id="waplink"><span class="m01">首页</span></a>
<a href="<?=$public_r['add_applink']?>" id="applink"><span class="m01">首页</span></a>
<a href="/cate/" id="cate"><span class="m03">分类</span></a>
<a href="/fav/" id="fav"><span class="m05">书架</span></a>
<a href="/user/" id="user"><span class="m04">我的</span><i></i></a>
</nav>
<script type="text/javascript">
if(navigator.userAgent.indexOf("Html5Plus") > -1){  
   document.writeln("<style>#waplink{display:none;}#applink{display:inline-block;}</style>");
   document.writeln("<link href=\'/skin/css/html5plus.css?v3=20190507\' rel=\'stylesheet\' type=\'text/css\'>");
}  
</script>
<script src="/skin/js/jquery.min.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/so.js?v2=201904" type="text/javascript"></script>
<script src="/skin/js/tj.js?v2=201904" type="text/javascript"></script>
<script>$(function(){$.get("/e/member/login/status.php?in=1",function(a,b){1==a&&$(".footnav #user").addClass("in")})});</script>


</body>
</html>