<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>标题</td><td bgcolor=ffffff><input name="title" type="text" id="title" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[title]))?>" size="50">&nbsp;&nbsp;审核：<input name="checked" type="checkbox" value="1"<?=$r[checked]?' checked':''?>>
</td></tr>