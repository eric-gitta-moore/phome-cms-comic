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
db_close(); 
$empire=null;
require('set.php');
$cachetotal=0;
if($_POST['del']==1 && is_dir(CACHE_ROOT)){
    unlinkDir(CACHE_ROOT);
    $ar = getDirectorySize(CACHE_ROOT);
    if($ar['count']==0){
        ShowMsg('缓存已全部删除','index.php'.$ecms_hashur['whehref'].'',0,5000);exit;
    }else{
        ShowMsg('删除失败','index.php'.$ecms_hashur['whehref'].'',0,5000);exit;
    }
}
?>

