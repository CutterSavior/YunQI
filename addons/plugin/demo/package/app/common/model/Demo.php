<?php
declare(strict_types=1);

namespace app\common\model;

use app\common\model\base\BaseModel;
use app\common\model\base\ConstTraits;

class Demo extends BaseModel
{
    /*
     * 枚举替代方法，比如
     * LEVEL('青铜')返回1，使用起来更直观
     */
    use ConstTraits;

    const EDUCATION=[
        1=>'幼儿园',
        2=>'小学',
        3=>'初中',
        4=>'高中',
        5=>'大专',
        6=>'本科',
    ];

    //对新增的数据设置排序默认值，以支持拖拽排序功能
    public static function onAfterInsert($demo)
    {
        $demo->weigh=1000-$demo->id;
        $demo->save();
    }
}
