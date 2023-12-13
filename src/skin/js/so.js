$(function() {
	$("#searchBtn");
	var a = $("#headerbox"),
		b = $("#searchbox");
	$("#cancleBtn");
	$("#cancleBtn").click(function() {
		b.hide();
		a.show()
	});
	$("#searchBtn").click(function() {
		b.show();
		a.hide()
	});
	document.onkeydown = function(a) {
		var b = document.getElementById("keywords"),
			c = a || window.event || arguments.callee.caller.arguments[0];
		c && 13 == c.keyCode && "" != b.value && GetNovelBySearch()
	}
});

function GetNovelBySearch() {
	location.href = "/e/search/?searchget=1&show=keyboard,title&classid=1&keyboard=" + $("#keywords").val()
};