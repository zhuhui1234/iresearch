/*
SQLyog Ultimate v8.32 
MySQL - 5.7.9 : Database - iviewdb
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iviewdb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `iviewdb`;

/*Table structure for table `ivw_config` */

DROP TABLE IF EXISTS `ivw_config`;

CREATE TABLE `ivw_config` (
  `cfg_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '配置自增ID',
  `cfg_guid` varchar(100) DEFAULT NULL COMMENT '配置GUID',
  `cfg_name` varchar(50) DEFAULT NULL COMMENT '配置名称',
  `cfg_describe` varchar(255) DEFAULT NULL COMMENT '配置描述',
  `cfg_service` varchar(100) DEFAULT NULL COMMENT '服务设备',
  `cfg_url` varchar(255) DEFAULT NULL COMMENT '配置url',
  `cfg_parameter` varchar(255) DEFAULT NULL COMMENT '配置参数',
  `cfg_type` tinyint(1) DEFAULT '1' COMMENT '所属层级',
  `cfg_sid` int(10) DEFAULT '0' COMMENT '上级分类',
  `cfg_model` int(10) DEFAULT '0' COMMENT '所属模块',
  `cfg_state` tinyint(1) DEFAULT '1' COMMENT '状态',
  `cfg_cdate` datetime DEFAULT NULL COMMENT '创建时间',
  `cfg_edate` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`cfg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `ivw_config` */

insert  into `ivw_config`(`cfg_id`,`cfg_guid`,`cfg_name`,`cfg_describe`,`cfg_service`,`cfg_url`,`cfg_parameter`,`cfg_type`,`cfg_sid`,`cfg_model`,`cfg_state`,`cfg_cdate`,`cfg_edate`) values (1,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B601','--首页','描述:控股公司资产排名','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^76ee^^5f55^^53ca^^9996^^9875^^2f^Index.db&browserType=Chrome','{\"adminv\":\"test1\",\"passv\":\"idas1234\"}',1,0,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(2,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B602','--地区数据分析占比','描述:非控股公司资产排名趋势','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^6807^^51c6^^62a5^^544a^Demo^7b2c^^56db^^7248^^2f^^5730^^533a^^6570^^636e^^5206^^6790^-^5360^^6bd4^.db&browserType=Chrome','{\"adminv\":\"test2\",\"passv\":\"idas1234\"}',1,0,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(10,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B610','--媒体数据分析占比','描述:控股公司资产构成信息','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^6807^^51c6^^62a5^^544a^Demo^7b2c^^56db^^7248^^2f^^5a92^^4f53^^6570^^636e^^5206^^6790^-^5360^^6bd4^.db&browserType=Chrome','{\"adminv\":\"test3\",\"passv\":\"idas1234\"}',1,0,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(4,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B604','--终端数据绝对值','描述:PC网站公司资产排名趋势','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^6807^^51c6^^62a5^^544a^Demo^7b2c^^56db^^7248^^2f^^7ec8^^7aef^^6570^^636e^^5206^^6790^-^7edd^^5bf9^^503c^.db&browserType=Chrome','{\"adminv\":\"test4\",\"passv\":\"idas1234\"}',2,1,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(5,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B605','--跨屏重合','描述:移动端安卓系统公司资产排名趋势','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^6807^^51c6^^62a5^^544a^Demo^7b2c^^56db^^7248^^2f^^8de8^^5c4f^^91cd^^5408^-^5355^^5a92^^4f53^-^56db^^5c4f^.db&browserType=Chrome','{\"adminv\":\"test5\",\"passv\":\"idas1234\"}',2,1,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(6,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B606','--跨屏重合','描述:移动端IOS系统公司资产排名趋势','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^6807^^51c6^^62a5^^544a^Demo^7b2c^^56db^^7248^^2f^^8de8^^5c4f^^91cd^^5408^-^5355^^5a92^^4f53^-^56db^^5c4f^.db&browserType=Chrome','{\"adminv\":\"test6\",\"passv\":\"idas1234\"}',2,1,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(7,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B607','--跨屏重合','描述:控股公司资产构成信息','1','http://203.156.255.149/bi/Viewer?proc=1&action=viewer&hback=true&db=Nick^2f^^6807^^51c6^^62a5^^544a^Demo^7b2c^^56db^^7248^^2f^^8de8^^5c4f^^91cd^^5408^-^5355^^5a92^^4f53^-^56db^^5c4f^.db&browserType=Chrome','{\"adminv\":\"test7\",\"passv\":\"idas1234\"}',2,1,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(11,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B611','测试2','描述:测试2','1',NULL,'{\"adminv\":\"test8\",\"passv\":\"idas1234\"}',2,2,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46'),(13,'8BDCF4C1-E1AB-FA26-4DE8-DA382156B613','测试13','描述:测试13','1',NULL,'{\"adminv\":\"test9\",\"passv\":\"idas1234\"}',2,10,7,1,'2016-08-25 14:31:46','2016-08-25 14:31:46');

/*Table structure for table `ivw_config_service` */

DROP TABLE IF EXISTS `ivw_config_service`;

CREATE TABLE `ivw_config_service` (
  `cfgs_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '配置引擎自增ID',
  `cfgs_name` varchar(100) DEFAULT NULL COMMENT '引擎名称',
  `cfgs_url` varchar(100) DEFAULT NULL COMMENT '配置引擎url',
  `cfgs_parameter` varchar(255) DEFAULT NULL COMMENT '配置参数模板',
  `cfgs_cdate` datetime DEFAULT NULL COMMENT '创建时间',
  `cfgs_edate` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`cfgs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `ivw_config_service` */

insert  into `ivw_config_service`(`cfgs_id`,`cfgs_name`,`cfgs_url`,`cfgs_parameter`,`cfgs_cdate`,`cfgs_edate`) values (1,'永洪报表','http://203.156.255.149/iReport/?m=service&a=showReport&guid=','{\"adminv\":\"\",\"passv\":\"\"}','2016-08-25 18:14:25','2016-08-25 18:14:25'),(2,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `ivw_industry` */

DROP TABLE IF EXISTS `ivw_industry`;

CREATE TABLE `ivw_industry` (
  `ity_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '行业自增ID',
  `ity_img` varchar(50) DEFAULT NULL COMMENT '行业图标',
  `ity_name` varchar(100) DEFAULT NULL COMMENT '行业名称',
  `ity_describe` varchar(255) DEFAULT NULL COMMENT '行业描述',
  `ity_type` tinyint(1) DEFAULT NULL COMMENT '分类层级',
  `ity_sid` int(10) DEFAULT '0' COMMENT '上级分类',
  `ity_state` tinyint(1) DEFAULT '0' COMMENT '行业状态',
  `ity_cdate` datetime DEFAULT NULL COMMENT '创建时间',
  `ity_edate` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`ity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `ivw_industry` */

insert  into `ivw_industry`(`ity_id`,`ity_img`,`ity_name`,`ity_describe`,`ity_type`,`ity_sid`,`ity_state`,`ity_cdate`,`ity_edate`) values (1,'ity.png','网络应用行业','PC网站、移动App、电视盒子、KOL网红',1,0,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(2,'ity.png','网络内容行业','视频、资讯、UGC、商品、下载',1,0,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(3,'ity.png','网络商业客户','广告主、商品、广告、电商店铺',1,0,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(4,'ity.png','用户族群数据','性别、年龄段、网络应用、消费服务',1,0,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(5,'ity.png','媒介营销洞察工具','广告效果、跨屏预算分配、媒体覆盖受众效率',1,0,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(6,'ity.png','媒体运营洞察工具','竞品监控、渠道效率分析、新用户兴趣研究、用户转化研究、媒体价值证明',1,0,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(7,'ity.png','公司资产服务排名','中国网络应用行业数据',2,1,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(8,'ity.png','电视盒子应用排名','中国网络应用行业数据',2,1,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(9,'ity.png','移动App应用排名','中国网络应用行业数据',2,1,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(10,'ity.png','自媒体KOL排名(Beta)','中国网络应用行业数据',2,1,0,'2016-08-23 17:49:23','2016-08-23 17:49:23'),(11,'ity.png','PC网站应用排名','中国网络应用行业数据',2,1,1,'2016-08-23 17:49:23','2016-08-23 17:49:23');

/*Table structure for table `ivw_user` */

DROP TABLE IF EXISTS `ivw_user`;

CREATE TABLE `ivw_user` (
  `u_id` char(50) NOT NULL COMMENT '用户ID',
  `u_account` varchar(100) DEFAULT NULL COMMENT '用户帐号',
  `u_password` varchar(50) DEFAULT NULL COMMENT '用户密码',
  `u_head` varchar(100) DEFAULT NULL COMMENT '头像',
  `u_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `u_department` varchar(100) DEFAULT NULL COMMENT '部门',
  `u_position` varchar(100) DEFAULT NULL COMMENT '职位',
  `u_mobile` varchar(50) DEFAULT NULL COMMENT '联系电话(移动)',
  `u_token` char(50) DEFAULT NULL COMMENT '用户token',
  `u_cdate` datetime DEFAULT NULL COMMENT '创建时间',
  `u_edate` datetime DEFAULT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ivw_user` */

insert  into `ivw_user`(`u_id`,`u_account`,`u_password`,`u_head`,`u_name`,`u_department`,`u_position`,`u_mobile`,`u_token`,`u_cdate`,`u_edate`) values ('8BDCF4C1-E1AB-FA26-4DE8-DA382156B699','joson','73c321d3b60084e6271021a5ce4846a4','head.png','吴伟伟','大数据','资深技术经理','13127544688','99f2afc6dc1acf08d00a67a0c4c3d1d0','2016-08-23 16:31:25','2016-08-23 16:31:25'),('8BDCF4C1-E1AB-FA26-4DE8-DA382156B111','admin','73c321d3b60084e6271021a5ce4846a4','head.png','管理员','管理层','VP','13100000000','75f8cd48537cc841c867dffe46bba994','2016-08-23 17:31:25','2016-08-23 17:31:25');

/*Table structure for table `ivw_view_report_token` */

DROP TABLE IF EXISTS `ivw_view_report_token`;

CREATE TABLE `ivw_view_report_token` (
  `user_ip` varchar(255) DEFAULT NULL COMMENT 'ip地址',
  `report_guid` varchar(255) DEFAULT NULL COMMENT '报表名',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `time` int(11) DEFAULT NULL COMMENT '时间戳'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ivw_view_report_token` */

insert  into `ivw_view_report_token`(`user_ip`,`report_guid`,`token`,`time`) values ('10.10.21.163','8BDCF4C1-E1AB-FA26-4DE8-DA382156B606','7731038816dc987fb057584603ec68ae',1473245180),('10.10.21.163','8BDCF4C1-E1AB-FA26-4DE8-DA382156B604','a206f3eba07741c1140f71362e5a5d83',1473246234),('10.10.21.163','8BDCF4C1-E1AB-FA26-4DE8-DA382156B604','a206f3eba07741c1140f71362e5a5d83',1473246367),('10.10.21.163','8BDCF4C1-E1AB-FA26-4DE8-DA382156B604','a206f3eba07741c1140f71362e5a5d83',1473246377);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


ALTER TABLE idatadb.idt_company ADD saler_id INT DEFAULT /*销售ID*/ NULL;
ALTER TABLE idatadb.idt_company ADD saler_name VARCHAR(20) DEFAULT /*销售人员*/ NULL;
ALTER TABLE idatadb.idt_company ADD saler_email VARCHAR(50) DEFAULT /*销售邮箱*/ NULL;