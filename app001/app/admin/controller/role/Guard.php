<?php
declare(strict_types=1);
namespace app\admin\controller\role;
use app\common\controller\Backend;
use think\annotation\route\Group;
use think\annotation\route\Route;
#[Group("role/guard")]
class Guard extends Backend{
    #[Route("GET,JSON","index")]
    public function index(){
        if(false === $this->request->isAjax()){
            return $this->fetch();
        }
        return json(['total'=>0,'rows'=>[]]);
    }
}