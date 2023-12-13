<?php
require '../../extend/isMobile.php';
if (isMobile()) {
    require '../../class/connect.php';
	require eReturnTrueEcmsPath().'json/cache/MakeCache.php';
    require '../../class/db_sql.php';
    require '../../class/functions.php';
    require '../../class/t_functions.php';
    $link = db_connect();
    $empire = new mysqlquery();
    $searchid = (int) $_GET['searchid'];
    $page = (int) $_GET['page'];
    $perNumber = (int) $_GET['line'];
    $sor = $empire->fetch1("select * from {$dbtbpre}enewssearch where searchid=" . $searchid . " limit 1");
    $totalNumber = $empire->gettotal("select count(*) as total from {$dbtbpre}ecms_comic where title!='' {$sor[andsql]}");
    $totalPage = ceil($totalNumber / $perNumber);
    if (!isset($page)) {
        $page = 0;
    }
    $startCount = $page * $perNumber;
    $query = $empire->query("select * from {$dbtbpre}ecms_comic where title!='' {$sor[andsql]} order by newstime desc limit {$startCount},{$perNumber}");
    $list = "";
    $i = 0;
    while ($bqr = $empire->fetch($query)) {
        $on = '';
        if (!$i == 0) {
            $on = ',';
        }
        $new = $empire->fetch1("select num from {$dbtbpre}ecms_chapter where zpid='" . $bqr['zpid'] . "' order by num desc limit 1");
        if ($new[num] == 0) {
            $upstate = '预告篇';
        } elseif ($new[num] == 9999) {
            $upstate = '后记';
        } elseif ($new[num] == 99999) {
            $upstate = '停更';
        } else {
            $upstate = '更新:第' . $new[num] . '话';
        }
        $text = str_replace(array('"', "'"), array('“', '’'), $bqr[smalltext]);
        $list .= $on . '{"UpdateStatus":' . $bqr[jindu] . ',"Id": ' . $bqr[id] . ',"LChapter": "' . $upstate . '","ImgUrl": "' . $bqr[titlepic] . '","Title": "' . $bqr[title] . '","up": "' . get_infoval('up', $bqr[up]) . '","age": "' . $bqr[age] . '","tc": "' . get_ticai($bqr[ticai], 0) . '","Author": "' . $bqr[writer] . '","Summary": "' . $text . '","LinkUrl": "' . $bqr[titleurl] . '"}';
        $i++;
    }
    $list = $list ? '{"code": 0,"data": [' . $list . ']}' : '{"code": 0,"data": []}';
    header('Content-Type: application/json;charset=utf-8');
    echo $_GET['callback'] . $list;
    db_close();
    $empire = null;
} else {
    Header("Location:/error.php");
}