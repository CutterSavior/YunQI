<?php
declare (strict_types = 1);

namespace app\admin\controller\merchant;

use app\common\controller\Backend;
use think\annotation\route\Group;
use think\annotation\route\Route;

#[Group("merchant/index")]
class Index extends Backend
{
    #[Route('GET,JSON','index')]
    public function index()
    {
        if (false === $this->request->isAjax()) {
            return $this->fetch();
        }
        $limit = $this->request->post('limit/d', 10);
        $page = $this->request->post('page/d', 1);
        $keyword = trim((string)$this->request->post('searchValue', ''));

        $total = 120; // 模擬總數
        $start = ($page - 1) * $limit + 1;
        $end = min($start + $limit - 1, $total);
        $genders = ['男','女'];
        $timeslots = ['早班', '中班', '晚班'];
        $rows = [];
        for ($i = $start; $i <= $end; $i++) {
            $name = '商家' . $i;
            if ($keyword && mb_strpos($name, $keyword) === false) {
                continue;
            }
            $rows[] = [
                'id' => $i,
                'merchant' => $name,
                'merchant_no' => 'M' . str_pad((string)$i, 5, '0', STR_PAD_LEFT),
                'contact_name' => '聯繫人' . $i,
                'account' => 'macc' . $i,
                'gender' => $genders[array_rand($genders)],
                'timeslot' => $timeslots[array_rand($timeslots)],
                'avg_money' => rand(1000, 100000) / 100,
                'avg_speed' => rand(1, 10)
            ];
        }
        return json(['total' => $total, 'rows' => array_values($rows)]);
    }
}


