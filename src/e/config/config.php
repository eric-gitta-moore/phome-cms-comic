<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
define('EmpireCMSConfig',TRUE);
$ecms_config=array();

//数据库设置
$ecms_config['db']['usedb']='mysqli';	//数据库类型
$ecms_config['db']['dbver']='5.0';	//数据库版本
$ecms_config['db']['dbserver']='localhost';	//数据库登录地址
$ecms_config['db']['dbport']='';	//端口，不填为按默认
$ecms_config['db']['dbusername']='mh';	//数据库用户名
$ecms_config['db']['dbpassword']='yG3s3yZEc5GsM5fw';	//数据库密码
$ecms_config['db']['dbname']='mh';	//数据库名
$ecms_config['db']['setchar']='utf8';	//设置默认编码
$ecms_config['db']['dbchar']='utf8';	//数据库默认编码
$ecms_config['db']['dbtbpre']='sq_';	//数据表前缀
$dbtbpre=$ecms_config['db']['dbtbpre'];	//数据表前缀
$ecms_config['db']['showerror']=1;	//显示SQL错误提示(0为不显示,1为显示)


//页面编码设置
$ecms_config['sets']['pagechar']='utf-8';	//安装帝国CMS的编码版本
$ecms_config['sets']['setpagechar']=1;	//页面默认字符集,0=关闭 1=开启
$ecms_config['sets']['elang']='gb';	//语言包

//后台相关配置
$ecms_config['esafe']['openonlinesetting']=3;	//开启后台在线配置参数(0为关闭,1为开启防火墙配置,2为开启安全配置,3为全开启)
$ecms_config['esafe']['openeditdttemp']=1;	//开启后台在线修改动态模板(0为关闭,1为开启)

//易通行系统配置
$ecms_config['epassport']['open']=0;	//是否开启易通行系统(1为开启，0为关闭)

//其它配置
$ecms_config['sets']['webdebug']=0;	//是否显示PHP错误提示(0为不显示,1为显示)
$ecms_config['sets']['timezone']='PRC';	//时区
$ecms_config['sets']['getiptype']=0;	//获取IP地址类型(0为自动,1为REMOTE_ADDR,2为HTTP_X_FORWARDED_FOR,3为HTTP_CLIENT_IP)
$ecms_config['sets']['ecmscachepath']=ECMS_PATH.'ecachefiles/';	//动态页面缓存文件存放目录
$ecms_config['sets']['ecmscachefiletype']='.html';	//动态页面缓存文件扩展名
$ecms_config['sets']['txtpath']=ECMS_PATH.'d/txt/';	//文本型数据存放目录
$ecms_config['sets']['saveurlimgclearurl']=0;	//远程保存图片自动去除图片的链接(0为保留,1为去除)
$ecms_config['sets']['deftempid']=0;	//默认模板组ID
$ecms_config['sets']['selfmoreportid']=0;	//当前网站访问端ID,0为主访问端



//-------EmpireCMS.Seting.member-------

//会员系统相关配置
$ecms_config['member']['tablename']="{$dbtbpre}enewsmember";	//会员表
$user_tablename=$ecms_config['member']['tablename'];	//会员表
$ecms_config['member']['changeregisterurl']="ChangeRegister.php";    //多会员组中转注册地址
$ecms_config['member']['registerurl']="";							//会员注册地址
$ecms_config['member']['loginurl']="";								//会员登录地址
$ecms_config['member']['quiturl']="";								//会员退出地址
$ecms_config['member']['chmember']=0;//是否使用原版会员表信息,0为原版,1为非原版
$ecms_config['member']['pwtype']=2;//密码保存形式,0为md5,1为明码,2为双重加密,3为16位md5
$ecms_config['member']['regtimetype']=1;//注册时间保存格式,0为正常时间,1为数值型
$ecms_config['member']['regcookietime']=0;//注册后登录保存时间(秒)
$ecms_config['member']['defgroupid']=0;//注册时会员组ID(ecms的会员组,0为后台默认)
$ecms_config['member']['saltnum']=6;//SALT随机码字符数
$ecms_config['member']['utfdata']=0;//数据是否是GBK编码,0为正常数据,1为GBK编码

$ecms_config['memberf']['userid']='userid';//用户ID字段
$ecms_config['memberf']['username']='username';//用户名字段
$ecms_config['memberf']['password']='password';//密码字段
$ecms_config['memberf']['rnd']='rnd';//随机密码字段
$ecms_config['memberf']['email']='email';//邮箱字段
$ecms_config['memberf']['registertime']='registertime';//注册时间字段
$ecms_config['memberf']['groupid']='groupid';//会员组字段
$ecms_config['memberf']['userfen']='userfen';//积分字段
$ecms_config['memberf']['userdate']='userdate';//有效期字段
$ecms_config['memberf']['money']='money';//帐户余额字段
$ecms_config['memberf']['zgroupid']='zgroupid';//到期转向会员组字段
$ecms_config['memberf']['havemsg']='havemsg';//提示短消息字段
$ecms_config['memberf']['checked']='checked';//审核状态字段
$ecms_config['memberf']['salt']='salt';//SALT加密字段
$ecms_config['memberf']['userkey']='userkey';//用户密钥字段
$ecms_config['memberf']['ingid']='ingid';//内部会员组字段
$ecms_config['memberf']['agid']='agid';//会员管理组字段
$ecms_config['memberf']['isern']='isern';//实名字段

//-------EmpireCMS.Seting.member-------




//-------EmpireCMS.Seting.area-------

//后台安全设置
$ecms_config['esafe']['loginauth']='';	//登录认证码,如果设置登录需要输入此认证码才能通过
$ecms_config['esafe']['enloginauth']=0;	//登录认证码加密验证串有效时间,单位:秒(0为不启用加密)
$ecms_config['esafe']['ecookiernd']='1gzRzgtua7fjv0b4l2lxWBC2CFZWiRyGp3ua';	//后台登录COOKIE认证码(填写10~50个任意字符，最好多种字符组合)
$ecms_config['esafe']['ckhloginip']=0;	//后台是否验证登录IP,0为不验证,1为验证
$ecms_config['esafe']['ckhsession']=0;	//后台是否启用SESSION验证,0为不验证,1为验证
$ecms_config['esafe']['ckhanytime']=0;	//后台随时认证码变更周期,单位:秒(0为不启用)
$ecms_config['esafe']['theloginlog']=0;	//是否记录登陆日志(0为记录,1为不记录)
$ecms_config['esafe']['thedolog']=0;		//是否记录操作日志(0为记录,1为不记录)
$ecms_config['esafe']['ckfromurl']=2;	//是否启用来源地址验证,0为不验证,1为全部验证,2为后台验证,3为前台验证,4为全部验证(严格),5为后台验证(严格),6为前台验证(严格)
$ecms_config['esafe']['ckhash']=0;	//启用后台来源认证码,0为金刚模式验证,1为刺猬模式验证,2为关闭验证
$ecms_config['esafe']['ckhashename']='ehash_';	//后台来源认证码访问变量名(必须字母开头,并且只能由字母、数字、下划线组成)
$ecms_config['esafe']['ckhashrname']='rhash_';	//后台来源认证码提交变量名(必须字母开头,并且只能由字母、数字、下划线组成)
$ecms_config['esafe']['ckhuseragent']='';	//允许后台访问的UserAgent信息必须包含字符(区分大小写),多个用“||”半角双竖线隔开

//COOKIE设置
$ecms_config['cks']['ckdomain']='';		//cookie作用域
$ecms_config['cks']['ckpath']='/';		//cookie作用路径
$ecms_config['cks']['ckhttponly']=0;	//cookie的HttpOnly属性(0关闭,1开启,2只后台开启,3只前台开启)
$ecms_config['cks']['cksecure']=0;		//cookie的secure属性(0为自动识别,1为关闭,2为开启,3只后台开启,4只前台开启)
$ecms_config['cks']['ckvarpre']='lnfid';		//前台cookie变量前缀
$ecms_config['cks']['ckadminvarpre']='awndt';		//后台cookie变量前缀
$ecms_config['cks']['ckrnd']='b0PVUIgWBg8iO1SUvNwERdefZBeycK6x2MC';	//COOKIE验证随机码(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndtwo']='e2HGpEsBnivMkwCmu6CVB8rfSN0Jwv2pCE';	//COOKIE验证随机码2(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndthree']='XZNLAo3AVpw6xK2Id2Pokii1duO7GhL7v';	//COOKIE验证随机码3(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndfour']='umxmlrLcAfICWgA0vEeY1Unxzm0SsLQd';	//COOKIE验证随机码4(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndfive']='r7gqA5jesvNn77LbEQqjR1ygiEIlZen';	//COOKIE验证随机码5(填写10~50个任意字符，最好多种字符组合)

//网站防火墙配置
$ecms_config['fw']['eopen']=0;	//开启防火墙(0为关闭,1为开启)
$ecms_config['fw']['epass']='';	//防火墙加密密钥(填写10~50个任意字符，最好多种字符组合)
$ecms_config['fw']['adminloginurl']='';	//允许后台登陆的域名,设置后必须通过这个域名才能访问后台
$ecms_config['fw']['adminhour']='';	//允许登陆后台的时间：0~23小时，多个时间点用半角逗号格开
$ecms_config['fw']['adminweek']='';	//允许登陆后台的星期：星期0~6，多个星期用半角逗号格开
$ecms_config['fw']['adminckpassvar']='';	//后台预登陆验证变量名
$ecms_config['fw']['adminckpassval']='';	//后台预登陆认证码
$ecms_config['fw']['cleargettext']='';	//屏蔽提交敏感字符，多个用半角逗号格开

//-------EmpireCMS.Seting.area-------


//文件类型
$ecms_config['sets']['tranpicturetype']=',.jpg,.gif,.png,.bmp,.jpeg,.webp,';	//图片
$ecms_config['sets']['tranflashtype']=',.swf,.flv,.dcr,';	//FLASH
$ecms_config['sets']['mediaplayertype']=',.wmv,.asf,.wma,.mp3,.asx,.mid,.midi,.swf,.flv,.dcr,.ogg,.webm,';	//mediaplayer
$ecms_config['sets']['realplayertype']=',.rm,.ra,.rmvb,.mp4,.mov,.avi,.wav,.ram,.mpg,.mpeg,';	//realplayer




//***************** 以下部分为缓存，不用设置 **************

//-------EmpireCMS.Public.Cache-------

//------------e_public
$public_r=array('sitename'=>'黄瓜漫画',
'newsurl'=>'/',
'filetype'=>'|.gif|.jpg|.png|.swf|.rar|.zip|.mp3|.wmv|.txt|.doc|',
'filesize'=>2048,
'relistnum'=>8,
'renewsnum'=>100,
'min_keyboard'=>2,
'max_keyboard'=>50,
'search_num'=>10,
'search_pagenum'=>6,
'newslink'=>0,
'checked'=>0,
'searchtime'=>0,
'loginnum'=>5,
'logintime'=>60,
'addnews_ok'=>1,
'register_ok'=>0,
'indextype'=>'.php',
'goodlencord'=>0,
'goodtype'=>'',
'searchtype'=>'.html',
'exittime'=>40,
'smalltextlen'=>160,
'defaultgroupid'=>1,
'fileurl'=>'/d/file/',
'install'=>0,
'phpmode'=>0,
'dorepnum'=>300,
'loadtempnum'=>50,
'bakdbpath'=>'bdata',
'bakdbzip'=>'zip',
'downpass'=>'0L0xs2p8PNi6gRQRsP7f',
'filechmod'=>1,
'loginkey_ok'=>0,
'tbname'=>'comic',
'limittype'=>0,
'redodown'=>1,
'downsofttemp'=>'[ <a href=\"#ecms\" onclick=\"window.open(\'[!--down.url--]\',\'\',\'width=300,height=300,resizable=yes\');\">[!--down.name--]</a> ]',
'onlinemovietemp'=>'[ <a href=\"#ecms\" onclick=\"window.open(\'[!--down.url--]\',\'\',\'width=300,height=300,resizable=yes\');\">[!--down.name--]</a> ]',
'lctime'=>1222406370,
'candocode'=>1,
'opennotcj'=>0,
'listpagetemp'=>'页次：[!--thispage--]/[!--pagenum--]&nbsp;每页[!--lencord--]&nbsp;总数[!--num--]&nbsp;&nbsp;&nbsp;&nbsp;[!--pagelink--]&nbsp;&nbsp;&nbsp;&nbsp;转到:[!--options--]',
'reuserpagenum'=>50,
'revotejsnum'=>100,
'readjsnum'=>100,
'qaddtran'=>1,
'qaddtransize'=>50,
'ebakthisdb'=>1,
'delnewsnum'=>300,
'markpos'=>5,
'markimg'=>'../data/mark/maskdef.gif',
'marktext'=>'',
'markfontsize'=>'5',
'markfontcolor'=>'',
'markfont'=>'../data/mark/cour.ttf',
'adminloginkey'=>1,
'php_outtime'=>0,
'listpagefun'=>'sys_ShowListPage',
'textpagefun'=>'sys_ShowTextPage',
'adfile'=>'thea',
'notsaveurl'=>'',
'rssnum'=>50,
'rsssub'=>300,
'savetxtf'=>',',
'dorepdlevelnum'=>300,
'listpagelistfun'=>'sys_ShowListMorePage',
'listpagelistnum'=>10,
'infolinknum'=>100,
'searchgroupid'=>0,
'opencopytext'=>0,
'reuserjsnum'=>100,
'reuserlistnum'=>8,
'opentitleurl'=>1,
'searchtempvar'=>1,
'showinfolevel'=>0,
'navfh'=>'>',
'spicwidth'=>105,
'spicheight'=>118,
'spickill'=>1,
'jpgquality'=>80,
'markpct'=>65,
'redoview'=>24,
'reggetfen'=>0,
'regbooktime'=>30,
'revotetime'=>30,
'fpath'=>1,
'filepath'=>'Y/m-d',
'nreclass'=>',2,',
'nreinfo'=>',',
'nrejs'=>',',
'nottobq'=>',',
'defspacestyleid'=>1,
'canposturl'=>'',
'openspace'=>1,
'defadminstyle'=>1,
'realltime'=>0,
'closeip'=>'',
'openip'=>'',
'hopenip'=>'',
'textpagelistnum'=>6,
'memberlistlevel'=>0,
'ebakcanlistdb'=>0,
'keytog'=>0,
'keytime'=>900,
'keyrnd'=>'fWZhPsFlQCUFarmA8GJ6S9o7vpvkB4SR',
'checkdorepstr'=>',0,0,0,0,',
'regkey_ok'=>0,
'opengetdown'=>0,
'gbkey_ok'=>0,
'fbkey_ok'=>0,
'newaddinfotime'=>0,
'classnavs'=>'<a href=\"/cate/\">漫画大全</a>&nbsp;|&nbsp;<a href=\"/view/\">漫画章节</a>',
'adminstyle'=>',1,2,',
'docnewsnum'=>300,
'openschall'=>0,
'schallfield'=>1,
'schallminlen'=>3,
'schallmaxlen'=>20,
'schallnum'=>20,
'schallpagenum'=>10,
'dtcanbq'=>1,
'dtcachetime'=>43200,
'repkeynum'=>0,
'regacttype'=>0,
'opengetpass'=>1,
'hlistinfonum'=>100,
'qlistinfonum'=>25,
'dtncanbq'=>1,
'dtncachetime'=>43200,
'readdinfotime'=>60,
'qeditinfotime'=>0,
'onclicktype'=>0,
'onclickfilesize'=>10,
'onclickfiletime'=>60,
'schalltime'=>0,
'defprinttempid'=>1,
'opentags'=>1,
'tagstempid'=>1,
'usetags'=>',1,2,3,4,5,6,7,8,',
'chtags'=>'',
'tagslistnum'=>25,
'closeqdt'=>0,
'settop'=>0,
'qlistinfomod'=>0,
'gb_num'=>20,
'member_num'=>20,
'space_num'=>25,
'infolday'=>0,
'filelday'=>0,
'dorepkey'=>0,
'dorepword'=>0,
'onclickrnd'=>'',
'indexpagedt'=>0,
'keybgcolor'=>'',
'keyfontcolor'=>'',
'keydistcolor'=>'',
'indexpageid'=>0,
'closeqdtmsg'=>'',
'openfileserver'=>0,
'fs_purl'=>'',
'closemods'=>',down,movie,shop,rss,sch,error,pl,print,mconnect,gb,mlist,',
'fieldandtop'=>1,
'fieldandclosetb'=>'',
'filedatatbs'=>',1,',
'filedeftb'=>1,
'pldeftb'=>1,
'plurl'=>'/e/pl/',
'plkey_ok'=>1,
'plface'=>'||[~e.jy~]##1.gif||[~e.kq~]##2.gif||[~e.se~]##3.gif||[~e.sq~]##4.gif||[~e.lh~]##5.gif||[~e.ka~]##6.gif||[~e.hh~]##7.gif||[~e.ys~]##8.gif||[~e.ng~]##9.gif||[~e.ot~]##10.gif||',
'plf'=>'',
'pldatatbs'=>',1,',
'defpltempid'=>1,
'pl_num'=>12,
'plgroupid'=>0,
'closelisttemp'=>'',
'chclasscolor'=>'99C4E3',
'timeclose'=>'',
'timeclosedo'=>'',
'ipaddinfonum'=>0,
'ipaddinfotime'=>0,
'rewriteinfo'=>'',
'rewriteclass'=>'',
'rewriteinfotype'=>'',
'rewritetags'=>'',
'rewritepl'=>'',
'memberconnectnum'=>0,
'closehmenu'=>',shop,',
'indexaddpage'=>0,
'modmemberedittran'=>0,
'modinfoedittran'=>0,
'php_adminouttime'=>1000,
'httptype'=>0,
'qinfoaddfen'=>0,
'bakescapetype'=>1,
'hkeytime'=>30,
'hkeyrnd'=>'dKbUjpK1B5hL5LpoADyzZdlfmJ90dCXRuyTj',
'mhavedatedo'=>2,
'reportkey'=>0,
'ctimeopen'=>1,
'ctimelast'=>0,
'ctimeindex'=>240,
'ctimeclass'=>240,
'ctimelist'=>240,
'ctimetext'=>240,
'ctimett'=>240,
'ctimetags'=>240,
'ctimegids'=>'',
'ctimecids'=>'',
'ctimernd'=>'DuKqTBtvdUvd3mwODcDQ7r2QkOTgLRJkQoHHlyZlpm',
'qmadminuids'=>'',
'qmforumuids'=>'',
'qmotheruids'=>'',
'ckhavemoreport'=>0,
'usetotalnum'=>0,
'autodoopen'=>0,
'autodofile'=>0,
'autodoss'=>0,
'digglevel'=>0,
'diggcmids'=>'',
'spacegids'=>'',
'candocodetag'=>0,
'openern'=>'',
'ernurl'=>'',
'toqjf'=>'',
'qtoqjf'=>'',
'ctimeaddre'=>6,
'ctimeqaddre'=>6,
'deftempid'=>0,'add_name'=>'黄瓜漫画','add_gold'=>'50','add_qq'=>'邮箱：tisha.iu.168987@gmail.com','add_wx'=>'邮箱：tisha.iu.168987@gmail.com','add_url'=>'','add_fby'=>'','add_reward'=>'18','add_sign7'=>'288','add_sign15'=>'588','add_sign30'=>'1088','add_waplink'=>'/index.php','add_applink'=>'');
//------------e_public

//moreports
$emoreport_r=array();
//moreports


//-------EmpireCMS.Public.Cache-------

$emod_pubr=Array('linkfields'=>'|chapter.zpid,comic.zpid|');

$etable_r=array();
$etable_r['news']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>1);
$etable_r['photo']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>11);
$etable_r['comic']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>9);
$etable_r['chapter']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>10);


$emod_r=array();
$emod_r[1]=Array('mid'=>1,
'mname'=>'新闻系统模型',
'qmname'=>'新闻',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',special.field,title,titlepic,price,typename,newstext,smalltext,writer,befrom,newstime,',
'qenter'=>',',
'listtempf'=>',title,titlepic,price,typename,smalltext,newstime,diggtop,',
'tempf'=>',title,titlepic,price,typename,newstext,smalltext,writer,befrom,newstime,diggtop,',
'mustqenterf'=>',title,newstext,',
'listandf'=>',typename,newstime,diggtop,',
'setandf'=>0,
'searchvar'=>',title,',
'cj'=>',',
'canaddf'=>',title,titlepic,price,typename,newstext,smalltext,writer,befrom,newstime,',
'caneditf'=>',title,titlepic,price,typename,newstext,smalltext,writer,befrom,newstime,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,diggtop,typename,price,',
'tbdataf'=>',writer,befrom,newstext,',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,typename,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>',newstime,diggtop,',
'sonclass'=>'|4|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>1,
'tbname'=>'news');
$emod_r[11]=Array('mid'=>11,
'mname'=>'短篇漫画模型',
'qmname'=>'短篇漫画',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',special.field,title,titlepic,price,morepic,newstime,',
'qenter'=>',',
'listtempf'=>',title,titlepic,price,newstime,',
'tempf'=>',title,titlepic,price,morepic,newstime,',
'mustqenterf'=>',title,titlepic,morepic,newstime,',
'listandf'=>',newstime,',
'setandf'=>0,
'searchvar'=>'',
'cj'=>',title,',
'canaddf'=>',title,titlepic,price,morepic,newstime,',
'caneditf'=>',title,titlepic,price,morepic,newstime,',
'tbmainf'=>',newstime,price,titlepic,title,',
'tbdataf'=>',morepic,',
'tobrf'=>',',
'dohtmlf'=>',morepic,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>',newstime,',
'sonclass'=>'|3|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>11,
'tbname'=>'photo');
$emod_r[9]=Array('mid'=>9,
'mname'=>'漫画系统模型',
'qmname'=>'漫画',
'defaulttb'=>1,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',special.field,title,zpid,smalltext,titlepic,titleimg,back,cover,ticai,age,up,jindu,favnum,diggtop,writer,newstime,ctime,befrom,ftitle,',
'qenter'=>',',
'listtempf'=>',title,zpid,smalltext,titlepic,titleimg,back,cover,ticai,age,up,jindu,favnum,diggtop,writer,newstime,ctime,ftitle,',
'tempf'=>',title,zpid,smalltext,titlepic,titleimg,back,cover,ticai,age,up,jindu,favnum,diggtop,writer,newstime,ftitle,',
'mustqenterf'=>',title,titlepic,',
'listandf'=>',title,zpid,smalltext,ticai,age,up,jindu,favnum,diggtop,newstime,ctime,',
'setandf'=>1,
'searchvar'=>',title,smalltext,writer,ctime,',
'cj'=>',title,',
'canaddf'=>',title,zpid,smalltext,titlepic,titleimg,back,cover,ticai,age,up,jindu,favnum,diggtop,writer,newstime,ctime,befrom,ftitle,',
'caneditf'=>',title,zpid,smalltext,titlepic,titleimg,back,cover,ticai,age,up,jindu,favnum,diggtop,writer,newstime,ctime,befrom,ftitle,',
'tbmainf'=>',age,cover,back,up,title,writer,titlepic,newstime,ticai,ctime,jindu,smalltext,zpid,befrom,titleimg,favnum,ftitle,diggtop,',
'tbdataf'=>',',
'tobrf'=>',',
'dohtmlf'=>',smalltext,favnum,ftitle,',
'checkboxf'=>',ticai,',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',',
'filef'=>',',
'imgf'=>',cover,back,titlepic,titleimg,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>',favnum,diggtop,newstime,ctime,',
'sonclass'=>'|1|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>9,
'tbname'=>'comic');
$emod_r[10]=Array('mid'=>10,
'mname'=>'漫画章节模型',
'qmname'=>'漫画章节',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',special.field,zpid,num,title,score,titlepic,price,morepic,newstime,befrom,',
'qenter'=>',',
'listtempf'=>',zpid,num,title,score,titlepic,price,newstime,',
'tempf'=>',zpid,num,title,score,titlepic,price,morepic,newstime,',
'mustqenterf'=>',zpid,title,titlepic,morepic,',
'listandf'=>',zpid,num,newstime,',
'setandf'=>0,
'searchvar'=>'',
'cj'=>',title,',
'canaddf'=>',zpid,num,title,titlepic,price,morepic,newstime,befrom,',
'caneditf'=>',zpid,num,title,titlepic,price,morepic,newstime,befrom,',
'tbmainf'=>',score,befrom,num,title,titlepic,newstime,zpid,price,',
'tbdataf'=>',morepic,',
'tobrf'=>',',
'dohtmlf'=>',morepic,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|zpid,comic.zpid|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>',num,newstime,',
'sonclass'=>'|2|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>10,
'tbname'=>'chapter');


//-------EmpireCMS.Public.Cache-------

?>