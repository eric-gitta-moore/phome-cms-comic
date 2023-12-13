<?php
function get_infoval($f,$val){
	global $public_r,$class_r,$empire,$dbtbpre;
	$r=array();	
	$r[age]=array('17'=>'青少年','18'=>'成年');
	$r[jindu]=array('1'=>'连载中','2'=>'已完结');
	$r[up]=array('1'=>'周一更','2'=>'周二更','3'=>'周三更','4'=>'周四更','5'=>'周五更','6'=>'周六更','7'=>'周日更','8'=>'不定时','9'=>'全集');
	return $r[$f][$val];
}
function get_ticai($val,$url){ 
    global $public_r;
    $val=substr($val,1,strlen($val)-2);	
	$r_tag = explode("|",$val);
	for ($i = 0; $i < count($r_tag); $i++) {
    	if ($r_tag[$i]) {			
    	    $name =str_replace(array("|","61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72"),array(",","剧情", "恋爱", "校园", "冒险", "恐怖", "惊悚", "BL", "搞笑", "动作", "科幻", "古风", "其他"),$r_tag[$i]);	
			if($url==1) {  
    	    $value.= "<a href='/cate/?type=" . $r_tag[$i] . "' class='tag blueTag'>" . $name . "</a>";
			 }else { 
			    $list.= $name . " / ";
			    $value=rtrim($list," / ");
			}
    	}
	}
	return $value;
}
?>