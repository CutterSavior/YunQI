<?php
declare (strict_types = 1);

namespace app\admin\controller\role;

use app\common\controller\Backend;
use think\annotation\route\Group;
use think\annotation\route\Route;

#[Group("role/guard")]
class Guard extends Backend
{
    #[Route('GET,JSON','index')]
    public function index()
    {
        if (false === $this->request->isAjax()) {
            return $this->fetch();
        }
        $limit = $this->request->post('limit/d', 10);
        $page = $this->request->post('page/d', 1);
        $total = rand(70, 90);
        $start = ($page - 1) * $limit + 1;
        $end = min($start + $limit - 1, $total);
        $personalities = ['保守', '激進', '穩健'];
        $timeslots = ['早班', '中班', '晚班'];
        $rows = [];
        for ($i = $start; $i <= $end; $i++) {
            $rows[] = [
                'id' => $i,
                'name' => '玩家' . $i,
                'account' => 'acc' . $i,
                'personality' => $personalities[array_rand($personalities)],
                'timeslot' => $timeslots[array_rand($timeslots)],
                'avg_money' => rand(100, 1000),
                'avg_speed' => rand(1, 10),
            ];
        }
        return json(['total' => $total, 'rows' => $rows]);
    }
}



