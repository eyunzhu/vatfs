<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */
namespace eyz\lib;
class Config
{
    static public $config = [];
    //获取配置
    static public function get($name){
        if (isset(self::$config[$name])){
            self::$config[$name];
        }else{
            //系统配置
            $configFile = DATA_PATH.'/config/'.$name.'.php';
            if (is_file($configFile)){
                $includeConfigFile = include $configFile;
                self::$config[$name] = is_array($includeConfigFile)?$includeConfigFile:[];
            }else{
                self::$config[$name] = [];
            }
            //应用配置
            $currentApp = get_app_name(); //当前应用
            $appConfigFile = ROOT_PATH.'/'.$currentApp.'/'.$name.'.php';

            if (is_file($appConfigFile)){
                $includeAppConfigFile = include $appConfigFile;
                $includeAppConfigFile = is_array($includeAppConfigFile)?$includeAppConfigFile:[];
                self::$config[$name] = array_merge(self::$config[$name],$includeAppConfigFile);
            }
        }

        return self::$config[$name];
    }

    /**
     * 获取应用配置
     * @param $app
     * @return mixed
     */
    static public function getApplicationConfig($app = APP_ARR[0]){
        if (isset(self::$config[$app])){
            self::$config[$app];
        }else{
            //系统应用配置
            $configFile = DATA_PATH.'/config/app.php';
            if (is_file($configFile)){
                $includeConfig = include $configFile;
                self::$config[$app] = is_array($includeConfig)?$includeConfig:[];
            }else{
                self::$config[$app] = [];
            }
            //应用配置
            $appConfigFile = ROOT_PATH.'/'.$app.'/app.php';
            if (is_file($appConfigFile)){
                $includeAppConfig = include $appConfigFile;
                $includeAppConfig = is_array($includeAppConfig)?$includeAppConfig:[];
                self::$config[$app] = array_merge(self::$config[$app],$includeAppConfig);
            }
        }
        return self::$config[$app];
    }




}