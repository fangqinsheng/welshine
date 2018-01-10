DROP TABLE IF EXISTS `phpcms_order_cart`;
CREATE TABLE `phpcms_order_cart` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `a_id` int(10) NOT NULL,
  `a_catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `a_title` char(80) NOT NULL DEFAULT '',
  `money` char(8) NOT NULL,
  `quantity` int(8) unsigned NOT NULL DEFAULT '1',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

