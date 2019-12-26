<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */
namespace eyz\lib;

class BaseController
{
    public $assign =  [];
    public $route  = '';
    public $tmplRealFilePath = '';//模版文件完整路径

    public function __construct()
    {
        $app = get_app_name();
        $this->route = $route = Route::$route;
        $default_template = config_get('app')['default_template'];
        $default_template = ($default_template == '')?'default':$default_template;
        $tmplFilePath = DS.$route['application'].DS.$default_template;
        $controller = strtolower(substr($route['controller'],0,-10));
        $this->tmplRealFilePath = ROOT_PATH.DS."public".DS."view".$tmplFilePath.DS.$route['module'].DS.$controller;

        $this->assign['__ROOT_PATH__'] = DS;
        $this->assign['__TMPL__'] = DS."view".DS.$app.DS.$default_template;

    }

    public function assign($name,$value){
        $this->assign[$name] = $value;
    }
    public function display(){
        $file = $this->tmplRealFilePath.DS.$this->route['method'].'.html';
        if (!file_exists($file)){
            throw new \Exception(ROOT_PATH.$file.'模版文件不存在');
        }

        //加载Twig模版引擎
        $loader = new \Twig\Loader\FilesystemLoader($this->tmplRealFilePath);//文件系统加载器 将模版所在目录加载进来
        $twig = new \Twig\Environment($loader, [
            'cache' => ROOT_PATH.DS."runtime".DS."cache",
            'debug' =>DEBUG,//When set to true, it automatically set "auto_reload" to true
            'auto_reload'=>true,//Whether to reload the template if the original source changed.
            "strict_variables"  =>false,//Whether to ignore invalid variables in templates
        ]);
        echo $twig->render($this->route['method'].'.html', $this->assign);
    }
}