<?php
require '../../e/extend/isMobile.php';
if (isMobile()) {
    require "../../e/class/connect.php";
    $link = db_connect();
    $empire = new mysqlquery();
    $editor = 1;
    $type = $_GET['type'];
    $id = $_GET['id'];
    $cid = $_GET['cid'];
    $zid = $_GET['zid'];
    $nid = $_GET['nid'];
    $tbr = $empire->fetch1("select tbname from {$dbtbpre}enewsclass where classid='{$cid}'");
    if ($type == 2) {
        //连载上下话
        $mh = $empire->fetch1("select id,classid from {$dbtbpre}ecms_comic where zpid='{$zid}' limit 1");
        $num = $empire->gettotal("select count(*) as total from  {$dbtbpre}ecms_chapter where zpid='{$zid}'");
        $Next = $empire->fetch1("select titleurl,id from {$dbtbpre}ecms_chapter where zpid='{$zid}' and num>{$nid} order by num ASC limit 1");
        $Per = $empire->fetch1("select titleurl,id from {$dbtbpre}ecms_chapter where zpid='{$zid}' and num<{$nid} order by num desc limit 1");
        if ($Per['titleurl']) {
            $perurl = $Per[titleurl];
        } else {
            $perurl = $public_r['newsurl'] . 'comic/' . $mh[id] . '/';
        }
        if ($Next['titleurl']) {
            $nexturl = $Next['titleurl'];
			$nextnum=$Next['id'];
        } else {
            $nexturl = $public_r['newsurl'] . 'comic/' . $mh[id] . '/';
			$nextnum=0;
        }
		header('Content-Type: application/x-javascript;charset=utf-8');
        echo '$("#pre,.prev").attr("href","' . $perurl . '");$("#next,.next").attr("href","' . $nexturl . '");$("#num").text("' . $num . '");var nextnum='.$nextnum.';';
    } elseif ($type == 3) {
        //短漫&小说上下篇
        $Next = $empire->fetch1("select titleurl from {$dbtbpre}ecms_{$tbr[tbname]} where id>{$id} order by id ASC");
        $Per = $empire->fetch1("select titleurl from {$dbtbpre}ecms_{$tbr[tbname]} where id<{$id} order by id DESC");
        $one = $empire->fetch1("select titleurl from {$dbtbpre}ecms_{$tbr[tbname]} order by id DESC");
        $last = $empire->fetch1("select titleurl from {$dbtbpre}ecms_{$tbr[tbname]} order by id ASC");
        if ($Per['titleurl']) {
            $perurl = $Per['titleurl'];
        } else {
            $perurl = $one['titleurl'];
        }
        if ($Next['titleurl']) {
            $nexturl = $Next['titleurl'];
        } else {
            $nexturl = $last['titleurl'];
        }
		header('Content-Type: application/x-javascript;charset=utf-8');
        echo '$("#pre,.prev").attr("href","' . $perurl . '");$("#next,.next").attr("href","' . $nexturl . '");';
    } elseif ($type == 4) {
        //短漫&小说侧边列表
        $persql = $empire->query("select * from {$dbtbpre}ecms_{$tbr[tbname]} order by id ASC limit {$id},20");
        while ($perr = $empire->fetch($persql)) {
            $plist .= ',{"url":"' . $perr[titleurl] . '","name":"' . $perr[title] . '","id":"' . $perr[id] . '"}';
        }
        if ($id <= 4) {
            $pli = 0;
        } else {
            $pli = $id - 4;
        }
        $nextsql = $empire->query("select * from {$dbtbpre}ecms_{$tbr[tbname]} where id<{$id} order by id ASC limit {$pli},3");
        while ($nextr = $empire->fetch($nextsql)) {
            $nlist .= '{"url":"' . $nextr[titleurl] . '","name":"' . $nextr[title] . '","id":"' . $nextr[id] . '"},';
        }
        $bqr = $empire->fetch1("select * from {$dbtbpre}ecms_{$tbr[tbname]} where id='{$id}'");
        $dlist = '{"url":"' . $bqr[titleurl] . '","name":"<b>' . $bqr[title] . '</b>","id":"' . $bqr[id] . '"}';
        $list = $nlist . $dlist . $plist;
        header('Content-Type: application/json;charset=utf-8');
        echo $_GET['callback'] . '({"data": [{"list": [' . $list . ']}]})';
    } elseif ($type == 5) {
        //连载侧边列表	
        $bqr = $empire->fetch1("select zpid from {$dbtbpre}ecms_{$tbr[tbname]} where id='{$id}'");
		$comic = $empire->fetch1("select jindu,titleurl,up from {$dbtbpre}ecms_comic where zpid='{$bqr[zpid]}'");
        $listsql = $empire->query("select titleurl,title,id from {$dbtbpre}ecms_{$tbr[tbname]} where zpid='{$bqr[zpid]}' order by num ASC");
        while ($row = $empire->fetch($listsql)) {
			if($row[id]==$id) { 
				$name='<b>'.$row[title].'</b>';
				} else { 
				$name=$row[title]; 
			}
            $list .= '{"url":"' . $row[titleurl] . '","name":"' . $name . '","id":"' . $row[id] . '"},';
        }
        header('Content-Type: application/json;charset=utf-8');
		if($comic[jindu]==1) { 
			require "../../e/class/userfun.php";
			$name='未完，连载中 ('.get_infoval('up',$comic[up]).')';
			} else { 
			$name='全集已完结'; 
		}
        echo '{"data": [{"list": [' . $list . '{"url":"' . $comic[titleurl] . '","name":"' . $name . '","id":"' . $comic[id] . '"}]}]}';
        }else {
           return;
        }
    return;
} else {
    Header("Location:/error.php");
}