<?php
/**
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
 * QQ群   : 490993740
 * 欢迎交流使用本程序，但请保留版权
 */

use eyz\lib\FileConfig;
require_once "../../eyz/lib/FileConfig.php";

//配置域名
define('WEB_GETPAGEDATA',"http://XXX.XXX/index/collect/getPageData");
define('WEB_GETDETAILDATA',"http://XXX.XXX/index/collect/getDetailData");

$fileConfig = new FileConfig('../collectSiteConfig');
$siteArr = $fileConfig->get('siteRuleArr');
$firstPage = 1;
$endPage = 1;
echo date('Y-m-d h:i:s') . "采集开始任务:开始页面：".PHP_EOL;

for ($siteId = 0; $siteId <= 9; $siteId++) {
    run($siteId, $siteArr, $firstPage, $endPage);
}
exit(PHP_EOL . "========= collect successful =========" . PHP_EOL);

function run($siteId, $siteArr, $firstPage, $endPage)
{
    $setting = $siteArr[$siteId];//指定站点
    if(!$setting['status']){
        echo "siteId:$siteId domain: {$setting['domain']} 站点状态false".PHP_EOL;
        return;
    }
    $stepPage = 1;//2 ;//页面步进长度 页面跨度
    $firstPage = $firstPage;//1;//$setting['firstPage'] ;//开始页面
    $endPage = $endPage;//1;//$setting['endPage'] ;//截止页面

    $startPage = $firstPage;
    while ($startPage <= $endPage) {
        $xh = $startPage;
        $pageArr = [];
        for ($page = $xh; $page < ($xh + $stepPage); $page++) {
            $pageUrl = WEB_GETPAGEDATA."?siteId={$siteId}&pageId={$page}";
            array_push($pageArr, $pageUrl);
        }
        // print_r($pageArr);
        $pageResult = curl_multi($pageArr);

        $detailUrlArr = [];
        $collectDetailUrlArr = [];
        foreach ($pageResult as $k => $v) {
            if(strpos($v,'code') !== false){
                $v = json_decode($v);
                if ($v->code == 1) {
                    $detail = $v->data->detail;
                    foreach ($detail as $kk => $vv) {
                        $url = $setting['domain'] . $vv;
                        $detailUrl = WEB_GETDETAILDATA."?siteId={$siteId}&collectUrl={$url}";
                        array_push($detailUrlArr, $url);
                        array_push($collectDetailUrlArr, $detailUrl);
                    }
                } else {
                    echo "   " . $v->msg . " " . $pageArr[$k];
                }
            }else{
                echo "采集主页面 响应失败";
            }
        }

        $countDetailPage = count($collectDetailUrlArr);
        echo "siteId:{$siteId} domain：{$setting['domain']}  页面范围：$firstPage - $endPage 当前开始页面：$startPage  页面跨度:$stepPage    详情页数量:$countDetailPage ".PHP_EOL;

        if (count($collectDetailUrlArr) > 0) {
            $detailResult = curl_multi($collectDetailUrlArr);
            foreach ($detailResult as $k => $v) {
                $tepData = $v;
                $v = json_decode($v);
                if (is_object($v)) {
                    if ($v->code == 0) {
                        echo "   " . $k . " " . $v->code . " " . $v->msg . " " . $detailUrlArr[$k] . "\r\n";
                    }
                } else {
                    echo "页面采集错误" . $collectDetailUrlArr[$k] . PHP_EOL;
                }
            }
        }
        $startPage = $startPage + $stepPage;
    }
}

function curl_multi($urls)
{
    if (!is_array($urls) or count($urls) == 0) {
        return false;
    }
    $num = count($urls);
    $curl = $curl2 = $text = array();
    $handle = curl_multi_init();

    foreach ($urls as $k => $v) {
        $url = $urls[$k];
        $curl[$k] = createCh($url);
        curl_multi_add_handle($handle, $curl[$k]);
    }
    $active = null;
    do {
        $mrc = curl_multi_exec($handle, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) {
        if (curl_multi_select($handle) != -1) {
            usleep(100);
        }
        do {
            $mrc = curl_multi_exec($handle, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }

    foreach ($curl as $k => $v) {
        if (curl_error($curl[$k]) == "") {
            $text[$k] = (string)curl_multi_getcontent($curl[$k]);
        }
        curl_multi_remove_handle($handle, $curl[$k]);
        curl_close($curl[$k]);
    }
    curl_multi_close($handle);
    return $text;
}

function createCh($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko');//设置头部
    curl_setopt($ch, CURLOPT_REFERER, $url); //设置来源
    curl_setopt($ch, CURLOPT_ENCODING, "gzip"); // 编码压缩
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//是否采集301、302之后的页面
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);//查找次数，防止查找太深
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);//最大执行时间
    curl_setopt($ch, CURLOPT_HEADER, 0);//输出头部
    return $ch;
}