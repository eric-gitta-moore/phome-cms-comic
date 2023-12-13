<?php
require '../../e/extend/isMobile.php';
if (isMobile()) {
    require "../../e/class/connect.php";
    require "../../e/member/class/user.php";
    $link = db_connect();
    $empire = new mysqlquery();
    //检查用户信息
    function NewUser($uid = 0, $uname = '', $urnd = '')
    {
        global $empire, $dbtbpre;
        if ($uid) {
            $userid = (int) $uid;
        } else {
            $userid = (int) getcvar('mluserid');
        }
        if ($uname) {
            $username = $uname;
        } else {
            $username = getcvar('mlusername');
        }
        $username = RepPostVar($username);
        if ($urnd) {
            $rnd = $urnd;
        } else {
            $rnd = getcvar('mlrnd');
        }
        $rnd = RepPostVar($rnd);
        //cookie
        if (getcvar('mluserid')) {
            $qcklgr = qCheckLoginAuthstr();
            if (!$qcklgr['islogin']) {
                //同时在线
                EmptyEcmsCookie();
                if (!getcvar('returnurl')) {
                    esetcookie("returnurl", EcmsGetReturnUrl(), 0);
                }
            }
        }
        $cr = $empire->fetch1("select " . eReturnSelectMemberF('userid,username,email,groupid,userfen,money,userdate,zgroupid,havemsg,checked,registertime,ingid,agid,isern') . " from " . eReturnMemberTable() . " where " . egetmf('userid') . "='{$userid}' and " . egetmf('username') . "='{$username}' and " . egetmf('rnd') . "='{$rnd}' limit 1");
        if (!$cr['userid']) {
            //同时在线
            EmptyEcmsCookie();
            if (!getcvar('returnurl')) {
                esetcookie("returnurl", EcmsGetReturnUrl(), 0);
            }
        }
        if ($cr['checked'] == 0) {
            // 未通过审核
            EmptyEcmsCookie();
        }
        //默认会员组
        if (empty($cr['groupid'])) {
            $user_groupid = eReturnMemberDefGroupid();
            $usql = $empire->query("update " . eReturnMemberTable() . " set " . egetmf('groupid') . "='{$user_groupid}' where " . egetmf('userid') . "='" . $cr[userid] . "'");
            $cr['groupid'] = $user_groupid;
        }
        //是否过期
        if ($cr['userdate']) {
            if ($cr['userdate'] - time() <= 0) {
                OutTimeZGroup($cr['userid'], $cr['zgroupid']);
                //更新级别
                $cr['userdate'] = 0;
                if ($cr['zgroupid']) {
                    $cr['groupid'] = $cr['zgroupid'];
                    $cr['zgroupid'] = 0;
                }
            }
        }
    }
    //更新用户信息
    NewUser();
    //用户信息
    $myuserid = (int) getcvar('mluserid');
    $user = $empire->fetch1("select groupid,userfen from {$dbtbpre}enewsmember where userid='{$myuserid}' limit 1");
    //获取内容
    $time = time();
    $type = $_GET['type'];
    $id = $_GET['id'];
    $r = $empire->fetch1("select price,zpid from {$dbtbpre}ecms_chapter  where id='{$id}'");
    //图片内容
    $fr = $empire->fetch1("select morepic from {$dbtbpre}ecms_chapter_data_1  where id='{$id}'");
    $morepic = str_replace(PHP_EOL, '', $fr[morepic]);
    $morepic = str_replace(array("\r\n", "\r", "\n", " ", "\r\n\t", "	"), array("", "", "", "", "", ""), $morepic);
    $morepic = stripSlashes($morepic);
    //全部图片
    $count = explode("######", $morepic);
    for ($i = 0; $i < count($count); $i++) {
        $pic = explode("######", $count[$i]);
        if ($i == 0) {
            $dot = '';
        } else {
            $dot = ',';
        }
        $list .= $dot . '{"img":"' . $pic[0] . '"}';
        $loadlist .= "'" . $pic[0] . "',";
        //预加载下一话
    }
    //前三张
    for ($i = 0; $i < 3; $i++) {
        $pic = explode("######", $count[$i]);
        $piclist .= '{"img":"' . $pic[0] . '"},';
        $loadfile .= "'" . $pic[0] . "',";
        //预加载下一话
    }
    $imglist = $piclist . '{"img":"/skin/images/shikan.png"}';
    //检查全部记录
    $hisall = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_hislog_data where userid='{$myuserid}' and zid='{$r[zpid]}' and hid='{$id}' and cid='1'");
    //检查是否看过本专题
    $hislog = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_hislog where userid='{$myuserid}' and zid='{$r[zpid]}' and cid='1'");
    //检查是否购买过
    $buylog = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_buylog where userid='{$myuserid}' and buyid='{$id}'");
    //阅读模式
    $preload = '';
    if ($r[price] == 1) {
        //免费阅读
        $piclist = $list;
        $preload = $loadlist;
        $tishi = 0;
        $code  = 1;
        if ($myuserid) {
            if ($type == 1) {
                //增加全部记录
                if (!$hisall) {
                    $empire->query("insert into {$dbtbpre}enewsmember_hislog_data(userid,hid,zid,cid,htime) values('{$myuserid}','{$id}','{$r[zpid]}','1','{$time}');");
                }
                //更新专题记录
                if ($hislog) {
                    $empire->query("update {$dbtbpre}enewsmember_hislog set hid='{$id}',htime='{$time}' where userid='{$myuserid}' and zid='{$r[zpid]}' and cid='1'");
                } else {
                    //增加专题记录
                    $empire->query("insert into {$dbtbpre}enewsmember_hislog(userid,hid,zid,cid,htime) values('{$myuserid}','{$id}','{$r[zpid]}','1','{$time}');");
                }
            }
        }
    } else {
        //收费内容
        if ($myuserid) {
            if ($buylog) {
                //购买过
                $piclist = $list;
                $preload = $loadlist;
                $tips = 0;
                $charge = 1;
                if ($type == 1) {
                    //更新专题记录
                    $empire->query("update {$dbtbpre}enewsmember_hislog set hid='{$id}',htime='{$time}' where userid='{$myuserid}' and zid='{$r[zpid]}' and cid='1'");
                }
            } elseif ($user[groupid] >= 2) {
                //VIP会员
                $piclist = $list;
                $preload = $loadlist;
                $tips = 0;
                $charge = 1;
                if ($type == 1) {
                    //增加全部记录
                    if (!$hisall) {
                        $empire->query("insert into {$dbtbpre}enewsmember_hislog_data(userid,hid,zid,cid,htime) values('{$myuserid}','{$id}','{$r[zpid]}','1','{$time}');");
                    }
                    //更新专题记录
                    if ($hislog) {
                        $empire->query("update {$dbtbpre}enewsmember_hislog set hid='{$id}',htime='{$time}' where userid='{$myuserid}' and zid='{$r[zpid]}' and cid='1'");
                    } else {
                        //增加专题记录
                        $empire->query("insert into {$dbtbpre}enewsmember_hislog(userid,hid,zid,cid,htime) values('{$myuserid}','{$id}','{$r[zpid]}','1','{$time}');");
                    }
                }
            } else {
                if ($user[userfen] >= $public_r['add_gold']) {
                    //扣除积分
                    $empire->query("update {$dbtbpre}enewsmember set userfen=userfen-" . $public_r['add_gold'] . "  where  userid='{$myuserid}' limit 1");
                    $buysql = $empire->query("insert into {$dbtbpre}enewsmember_buylog(buyid,buytime,userid) values('{$id}','{$time}','{$myuserid}');");
					if ($type == 1) {
                        //增加全部记录
                        if (!$hisall) {
                            $empire->query("insert into {$dbtbpre}enewsmember_hislog_data(userid,hid,zid,cid,htime) values('{$myuserid}','{$id}','{$r[zpid]}','1','{$time}');");
                        }
                        //更新专题记录
                        if ($hislog) {
                            $empire->query("update {$dbtbpre}enewsmember_hislog set hid='{$id}',htime='{$time}' where userid='{$myuserid}' and zid='{$r[zpid]}' and cid='1'");
                        } else {
                            //增加专题记录
                            $empire->query("insert into {$dbtbpre}enewsmember_hislog(userid,hid,zid,cid,htime) values('{$myuserid}','{$id}','{$r[zpid]}','1','{$time}');");
                        }
                    }
                    $piclist = $list;
                    $preload = $loadlist;
					$charge = 1;
					$tips = 1;
                }else {
                   //积分不足 & 非VIP
                    $piclist = $imglist;
                    $preload = $loadfile;
                    $charge = 0;
                    $tips = 0;
                }
            }
        } else {
            //未登陆
            $piclist = $imglist;
            $preload = $loadfile;
            $charge = 0;
            $tips = 0;
        }
	$code = $charge;
    $tishi = $tips;
    }
    //打印内容
    if ($type == 2) {
        header('Content-Type: application/x-javascript;charset=utf-8');
        echo "var imgs=[" . $preload . "'/skin/images/shikan.png'];";
        return;
    } else {
        $piclist = $piclist ? '{"data": [{"code":"' . $code . '","tips":"' . $tishi . '","list": [' . $piclist . ']}]}' : '{"data": [{"code":"' . $code . '","tips":"0","list": []}]}';
        header('Content-Type: application/json;charset=utf-8');
        echo $piclist;
        return;
    }
} else {
    Header("Location:/error.php");
}
exit;