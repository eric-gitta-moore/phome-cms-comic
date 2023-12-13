$(function(){$(".spinner").hide();var c=$(".tabBar").offset().top+0;$(window).scroll(function(){(0==document.documentElement.scrollTop?document.body.scrollTop:document.documentElement.scrollTop)>=c?$(".indexso").addClass("float"):$(".indexso").removeClass("float")})});var last=0,page=0,line=10,count=0;last=0;function LoadMore(){0==last&&(page+=1,GetNovelInfo(1))}
function GetNovelInfo(c){var d=$("#order").val();$.ajax({url:"/json/comic/",data:{ph:1,tempid:2,classid:1,page:page,line:line,orderby:d},type:"GET",dataType:"json",beforeSend:function(){$(".spinner").show()},complete:function(){$(".spinner").hide()},success:function(b){if("0"==b.code){var e="",d=$("#litemp").html();$.each(b.data,function(b,a,c){c="blueTag";1==a.UpdateStatus&&(c="redTag");b="\u5b8c\u7ed3";1==a.UpdateStatus&&(b=a.LChapter);h="";18==a.age&&(h="<b>18+</b>");e+=d.replace(/{nlink}/g,
a.LinkUrl).replace(/{cname}/g,a.CName).replace(/{img}/g,a.ImgUrl).replace(/{upstate}/g,b).replace(/{age}/g,h).replace(/{jindu}/g,c).replace(/{author}/g,a.Author).replace(/{name}/g,a.Title).replace(/{up}/g,a.up).replace(/{tc}/g,a.tc).replace(/{summary}/g,a.Summary)});0==c?"":$("#novelList").append(e);original()}null==b||0==b.data.length||b.data.length<line?(document.getElementById("loading").innerHTML="\u6211\u662f\u6709\u5e95\u7ebf\u7684",last=1):(last=0,document.getElementById("loading").innerHTML=
"\u70b9\u51fb\u52a0\u8f7d\u66f4\u591a")}})};
$(window).scroll(function() {
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
             LoadMore();
        }
   });