/*
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
*/

$(document).ready(function() {
	
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
	        url: getQueryVariable('url'),
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
	setTimeout(function(){
		dp.play();
	},1000)
	
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
});

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