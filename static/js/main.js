/*
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
*/

//获取基本配置
var localConfig,serverConfig;
$(document).ready(function() {
	//获取本地基本配置
	$.ajax({
		url: "static/js/config.json",
		success:function(e){
			localConfig = e
			getServerConfig()
			getLiveSource()
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
			if(serverConfig.version != localConfig.version){
				$("#messageHint").append('<a  href="https://github.com/eyunzhu/vatfs" style="color: red;">有新版本更新</a>&emsp;');
			}
			serverConfig.link.forEach(function(v) {
				appendStr = '<a style="color:#FFA500;" href="'+v.link+'">'+v.name+'</a>&nbsp;&nbsp;';
				$("#bottomLink").append(appendStr);
			})
			
			var kw = getQueryVariable("kw");
			if (decodeURIComponent(kw) && decodeURIComponent(kw) != 'false') {
				$('#input-kw').val(decodeURIComponent(kw));
				doSearch();
			}
			$('#input-kw').bind('keypress', function(event) {
				if (event.keyCode == "13")doSearch();
			});
			//点击搜索按钮
			$("#search-bt").click(function() {
				doSearch();
			})
		},
		error:function(){
			$("#messageHint").append('<a  href="https://github.com/eyunzhu/vatfs" style="color: red;">Server Error!</a>&emsp;');
			$("#messageHint").append('<a  href="http://v.eyunzhu.com">官网</a>&emsp;');
			$("#messageHint").append('<a  href="http://eyunzhu.com">联系作者</a>&emsp;&emsp;');
		}
	});
}

//获取直播源
function getLiveSource(){
	$.ajax({
		url: localConfig.liveSource,
		success:function(e){
			if(e.code){
				e.data.forEach(function(v){
					appendStr = '<div><span >' +v.name +'</span><div style="margin-bottom: 10px;font-size: 14px;">';
					v.data.forEach(function(vs){
						appendStr += '<a href="/play.html?url='+vs.url+'">'+vs.name+'</a>&nbsp;&nbsp;';
					})
					appendStr += '</div></div>';
					$("#liveSourceBox").append(appendStr);
				})
			}
			
		},
		error:function(){
			$("#messageHint").text("直播源获取错误，请检查!");
			$("#messageHintLink").text("官方网站");
			$("#messageHintLink").show();
		}
	});
}

function doSearch() {
	//获取搜索关键词
	var wd = $("#input-kw").val();
	if (wd.match(/^[ ]*$/)) {
		$("#searchSuggest").text("请先输入关键词！");
		return;
	}
	//隐藏站点描述
	$("#siteDescript").hide();
	//清空搜索结果
	$("#searchResult").empty();

	for (var siteId = 0; siteId < serverConfig.siteSum; siteId++) {
		//加站点区块
		$("#searchResult").append('<div id="siteBlock' + siteId + '" class="col-12"></div>');
		//添加站点标题
		$("#siteBlock" + siteId).append('<div  class="nice-c">站点' + (siteId + 1) + '</div>');
		//添加站点加载图标
		var loadingId = "loading" + siteId;
		var loadingDiv = '<div id="' + loadingId +
			'" class="col-12 nice-c" >&emsp;&emsp;加载中...<img src="https://pane.oss-cn-beijing.aliyuncs.com/disposable/file/zatu/loading3.gif"  style="width: 16px;height:16px"></div>';
		$("#siteBlock" + siteId).append(loadingDiv);
		$("#siteBlock" + siteId).append('<div id="urlblock' + siteId + '"  class="row mr-0"></div>');
		//合成搜索链接
		var searchUrl = localConfig.search + "?siteId=" + siteId + "&wd=" + wd;
		$.ajax({
			url: searchUrl,
			timeout: 4000,
			complete: function(result) {
				if (result.status == 200) {
					if (result.responseJSON.code && result.responseJSON.data.data.length) {
						$("#loading" + result.responseJSON.data.siteId).remove();
						var appendStr = "";
						result.responseJSON.data.data.forEach(function(v) {
							appendStr = "<div class='col-md-3 col-12 pr-0 mb-0'><a href=detail.html?siteId=" + result.responseJSON.data
								.siteId + "&url=" + encodeURIComponent(v.url) + " target='_blank'>" + v.name + "</a></div>";
							$("#urlblock" + result.responseJSON.data.siteId).append(appendStr);
						})
					} else {
						console.log("请求成功,无数据", result.responseJSON)
						$("#loading" + result.responseJSON.data.siteId).remove();
						$("#siteBlock" + result.responseJSON.data.siteId).append(
							'<div class="col-12 nice-c" >&emsp;&emsp;站点无此影视，关注微信公众号：古图，留言添加资源</div>');
					}
				} else if (result.status == 0) {
					console.log("请求失败", result.statusText, result)
				}
			}
		});
	}
	setTimeout(function() {
		console.log("5m");
		for (var siteId = 0; siteId < serverConfig.siteSum; siteId++) {
			var removeResult = $("#loading" + siteId).remove();
			if (removeResult.length) {
				$("#siteBlock" + siteId).append('<div class="col-12 nice-c" >&emsp;&emsp;请求超时</div>');
			}
		}
	}, 20000)
}

