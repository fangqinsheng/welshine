<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class logistics extends admin {
	function __construct() {
		if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
		parent::__construct();
		$this->logistics_db = pc_base::load_model('order_logistics_model');
	}

	public function init() {
		$logistics_data = $this->logistics_db->select('');
		include $this->admin_tpl('logistics');
	}

	public function edit() {
		if(is_array($_POST['logistics_id'])){
			for ($i = 0; $i <= count($_POST['logistics_id']); $i++) {
				$this->logistics_db->update(
						array(
								'name'=>$_POST['name'][$i],
								'fee'=>$_POST['fee'][$i],
								'desc'=>$_POST['desc'][$i],
						),
						array('logistics_id'=>$_POST['logistics_id'][$i])
				);
			}
		}
		showmessage(L('operation_success'),'?m=order&c=logistics&a=init');
	}
}