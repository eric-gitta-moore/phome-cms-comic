<?php
require '../class/connect.php';
$link = db_connect();
$empire = new mysqlquery();
$action = $_GET['action'];
$classid = $_GET[classid];
$id = $_GET[id];
$type = $_GET[type];
$num = $_GET[num];
$cr = $empire->fetch1("select tbname from {$dbtbpre}enewsclass where classid='" . $classid . "'");
$tbname = $cr['tbname'];
$r = $empire->fetch1("select * from {$dbtbpre}ecms_" . $tbname . " where id='{$id}' limit 1");
$time = time();
$cookiename = 'like_' . $id;
if ($num == 'digg') {
    echo $r[diggtop];
} elseif ($type) {
    if ($type == 'like') {
        $like = $r[diggtop];
        if (getcvar($cookiename)) {
            $like = $r[diggtop];
            $code = 'on';
            $count = '<a class="ok"><i></i><span>好看<em>(' . $like . ')</em></span></a>';
            $msg = '表态过了';
            $status = '2';
        } else {
            $empire->query("update {$dbtbpre}ecms_" . $tbname . " set diggtop=diggtop+1  where  id='{$id}' limit 1");
            $like = $r[diggtop] + 1;
            $code = 'yes';
            $count = '<a class="ok"><i></i><span>好看<em>(' . $like . ')</em></span></a>';
            $msg = '好看+1';
            $status = '1';
            esetcookie($cookiename, '1', time() + 86400);
        }
    }
    $json = array('status' => $status, 'msg' => $msg, 'code' => $code, 'count' => $count);
    $jsond = json_encode($json);
    echo $_GET['callback'] . '(' . $jsond . ')';
    return;
}
db_close();
$empire = null;