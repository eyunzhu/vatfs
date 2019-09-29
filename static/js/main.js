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
			getSearchList()
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
//获取搜索排行
function getSearchList(){
	$.ajax({
		url: localConfig.baiduTop,
		success:function(e){
			if(e.code){
				var searchList = e.data;
				//分类标题
				appendStr = '<div class="swiper-wrapper" id="swiper-wrapper-title">';
				searchList.forEach(function(v,index){
					if(index == 0){
						appendStr += '<div class="swiper-slide selected">'+v.name +'</div>';
					}else{
						appendStr += '<div class="swiper-slide">'+v.name +'</div>';
					}
				})
				appendStr += '</div>';
				$("#swiper-container1").append(appendStr);
				
				//分类内容
				searchList.forEach(function(v,index){
					appendStr = '';
					appendStr += '<div  class="swiper-slide swiper-no-swiping"><div class="row" >';
					for(var item in v.data){
						appendStr += '<div  class="col-md-2 col-6" style="white-space:nowrap;word-break:keep-all;text-overflow:ellipsis;overflow:hidden;"><a href="/?kw='+item+'">'+item + ' <span style="color:#336600;">' +v.data[item]+'</span></a></div>';
					}
					appendStr += '</div></div>';
					$("#swiper-wrapper2").append(appendStr);
				})
				onloadSwiper1()
			}
		},
		error:function(){
			$("#messageHint").text("搜索排行榜获取错误，请检查!");
			$("#messageHintLink").text("官方网站");
			$("#messageHintLink").show();
		}
	});
}

//获取直播源
function getLiveSource(){
	$.ajax({
		url: localConfig.liveSource,
		success:function(e){
			if(e.code){
				//分类标题
				appendStr = '<div class="swiper-wrapper" id="swiper-wrapper-title">';
				e.data.forEach(function(v,index){
					if(index == 0){
						appendStr += '<div class="swiper-slide selected">'+v.name +'</div>';
					}else{
						appendStr += '<div class="swiper-slide">'+v.name +'</div>';
					}
				})
				appendStr += '</div>';
				$("#swiper-container11").append(appendStr);
				
				//分类内容
				e.data.forEach(function(v,index){
					appendStr = '';
					appendStr += '<div  class="swiper-slide swiper-no-swiping"><div class="row" >';
					v.data.forEach(function(vs){
						appendStr += '<div  class="col-md-2 col-6" style="white-space:nowrap;word-break:keep-all;text-overflow:ellipsis;overflow:hidden;"><a href="/play.html?url='+vs.url+'">'+vs.name +'</span></a></div>';
					})
					appendStr += '</div></div>';
					$("#swiper-wrapper22").append(appendStr);
				})
				onloadSwiper11()
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
			timeout: 15000,
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

function onloadSwiper1(){
					function setCurrentSlide(ele, index) {
						$(".swiper1 .swiper-slide").removeClass("selected");
						ele.addClass("selected");
						//swiper1.initialSlide=index;
					}
	
					var swiper1 = new Swiper('.swiper1', {
	//					设置slider容器能够同时显示的slides数量(carousel模式)。
	//					可以设置为number或者 'auto'则自动根据slides的宽度来设定数量。
	//					loop模式下如果设置为'auto'还需要设置另外一个参数loopedSlides。
						slidesPerView: 5.5,
						paginationClickable: true,//此参数设置为true时，点击分页器的指示点分页器会控制Swiper切换。
						spaceBetween: 10,//slide之间的距离（单位px）。
						freeMode: true,//默认为false，普通模式：slide滑动时只滑动一格，并自动贴合wrapper，设置为true则变为free模式，slide会根据惯性滑动且不会贴合。
						loop: false,//是否可循环
						onTab: function(swiper) {
							var n = swiper1.clickedIndex;
						}
					});
					swiper1.slides.each(function(index, val) {
						var ele = $(this);
						ele.on("click", function() {
							setCurrentSlide(ele, index);
							swiper2.slideTo(index, 500, false);
							//mySwiper.initialSlide=index;
						});
					});
	
					var swiper2 = new Swiper('.swiper2', {
						//freeModeSticky  设置为true 滑动会自动贴合  
						direction: 'horizontal',//Slides的滑动方向，可设置水平(horizontal)或垂直(vertical)。
						loop: false,
	//					effect : 'fade',//淡入
						//effect : 'cube',//方块
						//effect : 'coverflow',//3D流
	//					effect : 'flip',//3D翻转
						autoHeight: true,//自动高度。设置为true时，wrapper和container会随着当前slide的高度而发生变化。
						onSlideChangeEnd: function(swiper) {  //回调函数，swiper从一个slide过渡到另一个slide结束时执行。
							var n = swiper.activeIndex;
							setCurrentSlide($(".swiper1 .swiper-slide").eq(n), n);
							swiper1.slideTo(n, 500, false);
						}
					});
}

function onloadSwiper11(){
	function setCurrentSlide(ele, index) {
						$(".swiper11 .swiper-slide").removeClass("selected");
						ele.addClass("selected");
						//swiper1.initialSlide=index;
					}
	
					var swiper11 = new Swiper('.swiper11', {
	//					设置slider容器能够同时显示的slides数量(carousel模式)。
	//					可以设置为number或者 'auto'则自动根据slides的宽度来设定数量。
	//					loop模式下如果设置为'auto'还需要设置另外一个参数loopedSlides。
						slidesPerView: 5.5,
						paginationClickable: true,//此参数设置为true时，点击分页器的指示点分页器会控制Swiper切换。
						spaceBetween: 10,//slide之间的距离（单位px）。
						freeMode: true,//默认为false，普通模式：slide滑动时只滑动一格，并自动贴合wrapper，设置为true则变为free模式，slide会根据惯性滑动且不会贴合。
						loop: false,//是否可循环
						onTab: function(swiper) {
							var n = swiper11.clickedIndex;
						}
					});
					swiper11.slides.each(function(index, val) {
						var ele = $(this);
						ele.on("click", function() {
							setCurrentSlide(ele, index);
							swiper22.slideTo(index, 500, false);
							//mySwiper.initialSlide=index;
						});
					});
					var swiper22 = new Swiper('.swiper22', {
						//freeModeSticky  设置为true 滑动会自动贴合  
						direction: 'horizontal',//Slides的滑动方向，可设置水平(horizontal)或垂直(vertical)。
						loop: false,
	//					effect : 'fade',//淡入
						//effect : 'cube',//方块
						//effect : 'coverflow',//3D流
	//					effect : 'flip',//3D翻转
						autoHeight: true,//自动高度。设置为true时，wrapper和container会随着当前slide的高度而发生变化。
						onSlideChangeEnd: function(swiper) {  //回调函数，swiper从一个slide过渡到另一个slide结束时执行。
							var n = swiper.activeIndex;
							setCurrentSlide($(".swiper11 .swiper-slide").eq(n), n);
							swiper11.slideTo(n, 500, false);
						}
					});
	}