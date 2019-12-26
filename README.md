# vatfs (影视全搜索)
> 基于框架[eyz](https://github.com/eyunzhu/eyz)优化而成的影视全搜索是一个集合众多资源站的影视检索程序,
> 实现全网m3u8影视资源检索、直播源整理等

## 演示
&emsp;&emsp;演示站点：️[影视全搜索](http://v.eyunzhu.com)

## 起源
&emsp;&emsp;学习PHP爬虫练习项目,~~中间结合vue练习项目~~,后结合uniapp练习项目,后结合MVC框架练习项目

## 交流
> 程序多有不足之处,欢迎交流指正
1. 交流QQ群号:490993740
2. 博客:[eyunzhu.com](http://eyunzhu.com/)
3. 有问题，或者建议，请提交 [issues](https://github.com/eyunzhu/vatfs/issues)
4. 欢迎提交优质资源站点
5. 欢迎制作提交前端模版(模版目录为``public/view/vatfs`` 默认模版为``default``)

## 计划
- [X] 各站点影视搜索接口
- [X] 直播接口
- [X] 搜索排行
- [X] 独立站点 ：[影视全搜索](http://v.eyunzhu.com)
- [ ] 小程序 (等待开发中)
- [X] android app 公测版 ：️[怕黑](http://eyunzhu.com/tools/pahei/app.html)
	- [X] 投屏功能
	- [ ] 缓存功能
- [ ] iOS app (等待开发中)
- [ ] ~~插件~~(取消插件模式)
	- [X] ~~ThinkCMF插件~~
	- [ ] ~~WordPress插件~~
- [X] 管理后台(应网友要求，已添加~~微信扫码登陆~~后台,2.1版本改为密码登陆)
- [ ] 增添解析播放（等待开发）


## 安装使用
> PHP>=7.2
1. 下载程序压缩包 [点我下载最新版](https://github.com/eyunzhu/vatfs/archive/master.zip)
2. 解压置于网站根目录，设置`public`目录为网站运行目录
3. 管理后台地址：/admin  默认账户：eyunzhu密码：vatfs
4. 若为Nginx配置如下：
```
if (!-d $request_filename){
	set $rule_0 1$rule_0;
}
if (!-f $request_filename){
	set $rule_0 2$rule_0;
}
if ($rule_0 = "21"){
	rewrite ^/(.*)$ /index.php/$1 last;
}
```

## 接口
>为防止接口滥用，请关注公众号“古图”绑定域名
### 1.搜索
`https://api.eyunzhu.com/api/vatfs/resource_site_collect/search?kw=斗罗&per_page=50&page=1`
- per_page:每页显示数量
- page：当前页面
- wd:搜索关键词

### 2.获取播放地址等详情
`https://api.eyunzhu.com/api/vatfs/resource_site_collect/getVDetail?vid=1`
- vid:资源vid

### 3.直播源
`https://api.eyunzhu.com/plugin/eyunzhu_vatfs_api/api/getLiveSource`

### 4.影视搜索榜单
`http://api.eyunzhu.com/api/vatfs/baidu_top`

## 注意：
1. 因部分资源站不支持https资源，所以站点不建议添加ssl
2. 请关注公众号“古图”绑定域名以防止接口滥用
3. 欢迎交流使用本程序，但请保留版权


## 版本更新
### 2.1
> 由之前的html\css\js纯前端模式到vue版本，到此版本最终还是选择了PHP，本版本使用了自己集成的[eyz框架](https://github.com/eyunzhu/eyz)（框架优化中）。
1. 取消插件模式
2. 更新接口
3. 增加简易后台
4. 改用[eyz框架](https://github.com/eyunzhu/eyz)，前端添加多模版
5. 采集源码(位于vatfs/index/controller/CollectController.php,详细教程后续给出)

## 截图
**1. 影视全搜索-首页**
<img src="http://pane.oss.eyunzhu.com/static/project/vatfs/img/1.png" alt="影视全搜索-首页" />
**2. 影视全搜索-搜索页**
<img src="http://pane.oss.eyunzhu.com/static/project/vatfs/img/2.png" alt="影视全搜索-搜索页" />
**3. 影视全搜索-播放页**
<img src="http://pane.oss.eyunzhu.com/static/project/vatfs/img/3.png" alt="影视全搜索-播放页" />



