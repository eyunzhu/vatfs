# vatfs (影视全搜索)
> 提供全网m3u8影视资源(电影、动漫、电视剧、综艺等)搜索、直播源整理、资源播放

	搜索结果融合十几个站点结果，高效率的找到影视资源,从此看剧不用愁
	(欢迎提交优质的m3u8资源站点)
> **交流QQ群号:**490993740	
> 有问题，或者建议，请提交 [issues](https://github.com/eyunzhu/vatfs/issues)
## 计划
- [X] 各站点影视搜索接口
- [X] 直播接口
- [X] 搜索排行
- [X] 独立站点 ➡️[影视全搜索](http://v.eyunzhu.com)
- [ ] 小程序 (开发中)
- [ ] android app (开发中)
- [ ] iOS app (开发中)
- [ ] 插件
	- [X] ThinkCMF插件
	- [ ] WordPress插件
- [X] 管理后台(应网友要求，已添加微信扫码登陆后台)

## 演示
1. 普通站点演示： [影视全搜索](http://v.eyunzhu.com)
2. ThinkCMF插件演示：[插件演示](https://tools.eyunzhu.com/plugin/eyunzhu_vatfs/index/index)

## 安装使用
1. 普通安装 [点我下载最新版](https://github.com/eyunzhu/vatfs/archive/master.zip)
	> 下载文件放入网站根目录访问`index.html`即可
2. ThinkCMF插件安装
	> 1. 将eyunzhu_vatfs文件夹放入ThinkCMF插件目录
	> 2. 访问地址 ：域名/plugin/eyunzhu_vatfs/index/index

## 注意：
若站点添加了ssl,请在`detail.html`,`play.html`页面的head部分加入下方代码(用于将http资源转为https资源)
```
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
```
并删除`static/js/common.js`中的下方代码（7-10行）
```
// https跳转到http
if('https:' == document.location.protocol){
	window.location.href = 'http'+window.location.href.slice(5);
}
```
Ps:因部分资源站不支持https资源，所以本站不建议添加ssl

## 接口
### 1.搜索
`https://api.eyunzhu.com/plugin/eyunzhu_vatfs_api/api/index?wd=斗罗&siteId=0`
- siteId:采集资源站点id，目前资源站点id为[0,11] 欢迎提交优质的资源站点
- wd:搜索关键词

### 2.获取播放地址
`https://api.eyunzhu.com/plugin/eyunzhu_vatfs_api/api/detail?url=/?m=vod-detail-id-107281.html&siteId=0`
- siteId:采集资源站点id
- url:搜索接口返回的url

### 3.直播源
`https://api.eyunzhu.com/plugin/eyunzhu_vatfs_api/api/getLiveSource`


## 截图
**1. 影视全搜索-首页**
<img src="screenshot/1.jpg" alt="影视全搜索-首页" />
**2. 影视全搜索-搜索页**
<img src="screenshot/2.jpg" alt="影视全搜索-搜索页" />
**3. 影视全搜索-播放页**
<img src="screenshot/3.jpg" alt="影视全搜索-播放页" />



