# vatfs (影视全搜索)
影视全搜索|提供全网影视m3u8资源搜索播放

搜索结果融合十几个站点结果，高效率的找到影视资源(欢迎提交优质的m3u8资源站点)
## 演示
1. 普通站点演示： [影视全搜索](http://v.eyunzhu.com)
2. ThinkCMF插件演示：[插件演示](https://tools.eyunzhu.com/plugin/eyunzhu_vatfs/index/index)

## 安装
1. 普通安装
	> 将status文件夹以及index.html、detail.html放入网站目录访问即可
2. ThinkCMF插件安装
	> 1. 将eyunzhu_vatfs文件夹放入ThinkCMF插件目录
	> 2. 访问地址 ：域名/plugin/eyunzhu_vatfs/index/index
**注意**
`若站点是https请取消注释detail.html中的第九行`

## 影视接口
### 搜索
>`https://tools.eyunzhu.com/api/wxgzh/video?siteId=0&wd=斗罗大陆`
> 1. siteId:采集资源站点id，目前资源站点id为[0,11] 欢迎提交优质的资源站点
> 2. wd:搜索关键词

### 获取播放地址
>`https://tools.eyunzhu.com/api/wxgzh/video/detail?siteId=0&url=%2F%3Fm%3Dvod-detail-id-47670.html`
> 1. siteId:采集资源站点id
> 2. url:搜索接口返回的url

## 截图
<img src="screenshot/1.jpg" width = "300" height="495" alt="图片名称" />
<img src="screenshot/2.jpg" width = "300" height="495" alt="图片名称" />



