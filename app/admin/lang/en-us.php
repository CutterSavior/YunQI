<?php
use app\admin\controller\Ajax;
use app\admin\controller\Index;
return [
    //Global language pack
    'default'=>[
        // Basic operations
        '添加'=>'Add',
        '编辑'=>'Edit',
        '删除'=>'Delete',
        '更多'=>'More',
        '正常'=>'Normal',
        '隐藏'=>'Hidden',
        '是'=>'Yes',
        '否'=>'No',
        '提交'=>'Submit',
        '取消'=>'Cancel',
        '確認'=>'Confirm',
        '保存'=>'Save',
        '搜索'=>'Search',
        '重置'=>'Reset',
        '刷新'=>'Refresh',
        '導出'=>'Export',
        '導入'=>'Import',
        
        // Common fields
        '时间'=>'Time',
        '交易前'=>'Before',
        '变化数目'=>'Change',
        '交易后'=>'After',
        '订单编号'=>'Order No',
        '备注'=>'Remark',
        '用户名'=>'Username',
        '手机号'=>'Mobile',
        '昵称'=>'Nickname',
        '密码'=>'Password',
        '标题'=>'Title',
        '链接'=>'Link',
        '访问时间'=>'Visit Time',
        '姓名'=>'Name',
        '帳號'=>'Account',
        '性格'=>'Personality',
        '時段'=>'Timeslot',
        '平均金額'=>'Avg Amount',
        '平均速度'=>'Avg Speed',
        '商家'=>'Merchant',
        '商家號'=>'Merchant No',
        '性別'=>'Gender',
        '幣種'=>'Currency',
        '地址'=>'Address',
        '餘額'=>'Balance',
        '實名'=>'KYC',
        '最後上線'=>'Last Online',
        
        // Messages
        '操作成功'=>'Operation successful',
        '操作失败'=>'Operation failed',
        '创建成功'=>'Created successfully',
        '删除成功'=>'Deleted successfully',
        '清除成功'=>'Cleared successfully',
        '添加成功'=>'Added successfully',
        '超级管理员才能访问'=>'Only super admin can access',
        '只允许在开启调试模式下执行'=>'Only allowed in debug mode',
        '处理类不存在'=>'Handler class not found',
        '年份不能小于当前年份'=>'Year cannot be less than current year',
        '月份必须在1-12之间'=>'Month must be between 1-12',
        '日必须在1-31之间'=>'Day must be between 1-31',
        
        // Trading system
        '現貨交易'=>'Spot Trading',
        '加密交易'=>'Crypto Trading',
        '期貨交易'=>'Futures Trading',
        '跟單交易'=>'Copy Trading',
        '質押交易'=>'Staking',
        '市場自選'=>'Market Favorites',
        '牌路查詢'=>'History Query',
        '會員下注'=>'Member Bets',
        '指定單更改'=>'Order Modification',
        '預測分析'=>'Prediction Analysis',
        
        // Role system
        '場控管理'=>'Market Control',
        '商家管理'=>'Merchant Management',
        '會員管理'=>'Member Management',
        '代理管理'=>'Agent Management',
    ],
    //Controller language pack
    'controller'=>[
        Index::class=>[
            '控制台'=>'Dashboard',
            '常规管理'=>'General Management',
            '系统配置'=>'System Config',
            '分类管理'=>'Category Management',
            '附件管理'=>'Attachment Management',
            '个人资料'=>'Profile',
            '菜单规则'=>'Menu Rules',
            '管理员管理'=>'Admin Management',
            '角色组'=>'Role Groups',
            '管理员日志'=>'Admin Logs',
            '一键Crud'=>'Quick CRUD',
            '任务队列'=>'Task Queue',
            '权限管理'=>'Permission Management',
            '开发管理'=>'Development'
        ],
        Ajax::class=>[]
    ]
];
