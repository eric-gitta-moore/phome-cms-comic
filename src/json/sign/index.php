<?php
require '../../e/extend/isMobile.php';
if (isMobile()) {
    require "../../e/class/connect.php";
    require "../../e/member/class/user.php";
    $link = db_connect();
    $empire = new mysqlquery();
    $myuserid = (int) getcvar('mluserid');
    $type = $_GET[type];
    if ($myuserid) {
        //查询签到情况
        $r = $empire->fetch1("select * from {$dbtbpre}enewsmember_sign where userid='{$myuserid}' limit 1");
		$today = date('Ymd');
        $lastdate = date('Ymd', $r[lastdate]);
        if ($type == 'check') {
            //新用户添加记录
            $record = $empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_sign where userid='{$myuserid}'");
            if (!$record) {
                $empire->query("insert into {$dbtbpre}enewsmember_sign(userid,even,lastdate,record) values('{$myuserid}','0','0','');");
            }
            $even = $r[even];
            $lay =(strtotime($today)-strtotime($lastdate))/86400;
            if ($lay >= 2) {
                //断签
                $empire->query("update {$dbtbpre}enewsmember_sign set even=0 where userid='{$myuserid}'");
                $login = 1;
                $even = 0;
            } elseif ($today > $lastdate) {
                //正常签到
                $login = 1;
            } else {
                //已签到
                $login = 2;
				if ($even == 30) {
                	$reward = $public_r['add_sign30'];
            	} elseif ($even == 15) {
                	$reward = $public_r['add_sign15'];
            	} elseif ($even == 7) {
                	$reward = $public_r['add_sign7'];
            	} else {
                	$reward = $public_r['add_reward'];
            	}
            }
        } elseif ($type == 'sign') {
            //签到奖励          
            if ($today > $lastdate) {
				$time = time();
				$day=date('d');
                $record = $r[record] . $day . '#';
                $empire->query("update {$dbtbpre}enewsmember_sign set even=even+1,record='{$record}',lastdate='{$time}' where userid='{$myuserid}'");
                $even = $r[even] + 1;
                if ($even == 30) {
                    //30天奖励
                    $empire->query("update {$dbtbpre}enewsmember set userfen=userfen+{$public_r[add_sign30]} where userid='{$myuserid}'");
					$reward = $public_r['add_sign30'];
					//重新计算
                    $sql = $empire->query("update {$dbtbpre}enewsmember_sign set even=0 where userid='{$myuserid}'");
                } elseif ($even == 15) {
                    //15天奖励
                    $empire->query("update {$dbtbpre}enewsmember set userfen=userfen+{$public_r[add_sign15]} where userid='{$myuserid}'");
                    $reward = $public_r['add_sign15'];
                } elseif ($even == 7) {
                    //7天奖励
                    $empire->query("update {$dbtbpre}enewsmember set userfen=userfen+{$public_r[add_sign7]} where userid='{$myuserid}'");
                    $reward = $public_r['add_sign7'];
                } else {
                    //日常奖励
                    $empire->query("update {$dbtbpre}enewsmember set userfen=userfen+{$public_r[add_reward]} where userid='{$myuserid}'");
                    $reward = $public_r['add_reward'];
                }
				//月末清空记录
				$month = date('Y-m-01', strtotime(date("Y-m-d")));
                $lastday = date('d', strtotime("{$month} +1 month -1 day"));
				if ($day == $lastday) {				
                    $sql = $empire->query("update {$dbtbpre}enewsmember_sign set record='' where userid='{$myuserid}'");
                }
				//成功状态
                $status = 1;
            } else {
                $even = $r[even];
                $status = 2;
            }
        } else {
            exit;
        }
    } else {
        //未登陆
        $login = 3;
        $even = 0;
    }
    //输出数据
    header('Content-Type: application/x-javascript;charset=utf-8');
    echo '{"login":"' . $login . '","even":"' . $even . '","reward":"' . $reward . '","st":"' . $status . '"}';
    exit;
} else {
    Header("Location:/error.php");
    exit;
}