<?php
declare (strict_types = 1);

namespace app\admin\controller\demo;

use app\common\controller\Backend;
use app\admin\traits\Actions;
use think\annotation\route\Group;
use think\annotation\route\Route;
use app\common\model\Demo as DemoModel;

#[Group("demo/addons")]
class Addons extends Backend
{
    #[Route("GET","index")]
    public function index()
    {
        if(!addons_installed('qqmap')){
            return $this->fetch('demo/addons/without-qqmap');
        }
        return $this->fetch();
    }

    #[Route("POST","add")]
    public function add()
    {
        $this->success('添加成功');
    }
}
