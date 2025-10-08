-- 創建必要的數據表
SET FOREIGN_KEY_CHECKS=0;

-- 創建 config 表
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '变量名',
  `group` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分组',
  `addons` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '变量标题',
  `tip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '变量描述',
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '类型:string,text,int,bool,array,datetime,date,file',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '变量值',
  `rules` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '验证规则',
  `can_delete` tinyint(4) DEFAULT '1',
  `extend` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '扩展属性',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`group`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置';

-- 插入基本配置數據
INSERT INTO `config` VALUES ('1', 'categorytype', 'dictionary', null, '分类分组', '', 'json', '{\"default\":\"默认\",\"cate1\":\"分类一\",\"cate2\":\"分类二\",\"cate3\":\"分类三\"}', '', '0', '[[\"键名\",\"键值\"],[\"0\",\"1\"]]');
INSERT INTO `config` VALUES ('2', 'configgroup', 'dictionary', null, '配置分组', '', 'json', '{\"basic\":\"基础配置\",\"addons\":\"扩展配置\",\"dictionary\":\"配置分组\"}', '', '0', '[[\"键名\",\"键值\"],[\"0\",\"1\"]]');
INSERT INTO `config` VALUES ('3', 'filegroup', 'dictionary', null, '附件分组', '', 'json', '{\"fold-1\":\"相册1\",\"fold-2\":\"相册2\",\"fold-3\":\"相册3\"}', '', '0', '[[\"键名\",\"键值\"],[\"0\",\"1\"]]');
INSERT INTO `config` VALUES ('4', 'sitename', 'basic', null, '站点名称', '', 'text', '我的网站', 'required', '0', '');
INSERT INTO `config` VALUES ('5', 'logo', 'basic', null, '站点Logo', '', 'image', '/assets/img/logo.png', 'required', '0', '');
INSERT INTO `config` VALUES ('6', 'logo_white', 'basic', null, '亮色Logo', '', 'image', '/assets/img/logo-white.png', 'required', '0', '');
INSERT INTO `config` VALUES ('7', 'forbiddenip', 'basic', null, 'IP黑名单', '', 'textarea', '', '', '0', '');
INSERT INTO `config` VALUES ('8', 'version', 'basic', null, '版本号', '', 'text', '1.4.2', 'required', '0', '');
INSERT INTO `config` VALUES ('9', 'copyright', 'basic', null, '版权标识', '', 'text', '贵阳云起信息科技有限公司', 'required', '0', '');

-- 創建 admin 表
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '昵称',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码',
  `salt` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码盐',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/assets/img/avatar.jpg' COMMENT '头像',
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '手机号码',
  `groupids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loginfailure` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '失败次数',
  `logintime` int(10) unsigned DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录IP',
  `depart_id` int(11) DEFAULT NULL,
  `token` varchar(59) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Session标识',
  `element_ui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '状态',
  `createtime` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

-- 插入默認管理員
INSERT INTO `admin` VALUES ('1', 'admin', '管理员', 'c4fa2414ad0f73313b3425b50b4af4f4', 'UxO5', '/assets/img/avatar.jpg', '', '1', '0', NULL, NULL, NULL, '', NULL, 'normal', NULL, NULL);

-- 創建 auth_group 表
CREATE TABLE `auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父组别',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '组名',
  `rules` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规则ID',
  `auth_rules` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '状态',
  `createtime` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='分组表';

-- 插入默認權限組
INSERT INTO `auth_group` VALUES ('1', '0', '超级管理组', '*', '*', 'normal', '1491635035', '1491635035');

SET FOREIGN_KEY_CHECKS=1;



 
 