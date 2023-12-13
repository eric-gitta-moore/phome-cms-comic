<?php
require('../../e/extend/isMobile.php');
if (isMobile()){
header('Content-Type: application/json;charset=utf-8');
?>
{
  "data": [
    {
      "name": "强档推荐",
      "rtype": 2,
      "isfree": false,
      "linkurl": "/top/",
      "list": []
    },{
      "name": "成人污漫",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/cate/?type=62",
      "list": []
    },
	{
      "name": "浪漫爱情",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/cate/?type=61",
      "list": []
    },{
      "name": "激情校园",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/cate/?type=63",
      "list": []
    }, {
      "name": "热门追更",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/hot/",
      "list": []
    },	
    {
      "name": "新番发布",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/new/",
      "list": []
    }
  ]
}
<? } else { 
    Header("Location:/error.php");
}
?>