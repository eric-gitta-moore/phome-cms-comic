<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1>
<tr bgcolor="#ffffee"><td height="40" width='16%'>标题</td><td><input name="title" type="text" id="title" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[title]))?>" size="50">&nbsp;&nbsp;审核：<input name="checked" type="checkbox" value="1"<?=$r[checked]?' checked':''?>>
</td></tr>
<tr bgcolor="#ffffff"><td height="40">缩略图</td><td>
<input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="50">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="选择已上传的图片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr>
<tr bgcolor="#ffffff"><td height="40">阅读收费</td><td><input name="price" type="radio" value="1"<?=$r[price]=="1"||$ecmsfirstpost==1?' checked':''?>>免费<input name="price" type="radio" value="2"<?=$r[price]=="2"?' checked':''?>>收费</td></tr>
<tr bgcolor="#f9f9f9"><td height="40">内容图集</td><td><script>
function dopicadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.morepicnum.value);
for(i=1;i<=document.add.downmorepicnum.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=7%><div align=center>"+j+"</div></td><td width=33%><div align=center><input name=msmallpic[] type=text size=28 id=msmallpic"+j+" ondblclick=SpOpenChFile(1,'msmallpic"+j+"')><br><input type=file name=msmallpfile[] size=15></div></td><td width=30%><div align=center><input name=mbigpic[] type=text size=28 id=mbigpic"+j+" ondblclick=SpOpenChFile(1,'mbigpic"+j+"')><br><input type=file name=mbigpfile[] size=15></div></td><td width=30%><div align=center><input name=mpicname[] type=text></div></td></tr>";
}
document.getElementById("addpicdown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25">
<input type="button" name="Submit" value="选择图片上传 (可多选)" style="background:url(ecmseditor/tranmore/images/but.jpg)no-repeat;border:#eee solid 0px;width:160px;height:45px;display:block;color:#fff;font-weight:bold;margin:10px;" onclick="window.open('ecmseditor/tranmore/tranmore.php?type=1&classid=<?=$classid?>&filepass=<?=$filepass?>&infoid=<?=$id?>&modtype=0&sinfo=1&ecmsdo=ecmstmmorepic&tranfrom=2<?=$ecms_hashur['ehref']?>&oldmorepicnum='+document.add.morepicnum.value,'ecmstmpage','width=500,height=550,scrollbars=yes');">

 </td>
  </tr>
  <tr> 
    <td>
<table width="100%" border=0 align=center cellpadding=3 cellspacing=1>
   <tr bgcolor="#f3f3f3" height="50"> 
    <td width='50px' align='center'>编号</td>
    <td width='50px' align='center'>预览</td>
    <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;图片内容&nbsp;&nbsp;<font color="#666666">(双击文本框可更换图片)</font></td>
  </tr>
</table></td>
  </tr>
  <tr> 
    <td id=defmorepicid>
    <?php
    if(!$ecmsfirstpost==1)
    {
	echo'';
	$morepicpath="";
	$morepicnum=0;
	$r[morepic]=str_replace("\r\n\r\n","\r\n",$r[morepic]);
	if($r[morepic])
    	{
    		$r[morepic]=stripSlashes($r[morepic]);
    		//地址
    		$j=0;
    		$pd_record=explode("\r\n",$r[morepic]);
    		for($i=0;$i<count($pd_record);$i++)
    		{
			$j=$i+1;
    		$pd_field=explode(" ",$pd_record[$i]);
			$morepicpath.="<tr class='tr".$j."'> 
    <td width='50px' align='center'  height='50'>".$j."</td>
    <td width='50px' align='center'><a href='".$pd_field[0]."' target='_blank'><img src='".$pd_field[0]."' width='35' height='30'></a><div style='display:none;'><input name=msmallpic[] type=text value='".$pd_field[0]."' id=msmallpic".$j." ondblclick=\"SpOpenChFile(1,'msmallpic".$j."');\"></div></td>
    <td><input name=mbigpic[] type=text value='".$pd_field[0]."' size=80 id=mbigpic".$j." ondblclick=\"SpOpenChFile(1,'mbigpic".$j."');\"> <div style='display:none;'><input type=file name=mbigpfile[] size=15><input name=mpicname[] type=text value='".$pd_field[1]."'></div><input type=hidden name=mpicid[] value=".$j."><input type=checkbox name=mdelpicid[] value=".$j.">删</td>
  </tr>";
    		}
    		$morepicnum=$j;
    		$morepicpath="<table width='100%' border=0 align=center cellspacing=1 cellpadding=3  class='trpic'>".$morepicpath."</table>";
    	}
	echo $morepicpath;
    }
    ?>
    </td>
  </tr>
  <tr style="display:none;"> 
    <td height="25">地址扩展数量: <input name="morepicnum" type="hidden" id="morepicnum" value="<?=$morepicnum?>">
      <input name="downmorepicnum" type="text" value="1" size="6"> <input type="button" name="Submit5" value="输出地址" onclick="javascript:dopicadd();"></td>
  </tr>
  <tr> 
    <td id=addpicdown></td>
  </tr>
</table>
<style>.tr1,.tr3,.tr5,.tr7,.tr9,.tr11,.tr13,.tr15,.tr17,.tr19,.tr21,.tr23,.tr25,.tr27,.tr29,.tr31,.tr33,.tr35,.tr37,.tr39,.tr41,.tr43,.tr45,.tr47,.tr49,.tr51,.tr53,.tr55,.tr57,.tr59{background:#f8f8f8;}.trpic tr:hover {background:#ffe;}</style>
</td></tr>
<tr bgcolor="#ffffff"><td height="40">发布时间</td><td>
<input name="newstime" type="text" value="<?=$r[newstime]?>" size="28" class="Wdate" onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd HH:mm:ss'})"><input type=button name=button value="设为当前时间" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr>
</table>
