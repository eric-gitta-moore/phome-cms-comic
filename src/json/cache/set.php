<?php
//缓存存放目录
define('CACHE_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data');
//缓存时间 单位秒
define('CACHE_TIME', 86400 * 1);
//缓存文件后缀
define('CACHE_FIX', '.php');
//缓存开关
define('CACHE_CLOSE', false);
function getDirectorySize($path) {
    $totalsize = 0;
    $totalcount = 0;
    $dircount = 0;
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            $nextpath = $path . '/' . $file;
            if ($file != '.' && $file != '..' && !is_link($nextpath)) {
                if (is_dir($nextpath)) {
                    $dircount++;
                    $result = getDirectorySize($nextpath);
                    $totalsize+= $result['size'];
                    $totalcount+= $result['count'];
                    $dircount+= $result['dircount'];
                } elseif (is_file($nextpath)) {
                    $totalsize+= filesize($nextpath);
                    $totalcount++;
                }
            }
        }
    }
    closedir($handle);
    $total['size'] = $totalsize;
    $total['count'] = $totalcount;
    $total['dircount'] = $dircount;
    return $total;
}
function sizeFormat($size) {
    $sizeStr = '';
    if ($size < 1024) {
        return $size . " bytes";
    } else if ($size < (1024 * 1024)) {
        $size = round($size / 1024, 1);
        return $size . " KB";
    } else if ($size < (1024 * 1024 * 1024)) {
        $size = round($size / (1024 * 1024) , 1);
        return $size . " MB";
    } else {
        $size = round($size / (1024 * 1024 * 1024) , 1);
        return $size . " GB";
    }
}
/** 
 * 删除指定目录下的文件，不删除目录文件夹
 *
 * @param string $aimDir
 * @return boolean
 */
function unlinkDir($aimDir) {
    $aimDir = str_replace('', '/', $aimDir);
    $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
    if (!is_dir($aimDir)) {
        return false;
    }
    $dirHandle = opendir($aimDir);
    while (false !== ($file = readdir($dirHandle))) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        if (!is_dir($aimDir . $file)) {
            unlinkFile($aimDir . $file);
        } else {
            unlinkDir($aimDir . $file);
        }
    }
    closedir($dirHandle);
}
/** 
 * 删除文件
 *
 * @param string $aimUrl
 * @return boolean
 */
function unlinkFile($aimUrl) {
    if (file_exists($aimUrl)) {
        unlink($aimUrl);
        return true;
    } else {
        return false;
    }
}

function ShowMsg($msg, $gourl, $onlymsg = 0, $limittime = 0) {
	require("../../e/config/config.php");
	global $public_r;
    if ($limittime == 0) $litime = 1000;
    else $litime = $limittime;
    if ($gourl == "-1") {
        if ($limittime == 0) $litime = 5000;
        $gourl = "javascript:history.go(-2);";
    }
    if ($gourl == "" || $onlymsg == 1) {
        $msg = "<script>alert(\"" . str_replace("\"", "", $msg) . "\");</script>";
    } else {
        $func = "var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='javascript:history.go(-2);'; pgo=1; }
      }\r\n";
        $rmsg = $func;
        $rmsg.= "document.write(\"";
        if ($onlymsg == 0) {
            if ($gourl != "javascript:;" && $gourl != "") {
                $rmsg.= "<br/><br/><b>$msg</b><br><br/><a href='javascript:history.go(-2);'>如果你的浏览器没反应，请点击这里...</a>";
            }
            $rmsg.= "<br/><br/></div>\");\r\n";
            if ($gourl != "javascript:;" && $gourl != "") {
                $rmsg.= "setTimeout('JumpUrl()',$litime);";
            }
        } else {
            $rmsg.= "<br/><br/></div>\");\r\n";
        }
		$msg = $rmsg;
    }
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>信息提示</title>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body>
<br><br><br><br><br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder"><tr class="header"><td height="25"><div align="center">信息提示</div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="80"> 
      <div align="center">
	  <script>'.$msg.'</script>
	  </div></td>
  </tr>
</table>
</body>
</html>';
}
?>