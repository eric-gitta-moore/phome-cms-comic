//动态加载JSON
var last=0,page=0,line=10,count=0;last=0;function LoadMore(){0==last&&(page+=1,GetNovelInfo(1))}
function GetNovelInfo(e){$.ajax({url:"/json/comic/",data:{ph:1,tempid:2,classid:1,age:18,page:page,line:line,orderby:"lastdotime"},type:"GET",dataType:"json",beforeSend:function(){$(".spinner").show()},complete:function(){$(".spinner").hide()},success:function(b){if("0"==b.code){var d="",f=$("#litemptop").html();$.each(b.data,function(b,a,c){c="blueTag";1==a.UpdateStatus&&(c="redTag");b="\u5b8c\u7ed3";1==a.UpdateStatus&&(b=a.LChapter);h="";18==a.age&&(h="<b>18+</b>");d+=f.replace(/{nlink}/g,
a.LinkUrl).replace(/{cname}/g,a.CName).replace(/{img}/g,a.ImgUrl).replace(/{upstate}/g,b).replace(/{age}/g,h).replace(/{jindu}/g,c).replace(/{author}/g,a.Author).replace(/{name}/g,a.Title).replace(/{up}/g,a.up).replace(/{tc}/g,a.tc).replace(/{summary}/g,a.Summary)});0==e?"":$("#novelList").append(d);original()}null==b||0==b.data.length||b.data.length<line?(document.getElementById("loading").innerHTML="\u6211\u662f\u6709\u5e95\u7ebf\u7684",last=1):(last=0,document.getElementById("loading").innerHTML=
"\u70b9\u51fb\u52a0\u8f7d\u66f4\u591a")}})};
//判断登陆
$(function(){$(".spinner").hide();$("#waplink,#applink").addClass("selected");$.get("/e/member/login/status.php?in=1",function(a,b){1==a&&$(".footnav #user").addClass("in")});$("a#applink").click(function(){$("html,body").animate({scrollTop:0},300)})});
//获取渠道
function GetQueryString(c) {c = new RegExp("(^|&)" + c + "=([^&]*)(&|$)");c = window.location.search.substr(1).match(c);return null != c ? unescape(c[2]) : null}var myurl = GetQueryString("f");null != myurl && 1 < myurl.toString().length && $(function() {$.get("/e/member/from/?f=" + GetQueryString("f"))});
//APP下载提示
!function(){var d=setTimeout(function(){},0),b=0;$.fn.extend({showbanner:function(e){var a=$.extend({handle:!0,addclass:"",sound:"",position:"top",html:!1,show_duration:200,show_easing:"swing",duration:12E3,hide_duration:700,hide_easing:"swing",onClick:"",onHide:""},e);""!=a.sound&&(a.sound='<audio id="alertsound" autoplay="autoplay" src="'+a.sound+'"></audio>');var f=a.position,c=!1;b++;var g=function(b){var c=$(".AlertID"+b).outerHeight();"bottom"!=f?$(".AlertID"+b).animate({top:-c},a.hide_duration,
a.hide_easing,function(){$(".AlertID"+b).remove();"function"==typeof a.onHide&&a.onHide()}):$(".AlertID"+b).animate({bottom:-c},a.hide_duration,a.hide_easing,function(){$(".AlertID"+b).remove();"function"==typeof a.onHide&&a.onHide()})};(function(){$(".Appalert").remove();$("#alertsound").remove();clearTimeout(d);$("body").append('<div class="Appalert '+a.addclass+'" id="Appalert">'+a.content+"</div>"+a.sound);$(".Appalert").addClass("AlertID"+b);""!=a.sound&&(document.getElementById("alertsound").onended=
function(){$("#alertsound").remove()});var e=$(".Appalert").outerHeight();$(".Appalert").css(f,-e);"bottom"!=f?$(".Appalert").animate({top:0},a.show_duration,a.show_easing,function(){d=setTimeout(function(){g(b)},a.duration)}):$(".Appalert").animate({bottom:0},a.show_duration,a.show_easing,function(){d=setTimeout(function(){g(b)},a.duration)});$(".del").click(function(){c=!0;g(b)});$(".Appalert").click(function(){"function"==typeof a.onClick&&1!=c&&a.onClick()})})()}})}(jQuery);
//苹果
function balert(){$("body").showbanner({content:"<div id='iostips'><div class='calert box ios'><div class='fl'><img src='/icon/favicon.png' /></div><div class='fc'><p class='t1'>使用Safari浏览器打开，保存到桌面</p><p class='t2'>请轻点 <i></i>，然后点击<em></em>“添加到主屏幕”</p></div><div class='del' id='del'></div></div><div class='arrow'></div></div>",position:"bottom"})};
  $(window).scroll(function() {
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
             LoadMore();
        }
   });

