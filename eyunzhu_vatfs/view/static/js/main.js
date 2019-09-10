/*
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
*/
$(document).ready(function() {
	Maintain = false;
	$.ajax({
		url: "https://tools.eyunzhu.com/api/wxgzh/video/config",
		timeout: 6000,
		complete: function(result) {
			if (result.status == 200) {
				result.responseJSON.data.link.forEach(function(v) {
					appendStr = '<a style="color:#ffc107" href="'+v.link+'">'+v.name+'</a>&nbsp;&nbsp;';
					$("#bottobLink").append(appendStr);
				})
				if (result.responseJSON.code) {
					siteSum = result.responseJSON.data.siteSum
				} else {
					console.log("API维护中");
					Maintain=true;
					$("#siteDescript").empty();
					$("#siteDescript").append('<h5 style="color:white">维护中...&nbsp;&nbsp;<span style="color:#ffc107">'+result.responseJSON.msg+'</span> </h5><div ><a style="color:white" href="mailto:support@eyunzhu.com">联系作者: support@eyunzhu.com</a></div>');
				}
			} else{
				$("#siteDescript").empty();
				$("#siteDescript").append('<h5 style="color:red">程序错误...</h5>&nbsp;&nbsp;<div style="color:#ffc107">管理员请查看程序是否配置正确</div><div ><a href="https://github.com/eyunzhu/vatfs">最新程序下载地址</a></div><div ><a style="color:white" href="mailto:support@eyunzhu.com">联系作者: support@eyunzhu.com</a></div> ');
				
				Maintain=true;
			}
		}
	});
	
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
});
function doSearch() {
	if(Maintain){
		alert("维护中，请稍后尝试")
		return;
	}
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

	for (var siteId = 0; siteId < siteSum; siteId++) {
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
		var searchUrl = "https://tools.eyunzhu.com/api/wxgzh/video?siteId=" + siteId + "&wd=" + wd;
		$.ajax({
			url: searchUrl,
			//timeout: 14000,
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
		console.log("10m");
		for (var siteId = 0; siteId < siteSum; siteId++) {
			var removeResult = $("#loading" + siteId).remove();
			if (removeResult.length) {
				$("#siteBlock" + siteId).append('<div class="col-12 nice-c" >&emsp;&emsp;请求超时</div>');
			}
		}
	}, 20000)
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
