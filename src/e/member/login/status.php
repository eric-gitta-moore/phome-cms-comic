<?php
require "../../class/connect.php";
require "../class/user.php";
$link = db_connect();
$empire = new mysqlquery();
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
	if ($_GET['in']==1) {
        if (!$userid || !$username || !$rnd) {
            echo '0';
            //未登陆
        } else {
            echo '1';
            //已登陆
        }
	}
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
NewUser();
db_close();
$empire = null;