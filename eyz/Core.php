<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */

/**
 * 核心
 * 1.
 */
namespace eyz;
class Core
{
    static public function run()
    {
        spl_autoload_register('self::autoload'); //注册 自定义自动加载
        require ROOT_PATH . '/vendor/autoload.php';//载入 Composer自动加载器
        require('lib/common.php');//载入 公共函数

        if(!isset($_SERVER['PATH_INFO'])){
            $_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'];
        }
        $url_path = isset($_SERVER['PATH_INFO']) ? preg_replace('/\/+/','/',strtolower($_SERVER['PATH_INFO'])) : '/';
        $lastStr = substr($url_path,-5);
        if($lastStr == ".html"){
            $url_path = substr($url_path,0,strlen($url_path)-5);
        }
        define('URL_PATH',$url_path);
        $config = config_get('app');
        //是否开启调试
        define('DEBUG',$config['debug']);
        # @ Whoops 组件 错误处理类
        if(DEBUG){
            $whoops = new \Whoops\Run;
            $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
            ini_set('display_error', 'On');
        }else{
            set_error_handler("myErrorHandler", E_ALL | E_STRICT);  // 注册错误处理方法来处理所有错误
            set_exception_handler('myExceptionHandler');    // 注册异常处理方法来捕获异常
        }
        try{
            self::isInstall();//检测程序是否安装
            new \eyz\lib\Route();//处理路由
        }catch(\Exception $e){
            if($e->getCode() == '1000')//code==1000时为抛出接口响应
                echo $e->getMessage();
            else{
                $exceptionCreateFile = $e->getFile();
                if (substr($exceptionCreateFile,-14) == 'Validation.php'){//是否为验证器抛出错误
                    try{
                        $apiBaseController = new \eyz\lib\ApiBaseController;
                        $apiBaseController->error($e->getMessage());
                    }catch (\Exception $es){
                        echo $es->getMessage();
                    }
                }else{
                    DEBUG?$whoops->handleException($e):myExceptionHandler($e);
                }

            }
        }
    }

    /**
     * 自定义自动加载
     * @param $class
     */
    static public function autoload($class)
    {
        $file = strtr(ROOT_PATH . '/' . $class . '.php', '\\', DIRECTORY_SEPARATOR);
        if (file_exists($file)) {
            if (is_file($file)) {
                include_once $file;
            }
        }
    }
    /**
     * 检测是否安装
     */
    static  public function isInstall(){
//        if(!file_exists(DATA_PATH.DS.'install.lock')){
//            include ROOT_PATH.DS.'eyz/install/view/install.html';
//        }
//        exit;
    }
}