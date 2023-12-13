var CartoonId = $("#snovelId").val(),
	total = $("#total").val(),
	gold = $("#gold").val(),
	orderPageIndex = 0,
	orderPageSize = 1,
	orderBy = "asc";
window.onload = function() {
	IndexOrderBy(0)
};
function IndexOrderBy(a) {
	0 == a ? ($("#asc").removeClass("orderoff"), $("#asc").addClass("orderon"), $("#desc").removeClass("orderon"), $("#desc").addClass("orderoff"), orderBy = "asc") : ($("#desc").removeClass("orderoff"), $("#desc").addClass("orderon"), $("#asc").removeClass("orderon"), $("#asc").addClass("orderoff"), orderBy = "desc");
	Page(0, 1);
	FenYe({
		ph: 1,
		tempid: 8,
		classid: 2,
		line: 10,
		zpid: CartoonId,
		page: orderPageIndex,
		orderby: orderBy
	})
}
var pageIndex = 0,
	pageSize = 1,
	line = 10,
	count = 0,
	totalCount = $("#hidCount").val(),
	totalPage = parseInt((parseInt(totalCount) - 1) / pageSize) + 1;
function Page(a, c) {
	parseInt(totalPage);
	var d = document.getElementById("pageId");
	if (0 == a) pageIndex = count = 0;
	else if (1 == a) {
		if (0 == pageIndex) return;
		count--;
		pageIndex = 1 * parseInt(count)
	} else if (2 == a) {
		if (count == total) return;
		count++;
		pageIndex = 1 * parseInt(count)
	} else if (3 == a) {
		if (count == total) return;
		count = total - 1 + 1;
		pageIndex = total
	}
	if (1 == c) return d.value = 1, !1;
	a = {
		ph: 1,
		tempid: 8,
		classid: 2,
		line: 10,
		zpid: CartoonId,
		page: pageIndex,
		orderby: orderBy
	};
	totalCount > pageIndex && (d.value = count + 1, FenYe(a))
}
function FenYe(a) {
	$.ajax({
		url: "/json/comic/",
		data: a,
		type: "get",
		dataType: "json",
		beforeSend: function() {
			$(".spinner").show()
		},
		complete: function() {
			$(".spinner").hide()
		},
		success: function(a) {
			Html(a)
		}
	})
}
function Html(a) {
	if (null != a) {
		var c = "",
			d = $("#chaptermb").html();
		$.each(a, function(a, b) {
			var f = "";
			1 == b.price ? f = "gray" : 2 == b.price ? f =  "yellow" : 3 == b.price ? f = "green" :4 == b.price && (f = "green");
			e = "";
			1 == b.price ? e = "\u514d\u8d39" : 2 == b.price ? e = gold + "\u9605\u5e01" : 3 == b.price ? e = "VIP\u514d\u8d39" :4 == b.price && (e = "\u5df2\u8d2d\u4e70");
			c += d.replace(/{href}/g, b.Url).replace(/{name}/g, b.Name).replace(/{pricetxt}/g, e).replace(/{pricestyle}/g, f).replace(/{img}/g, b.ImgUrl);
			0 < a || $("#snew").hide()
		});
		$("#chapter").html(c);
		original()
	}
}
function show_sub(a) {
	count = a - 1;
	pageIndex = 10 * (a - 1);
	FenYe({
		ph: 1,
		tempid: 8,
		classid: 2,
		line: 10,
		zpid: CartoonId,
		page: (a - 1) * pageSize,
		orderby: orderBy
	})
}
if (localStorage.getItem(CartoonId)) {
	var str = localStorage.getItem(CartoonId),
		arr = str.split(",");
	$("#history").html('<li style="background:#fafafa;"><a href="' + arr[0] + '"><span class="imgs fl"><img src="' + arr[3] + '"></span><span class="w50 red"><p class="timeIcon">上次浏览到</p>&nbsp;&nbsp;&nbsp;' + arr[2] + "</a><b class='vip'>继续阅读</b></a></li>")
};