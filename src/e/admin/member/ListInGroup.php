<?php
define('EmpireCMSAdmin', '1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
require "../" . LoadLang("pub/fun.php");
$link = db_connect();
$empire = new mysqlquery();
$editor = 1;
//验证用户
$lur = is_login();
$logininid = $lur['userid'];
$loginin = $lur['username'];
$loginrnd = $lur['rnd'];
$loginlevel = $lur['groupid'];
$loginadminstyleid = $lur['adminstyleid'];
//ehash
$ecms_hashur = hReturnEcmsHashStrAll();
//验证权限
CheckLevel($logininid, $loginin, $classid, "ingroup");

//增加来自渠道
function AddInGroup($add, $userid, $username)
{
    global $empire, $dbtbpre;
    if (empty($add['gname'])) {
        printerror('EmptyInGroup', 'history.go(-1)');
    }
    $add['gname'] = hRepPostStr($add['gname'], 1);
    $add['myorder'] = (int)$add['myorder'];
    $add['number'] = (int)$add['number'];
    $add['kou'] = (int)$add['kou'];
    $add['money'] = (int)$add['money'];
    $sql = $empire->query("insert into {$dbtbpre}enewsingroup(gname,myorder,`number`,kou,money) values('$add[gname]','$add[myorder]','$add[number]','$add[kou]','$add[money]');");
    //更新缓存
    GetMemberLevel();
    if ($sql) {
        $gid = $empire->lastid();
        insert_dolog("gid=$gid&gname=$add[gname]");//操作日志
        printerror("AddInGroupSuccess", "AddInGroup.php?enews=AddInGroup" . hReturnEcmsHashStrHref2(0));
    } else {
        printerror("DbError", "history.go(-1)");
    }
}

//修改来自渠道
function EditInGroup($add, $userid, $username)
{
    global $empire, $dbtbpre;
    $gid = intval($add['gid']);
    if (empty($add['gname']) || !$gid) {
        printerror('EmptyInGroup', 'history.go(-1)');
    }
    $add['gname'] = hRepPostStr($add['gname'], 1);
    $add['myorder'] = (int)$add['myorder'];
    $add['number'] = (int)$add['number'];
    $add['kou'] = (int)$add['kou'];
    $add['money'] = (int)$add['money'];
    $sql = $empire->query("update {$dbtbpre}enewsingroup set gname='$add[gname]',myorder='$add[myorder]',`number`='$add[number]',kou='$add[kou]',money='$add[money]' where gid='$gid'");
    //更新缓存
    GetMemberLevel();
    if ($sql) {
        insert_dolog("gid=$gid&gname=$add[gname]");//操作日志
        printerror("EditInGroupSuccess", "ListInGroup.php" . hReturnEcmsHashStrHref2(1));
    } else {
        printerror("DbError", "history.go(-1)");
    }
}

//删除来自渠道
function DelInGroup($add, $userid, $username)
{
    global $empire, $dbtbpre;
    $gid = intval($add['gid']);
    if (!$gid) {
        printerror('EmptyInGroupid', 'history.go(-1)');
    }
    $r = $empire->fetch1("select gid,gname from {$dbtbpre}enewsingroup where gid='$gid'");
    if (!$r['gid']) {
        printerror('EmptyInGroupid', 'history.go(-1)');
    }
    $sql = $empire->query("delete from {$dbtbpre}enewsingroup where gid='$gid'");
    //更新缓存
    GetMemberLevel();
    if ($sql) {
        insert_dolog("gid=$gid&gname=$r[gname]");//操作日志
        printerror("DelInGroupSuccess", "ListInGroup.php" . hReturnEcmsHashStrHref2(1));
    } else {
        printerror("DbError", "history.go(-1)");
    }
}

$enews = $_POST['enews'];
if (empty($enews)) {
    $enews = $_GET['enews'];
}
if ($enews) {
    hCheckEcmsRHash();
}
if ($enews == "AddInGroup") {
    AddInGroup($_POST, $logininid, $loginin);
} elseif ($enews == "EditInGroup") {
    EditInGroup($_POST, $logininid, $loginin);
} elseif ($enews == "DelInGroup") {
    DelInGroup($_GET, $logininid, $loginin);
}


$search = $ecms_hashur['ehref'];
$page = (int)$_GET['page'];
$page = RepPIntvar($page);
$start = 0;
$line = 16;//每页显示条数
$page_line = 25;//每页显示链接数
$offset = $page * $line;//总偏移量
$query = "select * from {$dbtbpre}enewsingroup";
$totalquery = "select count(*) as total from {$dbtbpre}enewsingroup";
$num = $empire->gettotal($totalquery);//取得总条数
$query = $query . " order by gid desc limit $offset,$line";
$sql = $empire->query($query);
$returnpage = page2($num, $line, $page_line, $start, $page, $search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../adminstyle/<?= $loginadminstyleid ?>/adminstyle.css" rel="stylesheet" type="text/css">
    <title>来自渠道</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td width="50%" height="25">位置：<a href="ListInGroup.php<?= $ecms_hashur['whehref'] ?>">管理来自渠道</a></td>
        <td>
            <div align="right" class="emenubutton">
                <input type="button" name="Submit5" value="增加来自渠道"
                       onclick="self.location.href='AddInGroup.php?enews=AddInGroup<?= $ecms_hashur['ehref'] ?>';">
            </div>
        </td>
    </tr>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
        <td width="6%" height="25">
            <div align="center">ID</div>
        </td>
        <td width="29%" height="25">
            <div align="center">渠道名称</div>
        </td>
        <td width="14%">
            <div align="center">会员数</div>
        </td>
        <td width="10%">
            <div align="center">分润比例</div>
        </td>
        <td width="10%">
            <div align="center">扣量比例</div>
        </td>
        <td width="10%">
            <div align="center">起扣金额</div>
        </td>
        <td width="21%" height="25">
            <div align="center">操作</div>
        </td>
    </tr>
    <?php
    while ($r = $empire->fetch($sql)) {
        $color = "#ffffff";
        $movejs = ' onmouseout="this.style.backgroundColor=\'#ffffff\'" onmouseover="this.style.backgroundColor=\'#C3EFFF\'"';
        $membernum = $empire->gettotal("select count(*) as total from " . eReturnMemberTable() . " where " . egetmf('ingid') . "='$r[gid]'");
        ?>
        <tr bgcolor="<?= $color ?>"<?= $movejs ?>>
            <td height="25">
                <div align="center">
                    <?= $r[gid] ?>
                </div>
            </td>
            <td height="25">
                <div align="center">
                    <?= $r[gname] ?>
                </div>
            </td>
            <td>
                <div align="center"><a href="ListMember.php?sear=1&ingid=<?= $r['gid'] ?><?= $ecms_hashur['ehref'] ?>"
                                       target="_blank" title="点击查看列表"><?= $membernum ?></a></div>
            </td>
            <td height="25">
                <div align="center">
                    <?= $r[number] ?>
                </div>
            </td>
            <td height="25">
                <div align="center">
                    <?= $r[kou] ?>
                </div>
            </td>
            <td height="25">
                <div align="center">
                    <?= $r[money] ?>
                </div>
            </td>
            <td height="25">
                <div align="center"> [<a
                        href="AddInGroup.php?enews=EditInGroup&gid=<?= $r[gid] ?><?= $ecms_hashur['ehref'] ?>">修改</a>]&nbsp;[<a
                        href="ListInGroup.php?enews=DelInGroup&gid=<?= $r[gid] ?><?= $ecms_hashur['href'] ?>"
                        onclick="return confirm('确认要删除？');">删除</a>]
                </div>
            </td>
        </tr>
        <?
    }
    ?>
    <tr bgcolor="#FFFFFF">
        <td height="25" colspan="4">&nbsp;&nbsp;&nbsp;
            <?= $returnpage ?>    </td>
    </tr>
</table>
</body>
</html>
<?
db_close();
$empire = null;
?>
