$(".spinner").hide();
if (localStorage.getItem(CartoonId)) {
	var str = localStorage.getItem(CartoonId),
		arr = str.split(",");
	$("#startUrl").attr("href", arr[0]);
	$("#startUrl").html("继续阅读 <em>(第" + arr[1] + "话)</em>");
	$("#history").html('<li style="background:#fafafa;"><a href="' + arr[0] + '"><span class="imgs fl"><img src="' + arr[3] + '"></span><span class="w50 red"><p class="timeIcon">上次浏览到</p>&nbsp;&nbsp;&nbsp;' + arr[2] + "</a><b class='his'>继续阅读</b></a></li>")
} else $("#startUrl").html("开始阅读 <em>(第1话)</em>"), $("#history").hide();
var CartoonId = document.getElementById("snovelId").value,
	gold = document.getElementById("gold").value,
	orderBy = "",
	orderPageIndex = 0,
	orderPageSize = 10;
window.onload = function() {IndexOrderBy(1) };
function IndexOrderBy(a) {
	var b = document.getElementById("asc"),
		e = document.getElementById("desc");
	0 == a ? (b.style.display = "none", e.style.display = "block", orderBy = "desc") : 1 == a && (b.style.display = "block", e.style.display = "none", orderBy = "asc");
	a = {
		ph: 1,
		tempid: 3,
		classid: 2,
		zpid: $("#snovelId").val(),
		page: orderPageIndex,
		line: 200,
		orderby: orderBy
	};
	$.ajax({
		url: "/json/chapter",
		data: a,
		type: "get",
		dataType: "json",
		success: function(a) {
			if (null != a) {
				var b = "",
					e = $("#chaptermb").html();
				$.each(a, function(a, c) {
					a = "";
					1 == c.price ? a = "free" : 2 == c.price ? a = "toll" : 3 == c.price ? a = "vip" : 4 == c.price ? a = "bought" : 5 == c.price ? a = "read" : 6 == c.price && (a = "his");
					var f = "";
					1 == c.price ? f = "免费" : 2 == c.price ? f = gold + "阅币" : 3 == c.price ? f = "VIP免费" : 4 == c.price ? f = "已购买" : 5 == c.price ? f = "已看过" : 6 == c.price && (f = "上次看到这里");
					b += e.replace(/{href}/g, c.Url).replace(/{name}/g, c.Name).replace(/{stime}/g, c.Stime).replace(/{pricetxt}/g, f).replace(/{pricestyle}/g, a).replace(/{img}/g, c.ImgUrl)
				})
			}
			$("#chapter").html(b);
			original()
		}
	})
}
$(function() {
	var a = $("#classid").val(),
		b = $("#id").val();
	$.ajax({
		type: "get",
		url: "/json/fav/add",
		data: {
			type: "2",
			id: b,
			classid: a
		},
		success: function(a) {
			o = a.favour;
			d = a.diggtop;
			$(".diggnum").html(d);
			1 == o ? ($("#add").hide(), $("#del").show()) : ($("#add").show(), $("#del").hide())
		}
	})
});
user = {
	vote: function(a, b, e, h, g) {
		$.ajax({
			type: "get",
			url: "/json/fav/add/?btn=yes&type=" + e + "&id=" + a + "&classid=" + b,
			success: function(a) {
				"yes" == a ? (myTips("已加入书架"), $("#add").hide(), $("#del").show()) : "on" == a ? (myTips("删除成功"), $("#add").show(), $("#del").hide()) : myTips("请先登陆会员")
			}
		})
	}
};
SQ = {
	thispostion: function(a) {
		var b = $(a).offset().left;
		a = $(a).offset().top + $(a).height();
		return {
			x: b,
			y: a
		}
	},
	windowpostion: function(a) {
		a = $(window).width() / 2 + $(window).scrollLeft();
		var b = $(window).height() / 2 + $(window).scrollTop();
		return {
			x: a,
			y: b
		}
	},
	mouseposition: function(a) {
		var b = 0,
			e = 0;
		a = a || window.event;
		if (a.pageX || a.pageY) b = a.pageX, e = a.pageY;
		else if (a.clientX || a.clientY) b = a.clientX + document.body.scrollLeft + document.documentElement.scrollLeft, e = a.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		return {
			x: b,
			y: e
		}
	},
	Ajax: function(a) {
		a = $.extend({
			type: "post",
			data: "",
			dataType: "jsonp",
			before: function() {}
		}, a);
		burl = (-1 == a.request.indexOf("?") ? "?" : "&") + "_rnd=" + (new Date).getTime();
		$.ajax({
			type: a.type,
			url: a.request + burl,
			data: a.data,
			dataType: a.dataType,
			beforeSend: a.before,
			success: a.respon
		})
	},
	Ajax_async: function(a) {
		a = $.extend({
			type: "post",
			data: "",
			dataType: "jsonp",
			before: function() {}
		}, a);
		burl = (-1 == a.request.indexOf("?") ? "?" : "&") + "_rnd=" + (new Date).getTime();
		$.ajax({
			type: a.type,
			url: a.request + burl,
			async: !1,
			data: a.data,
			dataType: a.dataType,
			beforeSend: a.before,
			success: a.respon
		})
	},
	ajaxLoginCheck: function(a) {
		return "0" == a.is_login ? (SQ.Adiv(a), !1) : !0
	},
	boolIe: function() {
		return $.browser.msie && "6.0" == $.browser.version ? !0 : !1
	}
};
Digg = {
	vote: function(a, b, e, h, g) {
		$(".act-msg").remove();
		SQ.Ajax({
			request: "/e/extend/digg.php?id=" + a + "&classid=" + b + "&type=" + e,
			data: "",
			respon: function(b) {
				if (!1 !== SQ.ajaxLoginCheck(b)) {
					if (403 == b.status) return myTips(b.msg, "error"), !1;
					var e = $(g).offset().left + 50,
						c = $(g).offset().top - 20,
						f = c - 30;
					$("body").append("<div id='act-msg-" + a + "' class='act-msg " + b.code + "'><div class='layer-inner'>" + b.msg + "</div><em></em></div>");
					$("#act-msg-" + a).css({
						position: "absolute",
						left: e,
						top: c,
						"z-index": "99999999"
					}).animate({
						top: f
					}, 300);
					setTimeout(function() {
						$("#act-msg-" + a).fadeOut("200")
					}, 1E3);
					$("#" + h).html(b.count)
				}
			}
		})
	}
};