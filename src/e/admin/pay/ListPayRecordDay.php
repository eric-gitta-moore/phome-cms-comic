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

$t1=microtime(true); //获取程序1，开始的时间

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
        printerror("DelPayRecordSuccess", "ListPayRecordDay.php" . hReturnEcmsHashStrHref2(1));
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
//$query = "select * from {$dbtbpre}enewsbuybak";
//$totalquery = "select count(*) as total from {$dbtbpre}enewsbuybak";
$query = "SELECT DISTINCT(DATE_FORMAT(buytime,'%Y-%m-%d')) as `day` ,sum(money) as total,count(*) as num,sum(kou) as kou  from ((select * from {$dbtbpre}enewsbuybak GROUP BY card_no) AS aa)";
$totalquery = "SELECT DISTINCT(DATE_FORMAT(buytime,'%Y-%m-%d')) as `day` from ((select * from {$dbtbpre}enewsbuybak GROUP BY card_no) AS aa) ";

$t2=microtime(true); //获取程序1，结束的时间
$time1=$t2-$t1;
echo $time1;

//搜索
$search = '';
$search .= $ecms_hashur['ehref'];
$where = '';
$a = '';
if($loginlevel != 1 ){
    $a = " fromadd='".$loginin."' ";
}

if ($_GET['sear'] == 1) {
    $search .= "&sear=1";
    $startday = RepPostVar($_GET['startday']);
    $endday = RepPostVar($_GET['endday']);
    if ($startday && $endday) {
        $and = $a ? ' and ' : '';
        $search .= "&startday=$startday&endday=$endday";
        $a .= $and . "buytime<='" . $endday . " 23:59:59' and buytime>='" . $startday . " 00:00:00'";
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
//        $fromadd_sql = $empire->query("select userid from {$dbtbpre}enewsmember where fromadd='" . $_GET['fromadd'] . "'");
//        $from_str = '';
//        while ($form_add = $empire->fetch($fromadd_sql)) {
//            $from_str = $from_str . $form_add[userid] . ',';
//        }
//        $form_str = trim($from_str, ',');
//        if($form_str){
//            $a .= $and . " userid  in(" . $form_str . ")  ";
//        }else{
//            $a .= $and . " userid='' ";
//        }
        $a .= $and . " fromadd='".$_GET['fromadd']."' ";
        $search .= "&fromadd=".$_GET['fromadd'];
    }

    if ($a) {
        $where .= " where " . $a;
    }
    $query .= $where;
    $totalquery .= $where;
}else{
    $bdate = date('Y-m-d',time()-864000);//十天前
    $edate = date('Y-m-d',time());//现在
    if($loginlevel > 1 ){
        $query .= "where fromadd='".$loginin."' and buytime<='" . $edate . " 23:59:59' and buytime>='" . $bdate . " 00:00:00'";
        $totalquery .= "where fromadd='".$loginin."'  and  buytime<='" . $edate . " 23:59:59' and buytime>='" . $bdate . " 00:00:00'";
    }else{
        $query .= "where buytime<='" . $edate . " 23:59:59' and buytime>='" . $bdate . " 00:00:00'";
        $totalquery .= "where  buytime<='" . $edate . " 23:59:59' and buytime>='" . $bdate . " 00:00:00'";
    }
}
$query = $query ."  GROUP BY day  desc limit $offset,$line;";
$totalquery = $empire->query($totalquery . "  GROUP BY day  desc;");

$num = 0;
while ($num_r = $empire->fetch($totalquery)) {
    $num = $num+1;
}
//$num = $empire->gettotal($totalquery);//取得总条数
//$query = $query . " order by id desc limit $offset,$line";
$sql = $empire->query($query);
$returnpage = page2($num, $line, $page_line, $start, $page, $search);
//$mt = $empire->fetch1("select sum(money) as 'ScrTotal' from {$dbtbpre}enewsbuybak $where");

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
    <title>每日统计</title>
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
<!--<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>位置：&gt; <a href="ListPayRecordKou.php<?/*= $ecms_hashur['whehref'] */?>">每日统计</a></td>
        <td width="50%">
            <div align="right" class="emenubutton">
                <input type="button" name="Submit5" value="管理支付接口"
                       onclick="self.location.href='PayApi.php<?/*= $ecms_hashur['whehref'] */?>';">
                &nbsp;&nbsp;
                <input type="button" name="Submit5" value="支付参数设置"
                       onclick="self.location.href='SetPayFen.php<?/*= $ecms_hashur['whehref'] */?>';">
            </div>
        </td>
    </tr>
</table>-->

<br>
<table width="100%" align=center cellpadding=0 cellspacing=0>
    <form name="form2" method="GET" action='ListPayRecordDay.php'>
        <?= $ecms_hashur['eform'] ?>
        <tr>
            <td height="25">
                <div align="center">时间从
                    <input name="startday" type="text" value="<?= $startday ?>" size="15" class="Wdate"
                           onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd'})">
                    到
                    <input name="endday" type="text" value="<?= $endday ?>" size="15" class="Wdate"
                           onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd'})">
                    <?php if($loginlevel == 1 ){  ?>
                        <select name="fromadd" id="fromadd">
                            <option value="0">来自渠道</option>
                            <?= $ingroup ?>
                        </select>
                    <?php } ?>

                    <!--，关键字：
                    <input name="keyboard" type="text" id="keyboard" value="<?/*= $keyboard */?>">
                    <select name="show" id="show">
                        <option value="0"<?/*= $show == 0 ? ' selected' : '' */?>>订单号</option>
                        <option value="1"<?/*= $show == 1 ? ' selected' : '' */?>>汇款者</option>
                        <option value="2"<?/*= $show == 2 ? ' selected' : '' */?>>汇款IP</option>
                        <option value="3"<?/*= $show == 3 ? ' selected' : '' */?>>备注</option>
                    </select>-->
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
            <td width="10%">日期</td>
            <td width="10%">点击量</td>
            <td width="10%">充值笔数</td>
            <td width="8%">充值金额</td>

            <td width="8%">渠道应得</td>
            <td width="8%">支付宝金额</td>
            <td width="8%">手续费</td>

            <?php if($loginlevel == 1){   ?>
            <td width="8%">扣量金额</td>
            <td width="8%">剩余金额</td>
            <?php }  ?>
        </tr>
        <?php
        while ($r = $empire->fetch($sql)) {
//            if ($r['userid']) {
//                $username = "<a href='../member/AddMember.php?enews=EditMember&userid=$r[userid]" . $ecms_hashur['ehref'] . "'>$r[username]</a>";
//            } else {
//                $username = "游客(" . $r[username] . ")";
//            }
//            if ($r[type] == 1 || $r[type] == 901) {
//                $paytype = "微信";
//            } elseif ($r[type] == 2 || $r[type] == 904) {
//                $paytype = "支付宝";
//            } else {
//                $paytype = "";
//            }
//            if ($i % 2 == 0) {
//                $skin = "odd";
//            } else {
//                $skin = "even";
//            }
//            $buytime = esub($r[buytime], 10);
//            if (strtotime($buytime) == strtotime(date("Y-m-d"))) {
//                $color = " day";
//            } else {
//                $color = "";
//            }
            ?>
            <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'"
                onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="25"><input name="id[]" type="checkbox" id="id[]" value="<?= $r[id] ?>"></div></td>
                <td>
                    <div align="center">
                        <?php if($loginlevel != 1) {  ?>
                            <?=$r[day]?>
                        <?php }else{ ?>
                            <a href="ListPayRecordTong.php?sear=1&day=<?=$r['day']?><?=$ecms_hashur['ehref']?>"><?=$r[day]?></a>
                        <?php } ?>

                    </div>
                </td>
                <td>
                    <?php
//                    $start = strtotime($r[day].' 00:00:00');
//                    $end = strtotime($r[day].' 23:59:59');
//                    $kou_sql = $empire->query("SELECT count(*) as num  from {$dbtbpre}enewsmemberadd where lasttime>'".$start."' AND  lasttime<'".$end."';");
//                    while ($kou_r = $empire->fetch($kou_sql)) {
//                        $num = $kou_r['num'];
//                    }
                    if($loginlevel != 1) {
                        $start1 = strtotime($r[day] . ' 00:00:00');
                        $end1 = strtotime($r[day] . '23:59:59');
                        $add_num = $empire->query("SELECT count(*) as num  from {$dbtbpre}enewsmemberadd where lasttime>'" . $start1 . "' AND  lasttime<'" . $end1 . "'");
                        $add_number = mysql_fetch_assoc($add_num)['num'];
                        $enewsmember_num = $empire->query("SELECT count(*) as num  from {$dbtbpre}enewsmember where registertime>'" . $start1 . "' AND  registertime<'" . $end1 . "'");
                        $enewsmember_number = mysql_fetch_assoc($enewsmember_num)['num'];
                        $all_num = $empire->query("select count(id) as num from {$dbtbpre}ipday where day='" . $r[day] . "'");
                        $all_number = mysql_fetch_assoc($all_num)['num'];
                        $all_fromadd = 0;
                        $query_form = "SELECT id from {$dbtbpre}enewsbuybak a where buytime>'".$r[day]." 00:00:00' AND buytime<'".$r[day]." 23:59:59' GROUP BY fromadd;";;
                        $sql1 = $empire->query($query_form);
                        while ($all = $empire->fetch($sql1)) {
                            $all_fromadd = $all_fromadd + 1;
                        }
                        $avg_num = floor(($all_number - $enewsmember_number - $add_number) / $all_fromadd);
                        $start = strtotime($r[day].'00:00:00');
                        $end = strtotime($r[day].'23:59:59');
                        $fromadd_sql1 = $empire->query("select userid from {$dbtbpre}enewsmember where fromadd='" . $loginin . "'");
                        $from_str1 = '';
                        while ($form_add1 = $empire->fetch($fromadd_sql1)) {
                            $from_str1 = $from_str1 . $form_add1[userid] . ',';
                        }
                        $form_str1 = trim($from_str1, ',');
                        $kou_sql = $empire->query("SELECT count(*) as num  from {$dbtbpre}enewsmemberadd where lasttime>'".$start."' AND  lasttime<'".$end."' AND  userid  in(" . $form_str1 . ") ");
                        while ($kou_r = $empire->fetch($kou_sql)) {
                            $num = $kou_r['num'];
                        }
                        $member_num = $empire->query("SELECT count(*) as num  from {$dbtbpre}enewsmember where registertime>'".$start."' AND  registertime<'".$end."' AND fromadd='" . $loginin . "'");
                        $member_number = mysql_fetch_assoc($member_num)['num'];
//                        $number = $add_number.'-'.$enewsmember_number.'-'.$all_number.'-'.$all_fromadd;
                        $number = $member_number+$num+$avg_num;
                        echo $number?$number:0;

                    }else{
                        $num = 0;
                        $day_inmsql=$empire->query("select count(id) as num from {$dbtbpre}ipday where day='".$r[day]."'");
                        $num = mysql_fetch_assoc($day_inmsql)['num'];
                        echo $num;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($loginlevel != 1) {
                        $qstart = $r[day] . ' 00:00:00';
                        $qend = $r[day] . '23:59:59';
                        $q_num = $empire->query("SELECT count(*) as num  from ((select * from {$dbtbpre}enewsbuybak GROUP BY card_no) AS aa) where buytime>'" . $qstart . "' AND  buytime<'" . $qend . "' and kou=0 and fromadd='".$loginin."'");
                        $q_number = mysql_fetch_assoc($q_num)['num'];
                        echo $q_number;
                    }else{
                        echo  $r[num];
                    }
                    ?></td>
                <td>
                    <?php
                    //充值金额
                    $chongzhi = 0;
                    $chongzhi = $r[total] - $r[kou];
                    echo $chongzhi;
                    ?>
                </td>

                <td>￥
                    <?php
                    //渠道应得
                    $run = 0;
                    $start = $r[day].' 00:00:00';
                    $end = $r[day].' 23:59:59';
                    if ($_GET['fromadd'] || $loginlevel != 1) {
                        if($_GET['fromadd']){
                            $fromadd = $_GET['fromadd'];
                        }else{
                            $fromadd = $loginin;
                        }
                        $fquery2 = $empire->query("select * from {$dbtbpre}enewsingroup where gname='" . $fromadd . "'");
                        $fkou_r = mysql_fetch_assoc($fquery2);
                        $fkou_num = 0;
                        $fquchong = 0;
                        if($fkou_r){
                            $fkou_num = $fkou_r['number'];
                        }
                        $run = $chongzhi * $fkou_num/100;
                    }else{
                    $query1 = $empire->query("SELECT fromadd,sum(money) as total,sum(kou) as kou from ((select * from {$dbtbpre}enewsbuybak GROUP BY card_no) AS aa) where buytime>'".$start."' AND buytime<'".$end."' GROUP BY fromadd");
                    while ($qu_r = $empire->fetch($query1)) {
//                        $kou = 0;
//                        $money = 0;
                        $query2 = $empire->query("select * from {$dbtbpre}enewsingroup where gname='" . $qu_r['fromadd'] . "'");
                        $kou_r = mysql_fetch_assoc($query2);
                        $kou_num = 0;
                        $quchong = 0;
                        if($kou_r){
                            $kou_num = $kou_r['number'];
                        }
//                        while ($kou_r = $empire->fetch($query2)) {
//                            $run = $kou_r['number'];//分润比例
//                            $kou = $kou_r['kou'];//扣量比例
//                            $money = $kou_r['money'];//起扣金额
                            $quchong = $qu_r['total'] - $qu_r['kou'];
                            $run = $run + $quchong * $kou_num/100;
//                        }
                    }
                    }
                    echo $run;
                    ?>
                </td>
                <td>0</td>
                <td>0</td>
                <?php if($loginlevel == 1){   ?>
                <td>￥
                    <?php
                    //扣量金额
                    $kou_to = 0;
                    if ($_GET['fromadd']) {
                        $query3 = $empire->query("SELECT sum(money) as total from ((select * from {$dbtbpre}enewsbuybak GROUP BY card_no) AS aa) where buytime>'".$start."' AND buytime<'".$end."' AND  kou > 0 AND  fromadd='".$_GET['fromadd']."'");
                    }else{
                        $query3 = $empire->query("SELECT sum(money) as total from ((select * from {$dbtbpre}enewsbuybak GROUP BY card_no) AS aa) where buytime>'".$start."' AND buytime<'".$end."' AND  kou > 0 ;");
                    }
                    while ($to_r = $empire->fetch($query3)) {
                        $kou_to = $to_r['total'];
                    }
                    echo intval($kou_to);
                    ?>
                </td>
                <td>￥<?php
                    //剩余金额
                    echo $kou_to+$chongzhi-$run;

                    ?></td>
                <?php } ?>
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