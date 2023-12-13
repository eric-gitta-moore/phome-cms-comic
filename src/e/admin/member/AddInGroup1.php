<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//验证用户
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//验证权限
CheckLevel($logininid,$loginin,$classid,"ingroup");
$enews=ehtmlspecialchars($_GET['enews']);
$postword='增加';
$url="<a href='ListInGroup1.php".$ecms_hashur['whehref']."'>管理来自渠道</a>&nbsp;->&nbsp;增加来自渠道";
if($enews=="EditInGroup")
{
	$gid=(int)$_GET['gid'];
	$postword='修改';
      $r=$empire->fetch1("select * from {$dbtbpre}enewsingroup1 where gid='$gid'");
//	$url="<a href='ListInGroup1.php".$ecms_hashur['whehref']."'>管理来自渠道</a>&nbsp;->&nbsp;修改来自渠道：<b>".$r[gname]."</b>";
	$url="<a href='ListInGroup1.php".$ecms_hashur['whehref']."'>管理来自渠道</a>&nbsp;->&nbsp;修改来自渠道：<b></b>";
}
//----------渠道
$ingroup = '';
$inmsql = $empire->query("select * from {$dbtbpre}enewsingroup order by myorder");
while ($inm_r = $empire->fetch($inmsql)) {
    if ($_GET['fromadd'] == $inm_r['gname']) {
        $select = " selected";
    } else {
        $select = "";
    }
    $ingroup .= "<option value='" . $inm_r['gname'] ."'" . $select . ">" . $inm_r['gname'] . "</option>";
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>来自渠道</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListInGroup1.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="21%" height="25"><?=$postword?>渠道提現</td>
      <td width="79%" height="25"><input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="gid" type="hidden" id="gid" value="<?=$gid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">支付宝/银行卡</td>
      <td height="25"> <input name="gname" type="text" id="gname" value="<?=$r[gname]?>" size="30">      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">姓名</td>
      <td height="25"> <input name="number" type="text" id="number" value="<?=$r[number]?>" size="30">      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">金额</td>
      <td height="25"> <input name="kou" type="text" id="kou" value="<?=$r[kou]?>" size="30">      </td>
    </tr>

    <?php if($loginlevel == 1){   ?>
    <tr bgcolor="#FFFFFF">
      <td height="25">审核</td>
      <td height="25"> <input name="money" type="radio" id="money" value="0"<?=$r[money]==0?' checked':''?>>通过
        <input name="money" type="radio" id="money" value="1"<?=$r[money]==0?' checked':''?>>拒绝</td>
    </tr>
    <?php   }  ?>
      <?php if($loginlevel == 1){   ?>
          <tr bgcolor="#FFFFFF">
              <td height="25">渠道</td>
              <td height="25">
<!--                  <input name="kou" type="text" id="kou" value="--><?//=$r[fromadd]?><!--" size="30">-->
                  <select name="fromadd" id="fromadd">
                      <?= $ingroup ?>
                  </select>

              </td>
          </tr>
      <?php   }  ?>

<!--    <tr bgcolor="#FFFFFF"> -->
<!--      <td height="25">显示排序</td>-->
<!--      <td height="25"> <input name="myorder" type="text" id="myorder" value="--><?//=$r[myorder]?><!--" size="30">        <font color="#666666">(值越小越前面)</font></td>-->
<!--    </tr>-->
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
