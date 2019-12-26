<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */

/**
 * 公共函数
 */

//获取配置
function config_get($name)
{
    return eyz\lib\Config::get($name);
}

function p($v)
{
    echo PHP_EOL;
    print_r($v);
    echo PHP_EOL;
}

function pe($v)
{
    echo PHP_EOL;
    print_r($v);
    exit;
}

// 定义错误处理函数
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    $assign =  [
        "errno"     =>  $errno,
        "errstr"    =>  $errstr,
        "errfile"   =>  $errfile,
        "errline"   =>  $errline
    ];
    $put = showErrorPage('default_error.tpl',$assign);
    throw new eyz\lib\Exception($put);
}

function myExceptionHandler(\Throwable $e){
    $assign =  [
        "code"      =>  $e->getCode(),
        "message"   =>  $e->getMessage()
    ];
    echo showErrorPage('default_error.tpl',$assign);
}
//返回错误模版页面
function showErrorPage($file,$assign){
    //加载Twig模版引擎
    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH."/eyz/tpl");//文件系统加载器
    $twig = new \Twig\Environment($loader, [
        'cache' => ROOT_PATH.DS."runtime".DS."cache",
        'debug' =>DEBUG,//When set to true, it automatically set "auto_reload" to true
        'auto_reload'=>true,//Whether to reload the template if the original source changed.
        "strict_variables"  =>false,//Whether to ignore invalid variables in templates
    ]);
    return $twig->render($file, $assign);
}

//转为驼峰 首字母大写
function to_hump_h($Str, $separator = '_')
{
    $Str = str_replace($separator, " ", strtolower($Str));
    return str_replace(" ", "", ucwords($Str));
}

//转为驼峰 首字母小写
function to_hump_l($Str, $separator = '_')
{
    $Str = $separator . str_replace($separator, " ", strtolower($Str));
    return ltrim(str_replace(" ", "", ucwords($Str)), $separator);
}

//驼峰命名转下划线命名
function toUnderScore($str)
{
    $dstr = preg_replace_callback('/([A-Z]+)/', function ($matchs) {
        return '_' . strtolower($matchs[0]);
    }, $str);
    return trim(preg_replace('/_{2,}/', '_', $dstr), '_');
}



/**
 * 获取某个目录下所有子目录
 * @param $dir
 * @return array
 */
function eyz_sub_dirs($dir)
{
    $dir     = ltrim($dir, "/");
    $dirs    = [];
    $subDirs = eyz_scan_dir("$dir/*", GLOB_ONLYDIR);
    if (!empty($subDirs)) {
        foreach ($subDirs as $subDir) {
            $subDir = "$dir/$subDir";
            array_push($dirs, $subDir);
            $subDirSubDirs = eyz_sub_dirs($subDir);
            if (!empty($subDirSubDirs)) {
                $dirs = array_merge($dirs, $subDirSubDirs);
            }
        }
    }
    return $dirs;
}
/**
 * 替代scan_dir的方法
 * @param string $pattern 检索模式 搜索模式 *.txt,*.doc; (同glog方法)
 * @param int    $flags
 * @param        $pattern
 * @return array
 */
function eyz_scan_dir($pattern, $flags = null)
{
    $files = glob($pattern, $flags);
    if (empty($files)) {
        $files = [];
    } else {
        $files = array_map('basename', $files);
    }

    return $files;
}


function get_app_name(){
    $URI = substr($_SERVER['REQUEST_URI'], 1);
    if (empty($URI)) {
        $appName = APP_ARR[0];
    } else {
        $URI = explode('%EF%BC%9F', $URI)[0];
        $URI = explode('?', $URI)[0];
        $URIArr = explode('/', $URI);
        $isTopName = in_array($URIArr[0], APP_ARR);//是否为应用
        $appName = $isTopName ? $URIArr[0] : APP_ARR[0];
    }
    return $appName;
}

function eyz_file_get_contents($collectUrl,$timeOut = 10){
    //设置超时参数
    $opts=array(
        "http"=>array(
            "method"=>"GET",
            "timeout"=>$timeOut
        ),
    );
    ////创建数据流上下文
    $context = stream_context_create($opts);
    return @file_get_contents($collectUrl,0,$context);
}