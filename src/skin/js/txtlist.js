$(function() {
	$(".typename").find("a").click(function() {
		var c = $(this),
			b = c.data("value");
		console.log();
		c = c.parents(".typename").data("str");
		console.log(c);
		"type" == c ? b != s && SelS(this, b) : ""
	})
});
var cid = $("#cid").val(),
	pageIndex = 0,
	line = 20,
	cId = cid,
	jd = 0,
	a = 0,
	s = 0,
	classid = 4;
window.onload = function() {
	GetNovelInfo(0)
};

function removeSel(c) {
	pageIndex = 0;
	c.parentNode.getElementsByClassName("fl selected")[0].className = "fl";
	c.className = "fl selected"
}

function SelS(c, b) {
	removeSel(c);
	s = b;
	GetNovelInfo(0)
}
var last = 0;

function LoadMore() {
	0 == last && (pageIndex += 1, GetNovelInfo(1))
}

function GetNovelInfo(c) {
	$.ajax({
		url: "/json/comic/",
		data: {
			ph: 1,
			tempid: 7,
			classid: cid,
			page: pageIndex,
			typename: s,
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
				var d = "",
					f = $("#litemp").html();
				$.each(b.data, function(c, b, e) {
					d += f.replace(/{nlink}/g, b.LinkUrl).replace(/{name}/g, b.Title)
				});
				0 == c ? $("#novelList").html(d) : $("#novelList").append(d);
				original()
			}
			null == b || 0 == b.data.length || b.data.length < line ? (document.getElementById("loading").innerHTML = "我是有底线的", last = 1) : (last = 0, document.getElementById("loading").innerHTML = "点击加载更多")
		}
	})
};