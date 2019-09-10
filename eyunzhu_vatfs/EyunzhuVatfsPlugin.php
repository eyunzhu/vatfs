<?php
namespace plugins\eyunzhu_vatfs;
use cmf\lib\Plugin;

class EyunzhuVatfsPlugin extends Plugin
{
    public $info = [
        'name'        => 'EyunzhuVatfs', 
        'title'       => '影视全搜索',
        'description' => '全网m3u8影视资源',
        'status'      => 1,
        'author'      => 'eyunzhu',
        'version'     => '1.0',
        'demo_url'    => 'http://v.eyunzhu.com',
        'author_url'  => 'http://eyunzhu.com',
    ];

    public $hasAdmin = 0; //插件是否有后台管理界面

    // 插件安装
    public function install()
    {
        return true; //安装成功返回true，失败false
    }

    // 插件卸载
    public function uninstall()
    {
        return true; //卸载成功返回true，失败false
    }

    
}
