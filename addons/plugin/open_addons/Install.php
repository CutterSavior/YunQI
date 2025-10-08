<?php
declare(strict_types=1);
namespace addons\plugin\open_addons;

class Install{

    public static $files=[
        "app/addons",
        "app/common/model/AddonsPay.php",
    ];

    public static $unpack=[
        "*.pem",
        "*.p12",
    ];

    public static $menu=[

    ];

    public static $require=[
        "\\Yansongda\\Pay\\Pay",
    ];

    public static $config=[
        ['name'=>'open_addons_status','title'=>'开放扩展','type'=>'switch','value'=>1,'tip'=>'','rules'=>'','extend'=>''],
        ['name'=>'open_addons_mpappid','title'=>'公众号id','type'=>'text','tip'=>'','rules'=>'','extend'=>''],
        ['name'=>'open_addons_mchid','title'=>'商户号id','type'=>'text','tip'=>'','rules'=>'','extend'=>''],
        ['name'=>'open_addons_mchkey','title'=>'商户号v3密钥','type'=>'text','tip'=>'','rules'=>'','extend'=>''],
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