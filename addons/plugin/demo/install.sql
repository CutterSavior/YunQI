
-- 创建表结构 `__PREFIX__demo`
CREATE TABLE IF NOT EXISTS `__PREFIX__demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `education` tinyint(4) DEFAULT '0',
  `entrytime` date DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT '1',
  `status` varchar(30) DEFAULT NULL,
  `weigh` int(11) DEFAULT NULL,
  `append` varchar(255) DEFAULT NULL,
  `createtime` int(10) unsigned DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `deletetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- 导入表数据 `__PREFIX__demo`
INSERT INTO `__PREFIX__demo` VALUES ('1','张三','简单介绍','/assets/img/avatar.jpg','football,read,swim,climb,beauty','2','2023-12-01',null,'2','normal','997',null,'1696563406','1697785743',null);
INSERT INTO `__PREFIX__demo` VALUES ('2','李四','李四介绍','/assets/img/avatar.jpg','read,climb,football','5','2023-10-10',null,'2','normal','996',null,'1696579133','1697785743',null);
INSERT INTO `__PREFIX__demo` VALUES ('3','老王','简单介绍','/assets/img/avatar.jpg','read,beauty,football','1','2023-10-11',null,'1','normal','998',null,'1696750765','1697785743',null);
