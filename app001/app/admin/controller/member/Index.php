<?php
declare (strict_types = 1);

namespace app\admin\controller\member;

use app\common\controller\Backend;
use think\annotation\route\Group;
use think\annotation\route\Route;

#[Group("member/index")]
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
        $total = 200;
        $start = ($page - 1) * $limit + 1;
        $end = min($start + $limit - 1, $total);
        $genders = ['男','女'];
        $realnames = ['已實名','未實名'];
        $coins = ['USDT','BTC','ETH','BNB'];
        $rows = [];
        for ($i=$start;$i<=$end;$i++){
            $rows[] = [
                'id'=>$i,
                'name'=>'會員'.$i,
                'coin'=>$coins[array_rand($coins)],
                'address'=>'0x'.substr(md5((string)$i),0,10),
                'balance'=>rand(0,100000)/100,
                'gender'=>$genders[array_rand($genders)],
                'realname'=>$realnames[array_rand($realnames)],
                'last_active'=>date('Y-m-d H:i:s', time()-rand(0,86400)),
            ];
        }
        return json(['total'=>$total,'rows'=>$rows]);
    }
}


