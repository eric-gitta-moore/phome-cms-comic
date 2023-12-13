<?php
require('../../e/extend/isMobile.php');
if (isMobile()){
header('Content-Type: application/json;charset=utf-8');
?>
{
  "data": [
    {
      "list": []
    }
  ]
}
<? } else { 
    Header("Location:/error.php");
}
?>