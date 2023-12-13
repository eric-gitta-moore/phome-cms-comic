<?php
require "../../../e/class/connect.php";
require "../../../e/member/class/user.php";
$link = db_connect();
$empire = new mysqlquery();
$editor = 1;
$myuserid = (int) getcvar('mluserid');
$type = (int) $_GET['type'];
$r = ReturnUserInfo($myuserid);
$id = (int) $_GET['id'];
$classid = (int) $_GET['classid'];
$logid = (int) $_GET['logid'];
$time = date("Y-m-d H:i:s");
if ($type == 2) {
    header('Content-Type: application/json;charset=utf-8');
    $bqr = $empire->fetch1("select diggtop from {$dbtbpre}ecms_comic where id='{$id}' and classid='{$classid}'");
    echo '{"diggtop": "(' . $bqr[diggtop] . ')"';
    if ($myuserid) {
        $favnum = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsfava where userid='{$myuserid}' and id='{$id}' and classid='{$classid}'");
        $favour = 0;
        if ($favnum) {
            $favour = 1;
        }
        echo ',"favour": "' . $favour . '"';
    }
    echo '}';
    exit;
}
if ($_GET['btn'] == 'yes') {
    if ($myuserid) {
        if ($type == 3) {
            $sql = $empire->query("insert into {$dbtbpre}enewsfava(id,logid,favatime,userid,username,classid,cid) values('{$id}','1','{$time}','{$myuserid}','{$r['username']}','{$classid}','0');");
            $empire->query("update {$dbtbpre}ecms_comic set favnum=favnum+1  where id='{$id}' and classid='{$classid}' limit 1");
            $code = 'yes';
        } elseif ($type == 4) {
            $sql = $empire->query("delete from  {$dbtbpre}enewsfava where userid='{$myuserid}' and id='{$id}' and classid='{$classid}' limit 1");
            $empire->query("update {$dbtbpre}ecms_comic set favnum=favnum-1  where id='{$id}' and classid='{$classid}' limit 1");
            $code = 'on';
        } else {
            $code = 'error';
        }
    } else {
        $code = 'error';
    }
    header('Content-Type: application/x-javascript;charset=utf-8');
    echo $code;
    exit;
}
db_close();
$empire = null;