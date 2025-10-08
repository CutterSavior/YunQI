<?php
declare(strict_types=1);
namespace addons\plugin\tencent_orc;

class Install{

    public static $files=[
        "app/common/library/TencentOrc.php",
    ];

    public static $unpack=[

    ];

    public static $menu=[

    ];

    public static $require=[
        \TencentCloud\Common\Credential::class,
    ];

    public static $tables=[

    ];

    public static $addons=[

    ];

    public static $config=[
        ['id'=>40,'name'=>'tencent_orc_secret_id','title'=>'SecretId','type'=>'text','tip'=>'','rules'=>'','extend'=>''],
        ['id'=>41,'name'=>'tencent_orc_secret_key','title'=>'SecretKey','type'=>'text','tip'=>'','rules'=>'','extend'=>''],
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