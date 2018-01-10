DROP TABLE IF EXISTS `phpcms_order_logistics`;
CREATE TABLE `phpcms_order_logistics` (
  `logistics_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `fee` varchar(10) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`logistics_id`)
) TYPE=MyISAM;

alter table `phpcms_pay_account` add logistics_fee char(8) not Null DEFAULT '0';
alter table `phpcms_pay_account` add logistics_id int(10) NOT NULL DEFAULT '0';
alter table `phpcms_pay_account` add address char(255) NOT NULL;

INSERT INTO `phpcms_order_logistics` VALUES ('1', '送货上门', '10.00', '送货上门,领取商品时付费.');
INSERT INTO `phpcms_order_logistics` VALUES ('2', '特快专递(EMS)', '25.00', '特快专递(EMS),要另收手续费.');
INSERT INTO `phpcms_order_logistics` VALUES ('3', '普通邮递', '5.00', '普通邮递');
INSERT INTO `phpcms_order_logistics` VALUES ('4', '邮局快递', '12.00', '邮局快递');
