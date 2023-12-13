<?php
//接收异步通知请求demo文件
//签名算法库
include('sign1.php');
require('../../class/connect.php');
require("../../class/db_sql.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//商户名称
$account_name  = $_POST['account_name'];
//支付时间戳
$pay_time  = $_POST['pay_time'];
//支付状态
$status  = $_POST['status'];
//支付金额
$amount  = $_POST['amount'];
//支付时提交的订单信息
$out_trade_no  = $_POST['out_trade_no'];
//平台订单交易流水号
$trade_no  = $_POST['trade_no'];
//该笔交易手续费用
$fees  = $_POST['fees'];
//签名算法
$sign  = $_POST['sign'];
//回调时间戳
$callback_time  = $_POST['callback_time'];
//支付类型
$type = $_POST['type'];
//商户KEY（S_KEY）
$account_key = $_POST['account_key'];
//用户ID
$userid = $_GET["user"];


//第一步，检测商户KEY是否一致
if ($account_key != '3276F40FAF2DBA') exit('error:key');
//第二步，验证签名是否一致
if (sign('3276F40FAF2DBA', ['amount'=>$amount,'out_trade_no'=>$out_trade_no]) != $sign) exit('error:sign');


//下面就可以安全的使用上面的信息给贵公司平台进行入款操作
$data = $empire->fetch1("select * from {$dbtbpre}enewsbuybak where card_no='" . $out_trade_no . "' limit 1");

        if ($data) {
        	echo 'success';
        }
        //检查用户
        $user = $empire->fetch1("select * from {$dbtbpre}enewsmember where userid='" . $userid . "' limit 1");
        if (!$user || empty($user)) {
        	exit('error:user,id:' . $userid);
        }
        
        $flooramount = floor($amount);
        if($flooramount < $amount){
        	$amount = $flooramount + 1;
        }
        
        //检查购买充值类型，对应金额
        $card = $empire->fetch1("select * from {$dbtbpre}enewsbuygroup where gmoney='" . $amount . "' limit 1");
        if (!$card || empty($card)) {
            exit('error:user,money:' . $amount);
        }
        
        //备份记录
		$paytype = substr($out_trade_no,0,3);//通道类型
        BakBuy($user['userid'], $user['username'], $out_trade_no, $card['gfen'], $card['gmoney'], $card['gdate'], $paytype);
        //执行充值
        eAddFenToUser($card['gfen'], $card['gdate'], $card['ggroupid'], $card['gzgroupid'], $user);
echo 'success';

//测试时，将来源请求写入到txt文件，方便分析查看
file_put_contents("callback_log.txt", json_encode($_POST) . $userid );