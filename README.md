# vatfs (影视全搜索)
> 提供全网m3u8影视资源(电影、动漫、电视剧、综艺等)搜索、直播源整理、资源播放

	搜索结果融合十几个站点结果，高效率的找到影视资源(欢迎提交优质的m3u8资源站点)
	从此看剧不用愁
## 计划
- [X] 各站点影视搜索接口
- [X] 直播接口
- [X] 搜索排行
- [X] 独立站点
- [ ] 小程序
- [ ] android app
- [ ] iOS app
- [ ] 插件
	- [X] ThinkCMF插件
	- [ ] WordPress插件

## 演示
1. GitHub Pages：[GitHub Pages 演示](https://eyunzhu.github.io/vatfs/)
2. 普通站点演示： [影视全搜索](http://v.eyunzhu.com)
3. ThinkCMF插件演示：[插件演示](https://tools.eyunzhu.com/plugin/eyunzhu_vatfs/index/index)

## 安装使用
1. 普通安装
	> 下载文件放入网站根目录访问`index.html`即可
2. ThinkCMF插件安装
	> 1. 将eyunzhu_vatfs文件夹放入ThinkCMF插件目录
	> 2. 访问地址 ：域名/plugin/eyunzhu_vatfs/index/index
**注意**
`若站点是https请取消注释detail.html中的第九行`

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



