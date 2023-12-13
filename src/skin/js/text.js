var txtrecord, fontSize, viewMode;
txtrecord = getCookie("txtrecord") || 0;
$(function() {
	var id = $("#id").val();
	var cid = $("#cid").val();
	$.ajax({
		url: "/json/Info/text.php",
		data: {
			"cid": cid,
			"id": id
		},
		type: "get",
		dataType: "jsonp",
		async: true,
		timeout: 3000,
		success: function(a) {
			var c = "";
			$.each(a.data, function(a, b) {
				a = b.newstext;			
				var d = $("#litemppic").html();
				$.each(a, function(a, b) {
					c += d.replace(/{txt}/g, b.txt);
				});
			});
			$("#showimgcontent").after(c);
		}
	});
	$.ajax({
		url: "/json/link",
		data: {
			"cid": cid,
			"id": id,
			"type": "4"
		},
		type: "get",
		dataType: "jsonp",
		async: true,
		timeout: 3000,
		success: function(a) {
			var c = "";
			$.each(a.data, function(a, b) {
				a = b.list;
				var d = $("#litemptxt").html();
				$.each(a, function(a, b) {
					c += d.replace(/{name}/g, b.name).replace(/{nlink}/g, b.url).replace(/{id}/g, b.id);
				});
			});
			$("#listtext").after(c);
		}
	});
	$.getScript("/json/link/?id=" + id + "&cid=" + cid + "&type=3");
	$(".font span").click(function() {
		var cssFontSize = $(".text").css("font-size");
		var fontSize = parseFloat(cssFontSize);
		var unit = cssFontSize.slice(-2);
		var className = $(this).attr("class");
		if ("bigger" == className) {
			if (fontSize <= 22) {
				fontSize += 2;
			}
		} else if ("smaller" == className) {
			if (fontSize >= 12) {
				fontSize -= 2;
			}
		}
		$(".text").css("font-size", fontSize + unit);
	});
});