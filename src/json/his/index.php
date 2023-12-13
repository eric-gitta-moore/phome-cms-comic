<?php
require '../../e/extend/isMobile.php';
if (isMobile()) {
    require "../../e/class/connect.php";
	require "../../e/class/userfun.php";
    require "../../e/class/db_sql.php";
    require "../../e/member/class/user.php";
    $link = db_connect();
    $empire = new mysqlquery();
    $myuserid = (int) getcvar('mluserid');
    if ($myuserid) {
		$num = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_hislog where userid='{$myuserid}'");
        $page = (int) $_GET['page'] - 1;
        $line = (int) $_GET['line'];    
        $totalPage = ceil($num / $line);
        if (!isset($page)) {
            $page = 0;
        }
        $startCount = $page * $line;
        //浏览记录
        $sql = $empire->query("select * from {$dbtbpre}enewsmember_hislog where userid='{$myuserid}' order by htime desc limit {$startCount},{$line}");
        $list = "";
        $i = 0;
        while ($r = $empire->fetch($sql)) {
            if ($i == 0) {$on = '';} else {$on = ',';}
            $mh = $empire->fetch1("select * from {$dbtbpre}ecms_comic where zpid='{$r['zid']}'");		
            $new = $empire->fetch1("select num,newstime,titleurl from {$dbtbpre}ecms_chapter where zpid='{$mh[zpid]}' order by num desc");
			$zj = $empire->fetch1("select num,titleurl from {$dbtbpre}ecms_chapter where id='{$r[hid]}'");
            if ($r[htime] < $new[newstime]) {
                $up = 'true';
            } else {
                $up = '-1';
            }
             $list .= $on . '{"Id": "' . $r[id] . '","UserBookId": "' . $r[favid] . '","LinkUrl": "' .  $zj[titleurl] . '","ImgUrl": "' . $mh[titlepic] . '","Title": "' . $mh[title] . '","Progress":"' . $zj[num] . '","IsUpdate": ' . $up . ',"LChapter": "' . $new[num] . '","age": "' . $mh[age] . '","tc": "'.get_ticai($mh[ticai],0).'","up": "'.get_infoval('up',$mh[up]).'","CIndex": "1"}';
            $i++;
        }
    }
    //输出数据
	header('Content-Type: application/json;charset=utf-8');	
    echo $_GET['callback'] . '{"code":0,"total":' . $num . ',"data":[' . $list . ']}';
    db_close();
    $empire = null;
} else {
    Header("Location:/error.php");
}