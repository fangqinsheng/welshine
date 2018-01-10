<?php 
defined('IN_PHPCMS') or exit('Access Denied');
defined('UNINSTALL') or exit('Access Denied');
$type_db = pc_base::load_model('type_model');
$get_db = pc_base::load_model('get_model');
$typeid = $type_db->delete(array('module'=>'order'));
$get_db->sql_query('delete from v9_menu where m="pay" and c="order_admin"');
?>