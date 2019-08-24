/*
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
*/

var playListId = "";
var playUrl = "";
$(document).ready(function() {
	$.ajax({
		url: "https://tools.eyunzhu.com/api/wxgzh/video/config",
		timeout: 4000,
		complete: function(result) {
			if (result.status == 200) {
				if (result.responseJSON.code) {
					$("#marquee").append(result.responseJSON.data.marquee);
				} else {
					alert('维护中，请稍后访问');
					window.location.href="/../";
				}
			} else{
				alert('维护中，请稍后访问');
				window.location.href="/../";
			}
		}
	});
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
			
			 dp= new DPlayer({
			    container: document.getElementById('dplayer'),
			    autoplay: true,
			    theme: '#FADFA3',
			    loop: true,
			    lang: 'zh-cn',
			    screenshot: true,
			    hotkey: true,
			    preload: 'auto',
			    logo: 'static/ysqss.ico',
			    volume: 0.7,
			    mutex: true,
			    video: {
			        url: data.data.data[0].url,
			        //pic: 'https://v.eyunzhu.com/static/logo.png',
			        //thumbnails: 'https://v.eyunzhu.com/static/logo.png',
			        type: 'auto'
			    },
			    subtitle: {
			        url: 'static/dplayer/Dplayer.vtt',
			        type: 'webvtt',
			        fontSize: '25px',
			        bottom: '10%',
			        color: '#b7daff'
			    },
			    // danmaku: {
			    //     id: '9E2E3368B56CDBB4',
			    //     api: 'https://api.prprpr.me/dplayer/',
			    //     token: 'tokendemo',
			    //     maximum: 1000,
			    //     addition: ['https://api.prprpr.me/dplayer/v3/bilibili?aid=4157142'],
			    //     user: 'DIYgod',
			    //     bottom: '15%',
			    //     unlimited: true
			    // },
			    contextmenu: [
			        {
			            text: '忆云竹',
			            link: 'http://eyunzhu.com'
			        },
			        // {
			        //     text: 'custom2',
			        //     click: (player) => {
			        //         console.log(player);
			        //     }
			        // }
			    ],
			    highlight: [
			        {
			            time: 20,
			            text: '欢迎使用影视全搜索'
			        },
			        {
			            time: 120,
			            text: '关注公众号：古图'
			        }
			    ]
			});
			dp.play();
			setTimeout(function() {
				dp.play();dp.subtitle.show();
			}, 300);
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
	
	dp.switchVideo({
		url: playUrl,
	});
	setTimeout(function() {
		dp.play();dp.subtitle.hide();
	}, 200);
	
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
