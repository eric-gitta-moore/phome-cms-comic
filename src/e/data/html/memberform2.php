<?php
if(!defined('InEmpireCMS'))
{exit();}
?><table width='100%' align='center' cellpadding=3 cellspacing=1 bgcolor='#DBEAF5'><tr><td width='16%' height=25 bgcolor='ffffff'>初始密码</td><td bgcolor='ffffff'>
<input name="startpass" type="text" id="startpass" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[startpass]))?>" size="20">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>联系人</td><td bgcolor='ffffff'><input name="truename" type="text" id="truename" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[truename]))?>">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>手机</td><td bgcolor='ffffff'><input name="phone" type="text" id="phone" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[phone]))?>">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>QQ号码</td><td bgcolor='ffffff'><input name="oicq" type="text" id="oicq" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[oicq]))?>">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>会员头像</td><td bgcolor='ffffff'><input type="file" name="userpicfile">&nbsp;&nbsp;
<?=empty($addr[userpic])?"":"<img src='".ehtmlspecialchars(stripSlashes($addr[userpic]))."' border=0>"?></td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>公司介绍</td><td bgcolor='ffffff'><textarea name="saytext" cols="65" rows="10" id="saytext"><?=$ecmsfirstpost==1?"":stripSlashes($addr[saytext])?></textarea>
</td></tr></table>