<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>漫画名称</td><td bgcolor=ffffff>
<input name="title" type="text" id="title" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[title]))?>" size="27">
</td></tr>