<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */
namespace eyz\lib;
class FileConfig
{
    private $data;
    private $file;

    /**
     * 构造函数
     * @param $file 存储数据文件
     * @return
     */
    function __construct($file) {
        $file = $file.'.json';
        $this->file = $file;
        $this->data= self::read($file);
    }

    /**
     * 读取配置文件
     * @param $file 要读取的数据文件
     * @return 读取到的全部数据信息
     */
    public function read($file) {
        if(!file_exists($file)) return array();

        $str = file_get_contents($file);
        $data = json_decode($str, true);
        if (is_null($data)) return array();
        return $data;
    }

    /**
     * 获取指定项的值
     * @param $key 要获取的项名
     * @param $default 默认值
     * @return data
     */
    public function get($key = null, $default = '') {
        if (is_null($key)) return $this->data;  // 取全部数据

        if(isset($this->data[$key])) return $this->data[$key];
        return $default;
    }

    /**
     * 设置指定项的值
     * @param $key 要设置的项名
     * @param $value 值
     * @return null
     */
    public function set($key, $value) {
        if(is_string($key)) {   // 更新单条数据
            $this->data[$key] = $value;
        } else if(is_array($key)) {   // 更新多条数据
            foreach ($this->data as $k => $v) {
                if ($v[$key[0]] == $key[1]) {
                    $this->data[$k][$value[0]] = $value[1];
                }
            }
        }

        return $this;
    }

    /**
     * 删除并清空指定项
     * @param $key 删除项名
     * @return null
     */
    public function delete($key) {
        unset($this->data[$key]);

        return $this;
    }

    /**
     * 保存配置文件
     * @param $file 要保存的数据文件
     * @return true-成功 其它-保存失败原因
     */
    public function save() {
        if(defined('JSON_PRETTY_PRINT')) {
            $jsonStr = json_encode($this->data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        } else {
            $jsonStr = json_encode($this->data);
        }

        // 含有二进制或非utf8字符串对应检测
        if(is_null($jsonStr)) return '数据文件有误';
        $buffer = $jsonStr;

        $file_strm = fopen($this->file, 'w');
        if(!$file_strm) return '写入文件失败，请赋予 '.$this->file.' 文件写权限！';
        if (flock($file_strm,LOCK_EX)){//排他锁 写锁
            fwrite($file_strm, $buffer);
            flock($file_strm,LOCK_UN);
        }else{
            return "Couldn't get the lock!";
        }
        fclose($file_strm);
        return true;
    }
}