<?php
define('EmpireCMSAdmin','1');
require("../../e/class/connect.php");
require("../../e/class/db_sql.php");
require("../../e/class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"ad");

$url="<a href=index.php".$ecms_hashur['whehref'].">缓存管理</a>&nbsp;->&nbsp;设置";
require('set.php');
$cachesize='0B';
$cachecount=0;
$cachedircount=0;
$title = '动态页缓存管理';
if(is_dir(CACHE_ROOT)){
    $ar = getDirectorySize(CACHE_ROOT);
    $cachesize = sizeFormat($ar['size']);
    $cachecount = $ar['count'];
    $cachedircount = $ar['dircount'];
}else{
    $title = '<font color="red">缓存存放目录不存在！请确保已设置0777，若不存在请手动建立！</font>';
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css.css" rel="stylesheet" type="text/css">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<br>
<form action="do.php<?=$ecms_hashur['whehref']?>" method="post">
  <table width="100%" border="0" cellpadding="8" cellspacing="1" class="tableborder">
    <tr class="header" align="center">
      <td colspan="3"><?=$title?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存路径:</td>
      <td colspan="2"><?=CACHE_ROOT?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存大小:</td>
      <td colspan="2"><?=$cachesize?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存目录数:</td>
      <td colspan="2"><?=$cachedircount?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存文件数:</td>
      <td colspan="2"><?=$cachecount?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">清空缓存</td>
      <input type="hidden" name="del" value="1">
      <td colspan="2"><input type="submit" name="submit"  value="提交"  border="1"></td>
    </tr>
  </table>
</form>
<?php
db_close(); 
$empire=null;
?>