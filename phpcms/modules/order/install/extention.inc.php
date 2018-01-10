<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');

$parentid = $menu_db->insert(array('name'=>'order', 'parentid'=>29, 'm'=>'pay', 'c'=>'order_admin', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'logistics', 'parentid'=>$parentid, 'm'=>'order', 'c'=>'logistics', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'logistics_edit', 'parentid'=>$parentid, 'm'=>'order', 'c'=>'logistics', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$language = array('order'=>'订单','cart'=>'购物车','order_view'=>'详情','logistics'=>'物流','logistics_edit'=>'编辑');
?>