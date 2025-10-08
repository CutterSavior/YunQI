<?php
declare(strict_types=1);
namespace addons\plugin\demo;

class Install{

    public static $files=[
        "app/admin/controller/demo",
        "app/admin/view/demo",
        "app/common/model/Demo.php",
    ];

    public static $unpack=[

    ];

    public static $menu=[
        ['id'=>30,'controller'=>'','action'=>'','title'=>'开发示例','icon'=>'fa fa-slideshare','ismenu'=>1,'menutype'=>'tab','extend'=>'','weigh'=>970,'childlist'=>[['id'=>31,'controller'=>'app\admin\controller\demo\Table','action'=>'index','title'=>'表格示例','icon'=>'fa fa-table','ismenu'=>1,'menutype'=>'tab','extend'=>'','weigh'=>969,'childlist'=>[['id'=>32,'controller'=>'app\admin\controller\demo\Table','action'=>'["index","multi","del","import","download","recyclebin"]','title'=>'["查看","更新","删除","导入","下载","回收站"]','icon'=>'','ismenu'=>0,'menutype'=>'','extend'=>'','weigh'=>0]]],['id'=>33,'controller'=>'app\admin\controller\demo\Form','action'=>'index','title'=>'表单示例','icon'=>'fa fa-wpforms','ismenu'=>1,'menutype'=>'tab','extend'=>'','weigh'=>967,'childlist'=>[['id'=>34,'controller'=>'app\admin\controller\demo\Form','action'=>'["index","add","edit"]','title'=>'["页面","添加","编辑"]','icon'=>'','ismenu'=>0,'menutype'=>'','extend'=>'','weigh'=>966]]],['id'=>42,'controller'=>'app\admin\controller\demo\Addons','action'=>'index','title'=>'扩展示例','icon'=>'fa fa-rocket','ismenu'=>1,'menutype'=>'tab','extend'=>'','weigh'=>958,'childlist'=>[['id'=>43,'controller'=>'app\admin\controller\demo\Addons','action'=>'["index","add"]','title'=>'["查看","添加"]','icon'=>'','ismenu'=>0,'menutype'=>'','extend'=>'','weigh'=>957]]]]],
    ];

    public static $require=[

    ];

    public static $tables=[
        "yun_demo",
    ];

    public static $addons=[
        "area"=>"省份城市地区数据",
        "qqmap"=>"腾讯地图选择位置坐标"
    ];

    public static $config=[

    ];

    //安装扩展时的回调方法
    public static function install()
    {

    }

    //卸载扩展时的回调方法
    public static function uninstall()
    {

    }

}