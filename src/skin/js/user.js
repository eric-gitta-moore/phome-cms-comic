$(function() {
	LoadMore(0);
});
function LoadMore(type) {
	var data = {
		"page": 1,
		"line":3
	};
	Info(data, type);
}
function Info(data, loadType) {
	$.ajax({
		url: "/json/fav",
		data: data,
		type: "get",
		dataType: "json",
		success: function(msg) {
			if (msg.code == "0") {
				var li = "";
				var lit = $("#litemp").html();
				$.each(msg.data,
				function(j, v) {
					li += lit.replace(/{nlink}/g, v.LinkUrl).replace(/{img}/g, v.ImgUrl).replace(/{name}/g, v.Title);
				});
				$("#novelList").html(li);
				original()
			}
		}
	});
}