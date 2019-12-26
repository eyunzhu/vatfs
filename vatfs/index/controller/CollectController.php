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
use eyz\lib\EyzValidation;
use eyz\lib\FileConfig;
use eyz\lib\Model;
use eyz\lib\Request;
use Twig\Node\Expression\Test\OddTest;

class CollectController extends ApiBaseController
{
    private $fileConfig  =  "";
    private $siteRuleArr = [];
    public function __construct()
    {
        $this->fileConfig = new FileConfig(ROOT_PATH.DS."vatfs".DS."collectSiteConfig");
        $this->siteRuleArr = $this->fileConfig->get("siteRuleArr");
    }

    /**
     * 获取采集页资源列表
     */
    public function getPageData(){
        $siteCount = count($this->siteRuleArr);//站点规则总数
        $maxSiteId = $siteCount-1;//最大站点

        $request = new Request();
        $data = $request->param();

        EyzValidation::validate($data,[
            "siteId" => "Required|IntGeLe:0,{$maxSiteId}",
            "pageId" => "Required"
        ]);

        $siteId = $data['siteId'];
        $pageId = $data['pageId'];

        $siteRule = [];//站点采集规则
        foreach ($this->siteRuleArr as $k=>$v){
            if($v['siteId'] == $siteId){
                $siteRule = $v;
            }
        }
        if(empty($siteRule))
            $this->error("采集站点规则不存在 siteId：$siteId");
        if(!$siteRule['status'])
            $this->error("采集站点 状态为 0 siteId：$siteId");

        $collectUrl = $siteRule['collectUrl_a'].$pageId.$siteRule['collectUrl_b'];
        $sitePageData = eyz_file_get_contents($collectUrl);
        if(!$sitePageData)
            $this->error('采集错误，页面响应超时'.$collectUrl,1);

        if(strpos($sitePageData,$siteRule['explodeStr'][0]) == false || strpos($sitePageData,$siteRule['explodeStr'][1]) == false){
            $this->error("列表页面不包含定位字符串 $collectUrl",1);
        }

        //对采集数据进行切割 以确保准确匹配
        $sitePageData = explode($siteRule['explodeStr'][0], $sitePageData)[1];
        $sitePageData = explode($siteRule['explodeStr'][1], $sitePageData)[0];
        //进行匹配
        $pregResult = preg_match_all($siteRule['detailUrlRule'], $sitePageData,$detailUrlArr);
        if(!$pregResult)//当匹配结果为0个 或者FALSE时
            $this->error("内容匹配失败".$collectUrl,1);
        $selectResult_deal = array_combine($detailUrlArr['vName'],$detailUrlArr['pUrl']);
        $result = [
            "siteId"=>$siteId,
            "domain"=>$siteRule['domain'],
            "detail"=>$selectResult_deal
        ];
        $this->success($pregResult,$result);
    }


    /**
     * 获取详情数据 影视名称,播放地址
     */
    public function getDetailData(){
        $siteCount = count($this->siteRuleArr);//站点规则总数
        $maxSiteId = $siteCount-1;//最大站点

        $request = new Request();
        $data = $request->param();

        EyzValidation::validate($data,[
            "siteId" => "Required|IntGeLe:0,{$maxSiteId}",
            "collectUrl" => "Required"
        ]);

        $siteId = $data['siteId'];
        $collectUrl = $data['collectUrl'];

        $siteRule = [];//站点采集规则
        foreach ($this->siteRuleArr as $k=>$v){
            if($v['siteId'] == $siteId){
                if(!$v['status'])
                    $this->error("采集站点 状态为 0 siteId：$siteId");
                $siteRule = $v['detailPage'];
            }
        }
        if(empty($siteRule))
            $this->error("采集站点规则不存在 siteId：$siteId");


        $collectData = eyz_file_get_contents($collectUrl);
        if(!$collectData)
            $this->error('采集错误，页面响应超时'.$collectUrl,1);

        if(strpos($collectData,$siteRule['explodeStr'][0]) == false || strpos($collectData,$siteRule['explodeStr'][1]) == false){
            $this->error("详情页面不包含定位字符串 $collectUrl",1);
        }

        $pregResult0 = preg_match_all($siteRule['name'], $collectData,$name_Arr);
        $pregResult2 = preg_match_all($siteRule['pic'], $collectData,$pic_Arr);
        $pregResult3 = preg_match_all($siteRule['updateTime'], $collectData,$updateTime_Arr);
        $pregResult4 = preg_match_all($siteRule['detailId'], $collectData,$detailId_Arr);
        $pregResult5 = preg_match_all($siteRule['mName'], $collectData,$mName_Arr);
        $pregResult6 = preg_match_all($siteRule['type'], $collectData,$type_Arr);//不一定有


        //对采集数据进行切割 用以准确匹配播放地址
        $collectData = explode($siteRule['explodeStr'][0], $collectData)[1];
        $collectData = explode($siteRule['explodeStr'][1], $collectData)[0];

        $pregResult1 = preg_match_all($siteRule['playUrl'], $collectData,$playUrl_Arr);

        if(!$pregResult0 || !$pregResult1 || !$pregResult2 || !$pregResult3 || !$pregResult4)//当匹配结果为0个 或者FALSE时
            $this->error("匹配失败 匹配基本数据失败 $collectUrl",1);

        $playUrl_Arr = array_combine($playUrl_Arr['playName'],$playUrl_Arr['playUrl']);

        if(!isset($name_Arr['name'][0]) || !isset($pic_Arr['pic'][0]) || !isset($playUrl_Arr) || !isset($updateTime_Arr['updateTime'][0]) || !isset($updateTime_Arr[0]) ){
            $this->error("匹配失败 匹配基本数据为空 $collectUrl",1);
        }
        if(!isset($mName_Arr['mName'][0])){
            $mName_Arr['mName'][0] = '';
        }

        $result = [
            'name'=>$name_Arr['name'][0],
            'pic'=>$pic_Arr['pic'][0],
            'playUrl[JSON]'=>$playUrl_Arr,
            'siteId'=>$siteId,
            'updateTime'=>strtotime($updateTime_Arr['updateTime'][0]),
            'detailId'=>$detailId_Arr['detailId'][0],
            'mName'=>$mName_Arr['mName'][0],
            'type'=>$type_Arr['type'][0],
        ];

        $video = new Model('vatfs_collect_video');
        $findResult = $video->select(["updateTime","id"],['siteId'=>$result['siteId'],'detailId'=>$result['detailId']]);
        if(empty($findResult)){
            $video->insert($result);
            $msg = "新增";
        }else{
            if($findResult[0]['updateTime'] == $result['updateTime']){
                $msg = "已采集";
            }else{
                $video->update($result,["id"=>$findResult[0]['id']]);
                $msg = "更新";
            }
        }
        $this->success($msg,$result);
    }

}