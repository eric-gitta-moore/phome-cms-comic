<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><?php
require('../../e/extend/isMobile.php');
if (isMobile()){
?>
{"code": 0,"data": [[!--empirenews.listtemp--]<!--list.var1-->[!--empirenews.listtemp--]]}
<? } else { 
    Header("Location:/error.php");
}
?>