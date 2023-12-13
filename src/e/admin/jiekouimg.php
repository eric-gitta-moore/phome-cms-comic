<?php
ini_set("display_errors", "On");
error_reporting(E_ERROR | E_PARSE);

/********密码验证***********/
$password='akcakadldjad133';				                   //这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
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

//print_r($class_r);
//获取分类列表
foreach($class_r as $kv)
{
	if($kv['modid']=='9')
	{
		$cates[]=array('cname'=>$kv['classname'],'cid'=>$kv['classid'],'pid'=>$kv['bclassid']);
	}
}
//print_r($cates);
if(empty($_POST))
{
	//这里刷新列表
	echo "<select name='list'>";
	echo "<option value=\"0\">请选择分类栏目</option>";
	echo maketree($cates,0,'');
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
$navtheid=(int)$_POST['filepass'];
/*
&msmallpic[]=/images/nosmallpic.gif&msmallpfile[]=&mbigpic[]=[参数1]&mbigpfile[]=&mpicname[]=
*/
//数据格式化

/*漫画判断是否存在*/
$title = $_POST['title'];
$zpid = trim($_POST['zpid']);
$writer = trim($_POST['writer']);
if ($writer != "" && $zpid != ""){
	$mhname = $empire->fetch1("select id from {$dbtbpre}ecms_comic where title = '$title' and zpid = '$zpid' limit 1");
}else{
	$mhname = $empire->fetch1("select id from {$dbtbpre}ecms_chapter where title = '$title' and zpid = '$zpid' limit 1");
}
print_r ($mhname);
$mhid = $mhname['id'];
if ($mhid){

	printerror2("漫画存在，增加信息成功！","history.go(-1)");
}
/*漫画判断是否存在结束*/
$titlepic = $_POST['titlepic'];
$titlepic = stripslashes($titlepic) ;
$titlepic = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","$1",$titlepic); 
$_POST['titlepic'] = $titlepic;
$pics = ebotxs($_POST['pics']);
$pics = stripslashes($pics) ;
//$pics = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","$1",$pics);
$imgarray=explode('|||',$pics);
$imgarray = array_flip(array_flip($imgarray));
foreach($imgarray as $value){
	if(!$value){continue;}
	$pic = $value;
	$newpics = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","$1",$pic);
	$_POST['mpicname'][] = GetUserFromBody($pic);
	$_POST['mbigpic'][] = $newpics;
	$_POST['msmallpic'][] = $newpics;
}
AddNews($_POST,$logininid,$loginin);
db_close();
$empire=null;

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
//自定义获取参数
    function GetUserFromBody( $message )
		{
			preg_match( "@alt=\"(.*?)\"@is", $message, $attrname );
			return trim( $attrname[1] );
		}

	function ebotxs($message){
		$attr_b=explode("|||",$message);
		$attr_a=count($attr_b);

		for($i=0;$i<$attr_a;$i++){
			if($attr_b[$i]){
				$attr_c[$i]=$attr_b[$i];
			} 
		}
		$attr_d=implode('|||',$attr_c);
		return $attr_d;
	}

?>