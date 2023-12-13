<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!--code.start-->?php
require('../../e/extend/isMobile.php');
if (isMobile()){
header('Content-Type: application/json;charset=utf-8');
?<!--code.end-->
{
  "data": [
    {
      "list": [<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('comic',10,18,0,'isgood=1 or firsttitle=1','onclick DESC');
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?><?if($bqno==1){} else { echo ',';}?>{"Title": "<?=$bqr['title']?>：<?=$bqr['smalltext']?>","LinkUrl": "<?=$bqsr['titleurl']?>"}<?php
}
}
?>]
    }
  ]
}
<!--code.start-->? } else { 
    Header("Location:/error.php");
}
?<!--code.end-->