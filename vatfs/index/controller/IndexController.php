<?php
/**
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
 * QQ群   : 490993740
 * 欢迎交流使用本程序，但请保留版权
 */

namespace vatfs\index\controller;
use eyz\lib\ApiBaseController;
use eyz\lib\BaseController;
use eyz\lib\EyzValidation;
use eyz\lib\FileConfig;
use eyz\lib\Request;
use eyz\lib\Route;

class IndexController extends BaseController
{
    private $fileConfig = '';
    public function __construct()
    {
        $this->fileConfig = new FileConfig(ROOT_PATH.DS.get_app_name().DS."siteConfig");
        $siteConfig = $this->fileConfig->get();
        $this->assign('siteBaseConfig',$siteConfig['siteBaseConfig']);
        parent::__construct();
    }

    /**
     * 首页
     */
    public function index(){
        $fileConfig = $this->fileConfig;
        $siteConfig = $fileConfig->get();

        $today      = date("Y-m-d");
        if (!empty($siteConfig['cache'][$today])){//今日 有缓存
            $rank = $siteConfig['cache'][$today]['rank'];
            $live = $siteConfig['cache'][$today]['live'];
        }else{//今日 无缓存
            //获取 搜索排行
            $rankingData = eyz_file_get_contents($siteConfig['siteBaseConfig']['searchRankingApi']);
            $rank = (array)json_decode($rankingData,true)['data'];
            //获取直播源
            $liveData = eyz_file_get_contents($siteConfig['siteBaseConfig']['liveSourceApi']);
            $live = (array)json_decode($liveData,true)['data'];

            $fileConfig->delete('cache');
            $fileConfig->set('cache',[$today=>["rank"=>$rank,"live"=>$live]]);
            $fileConfig->save();
        }

        $this->assign('rank',$rank);
        $this->assign('live',$live);
        $this->display();
    }

    /**
     * 搜索页面
     */
    public function search(){
        $param  = Route::$param;
        $kw     = isset($param['kw'])?$param['kw']:'';
        $kw     = urldecode($kw);
        $page   = isset($param['page'])?$param['page']:1;
        $fileConfig = $this->fileConfig;
        $siteConfig = $fileConfig->get();
        $searchApi  = $siteConfig['siteBaseConfig']['searchApi'];

        $searchUrl = $searchApi."?kw=".$kw."&per_page=25&page=".$page;
        $getResult = eyz_file_get_contents($searchUrl);
        $searchResult = (array)json_decode($getResult,true)['data'];

        $this->assign('kw',$kw);
        $this->assign('page',$page);
        $this->assign('max',$searchResult['last_page']);
        $this->assign('url',"detail");
        $this->assign('searchResult',$searchResult);
        $this->display();
    }

    /**
     * 详情页面
     */
    public function detail(){
        $param = Route::$param;
        (isset($param['vid']) && is_numeric($param['vid']))?$vid = $param['vid']:header('Location: /');
        $fileConfig = $this->fileConfig;
        $siteConfig = $fileConfig->get();
        $detailApi  = $siteConfig['siteBaseConfig']['detailApi'];

        $detailUrl = $detailApi."?vid=".$vid;
        $getResult = eyz_file_get_contents($detailUrl);
        $detailResult = (array)json_decode($getResult,true)['data'];

        $key = key($detailResult['playUrl']);//第一个播放地址的key
        $this->assign('detailResult',$detailResult);
        $this->assign('playUrl',$detailResult['playUrl'][$key]);
        $this->display();
    }

    /**
     * 播放器
     */
    public function player()
    {
        $param = Route::$param;
        $url = (!empty($param['url']))?$param['url']:'http://tx.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1.m3u8';
        $this->assign('url',$url);
        $this->display();
    }

    public function uploadFile(){
        $apiBaseController = new ApiBaseController();
        session_start();
        if(!isset($_SESSION['userName']) ){
            $apiBaseController->error("没有权限");
        }
        isset($_FILES["file"])?'':$apiBaseController->error("请上传文件");
        // 允许上传的图片后缀
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);        // 获取文件后缀名
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 204800*1024*2)    // 小于 200*1024*2 kb
            && in_array($extension, $allowedExts))
        {
            if ($_FILES["file"]["error"] > 0)
            {
                $apiBaseController->error("error",$_FILES["file"]["error"]);
            }
            else
            {
                $path =  ROOT_PATH.DS."public".DS."static".DS."upload".DS;
                $saveFileName = time().".".$extension;
                //目录不存在就创建
                if(!file_exists($path))
                    mkdir(iconv("UTF-8", "GBK", $path),0777,true);
                if (file_exists($path.$saveFileName))
                    $apiBaseController->error($path.$saveFileName . " 文件已经存在。 ");
                else
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $path.$saveFileName);
                    $apiBaseController->success("success",DS."static".DS."upload".DS.$saveFileName);
                }
            }
        }else{
            $apiBaseController->error("error","非法的文件格式");
        }
        $apiBaseController->success("success",$_FILES);
    }
}