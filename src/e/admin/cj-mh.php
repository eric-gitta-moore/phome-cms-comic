<?php
$password = 'NU8uRGvZ4Imm7i2PPDic';
if ($password != $_GET['pw']) {
    exit('验证密码错误');
}
/****以下代码非专业人员不建议修改***************/
define('EmpireCMSAdmin', '1');
require "../class/connect.php";
require "../class/db_sql.php";
require "../class/functions.php";
require LoadLang("pub/fun.php");
require "../class/delpath.php";
require "../class/copypath.php";
require "../class/t_functions.php";
require "../data/dbcache/class.php";
require "../data/dbcache/MemberLevel.php";
//获取分类列表
foreach ($class_r as $kv) {
    if ($kv['modid'] == '1') {
        $cates[] = array('cname' => $kv['classname'], 'cid' => $kv['classid'], 'pid' => $kv['bclassid']);
    }
}
if (empty($_POST)) {
    //这里刷新列表
    echo "<select name='list'>";
    echo maketree($cates, 0, '');
    echo '</select>';
    exit;
}
$link = db_connect();
$empire = new mysqlquery();
//验证用户
$loginin = $_POST['username'];
$lur = $empire->fetch1("select * from {$dbtbpre}enewsuser where `username`='{$loginin}'");
if (!$lur) {
    exit('不存在的用户名' . $loginin);
}
$logininid = $lur['userid'];
$loginrnd = $lur['rnd'];
$loginlevel = $lur['groupid'];
$loginadminstyleid = $lur['adminstyleid'];
$incftp = 0;
if ($public_r['phpmode']) {
    include "../class/ftp.php";
    $incftp = 1;
}
require "../class/hinfofun.php";
/***替换变量***/
$_POST['titlepic'] = str_replace(array("<img src=", ">", "https://file.ikaimi.com/pic/"), array("", "", "https://img.bingli.co/m/pic/"), $_POST['titlepic']);
$_POST['titleimg'] = str_replace(array("<img src=", ">", "https://file.ikaimi.com/pic/"), array("", "", "https://img.bingli.co/m/pic/"), $_POST['titleimg']);
$_POST['back'] = str_replace(array("<img src=", ">", "https://file.ikaimi.com/pic/"), array("", "", "https://img.bingli.co/m/pic/"), $_POST['back']);
$_POST['cover'] = str_replace(array("<img src=", ">", "https://file.ikaimi.com/pic/"), array("", "", "https://img.bingli.co/m/pic/"), $_POST['cover']);
$_POST['jindu'] = str_replace(array("連載","连载", "完结", "完結"), array("1", "1", "2", "2"), $_POST['jindu']);
$_POST['ticai'] = str_replace(array("剧情","浪漫爱情","青春校园","校园","奇幻冒险","恐怖悬疑","恐怖","悬疑","惊悚","BL","幽默搞笑","动作","未来科幻","科幻","古装武侠","古风穿越","漫画式小说","其他"), array("61","62","63","63","64","65","65","66","67","67","68","69","70","70","71","71","72","72"), $_POST['ticai']);
$_POST['ticai'] = str_replace(array("劇情", "浪漫愛情", "校園", "青春校園", "奇幻冒險", "恐怖", "恐怖懸疑","懸疑", "驚悚", "BL", "幽默搞笑", "動作", "科幻", "古風穿越", "其他"), array("61", "62", "63","63", "64", "65","65", "66", "67", "67", "68", "69", "70", "71", "72"), $_POST['ticai']);
$_POST['up'] = str_replace(array("周一","周二","周三","周四","周五","周六","周日"), array("1","2","3","4","5","6","7"), $_POST['up']);
$_POST['up'] = str_replace(array("週一","週二","週三","週四","週五","週六","週日"), array("1","2","3","4","5","6","7"), $_POST['up']);
$_POST['infotags'] = rtrim($_POST['infotags'], ",");
$_POST['keyboard'] = rtrim($_POST['keyboard'], ",");
/***变量结束***/
$navtheid = (int) $_POST['filepass'];
$title = addslashes($_POST['title']);
$zpid = addslashes($_POST['zpid']);
$jindu = addslashes($_POST['jindu']);
$ticai = $_POST['ticai'];
$age = addslashes($_POST['age']);
$up = addslashes($_POST['up']);
$titlepic = addslashes($_POST['titlepic']);
$titleimg = addslashes($_POST['titleimg']);
$back = addslashes($_POST['back']);
$cover = addslashes($_POST['cover']);
$keyboard = addslashes($_POST['keyboard']);
$smalltext = addslashes($_POST['smalltext']);
$writer = addslashes($_POST['writer']);
$befrom = $_POST['befrom'];
$newstime = strtotime($_POST[newstime]);
/***更新变量***/
$newup = addslashes($_POST['newup']);
$isgood = addslashes($_POST['isgood']);
$firsttitle = addslashes($_POST['firsttitle']);
/***更新内容***/
$tr = $empire->fetch1("select * from {$dbtbpre}ecms_comic where zpid='{$zpid}'");
if ($firsttitle == 1) {
	//设置头条
    if ($tr) {
        $titleimg = addslashes($_POST['titleimg']);
        $empire->query("update {$dbtbpre}ecms_comic set firsttitle='{$firsttitle}',titleimg='{$titleimg}' where id='{$tr['id']}'");
        echo "标题重复,增加不成功!";
    }
} elseif ($isgood == 1) {
	//设置推荐
    if ($tr) {
        $empire->query("update {$dbtbpre}ecms_comic set isgood='{$isgood}' where id='{$tr['id']}'");
        echo "标题重复,增加不成功!";
    }
} elseif ($newup == 1) {
    if ($tr) {
		//更新进度
        $empire->query("update {$dbtbpre}ecms_comic set jindu='{$jindu}' where id='{$tr['id']}'");
		GetHtml($tr['classid'],$tr['id'],'',0,1);
        echo "标题重复,增加不成功!";
    }
} elseif ($newup == 2) {
	//更新专题
    $newr = $empire->fetch1("select * from {$dbtbpre}ecms_comic where title='{$title}' and back!=''");
    if ($newr) {
		$empire->query("update {$dbtbpre}ecms_comic set jindu='{$jindu}',up='{$up}',ticai='{$ticai}',zpid='{$zpid}',title='{$title}',writer='{$writer}',keyboard='{$keyboard}',smalltext='{$smalltext}',newstime='{$newstime}',ctime='{$newstime}',titlepic='{$titlepic}',back='{$back}',cover='{$cover}',befrom='{$befrom}' where id='{$tr['id']}'");
		GetHtml($tr['classid'],$tr['id'],'',0,1);
        echo "标题重复,增加不成功!";
    } else {
       AddNews($_POST, $logininid, $loginin);
   }
}elseif ($newup == 3) {
    if ($tr) {
		//更新缩略图
        $empire->query("update {$dbtbpre}ecms_comic set titlepic='{$titlepic}' where id='{$tr['id']}'");
		GetHtml($tr['classid'],$tr['id'],'',0,1);
        echo "标题重复,增加不成功!";
    }
}elseif ($newup == 4) {
    if ($tr) {
		//更新来源
        $empire->query("update {$dbtbpre}ecms_comic set befrom='{$befrom}' where id='{$tr['id']}'");
        echo "标题重复,增加不成功!";
    }
} else {
	//全新发布
    AddNews($_POST, $logininid, $loginin);
}
db_close();
$empire = null;
/***生成目录的一个遍历算法***/
function maketree($ar, $id, $pre)
{
    $ids = '';
    foreach ($ar as $k => $v) {
        $pid = $v['pid'];
        $cname = $v['cname'];
        $cid = $v['cid'];
        if ($pid == $id) {
            $ids .= "<option value='{$cid}'>{$pre}{$cname}</option>";
            foreach ($ar as $kk => $vv) {
                $pp = $vv['pid'];
                if ($pp == $cid) {
                    $ids .= maketree($ar, $cid, $pre . "&nbsp;&nbsp;");
                    break;
                }
            }
        }
    }
    return $ids;
}