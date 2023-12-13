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
      "name": "强档推荐",
      "rtype": 2,
      "isfree": false,
      "linkurl": "/top/",
      "list": [<? @sys_GetEcmsInfo('comic',4,0,0,18,4,1,"isgood=1 and age=18","diggtop DESC");?>]
    },{
      "name": "成人污漫",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/cate/?type=62",
      "list": [<? @sys_GetEcmsInfo("comic",9,0,0,18,4,1,"ticai='|62|' and age=18","lastdotime DESC");?>]
    },
	{
      "name": "浪漫爱情",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/cate/?type=61",
      "list": [<? @sys_GetEcmsInfo("comic",9,0,0,18,4,1,"ticai='|61|' and age=18","lastdotime DESC");?>]
    },{
      "name": "激情校园",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/cate/?type=63",
      "list": [<? @sys_GetEcmsInfo("comic",6,0,0,18,4,1,"ticai like '%|63|%' and age=18","lastdotime DESC");?>]
    }, {
      "name": "热门追更",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/hot/",
      "list": [<? @sys_GetEcmsInfo("comic",6,0,0,18,4,1,"age=18","favnum DESC");?>]
    },	
    {
      "name": "新番发布",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/new/",
      "list": [<? @sys_GetEcmsInfo("comic",3,0,0,18,4,1,"age=18","id DESC");?>]
    }
  ]
}
<!--code.start-->? } else { 
    Header("Location:/error.php");
}
?<!--code.end-->