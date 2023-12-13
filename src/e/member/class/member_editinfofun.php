<?php
//修改安全信息
function EditSafeInfo($add)
{
    global $empire, $dbtbpre, $public_r;
    $user_r = islogin();
    //是否登陆
    $userid = $user_r[userid];
    $username = $user_r[username];
    $rnd = $user_r[rnd];
    $mail = $_POST['mail'];
    $ajax = $_POST['ajax'];
    //邮箱是否为空
    if ($mail == 'no') {
    } else {
        $email = trim($add['email']);
        if (!$email || !chemail($email)) {
            if ($ajax) {
                die('1');
            } else {
                printerror("EmailFail", "history.go(-1)", 1);
            }
        }
        $email = addslashes(RepPostStr($email));
        $email = RepPostVar($email);
    }
    //验证原密码
    $oldpassword = RepPostVar($add[oldpassword]);
    if (!$oldpassword) {
        if ($ajax) {
            die('2');
        } else {
            printerror('FailOldPassword', '', 1);
        }
    }
    $add[password] = RepPostVar($add[password]);
    $num = 0;
    $ur = $empire->fetch1("select " . eReturnSelectMemberF('userid,password,salt') . " from " . eReturnMemberTable() . " where " . egetmf('userid') . "='{$userid}'");
    if (empty($ur['userid'])) {
        if ($ajax) {
            die('3');
        } else {
            printerror('FailOldPassword', '', 1);
        }
    }
    if (!eDoCkMemberPw($oldpassword, $ur['password'], $ur['salt'])) {
        if ($ajax) {
            die('3');
        } else {
            printerror('FailOldPassword', '', 1);
        }
    }
    //检查邮箱唯一性
    if ($mail == 'no') {
    } else {
        $pr = $empire->fetch1("select regemailonly from {$dbtbpre}enewspublic limit 1");
        if ($pr['regemailonly']) {
            $num = $empire->gettotal("select count(*) as total from " . eReturnMemberTable() . " where " . egetmf('email') . "='{$email}' and " . egetmf('userid') . "<>'{$userid}' limit 1");
            if ($num) {
                if ($ajax) {
                    die('6');
                } else {
                    printerror("ReEmailFail", "history.go(-1)", 1);
                }
            }
        }
    }
    //密码
    $a = '';
    $salt = '';
    $truepassword = '';
    if ($add[password]) {
        if ($add[password] !== $add[repassword]) {
            if ($ajax) {
                die('5');
            } else {
                printerror('NotRepassword', 'history.go(-1)', 1);
            }
        }
        $salt = eReturnMemberSalt();
        $password = eDoMemberPw($add[password], $salt);
		if ($mail == 'no') {	
			  $a =  "edit='1'," . egetmf('password') . "='{$password}'," . egetmf('salt') . "='{$salt}'";
    	} else {
        	  $a = ", edit='1'," . egetmf('password') . "='{$password}'," . egetmf('salt') . "='{$salt}'";
		}
        $truepassword = $add[password];
    }
	if ($mail == 'no') {	
		 $sql = $empire->query("update " . eReturnMemberTable() . " set " . $a . " where " . egetmf('userid') . "='{$userid}'");	 
    } else {
         $sql = $empire->query("update " . eReturnMemberTable() . " set " . egetmf('email') . "='{$email}'" . $a . " where " . egetmf('userid') . "='{$userid}'");
	}
    if ($sql) {
        //易通行系统
        DoEpassport('editpassword', $userid, $username, $truepassword, $salt, $email, $user_r['groupid'], '');
        if ($ajax) {
            die('7');
        } else {
            printerror("EditInfoSuccess", "../member/EditInfo/EditSafeInfo.php", 1);
        }
    } else {
        if ($ajax) {
            die('99');
        } else {
            printerror("DbError", "history.go(-1)", 1);
        }
    }
}
//个人信息修改
function EditInfo($post)
{
    global $empire, $dbtbpre, $public_r;
    $user_r = islogin();
    //是否登陆
    $userid = $user_r[userid];
    $username = $user_r[username];
    $dousername = $username;
    $rnd = $user_r[rnd];
    $groupid = $user_r[groupid];
    $email = $_POST['email'];
    $ajax = $_POST['ajax'];
    if (!$userid || !$username) {
        if ($ajax) {
            die('2');
        } else {
            printerror("NotEmpty", "history.go(-1)", 1);
        }
    }
    //验证附加表必填项
    $addr = $empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='{$userid}'");
    $user_r = $empire->fetch1("select " . eReturnSelectMemberF('groupid') . " from " . eReturnMemberTable() . " where " . egetmf('userid') . "='{$userid}'");
    $fid = GetMemberFormId($user_r['groupid']);
    if (empty($addr[userid])) {
        $mr['add_filepass'] = $userid;
        $member_r = ReturnDoMemberF($fid, $post, $mr, 0, $dousername);
    } else {
        $addr['add_filepass'] = $userid;
        $member_r = ReturnDoMemberF($fid, $post, $addr, 1, $dousername);
    }
    //附加表
    if (empty($addr[userid])) {
        //IP
        $regip = egetip();
        $regipport = egetipport();
        $lasttime = time();
        $sql = $empire->query("insert into {$dbtbpre}enewsmemberadd(userid,regip,lasttime,lastip,loginnum,regipport,lastipport" . $member_r[0] . ") values('{$userid}','{$regip}','{$lasttime}','{$regip}',1,'{$regipport}','{$regipport}'" . $member_r[1] . ");");
    } else {
        $sql = $empire->query("update {$dbtbpre}enewsmemberadd set userid='{$userid}'" . $member_r[0] . " where userid='{$userid}'");
        //修改主表邮箱
        if ($email) {
            $pr = $empire->fetch1("select regemailonly from {$dbtbpre}enewspublic limit 1");
            if ($pr['regemailonly']) {
                $num = $empire->gettotal("select count(*) as total from " . eReturnMemberTable() . " where " . egetmf('email') . "='{$email}' and " . egetmf('userid') . "<>'{$userid}' limit 1");
                if ($num) {
                    if ($ajax) {
                        die('3');
                    } else {
                        printerror("ReEmailFail", "history.go(-1)", 1);
                    }
                } 
            }
			 $sql = $empire->query("update {$dbtbpre}enewsmember set email='{$email}' where userid='{$userid}'");
        }
    }
    //更新附件
    UpdateTheFileEditOther(6, $userid, 'member');
    if ($sql) {
        if ($ajax) {
            die('1');
        } else {
            printerror("EditInfoSuccess", "../member/EditInfo/", 1);
        }
    } else {
        if ($ajax) {
            die('4');
        } else {
            printerror("DbError", "history.go(-1)", 1);
        }
    }
}