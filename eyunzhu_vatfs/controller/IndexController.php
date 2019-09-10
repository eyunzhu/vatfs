<?php
namespace plugins\eyunzhu_vatfs\controller;

use cmf\controller\PluginBaseController;
use think\Db;

class IndexController extends PluginBaseController
{
    public function index()
    {
       return $this->fetch('/index');
    }
	public function detail()
	{
	   return $this->fetch('/detail');
	}
}
