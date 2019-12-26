<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */

/**
 * 入口文件
 * 1.定义常量
 * 2.载入核心文件
 * 3.启动框架
 */
namespace eyz;
define('EYZ_START_TIME', microtime(true));
//根目录
define('ROOT_PATH',realpath('../'));
//数据目录
define('DATA_PATH',ROOT_PATH.'/data');
//路径分隔符
define('DS',DIRECTORY_SEPARATOR);
//包含的应用 数组
define('APP_ARR',['vatfs']);
require ROOT_PATH.'/eyz/Core.php';
core::run();
