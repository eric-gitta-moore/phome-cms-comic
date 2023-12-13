<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require ''.LoadLang("pub/fun.php");
require("../class/t_functions.php");
require("../data/dbcache/class.php");
require("../data/dbcache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
@set_time_limit(0);
//定时刷新任务
function user_DoTimeRepage(){
	global $empire,$dbtbpre;
	//user_DoAutoUpAndDownInfo();//自动上/下线
	$todaytime=time();
	$b=0;
	$sql=$empire->query("select doing,classid,doid from {$dbtbpre}enewsdo where isopen=1 and lasttime+dotime*60<$todaytime");
	while($r=$empire->fetch($sql))
	{
		$b=1;
		if($r[doing]==1)//生成栏目
		{
			$cr=explode(',',$r[classid]);
			$count=count($cr)-1;
			for($i=1;$i<$count;$i++)
			{
				if(empty($cr[$i]))
				{
					continue;
				}
				$cr[$i]=(int)$cr[$i];
				ReListHtml($cr[$i],1);
			}
	    }
		elseif($r[doing]==2)//生成专题
		{
			$cr=explode(',',$r[classid]);
			$count=count($cr)-1;
			for($i=1;$i<$count;$i++)
			{
				if(empty($cr[$i]))
				{
					continue;
				}
				$cr[$i]=(int)$cr[$i];
				ListHtmlIndex($cr[$i],$ret_r[0],0);
			}
	    }
		elseif($r[doing]==3)//生成自定义列表
		{
			$cr=explode(',',$r[classid]);
			$count=count($cr)-1;
			for($i=1;$i<$count;$i++)
			{
				if(empty($cr[$i]))
				{
					continue;
				}
				$cr[$i]=(int)$cr[$i];
				$ur=$empire->fetch1("select listid,pagetitle,filepath,filetype,totalsql,listsql,maxnum,lencord,listtempid,pagekeywords,pagedescription from {$dbtbpre}enewsuserlist where listid='".$cr[$i]."'");
				ReUserlist($ur,"");
			}
	    }
		elseif($r[doing]==4)//生成自定义页面
		{
			$cr=explode(',',$r[classid]);
			$count=count($cr)-1;
			for($i=1;$i<$count;$i++)
			{
				if(empty($cr[$i]))
				{
					continue;
				}
				$cr[$i]=(int)$cr[$i];
				$ur=$empire->fetch1("select id,path,pagetext,title,pagetitle,pagekeywords,pagedescription,tempid from {$dbtbpre}enewspage where id='".$cr[$i]."'");
				ReUserpage($ur[id],$ur[pagetext],$ur[path],$ur[title],$ur[pagetitle],$ur[pagekeywords],$ur[pagedescription],$ur[tempid]);
			}
	    }
		elseif($r[doing]==5)//生成自定义JS
		{
			$cr=explode(',',$r[classid]);
			$count=count($cr)-1;
			for($i=1;$i<$count;$i++)
			{
				if(empty($cr[$i]))
				{
					continue;
				}
				$cr[$i]=(int)$cr[$i];
				$ur=$empire->fetch1("select jsid,jsname,jssql,jstempid,jsfilename from {$dbtbpre}enewsuserjs where jsid='".$cr[$i]."'");
				ReUserjs($ur,'');
			}
	    }
		elseif($r[doing]==6)//生成标题分类页面
		{
			$cr=explode(',',$r[classid]);
			$count=count($cr)-1;
			for($i=1;$i<$count;$i++)
			{
				if(empty($cr[$i]))
				{
					continue;
				}
				$cr[$i]=(int)$cr[$i];
				ListHtml($cr[$i],$ret_r,5);
			}
	    }
		else//生成首页
		{
			$indextemp=GetIndextemp();
			NewsBq($classid,$indextemp,1,0);
	    }
		$empire->query("update {$dbtbpre}enewsdo set lasttime=$todaytime where doid='$r[doid]'");
    }
	if($b)
	{
		//echo "最后执行时间：".date("Y-m-d H:i:s",$todaytime)."<br><br>";
	}
}
user_DoTimeRepage();//自动刷新页面
db_close();
$empire=null;