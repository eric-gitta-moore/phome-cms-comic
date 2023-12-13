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
      "name": "精选推荐",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/rank/",
      "list": [<? @sys_GetEcmsInfo("comic",6,0,0,18,4,1,"","favnum DESC");?>]
    }
  ]
}
<!--code.start-->? } else { 
    Header("Location:/error.php");
}
?<!--code.end-->