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
        $a .= " buytime<='" . $endday . " 23:59:59' and buytime>='" . $startday . " 00:00:00'";
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

//    if ($_GET['fromadd']) {
//        $and = $a ? ' and ' : '';
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
//        $search .= "&fromadd=".$_GET['fromadd'];
//    }

    if ($a) {
        $where .= " where " . $a ;
    }
    $query .= $where;
    $totalquery .= $where;
}

$line = 50;//每页显示条数
$page_line = 5;//每页显示链接数
$page = (int)$_GET['page'];
$page = RepPIntvar($page);
$start = 0;
$offset = $page * $line;//总偏移量
//$query = "select * from {$dbtbpre}enewsbuybak";
//$totalquery = "select count(*) as total from {$dbtbpre}enewsbuybak";
if($query){
    $where1 = $where . ' and cardfen > 0 ';
}else{
    $where1 = 'where cardfen > 0 ';
}
$query1 = $empire->query("SELECT *  from {$dbtbpre}enewsbuybak  ".$where1." order by  buytime desc limit $offset,$line");
$totalquery1 = $empire->query("SELECT count(*) as num from {$dbtbpre}enewsbuybak ".$where1);
$arr1 = array();
while ($r1 = $empire->fetch($query1)) {
//    $r11['buytime'] = $r1['buytime'];
    $r11['buytime'] = strtotime($r1['buytime']);
    $r11['fromadd'] = $r1['fromadd'];
    $r11['username'] = $r1['username'];
    $r11['class'] = 1;//充值
    $r11['money'] = $r1['money'];
    $r11['cardfen'] = $r1['cardfen'];
    $arr1[] = $r11;
}
if($query){
$start_time = strtotime($startday);
$end_time = strtotime($endday) + 24*3600-1;
    if ($startday && $endday) {
        $search .= "&startday=$startday&endday=$endday";
        $where2 = "where buytime<='" . $start_time . "' and buytime>='" . $end_time . "'";
    }
}else{
    $where2 = ' ';
}
$query2 = $empire->query("select * from {$dbtbpre}enewsmember_buylog ".$where2." order by  buytime desc limit $offset,$line");
$totalquery2 = $empire->query("select count(*) as  num from {$dbtbpre}enewsmember_buylog ".$where2);
$arr2 = array();
while ($r2 = $empire->fetch($query2)) {
//    $r22['buytime'] = date('Y_m-d H:i:s',$r2['buytime']);
    $r22['buytime'] = $r2['buytime'];
    $from_sql = $empire->query("select fromadd,username from {$dbtbpre}enewsmember where userid=" . $r2[userid]);
    while ($form_r = $empire->fetch($from_sql)) {
        $r22['fromadd'] = $form_r[fromadd];
        $r22['username'] = $form_r[username];
    }
    $r22['class'] = 2;//打赏
    $r22['money'] = 0;
    /*$price_sql = $empire->query("select id from {$dbtbpre}ecms_chapter where price=1");
    $from_str = '';
    while ($form_add = $empire->fetch($price_sql)) {
        $from_str = $from_str . $form_add[id] . ',';
    }
    $form_str = trim($from_str, ',');
    if($form_str){
        $a .= " buyid  in(" . $form_str . ")  ";
    }
    $buy_mt = $empire->query("select * from {$dbtbpre}enewsmember_buylog where ".$a." order by  buytime desc limit 0,100;");
    $arr2 = array();
    while ($r2 = $empire->fetch($buy_mt)) {
        print_r($r2);
    }*/

    $price_sql = $empire->query("select price from {$dbtbpre}ecms_chapter where id=" . $r2[buyid]);
    $price_r = mysql_fetch_assoc($price_sql);
    if($price_r['price'] > 1){//2为付费文章
        $r22['cardfen'] = 50;
    }else{
        $r22['cardfen'] = 0;
    }
    $arr2[] = $r22;
}
function _array_column(array $array, $column_key, $index_key=null){
    $result = [];
    foreach($array as $arr) {
        if(!is_array($arr)) continue;

        if(is_null($column_key)){
            $value = $arr;
        }else{
            $value = $arr[$column_key];
        }

        if(!is_null($index_key)){
            $key = $arr[$index_key];
            $result[$key] = $value;
        }else{
            $result[] = $value;
        }
    }
    return $result;
}
if($_GET['fromadd']){
    if($_GET['fromadd'] == 1){
        $date = _array_column($arr1, 'buytime');
        array_multisort($date,SORT_DESC,$arr1);//按time排序
        $num = mysql_fetch_assoc($totalquery1)['num'];
        $all = $arr1;
    }elseif($_GET['fromadd'] == 2){
        $date = _array_column($arr2, 'buytime');
        array_multisort($date,SORT_DESC,$arr2);//按time排序
        $num = mysql_fetch_assoc($totalquery2)['num'];
        $all = $arr2;
    }
    $search .= "&fromadd=".$_GET['fromadd'];
}else{
    $all = array_merge($arr1,$arr2);//合并两个二维数组
    $date = _array_column($all, 'buytime');
    array_multisort($date,SORT_DESC,$all);//按time排序
    $num = mysql_fetch_assoc($totalquery1)['num'] + mysql_fetch_assoc($totalquery2)['num'];//取得总条数
}
//$num = $empire->gettotal($totalquery);//取得总条数
//$num = mysql_fetch_assoc($totalquery1)['num'] + mysql_fetch_assoc($totalquery2)['num'];//取得总条数
//$query = $query . " order by id desc limit $offset,$line";
//$sql = $empire->query($query);
$returnpage = page2($num, $line, $page_line, $start, $page, $search);
//$mt = $empire->fetch1("select sum(money) as 'ScrTotal' from {$dbtbpre}enewsbuybak $where");

//----------渠道
$ingroup = '';
//$inmsql = $empire->query("select * from {$dbtbpre}enewsingroup order by myorder");
//while ($inm_r = $empire->fetch($inmsql)) {
//    if ($_GET['fromadd'] == $inm_r['gname']) {
//        $select = " selected";
//    } else {
//        $select = "";
//    }
//    $ingroup .= "<option value='" . $inm_r['gname'] ."'" . $select . ">" . $inm_r['gname'] . "</option>";
//}
for($i=1;$i<3;$i++){
    if ($_GET['fromadd'] == $i) {
        $select = " selected";
    } else {
        $select = "";
    }
    if($i == 1){
        $class = '充值';
    }else{
        $class = '打赏';
    }
    $ingroup .= "<option value='" . $i ."'" . $select . ">" . $class . "</option>";
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
    <form name="form2" method="GET" action='ListPayRecordYong.php'>
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
                        <option value="0">出入类型</option>
                        <?= $ingroup ?>
                    </select>
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
            <td width="10%">操作时间</td>
            <td width="10%">渠道</td>
            <td width="10%">现金积分出入类型</td>
            <td width="8%">账号</td>
            <td width="8%">手机号码</td>
            <td width="8%">现金</td>
            <td width="8%">积分</td>
            <td width="8%">充值类型</td>
            <td width="8%">是否app用户</td>
            <td width="8%">是否支付成功</td>
        </tr>
        <?php
        /*while ($r = $empire->fetch($sql)) {
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
            */?><!--
            <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'"
                onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td><div align="center"><?/*=$r[buytime]*/?></div></td>
                <td><div align="center"><?/*=$r[fromadd]*/?></div></td>
                <td><div align="center">充值</div></td>
                <td><div align="center"><?/*=$r[username]*/?></div></td>
                <td><div align="center"></div></td>
                <td><div align="center"><?/*=$r[money]*/?></div></td>
                <td><div align="center">微信支付</div></td>
                <td><div align="center">是</div></td>
                <td><div align="center">是</div></td>
            </tr>
            --><?/*
        }*/

        foreach($all as $val) {

            ?>
            <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'"
                onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="25"><input name="id[]" type="checkbox" id="id[]" value="<?= $r[id] ?>"></div></td>
                <td><div align="center"><?= date("Y-m-d H:i:s",$val[buytime])?></div></td>
                <td><div align="center"><?=$val[fromadd]?></div></td>
                <td>
                    <div align="center">
                        <?php   if($val['class'] > 1){
                            echo '打赏';
                        }else{
                            echo '充值';
                        } ?>
                    </div>
                </td>
                <td><div align="center"><?=$val[username]?></div></td>
                <td><div align="center"></div></td>
                <td><div align="center"><?=$val[money]?></div></td>
                <td><div align="center"><?=$val[cardfen]?></div></td>
                <td><div align="center">微信支付</div></td>
                <td><div align="center">是</div></td>
                <td><div align="center">是</div></td>
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