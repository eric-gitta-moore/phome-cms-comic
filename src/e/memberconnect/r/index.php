<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
$line=30;//每页显示条数
$page_line=5;//每页显示链接数
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$offset=$page*$line;//总偏移量
$query="select * from {$dbtbpre}enewsbuybak";
$totalquery="select count(*) as total from {$dbtbpre}enewsbuybak";
//搜索
$search='';
$search.=$ecms_hashur['ehref'];
$where='';
if($_GET['sear']==1)
{
	$search.="&sear=1";
	$a='';
	$startday=RepPostVar($_GET['startday']);
	$endday=RepPostVar($_GET['endday']);
	if($startday&&$endday)
	{
		$search.="&startday=$startday&endday=$endday";
		$a.="buytime<='".$endday." 23:59:59' and buytime>='".$startday." 00:00:00'";
	}
	$keyboard=RepPostVar($_GET['keyboard']);
	if($keyboard)
	{
		$and=$a?' and ':'';
		$show=RepPostStr($_GET['show'],1);
		if($show==1)
		{
			$a.=$and."username like '%$keyboard%'";
		}
		elseif($show==2)
		{
			$a.=$and."userid like '%$keyboard%'";
		}
		elseif($show==3)
		{
			$a.=$and."money like '%$keyboard%'";
		}
		else
		{
			$a.=$and."card_no like '%$keyboard%'";
		}
		$search.="&keyboard=$keyboard&show=$show";
	}
	if($a)
	{
		$where.=" where ".$a;
	}
	$query.=$where;
	$totalquery.=$where;
}else{
$startday=date("Y-m-d");
$endday=date("Y-m-d");
}
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$mt=$empire->fetch1("select sum(money) as 'ScrTotal' from {$dbtbpre}enewsbuybak $where");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta name="renderer" content="webkit">
<title>WMB</title>
<script type="text/javascript" src="jstime/WdatePicker.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
</head>
 <body>
<style type="text/css">
{margin:0;padding:0}
li,ul{list-style:none}
img,input{border:0}
a{text-decoration:none}
body{font-family:微软雅黑,microsoft yahei,Arial,Helvetica,sans-serif,宋体;font-size:14px;color:#515151}
body input,body textarea{font-family:微软雅黑,microsoft yahei,Arial,Helvetica,sans-serif,宋体;background:#fff;outline:0}
.listbox {width:960px;margin:20px auto;padding:0px;}
.listbox h1{width:100%;margin:0px auto 20px;text-align:center;}
.top{height:35px;position: relative;width: 100%;}
.top .info{float:left;line-height:35px;}
.top .info b{color:#f60;}
.top .search{float:right;text-align:right;}
.top .search .input,.top .search .select{border: #999 1px solid;height: 22px;}
.top .search .select{height: 24px;}
.top .search .submit{background:#2683F5;margin-left:10px;padding:3px 10px;color:#fff;cursor:pointer;}
.top .search .submit:hover{background:#3FA9FB;}
.table {width: 100%;border-collapse: collapse;border-spacing: 0;empty-cells: show;margin-top:20px}
.table thead th, .table thead td, .table tfoot th, .table tfoot td {padding: 10px;}
.table tbody th, .table tbody td {padding: 10px;}
.table tbody tr:hover td{background:#ffe;color:#f60}
.table th, .table thead td, .table tfoot td {background: #ddd;font-weight: 700;}
.table tr.even td {background: #f6f6f6;}
.table tr td, .table th {text-align:center;border: 1px solid #ddd;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
.table tr td {background: #fff;color:#555;font-size: 12px;}
.table tr td a{color:#555;}
.table tr td a:hover{color:#f00}
.table tr td.f14{font-size: 14px;}
.table tr td.f16{font-size: 16px;}
.table tr td.day{color:#f00;}
.bottom{width:100%;display:block;padding:0px;margin:20px auto 100px;text-align:center;}
.bottom a,.bottom b{font-size:12px;color:#777;max-width:50px;min-width:16px;height:20px;line-height:20px;text-align:center;background:#fff;border:1px solid #e7e7e7;display:inline-block;padding:2px 6px;margin:0px 3px;}
.bottom a:hover,.bottom b{background:#3FB118;color:#fff;border:1px solid #3FB118;text-decoration:none;}
.bottom a b{background:#fff;border:0px;color:#777;padding:0px;margin:0px;}
.bottom a:hover b{background:#3FB118;color:#fff;}
.bottom a.nexton,.bottom a.prevon,.bottom a:hover.nexton,.bottom a:hover.prevon{padding:0px 5px;background:#eee;color:#999;border:1px solid #e7e7e7;}
</style>
  <div class="listbox"> 
    <h1>收款记录</h1>
    <div class="top">
        <div class="info">
		总额：<b>￥<?=$mt[ScrTotal]?></b> 元 ，订单：<?=$num?></div> 
		<div class="search">
	 <form name=searchlogform method=get action='index.php'>
    时间从 
          <input name="startday" type="text" value="<?=$startday?>" size="15" class="Wdate" onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd'})">
          到 
          <input name="endday" type="text" value="<?=$endday?>" size="15" class="Wdate" onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd'})">
          ，关键字： 
          <input class="input" name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show" id="show"  class="select">
		    <option value="2"<?=$show==2?' selected':''?>>会员ID</option>
		    <option value="1"<?=$show==1?' selected':''?>>会员名称</option>
			<option value="3"<?=$show==3?' selected':''?>>支付金额</option>
            <option value="0"<?=$show==0?' selected':''?>>订单号</option>
          </select>
          <input class="submit" name=submit1 type=submit id="submit12" value=搜索>
          <input name="sear" type="hidden" id="sear" value="1">       
  </form>
		</div>
   </div>
   <table class="table"> 
    <thead>
     <tr> 
      <th width="16%">会员名</th>
      <th width="15%">付款金额</th>
      <th width="20%">支付时间</th>
	  <th width="8%">+天数</th>
      <th width="8%">+积分</th>
	  <th width="25%">订单号</th>
	  <th width="8%">付款</th>
     </tr>
    </thead> 
    <tbody>
    <?php 
	$i=0;
	while($r=$empire->fetch($sql)){
if($r[type]==1){
		$paytype="个人微信";
	}elseif($r[type]==2){
		$paytype="个人支付宝";
	}elseif($r[type]==901){
		$paytype="微信H5";
	}elseif($r[type]==902){
		$paytype="微信扫码";
	}elseif($r[type]==903){
		$paytype="支付宝扫码";
	}elseif($r[type]==904){
		$paytype="支付宝H5";
	}else{
		$paytype="";
	}
	if($i%2==0){
		$skin="odd";
	}else{
		$skin="even";
	}
	$buytime=esub($r[buytime],10);
	if(strtotime($buytime)==strtotime(date("Y-m-d"))){
		$color=" day";
	}else{
		$color="";
	}
    ?>
    <tr class="<?=$skin?>"> 
      <td><?=$r[username]?></td>
      <td class="f16 <?=$color?>">￥<?=$r[money]?></td>
      <td><?=$r[buytime]?></td>
      <td class="f14"><?=$r[userdate]?></td>
	  <td class="f14"><?=$r[cardfen]?></td>
	  <td><?=$r[card_no]?></td>
	  <td><?=$paytype?></td>
    </tr>
    <? $i++; }?>
    </tbody> 
   </table>
   <div class="bottom">
     <?=$returnpage?>
   </div>
  </div>
<?
db_close();
$empire=null;
?>
</body>
</html>