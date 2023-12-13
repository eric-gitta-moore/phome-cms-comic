<?php
require('../../e/extend/isMobile.php');
if (isMobile()){
header('Content-Type: application/json;charset=utf-8');
?>
{
  "data": [
    {
      "name": "精选推荐",
      "rtype": 1,
      "isfree": false,
      "linkurl": "/rank/",
      "list": []
    }
  ]
}
<? } else { 
    Header("Location:/error.php");
}
?>