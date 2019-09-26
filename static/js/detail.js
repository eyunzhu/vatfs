/*
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
*/
var playListId = "";
//获取基本配置
var localConfig,serverConfig;
$(document).ready(function() {
	//获取本地基本配置
	$.ajax({
		url: "static/js/config.json",
		success:function(e){
			localConfig = e
			getServerConfig()
		},
		error:function(){
			$("#messageHint").append('<a  href="https://github.com/eyunzhu/vatfs" style="color: red;">Local configuration error!</a>&emsp;');
			$("#messageHint").append('<a  href="http://v.eyunzhu.com">官网</a>&emsp;');
			$("#messageHint").append('<a  href="http://eyunzhu.com">联系作者</a>&emsp;&emsp;');
		}
	});
})
//获取服务端配置
function getServerConfig(){
	$.ajax({
		url: localConfig.config,
		success:function(e){
			serverConfig = e.data
			getPlayUrl()
			$("#marquee").append(serverConfig.marquee);
		},
		error:function(){
			$("#messageHint").append('<a  href="https://github.com/eyunzhu/vatfs" style="color: red;">Server Error!</a>&emsp;');
			$("#messageHint").append('<a  href="http://v.eyunzhu.com">官网</a>&emsp;');
			$("#messageHint").append('<a  href="http://eyunzhu.com">联系作者</a>&emsp;&emsp;');
		}
	});
}

function getPlayUrl(){
	var url =  localConfig.detail + "?siteId=" + getQueryVariable('siteId') + "&url=" +
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
			playTitle = data.data.title;
			playTitles = data.data.data[0].name;
			$("#play-title").text(playTitle);
			$("#play-titles").text(playTitles);
	
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
	
	$("#play-url").click(function(){
		$("#play-title").text('播放自定义链接');
		$("#play-titles").text('');
		console.log($("#video-url").val());
		dp.switchVideo({
			url: $("#video-url").val(),
		});
		setTimeout(function() {
			dp.play();dp.subtitle.hide();
		}, 200);
	});
}

function play(id, url, name) {
	$("#play-title").text(playTitle);
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



