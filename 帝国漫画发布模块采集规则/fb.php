<?php

/********密码验证***********/
$password='hacker888';	//这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if($password!=$_GET['pw']) exit('验证密码错误');   //安全检测,密码不符则退出

/****以下代码非专业人员不建议修改***************/
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
require("../class/delpath.php");
require("../class/copypath.php");
require("../class/t_functions.php");
require("../data/dbcache/class.php");
require("../data/dbcache/MemberLevel.php");

//获取分类列表
foreach($class_r as $kv)
{
	if($kv['modid']=='1' && empty($kv['sonclass']))//这个是分类所在的系统模型id，记得修改
	{
		$cates[]=array('cname'=>$kv['classname'],'cid'=>$kv['classid'],'pid'=>$kv['bclassid'],'tbname'=>$kv['tbname']);
	}
}

if(empty($_POST))
{
	//这里刷新列表
	echo "<select name='list'>";
	//echo maketree($cates,0,'');
	foreach($cates as $item)
	{
		echo("<option value='".$item[cid]."'>".$item[cname]."</option>");
	}
	echo '</select>';
	exit();
}

$link=db_connect();
$empire=new mysqlquery();

//验证用户
$loginin=$_POST['username'];
$lur=$empire->fetch1("select * from {$dbtbpre}enewsuser where `username`='$loginin'");
if(!$lur) exit('不存在的用户名'.$loginin);

$logininid=$lur['userid'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];

$incftp=0;
if($public_r['phpmode'])
{
	include("../class/ftp.php");
	$incftp=1;
}
require("../class/hinfofun.php");

$enews=$_POST['enews'];
if(empty($enews))
{
	$enews=$_GET['enews'];
}
if($enews=="AddNews")//增加信息
{
	$_POST[newstime] = fmtDate($_POST[newstime]);
	if(!isDateTime($_POST[newstime]))
		$_POST[newstime] = strtotime();
	foreach($_POST as $k=>$v)
	{
		if(strstr($_POST[$k],"[db"))
		{
			$_POST[$k] = "";
		}
	}		
	$navtheid=(int)$_POST['filepass'];	
	AddNews($_POST,$logininid,$loginin);
}


db_close();
$empire=null;

function isDateTime($dateTime){
    $ret = strtotime($dateTime);
    return $ret !== FALSE && $ret != -1;
}


function fmtDate($PostTime)
{
	if(strstr($PostTime,"年"))
	{
		$PostTime = str_replace("年", "-", $PostTime);
		$PostTime = str_replace("月", "-", $PostTime);
		$PostTime = str_replace("日", "", $PostTime);
		$PostTime = str_replace("时", ":", $PostTime);
		$PostTime = str_replace("分", ":", $PostTime);
		$PostTime = str_replace("秒", "", $PostTime);
		$PostTime = str_replace("年", "-", $PostTime);
	}
	return $PostTime;
}

/***生成目录的一个遍历算法***/
function maketree($ar,$id,$pre)
{
	$ids='';
	foreach($ar as $k=>$v){
		$pid=$v['pid'];
		$cname=$v['cname'];
		$cid=$v['cid'];
		if($pid==$id)
		{
			$ids.="<option value='$cid'>{$pre}{$cname}</option>";
			foreach($ar as $kk=>$vv)
			{
				$pp=$vv['pid'];
				if($pp==$cid)
				{ 
					$ids.=maketree($ar,$cid,$pre."&nbsp;&nbsp;");
					break;
				}
			}
		}
	}
	return $ids;
}
?>
