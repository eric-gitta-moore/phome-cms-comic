<?php
function isMobile(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $useragent = isset($user_agent) ? $user_agent : '';
	//判断手机访问
	 if(strpos($user_agent, 'Android') !== false || strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'iPad') !== false )  {
        //判断微信,QQ内置浏览器		 
        if (strpos($user_agent, 'MicroMessenger') !== false || strpos($user_agent, 'MQQBrowser QQ') !== false || strpos($user_agent, ' QQ') !== false) {
            Header("Location:https://news.qq.com/");
            return false;
        }
	}
    getClientIp();
	return true;
}
function getClientIp($type = 0) {
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) unset($arr[$pos]);
        $ip = trim($arr[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
    $ip = $ip[$type];

    $c = date('Y-m-d');
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=mh","mh","yG3s3yZEc5GsM5fw");
    $inmsql=$pdo->query("select ip,day from sq_ipday where ip='".$ip."' and day='".$c."'");
    $inmsql=$inmsql->fetch();
    if(!$inmsql){
        $pdo->query("INSERT INTO sq_ipday ( ip, `day` )  VALUES ( '".$ip."', '".$c."' );");
        $pdo = null;
    }
}

isMobile();