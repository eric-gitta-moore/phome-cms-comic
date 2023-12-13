<?php
define('EmpireCMSAdmin', '1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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
CheckLevel($logininid, $loginin, $classid, "pay");


//批量删除
function DelPayRecord_all($id, $userid, $username)
{
    global $empire, $dbtbpre;

    //验证权限
    CheckLevel($userid, $username, $classid, "pay");
    $count = count($id);
    if (!$count) {
        printerror("NotDelPayRecordid", "history.go(-1)");
    }
    for ($i = 0; $i < $count; $i++) {
        $add .= " id='" . intval($id[$i]) . "' or";
    }
    $add = substr($add, 0, strlen($add) - 3);
    $sql = $empire->query("delete from {$dbtbpre}enewspayrecord where" . $add);
    if ($sql) {
        //操作日志
        insert_dolog("");
        printerror("DelPayRecordSuccess", "ListPayRecordKou.php" . hReturnEcmsHashStrHref2(1));
    } else {
        printerror("DbError", "history.go(-1)");
    }
}

//print_r(DelPayRecord_all('778431',66));


$enews = $_POST['enews'];
if (empty($enews)) {
    $enews = $_GET['enews'];
}
if ($enews) {
    hCheckEcmsRHash();
}
//批量删除
if ($enews == "DelPayRecord_all") {
    $id = $_POST['id'];
    DelPayRecord_all($id, $logininid, $loginin);
}

$line = 30;//每页显示条数
$page_line = 5;//每页显示链接数
$page = (int)$_GET['page'];
$page = RepPIntvar($page);
$start = 0;
$offset = $page * $line;//总偏移量
$query = "select * from {$dbtbpre}enewsbuybak";
$totalquery = "select count(*) as total from {$dbtbpre}enewsbuybak";
//搜索
$search = '';
$search .= $ecms_hashur['ehref'];
$where = '';

if ($_GET['sear'] == 1) {
    $search .= "&sear=1";
    $a = '';
    $startday = RepPostVar($_GET['startday']);
    $endday = RepPostVar($_GET['endday']);
    if ($startday && $endday) {
        $search .= "&startday=$startday&endday=$endday";
        $a .= "buytime<='" . $endday . " 23:59:59' and buytime>='" . $startday . " 00:00:00'";
    }
    $keyboard = RepPostVar($_GET['keyboard']);
    if ($keyboard) {
        $and = $a ? ' and ' : '';
        $show = RepPostStr($_GET['show'], 1);
        if ($show == 1) {
            $a .= $and . "username like '%$keyboard%'";
        } elseif ($show == 2) {
            $a .= $and . "cardfen like '%$keyboard%'";
        } elseif ($show == 3) {
            $a .= $and . "userdate like '%$keyboard%'";
        } else {
            $a .= $and . "card_no like '%$keyboard%'";
        }
        $search .= "&keyboard=$keyboard&show=$show";
    }

    if ($_GET['fromadd']) {
        $and = $a ? ' and ' : '';
        $fromadd_sql = $empire->query("select userid from {$dbtbpre}enewsmember where fromadd='" . $_GET['fromadd'] . "'");
        $from_str = '';
        while ($form_add = $empire->fetch($fromadd_sql)) {
            $from_str = $from_str . $form_add[userid] . ',';
        }
        $form_str = trim($from_str, ',');
        if($form_str){
            $a .= $and . " userid  in(" . $form_str . ")  ";
        }else{
            $a .= $and . " userid='' ";
        }
        $search .= "&fromadd=".$_GET['fromadd'];
    }

    if ($a) {
        $where .= " where " . $a .' and kou != 0 ';
    }
    $query .= $where;
    $totalquery .= $where;
}else{
    $where .= " where kou != 0 ";
    $query .= $where;
    $totalquery .= $where;
}

$num = $empire->gettotal($totalquery);//取得总条数
$query = $query . " order by id desc limit $offset,$line";
$sql = $empire->query($query);
$returnpage = page2($num, $line, $page_line, $start, $page, $search);
$mt = $empire->fetch1("select sum(money) as 'ScrTotal' from {$dbtbpre}enewsbuybak $where");

//----------渠道
$ingroup = '';
$inmsql = $empire->query("select * from {$dbtbpre}enewsingroup order by myorder");
while ($inm_r = $empire->fetch($inmsql)) {
    if ($_GET['fromadd'] == $inm_r['gname']) {
        $select = " selected";
    } else {
        $select = "";
    }
    $ingroup .= "<option value='" . $inm_r['gname'] ."'" . $select . ">" . $inm_r['gname'] . "</option>";
}

?>
<html>
<head>
    <link href="../adminstyle/<?= $loginadminstyleid ?>/adminstyle.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>在线支付</title>
    <script type="text/javascript" src="../ecmseditor/js/jstime/WdatePicker.js"></script>
    <script>
        function CheckAll(form) {
            for (var i = 0; i < form.elements.length; i++) {
                var e = form.elements[i];
                if (e.name != 'chkall')
                    e.checked = form.chkall.checked;
            }
        }
    </script>
</head>
<style type="text/css">
    .tableborder tr td {
        text-align: center;
    }

    .tableborder tr td.f14 {
        font-size: 14px;
    }

    .tableborder tr td.day {
        color: #f00;
    }
</style>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>位置：在线支付&gt; <a href="ListPayRecordKou.php<?= $ecms_hashur['whehref'] ?>">渠道每日扣量记录</a></td>
        <td width="50%">
            <div align="right" class="emenubutton">
                <input type="button" name="Submit5" value="管理支付接口"
                       onclick="self.location.href='PayApi.php<?= $ecms_hashur['whehref'] ?>';">
                &nbsp;&nbsp;
                <input type="button" name="Submit5" value="支付参数设置"
                       onclick="self.location.href='SetPayFen.php<?= $ecms_hashur['whehref'] ?>';">
            </div>
        </td>
    </tr>
</table>

<br>
<table width="100%" align=center cellpadding=0 cellspacing=0>
    <form name="form2" method="GET" action='ListPayRecordKou.php'>
        <?= $ecms_hashur['eform'] ?>
        <tr>
            <td height="25">
                <div align="center">时间从
                    <input name="startday" type="text" value="<?= $startday ?>" size="15" class="Wdate"
                           onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd'})">
                    到
                    <input name="endday" type="text" value="<?= $endday ?>" size="15" class="Wdate"
                           onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd'})">
                    <select name="fromadd" id="fromadd">
                        <option value="0">来自渠道</option>
                        <?= $ingroup ?>
                    </select>
                    ，关键字：
                    <input name="keyboard" type="text" id="keyboard" value="<?= $keyboard ?>">
                    <select name="show" id="show">
                        <option value="0"<?= $show == 0 ? ' selected' : '' ?>>订单号</option>
                        <option value="1"<?= $show == 1 ? ' selected' : '' ?>>汇款者</option>
                        <option value="2"<?= $show == 2 ? ' selected' : '' ?>>汇款IP</option>
                        <option value="3"<?= $show == 3 ? ' selected' : '' ?>>备注</option>
                    </select>
                    <input name=submit1 type=submit id="submit12" value=搜索>
                    <input name="sear" type="hidden" id="sear" value="1">
                </div>
            </td>
        </tr>
    </form>
</table>
<form name="form2" method="post" action="ListPayRecord.php" onsubmit="return confirm('确认要删除?');">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableborder">
        <?= $ecms_hashur['form'] ?>
        <tr class="header">
            <td width="3%" height="35"><input type=checkbox name=chkall value=on onClick="CheckAll(this.form)"></td>
            <td width="10%">会员名</td>
            <td width="10%">付款金额</td>
            <td width="12%">支付时间</td>
            <td width="8%">+天数</td>
            <td width="8%">+积分</td>
            <td width="5%">渠道</td>
            <td width="8%">渠道比例</td>
            <td width="8%">渠道起扣金额</td>
            <td width="8%">扣量</td>
            <td width="13%">订单号</td>
<!--            <td width="8%">付款</td>-->
        </tr>
        <?php
        while ($r = $empire->fetch($sql)) {
            if ($r['userid']) {
                $username = "<a href='../member/AddMember.php?enews=EditMember&userid=$r[userid]" . $ecms_hashur['ehref'] . "'>$r[username]</a>";
            } else {
                $username = "游客(" . $r[username] . ")";
            }
            if ($r[type] == 1 || $r[type] == 901) {
                $paytype = "微信";
            } elseif ($r[type] == 2 || $r[type] == 904) {
                $paytype = "支付宝";
            } else {
                $paytype = "";
            }
            if ($i % 2 == 0) {
                $skin = "odd";
            } else {
                $skin = "even";
            }
            $buytime = esub($r[buytime], 10);
            if (strtotime($buytime) == strtotime(date("Y-m-d"))) {
                $color = " day";
            } else {
                $color = "";
            }
            ?>
            <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'"
                onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="25"><input name="id[]" type="checkbox" id="id[]" value="<?= $r[id] ?>"></div></td>
                <td><?= $username ?></td>
                <td class="f14 <?= $color ?>">￥<?= $r[money] ?></td>
                <td><?= $r[buytime] ?></td>
                <td><?= $r[userdate] ?></td>
                <td><?= $r[cardfen] ?></td>
                <td>
                    <?php
                    $from_sql = $empire->query("select fromadd from {$dbtbpre}enewsmember where userid=" . $r[userid]);
                    while ($form_r = $empire->fetch($from_sql)) {
                        $gname = $form_r[fromadd];
                    }
                    echo $gname
                    ?>
                </td>

                <?php
                $kou = 0;
                $money = 0;
                $kou_sql = $empire->query("select * from {$dbtbpre}enewsingroup where gname='" . $gname . "'");
                while ($kou_r = $empire->fetch($kou_sql)) {
                    $kou = $kou_r['kou'];//扣量比例
                    $money = $kou_r['money'];//起扣金额
                }
                ?>

                <td><?php echo $kou ?>%</td>
                <td>￥<?php echo $money ?></td>
                <td>￥<?= $r[kou] ?></td>
                <td><?= $r[card_no] ?></td>
<!--                <td>--><?//= $paytype ?><!--</td>-->
            </tr>
            <?
        }
        ?>
        <tr bgcolor="#FFFFFF">
            <td height="25" colspan="8">&nbsp;
                <?= $returnpage ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--                <input type="submit" name="Submit" value="批量删除"> -->
                <input name="enews" type="hidden" id="enews" value="DelPayRecord_all">
            </td>
        </tr>
    </table>
</form>
<?
db_close();
$empire = null;
?>
</body>
</html>