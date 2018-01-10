<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('format', '', 0);
pc_base::load_sys_class('form', '', 0);
pc_base::load_app_func('global');

class order_admin extends admin {	
	function __construct() {
		if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists')); 
		parent::__construct();
		$this->db = pc_base::load_model('pay_payment_model');
		$this->account_db = pc_base::load_model('pay_account_model');
		$this->member_db = pc_base::load_model('member_model');
		$this->modules_path = PC_PATH.'modules'.DIRECTORY_SEPARATOR.'pay';
		pc_base::load_app_class('pay_method','','0');
		$this->method = new pay_method($this->modules_path);
		
		$this->pay_deposit_cls = pc_base::load_app_class('pay_deposit');
		$this->content_db = pc_base::load_model('order_content_model');
		$this->logistics_db = pc_base::load_model('order_logistics_model');
	}
	
	public function init() {
		$where = " `pay_type` = 'online' ";
		if($_GET['dosubmit']){
			extract($_GET['info']);
			if($trade_sn) $where = "AND `trade_sn` LIKE '%$trade_sn%' ";
			if($username) $where = "AND `username` LIKE '%$username%' ";
			if($start_addtime && $end_addtime) {
				$start = strtotime($start_addtime.' 00:00:00');
				$end = strtotime($end_addtime.' 23:59:59');
				$where .= "AND `addtime` >= '$start' AND  `addtime` <= '$end'";				
			}
			if($status) $where .= "AND `status` LIKE '%$status%' ";			
			if($where) $where = substr($where, 3);
		}			
		$infos = array();
		foreach(L('select') as $key=>$value) {
			$trade_status[$key] = $value;
		}
		$page = $_GET['page'] ? $_GET['page'] : '1';
		
		$infos = $this->account_db->listinfo($where, $order = 'addtime DESC,id DESC', $page, $pagesize = 20);
		$pages = $this->account_db->pages;
		$number = count($infos);
		include $this->admin_tpl('order_list');	
	}
	
	public function view(){
		$trade_sn=$_GET['trade_sn'];
		$account_data = $this->account_db->get_one(array('trade_sn'=>$trade_sn));
	
		//支付手续费
		$payment = $this->pay_deposit_cls->get_payment($account_data['pay_id']);
		$pay_fee = pay_fee($account_data['money'],$payment['pay_fee'],$payment['pay_method']);
	
		$logistics_data = $this->logistics_db->get_one(array('logistics_id'=>$account_data['logistics_id']));
	
		//合计
		$price = $account_data['money'] + $pay_fee + $logistics_data['fee'] + $account_data['discount'];
	
		//订单商品
		$infos = $this->content_db->select(array('trade_sn'=>$trade_sn));
	
		include $this->admin_tpl('order_view');	
	}
}