/*
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
*/
var player = videojs("#player");
var playListId = "";
var playUrl = "";
$(document).ready(function() {
	var url = "https://tools.eyunzhu.com/api/wxgzh/video/detail?siteId=" + getQueryVariable('siteId') + "&url=" +
		getQueryVariable('url');
	$.get(url, function(data, status) {
		if (data.data.data[0]) {
			var appendStr = "";
			var index = 0;
			data.data.data.forEach(function(v) {
				appendStr = "<div class='col-md-1 col-3 pr-0 mb-0'><button onclick=\"play('playList" + index + "','" +
					encodeURIComponent(v.url) + "','" + v.name + "')\" id='playList" + index++ +
					"' type='button' class='btn btn-info' style='margin:4px 0px;padding:2px;'>" + v.name + "</button></div>";
				$("#play-list").append(appendStr);
			})

			$("#play-title").text(data.data.title);
			$("#play-titles").text(data.data.data[0].name);

			playListId = 'playList0';

			$("#playList0").removeClass("btn btn-info");
			$("#playList0").addClass("btn btn-primary");

			
			player.src(data.data.data[0].url);
			setTimeout(function() {
				player.play();
			}, 100);
			$(".loading").hide();
		} else {
			alert("此资源不存在，请换个资源或者换个站点");
		}
	});
});

function play(id, url, name) {
	$("#play-titles").text(name);
	if (playListId) {
		$("#" + playListId).removeClass("btn btn-primary");
		$("#" + playListId).addClass("btn btn-info");
	}
	playListId = id;
	playUrl = decodeURIComponent(url);

	player.src(decodeURIComponent(url));
	player.play();

	$("#" + id).removeClass("btn btn-info");
	$("#" + id).addClass("btn btn-primary");
}


function getQueryVariable(variable) {
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split("=");
		if (pair[0] == variable) {
			return pair[1];
		}
	}
	return (false);
}
