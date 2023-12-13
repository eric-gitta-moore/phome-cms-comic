$(function() {
	$(".checkcatebox").find("a").click(function() {
		var a = $(this),
			b = a.data("value");
		console.log();
		a = a.parents(".checkcatebox").data("str");
		console.log(a);
		"order" == a ? b != px && SelS(this, b) : "up" == a ? b != gx && SelG(this, b) : "age" == a ? b != nl && SelA(this, b) : "status" == a && b != zt && SelJd(this, b)
	})
});
var pageIndex = 0,
	line = 10,
	gx = 0,
	tc = tid,
	zt = st,
	nl = age,
	px = "diggtop",
	classid = 1;
window.onload = function() {
	GetNovelInfo(1) 
};
function removeSel(a) {
	pageIndex = 0;
	a.parentNode.getElementsByClassName("red")[0].className = "";
	a.className = "red"
}
function SelClass(a, b) {
	removeSel(a);
	tc = b;
	GetNovelInfo(0)
}
function SelG(a, b) {
	removeSel(a);
	gx = b;
	GetNovelInfo(0)
}
function SelA(a, b) {
	removeSel(a);
	nl = b;
	GetNovelInfo(0)
}
function SelJd(a, b) {
	removeSel(a);
	zt = b;
	GetNovelInfo(0)
}
function SelS(a, b) {
	removeSel(a);
	px = b;
	GetNovelInfo(0)
}
var last = 0;

function LoadMore() {
	0 == last && (pageIndex += 1, GetNovelInfo(1))
}
$(".spinner").hide();
function GetNovelInfo(a) {
	$.ajax({
		url: "/json/comic/",
		data: {
			ph: 1,
			tempid: 2,
			classid: 1,
			page: pageIndex,
			ticai: tc,
			up: gx,
			jindu: zt,
			age: nl,
			orderby: px,
			line: line
		},
		type: "GET",
		dataType: "json",
		beforeSend: function() {
			$(".spinner").show()
		},
		complete: function() {
			$(".spinner").hide()
		},
		success: function(b) {
			if ("0" == b.code) {
				var c = "",
					e = $("#litemp").html();
				$.each(b.data, function(b, a, d) {
					d = "blueTag";
					1 == a.UpdateStatus && (d = "redTag");
					b = "完结";
					1 == a.UpdateStatus && (b = a.LChapter);
					h = "";
					18 == a.age && (h = "<b>18+</b>");
					c += e.replace(/{nlink}/g, a.LinkUrl).replace(/{cname}/g, a.CName).replace(/{img}/g, a.ImgUrl).replace(/{upstate}/g, b).replace(/{age}/g, h).replace(/{jindu}/g, d).replace(/{author}/g, a.Author).replace(/{name}/g, a.Title).replace(/{up}/g, a.up).replace(/{tc}/g, a.tc).replace(/{summary}/g, a.Summary)
				});
				0 == a ? $("#novelList").html(c) : $("#novelList").append(c);
				original()
			}
			null == b || 0 == b.data.length || b.data.length < line ? (document.getElementById("loading").innerHTML = "我是有底线的", last = 1) : (last = 0, document.getElementById("loading").innerHTML = "点击加载更多")
		}
	})
};

  $(window).scroll(function() {
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
             LoadMore();
        }
   });
