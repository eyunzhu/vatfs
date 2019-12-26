<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */
namespace eyz\lib;

class Route
{
    static public $route = [];
    static public $param = [];

    private $application = '';//默认应用为第一个应用
    private $module = '';//模块
    private $controller = '';//控制器
    private $method = '';//操作方法

    public function __construct()
    {
        $routeConfig = config_get('route');
//        pe($routeConfig);
        //解析用户访问的地址
        self::$route = $this->getRoute();
        $this->startDoRequest(self::$route['application'], self::$route['module'], self::$route['controller'], self::$route['method']);
    }

    /**
     * @param $application
     * @param $module
     * @param $controller
     * @param $method
     * @throws \ReflectionException
     */
    public function startDoRequest($application, $module, $controller, $method)
    {
        $controllerStr = "\\$application\\$module\controller\\$controller";//操作类 位置
//        if(DEBUG)
//            echo PHP_EOL."$application\\$module\\$controller->$method".PHP_EOL;
        if (!class_exists($controllerStr))
            throw new \Exception("$controllerStr 控制器不存在");
        $requestController = new $controllerStr();

        if (!method_exists($requestController, $method))
            throw new \Exception("$method 方法未定义");
        //方法参数绑定
        $reflect = new \ReflectionMethod($controllerStr, $method);// 建立 Person这个类的反射类
        $params = $reflect->getParameters();
        $args = [];
        foreach ($params as $param) {
            $name = $param->getName();
            $defult = '';
            if ($param->isDefaultValueAvailable()) {
                $defult = $param->getDefaultValue();
            }
            $args[] = isset($_POST[$name]) ? $_POST[$name] : (isset($_GET[$name]) ? $_GET[$name] : $defult);
        }
        $reflect->invokeArgs($requestController, $args);
        //$requestController->$method($_GET);
    }


    /**
     * 获取当前访问路由
     * @return array
     */
    public function getRoute()
    {
        /**1.获取当前访问的应用**/
        $this->getAppName();
        /**2.获取当前访问的应用配置**/
        $applicationConfig = \eyz\lib\Config::getApplicationConfig($this->application);
        //设置当前访问的应用的默认 模块、控制器、操作方法
        $this->module = isset($applicationConfig['default_module']) ? $applicationConfig['default_module'] : 'index';
        $this->controller = isset($applicationConfig['default_controller']) ? $applicationConfig['default_controller'] : 'Index';
        $this->method = isset($applicationConfig['default_method']) ? $applicationConfig['default_method'] : 'Index';
        /**3.解析访问路由**/
        return $this->analysisRequestUrl();
    }

    /**
     * 获取当前访问的应用名称
     */
    public function getAppName()
    {
        $URI = substr($_SERVER['REQUEST_URI'], 1);
        if (empty($URI)) {
            $this->application = APP_ARR[0];
        } else {
            $URI = explode('%EF%BC%9F', $URI)[0];
            $URI = explode('?', $URI)[0];
            $URIArr = explode('/', $URI);
            $isTopName = in_array($URIArr[0], APP_ARR);//是否为应用
            $this->application = $isTopName ? $URIArr[0] : APP_ARR[0];
        }
        return $this->application;
    }


    /**
     * 解析当前访问地址
     */

    public function analysisRequestUrl()
    {
//        $appConfig = config_get('app');
//        //appa默认配置路由
//        $route = [
//            "application"   => $appConfig['default_application'],
//            "module"        => $appConfig['default_module'],
//            "controller"    => to_hump_h($appConfig['default_controller']) . "Controller",//控制器转驼峰 首字母大写
//            "method"        => to_hump_l($appConfig['default_method']),
//        ];


        //路由规则配置
        $routeConfig = config_get('route');
        //1.完全匹配路由规则
        if(isset($routeConfig[URL_PATH])){
            //直接匹配成功
            //echo "直接匹配成功".PHP_EOL;
            $rule = URL_PATH;
            $current = $routeConfig[URL_PATH];
            $currentArr = explode('/',$current);
            $route = [
                "application"   => get_app_name(),
                "module"        => $currentArr[0],
                "controller"    => to_hump_h($currentArr[1]) . "Controller",//控制器转驼峰 首字母大写
                "method"        => to_hump_l($currentArr[2]),
            ];
        }
        //2.正则匹配路由规则
        foreach ($routeConfig as $k=>$v){
            $reg = '/^'.str_replace('/','\/',preg_replace('/:[a-z]+(?=\/|\$|$)/','\S+',$k)).'/';
            if(preg_match($reg,URL_PATH,$re)){
                $rule = $k;
                $current = $routeConfig[$k];
                $currentArr = explode('/',$current);
                $route = [
                    "application"   => get_app_name(),
                    "module"        => $currentArr[0],
                    "controller"    => to_hump_h($currentArr[1]) . "Controller",//控制器转驼峰 首字母大写
                    "method"        => to_hump_l($currentArr[2]),
                ];
                break;
            }
        }
        // 路由规则匹配成功
        if (isset($rule)) {
            $param = [];
            $rule_list = explode('/', $rule);
            $path_list = explode('/', URL_PATH);
            if(strpos($rule, ':')!==false){
                foreach ($rule_list as $key => $value) {
                    if (substr($value,0,1)==':') {
                        $param[trim($value,':$')] = $path_list[$key];
                    }
                }
            }
            // 获取剩余参数
            for ($i=count($rule_list); $i < count($path_list); $i+=2) {
                if (isset($path_list[$i+1])) {
                    $param[$path_list[$i]] = $path_list[$i+1];
                }
            }
            self::$param = array_merge($param,$_GET,$_POST);
            return $route;
        }else{
            return $this->analysisRequestUrl0();
        }
    }
    public function analysisRequestUrl0()
    {
        if(substr($_SERVER['REQUEST_URI'],-5) == ".html"){
            $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'],0,strlen($_SERVER['REQUEST_URI'])-5);
        }

        //是否存在地址参数
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $URI = substr($_SERVER['REQUEST_URI'], 1);
            $URISArr = explode('?', $URI);

            if (count($URISArr) > 1 && $URISArr[0] != '') {
                $URIArr = explode('/', $URISArr[0]);
            } else {
                $URIArr = explode('/', $URI);
            }
            //地址中是否有应用
            $isTopName = in_array($URIArr[0], APP_ARR);//是否为应用
            if ($isTopName) {//地址中存在应用
                $this->application = $URIArr[0];
                unset($URIArr[0]);
                if (!empty($URIArr[1])) {
                    $this->module = $URIArr[1];
                    unset($URIArr[1]);
                }
                if (!empty($URIArr[2])) {
                    $this->controller = $URIArr[2];
                    unset($URIArr[2]);
                }
                if (!empty($URIArr[3])) {
                    //判断$URIArr[3] 中是否存在问好
                    $methodStrArr = explode('?', $URIArr[3]);
                    if (count($methodStrArr) > 1) {//有?
                        $this->method = $methodStrArr[0];
                    } else {
                        $this->method = $URIArr[3];
                    }
                    unset($URIArr[3]);
                }
                //url多余部分转为GET
                $count = count($URIArr) + 2;
                $i = 2;
                while ($i < $count) {
                    if (!empty($URIArr[$i + 3]))
                        $_GET[$URIArr[$i + 2]] = $URIArr[$i + 3];
                    $i = $i + 2;
                }

            } else {//地址参数中没有应用
                if (substr($URIArr[0], 0, 1) != '?') {
                    $this->module = $URIArr[0];
                    unset($URIArr[0]);
                    if (!empty($URIArr[1])) {
                        $this->controller = $URIArr[1];
                        unset($URIArr[1]);
                    }
                    if (!empty($URIArr[2])) {
                        //判断$URIArr[2] 中是否存在问好
                        $methodStrArr = explode('?', $URIArr[2]);
                        if (count($methodStrArr) > 1) {//有?
                            $this->method = $methodStrArr[0];
                        } else {
                            $this->method = $URIArr[2];
                        }
                        unset($URIArr[2]);
                    }
                    //url多余部分转为GET
                    $count = count($URIArr) + 2;
                    $i = 2;
                    while ($i < $count) {
                        if (!empty($URIArr[$i + 2]))
                            $_GET[$URIArr[$i + 1]] = $URIArr[$i + 2];
                        $i = $i + 2;
                    }
                }
            }
        }

        self::$param = array_merge($_GET,$_POST);

        $application = $this->application;
        $module = $this->module;
        $controller = to_hump_h($this->controller) . "Controller";//控制器转驼峰 首字母大写
        $method = to_hump_l($this->method);//方法转驼峰 首字母小写


        return [
            "application" => $application,
            "module" => $module,
            "controller" => $controller,
            "method" => $method,
        ];
    }
}