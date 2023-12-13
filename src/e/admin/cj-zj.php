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
$_POST['morepic'] = str_replace(array("<img src=", ">", "https://file.ikaimi.com/pic/"), array("", "", "https://img.bingli.co/m/pic/"), $_POST['morepic']);
$_POST['morepic'] = str_replace("######", " ######\r\n", $_POST['morepic']);
$_POST['morepic'] = rtrim($_POST['morepic'], "######");
$_POST['morepic'] = rtrim($_POST['morepic'], "\r\n");
$_POST['morepic'] = rtrim($_POST['morepic'], "######\r\n");
$price=$_POST['price'];
$num=$_POST['num'];
if ($num=='0' || $num=='1' || $num=='2' || $num=='3') {
    $_POST['price'] = '1';
}else {
    $_POST['price'] = '2';
}
/***变量结束***/
$navtheid = (int) $_POST['filepass'];
$zpid=addslashes($_POST['zpid']);
$num=addslashes($_POST['num']);
$titlepic=addslashes($_POST['titlepic']);
$chaptertime=strtotime($_POST[newstime]);
$morepic=$_POST['morepic'];
$cjid=addslashes($_POST['cjid']);
/***更新章节时间****/
$tc=$empire->fetch1("select zpid from {$dbtbpre}ecms_comic where zpid='{$zpid}' and lastdotime < {$chaptertime}");
if ($tc['zpid']) {
   $empire->query("update {$dbtbpre}ecms_comic set lastdotime='{$chaptertime}' where zpid='$tc[zpid]'");
} 
$tr = $empire->fetch1("select id from {$dbtbpre}ecms_chapter where zpid='{$zpid}' and num='{$num}'");
if ($tr['id']) {
	$empire->query("update {$dbtbpre}ecms_chapter_data_1 set morepic='{$morepic}' where id='{$tr[id]}'");
   echo "标题重复,增加不成功!";
}  else {
    AddNews($_POST, $logininid, $loginin);
	GetHtml($tc['classid'], $tc['id'], '', 0,1);	
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