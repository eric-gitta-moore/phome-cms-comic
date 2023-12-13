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
		$num = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsfava where userid='{$myuserid}'");
        $page = (int) $_GET['page'] - 1;
        $line = (int) $_GET['line'];    
        $totalPage = ceil($num / $line);
        if (!isset($page)) {
            $page = 0;
        }
        $startCount = $page * $line;
        //收藏记录
        $sql = $empire->query("select * from {$dbtbpre}enewsfava where userid='{$myuserid}' order by favatime desc limit {$startCount},{$line}");
        $list = "";
        $i = 0;
        while ($r = $empire->fetch($sql)) {
            if ($i == 0) {$on = '';} else {$on = ',';}
            $mh = $empire->fetch1("select * from {$dbtbpre}ecms_comic where id='{$r['id']}'");	
            $new = $empire->fetch1("select num,newstime from {$dbtbpre}ecms_chapter where zpid='{$mh[zpid]}' order by num desc");			
            $jl = $empire->fetch1("select hid,htime from {$dbtbpre}enewsmember_hislog where userid='{$myuserid}' and zid='{$mh[zpid]}' order by id desc");
			if ($jl[hid]) {
				$zj = $empire->fetch1("select num,titleurl from {$dbtbpre}ecms_chapter where id='{$jl[hid]}'");
				$url= $zj[titleurl];
                $hua = $zj[num];
            } else {
				$url= $mh[titleurl];
                $hua = '0';
            }
            if ($jl[htime] < $new[newstime]) {
                $up = 'true';
            } else {
                $up = '-1';
            }
            $list .= $on . '{"Id": "' . $mh[id] . '","UserBookId": "' . $r[favid] . '","LinkUrl": "' . $url . '","ImgUrl": "' . $mh[titlepic] . '","Title": "' . $mh[title] . '","Progress":"' . $hua . '","IsUpdate": "' . $up . '","LChapter": "' . $new[num] . '","age": "' . $mh[age] . '","tc": "'.get_ticai($mh[ticai],0).'","up": "'.get_infoval('up',$mh[up]).'","CIndex": "1"}';
            $i++;
        }
    }
    //小编推荐
    if ($num) {
        $tlist = "";		
    } else {
        $tui = $empire->query("select * from {$dbtbpre}ecms_comic where firsttitle=1 or isgood=1 order by newstime desc limit 5");
        $i = 0;
        while ($bqr = $empire->fetch($tui)) {
            if ($i == 0) {$on = '';} else {$on = ',';}
            $new = $empire->fetch1("select num from {$dbtbpre}ecms_chapter where zpid=" . $bqr['zpid'] . " order by num desc");
            $tlist .= $on . '{"Id": ' . $bqr[id] . ',"UserBookId":  -1,"LinkUrl": "' . $bqr[titleurl] . '","ImgUrl": "' . $bqr[titlepic] . '","Title": "' . $bqr[title] . '","Progress": 0,"IsUpdate": 0,"LChapter": "' . $new[num] . '","age": "' . $bqr[age] . '","tc": "'.get_ticai($bqr[ticai],0).'","up": "'.get_infoval('up',$bqr[up]).'","CIndex": 0}';
            $i++;
        }
		$num='5';
    }
    //输出数据
	header('Content-Type: application/json;charset=utf-8');	
    echo $_GET['callback'] . '{"code":0,"total":' . $num . ',"data":[' . $list . $tlist . ']}';
    db_close();
    $empire = null;
} else {
    Header("Location:/error.php");
}