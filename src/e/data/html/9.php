<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1>
<tr bgcolor="#ffffee"><td height="40" width='16%'>特殊属性</td><td>审核：<input name="checked" type="checkbox" value="1"<?=$r[checked]?' checked':''?>>&nbsp;&nbsp; 
推荐：<select name="isgood" id="isgood"><option value="0">不推荐</option><?=$ftnr['igname']?></select>&nbsp;&nbsp; 
头条：<select name="firsttitle" id="firsttitle"><option value="0">非头条</option><?=$ftnr['ftname']?></select></td></tr>
<tr bgcolor="#ffffff"><td height="40">漫画名称</td><td>
<input name="title" type="text" id="title" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[title]))?>" size="27">
&nbsp;&nbsp;作品ID：
<input name="zpid" type="text" id="zpid" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[zpid]))?>" size="6">
&nbsp;&nbsp;<font color="#ff6666">(用于关联章节)</font></td></tr>
<tr bgcolor="#f9f9f9"><td height="40">内容简介</td><td>
<textarea name="smalltext" cols="52" rows="5" id="smalltext"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>
</td></tr>
<tr bgcolor="#ffffff"><td height="40">缩略图</td><td><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="50">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="选择已上传的图片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
&nbsp;&nbsp;<font color="#666666">(270*360)</font></td></tr>
<tr bgcolor="#f9f9f9"><td height="40">焦点图</td><td>
<input name="titleimg" type="text" id="titleimg" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titleimg]))?>" size="50">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titleimg<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="选择已上传的图片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
&nbsp;&nbsp;<font color="#666666">(750*480)</font></td></tr>
<tr bgcolor="#ffffff"><td height="40">背景图</td><td>
<input name="back" type="text" id="back" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[back]))?>" size="50">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=back<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="选择已上传的图片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr>
<tr bgcolor="#f9f9f9"><td height="40">封面图</td><td>
<input name="cover" type="text" id="cover" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[cover]))?>" size="50">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=cover<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="选择已上传的图片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr>
<tr bgcolor="#ffffff"><td height="40">题材</td><td><input name="ticai[]" type="checkbox" value="61"<?=strstr($r[ticai],"|61|")?' checked':''?>>剧情<input name="ticai[]" type="checkbox" value="62"<?=strstr($r[ticai],"|62|")?' checked':''?>>浪漫爱情<input name="ticai[]" type="checkbox" value="63"<?=strstr($r[ticai],"|63|")?' checked':''?>>校园<input name="ticai[]" type="checkbox" value="64"<?=strstr($r[ticai],"|64|")?' checked':''?>>奇幻冒险<input name="ticai[]" type="checkbox" value="65"<?=strstr($r[ticai],"|65|")?' checked':''?>>恐怖<input name="ticai[]" type="checkbox" value="66"<?=strstr($r[ticai],"|66|")?' checked':''?>>惊悚<input name="ticai[]" type="checkbox" value="67"<?=strstr($r[ticai],"|67|")?' checked':''?>>BL/同性<input name="ticai[]" type="checkbox" value="68"<?=strstr($r[ticai],"|68|")?' checked':''?>>幽默搞笑<input name="ticai[]" type="checkbox" value="69"<?=strstr($r[ticai],"|69|")?' checked':''?>>动作<input name="ticai[]" type="checkbox" value="70"<?=strstr($r[ticai],"|70|")?' checked':''?>>科幻<input name="ticai[]" type="checkbox" value="71"<?=strstr($r[ticai],"|71|")?' checked':''?>>古风穿越<input name="ticai[]" type="checkbox" value="72"<?=strstr($r[ticai],"|72|")?' checked':''?>>其他</td></tr>
<tr bgcolor="#f9f9f9"><td height="40">读者群</td><td><input name="age" type="radio" value="18"<?=$r[age]=="18"||$ecmsfirstpost==1?' checked':''?>>成年18+<input name="age" type="radio" value="17"<?=$r[age]=="17"?' checked':''?>>青少年</td></tr>
<tr bgcolor="#ffffff"><td height="40">更新周期</td><td><input name="up" type="radio" value="1"<?=$r[up]=="1"?' checked':''?>>周一<input name="up" type="radio" value="2"<?=$r[up]=="2"?' checked':''?>>周二<input name="up" type="radio" value="3"<?=$r[up]=="3"?' checked':''?>>周三<input name="up" type="radio" value="4"<?=$r[up]=="4"?' checked':''?>>周四<input name="up" type="radio" value="5"<?=$r[up]=="5"?' checked':''?>>周五<input name="up" type="radio" value="6"<?=$r[up]=="6"?' checked':''?>>周六<input name="up" type="radio" value="7"<?=$r[up]=="7"?' checked':''?>>周日<input name="up" type="radio" value="8"<?=$r[up]=="8"||$ecmsfirstpost==1?' checked':''?>>不定时<input name="up" type="radio" value="9"<?=$r[up]=="9"?' checked':''?>>停更</td></tr>
<tr bgcolor="#f9f9f9"><td height="40">进度</td><td><input name="jindu" type="radio" value="1"<?=$r[jindu]=="1"||$ecmsfirstpost==1?' checked':''?>>连载<input name="jindu" type="radio" value="2"<?=$r[jindu]=="2"?' checked':''?>>完结</td></tr>
<tr bgcolor="#ffffff"><td height="40">关键字</td><td><input name="keyboard" type="text" size="50" value="<?=stripslashes($r[keyboard])?>"></td></tr>
<tr bgcolor="#f9f9f9"><td height="40"></td><td><a href="javascript:;" id="expand">展开其他参数 &darr;</a></td></tr>
</table>
<table width=100% align=center cellpadding=3 cellspacing=1 style="display:none;" id="other">
<tr bgcolor="#ffffff"><td height="40">收藏量</td><td>
<input name="favnum" type="text" id="favnum" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[favnum]))?>" size="">
</td></tr>
<tr bgcolor="#f9f9f9"><td height="40">点赞量</td><td>
<input name="diggtop" type="text" id="diggtop" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[diggtop]))?>" size="">
</td></tr>
<tr bgcolor="#ffffff"><td height="40" width='16%'>漫画作者</td><td><input type=text name=writer value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[writer]))?>" size="20"> </td></tr>
<tr bgcolor="#f9f9f9"><td height="40">发布时间</td><td><input name="newstime" type="text" value="<?=$r[newstime]?>" size="20" class="Wdate" onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd HH:mm:ss'})"><input type=button name=button value="设为当前时间" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr>
<tr bgcolor="#ffffff"><td height="40">新章时间</td><td><?php $hr=$empire->fetch1("select lastdotime from {$dbtbpre}ecms_chapter where zpid='$r[zpid]' order by newstime desc limit 1");?>
<input name="lastdotime" type="text" id="lastdotime" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes(date('Y-m-d H:i:s',$hr[lastdotime])))?>" size="20"  disabled="disabled"></td></tr>
<tr bgcolor="#f9f9f9"><td height="40">原文网址</td><td><input type="text" name="befrom" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[befrom]))?>" size="50"> </td></tr>
<tr bgcolor="#ffffff"><td height="40">外部链接</td><td><input name="titleurl" type="text" value="<?=stripslashes($r[titleurl])?>" size="50"></td></tr>
</table>
<script type="text/javascript"> 
$(document).ready(function(){
$("#expand").click(function(){
    $("#other").fadeToggle();
  });
});
</script>