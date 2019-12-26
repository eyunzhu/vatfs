<?php
/**
* author : 忆云竹 < http://eyunzhu.com/ >
* e-mail : support@eyunzhu.com
* github : https://github.com/eyunzhu/vatfs
* blog   : http://eyunzhu.com
* QQ群   : 490993740
* 欢迎交流使用本程序，但请保留版权
*/

namespace vatfs\admin\controller;
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
        session_start();
    }

    /**
     * 管理后台首页
     */
    public function Index(){
        if(!isset($_SESSION['userName']) ){
            header("Location:/login");
            exit;
        }
        $siteConfig = $this->fileConfig->get();
        $siteBaseConfig = $siteConfig['siteBaseConfig'];

        $param = Route::$param;
        $userChange = false;
        if(!empty($param['searchApi'])){
            if($siteBaseConfig['user']  != $param['user']){//用户名更改
                $userChange = true;
            }
            if(!empty($param['password']) && $siteBaseConfig['password'] != md5($param['password'])){//密码更改
                $userChange = true;
                $param['password'] = md5($param['password']);
            }else{
                $param['password'] = $siteBaseConfig['password'];
            }

            $param['navRight']=json_decode($param['navRight'],true);
            $param['link']=json_decode($param['link'],true);
            $param['meta'] = [
                "keywords"=>$param['keywords'],
                "description"=>$param['description']
            ];
            unset($param['keywords'],$param['description']);
            $siteBaseConfig = array_merge($siteBaseConfig,$param);

            $this->fileConfig->set("siteBaseConfig",$siteBaseConfig);
            $this->fileConfig->save();
            if($userChange == true){
                $this->LoginOut();
            }
            $siteConfig = $this->fileConfig->get();
            $this->assign('siteBaseConfig',$siteConfig['siteBaseConfig']);
        }

        $this->assign('navRight',json_encode($siteConfig['siteBaseConfig']['navRight'],JSON_UNESCAPED_UNICODE));
        $this->assign('link',json_encode($siteConfig['siteBaseConfig']['link'],JSON_UNESCAPED_UNICODE));
        $this->display();
    }

    public function Login(){
        if(isset($_SESSION['userName']) ){
            header("Location:/admin");
            exit;
        }
        $siteConfig = $this->fileConfig->get();
        $siteBaseConfig = $siteConfig['siteBaseConfig'];
        $request = new Request();
        $data = $param = $request->param();

        if(isset($param['userName']) && isset($param['passWord'])){
            if($siteBaseConfig['user'] == $param['userName'] && $siteBaseConfig['password'] == md5($param['passWord'])){
                $_SESSION['userName']=$data['userName'];
                header("Location:/admin");
                exit;
            }else{//登陆失败
                $this->assign('loginStatus',"error");
            }
        }
        $this->display();
    }

    public function LoginOut(){
        session_unset();
        session_destroy();
        setcookie(session_name(),'',time()-3600);
        header("Location:/login");
    }
}