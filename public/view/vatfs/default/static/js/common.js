/**
* author : 忆云竹 < http://eyunzhu.com/ >
* e-mail : support@eyunzhu.com
* github : https://github.com/eyunzhu/vatfs
    * blog   : http://eyunzhu.com
    * QQ群   : 490993740
**/
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
console.log('%c欢迎使用 %c影视全搜索 http://v.eyunzhu.com ','','color:#ff8400;');
console.group('忆云竹');
console.log('忆云竹 %c技术教程,资源分享 http://eyunzhu.com','color:#ff8400');
console.log('小淘券 %c淘宝内部优惠券 http://tb.eyunzhu.com','color:#ff8400');
console.log('影视全搜索 %c全网影视检索，你要的这都有 http://v.eyunzhu.com','color:#ff8400');
console.groupEnd('忆云竹');

console.group('更多资源');
console.log('关注微信公众号：小白资源分享');
console.log('关注微信公众号：古图');
console.groupEnd('更多资源');
console.log('%c ','background-image:url("https://eyunzhu.com/wp-content/uploads/2018/06/logo2.png");background-size:100% 100%;background-repeat:no-repeat;background-position:center center;line-height:0px;padding:30px 110px;');
/* 友盟统计 */
//console.log("友盟统计");
var cnzz_s_tag = document.createElement('script');
cnzz_s_tag.type = 'text/javascript';
cnzz_s_tag.async = true;
cnzz_s_tag.charset = 'utf-8';
cnzz_s_tag.src = 'https://w.cnzz.com/c.php?id=1277946350&async=1';
var root_s = document.getElementsByTagName('script')[0];
root_s.parentNode.insertBefore(cnzz_s_tag, root_s);

/* 百度链接主动推送 */
(function(){
    //console.log("百度链接主动推送");
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
