<?php
defined('IN_PHPCMS') or exit('No permission resources.');
$session_storage = 'session_'.pc_base::load_config('system','session_storage');
pc_base::load_sys_class($session_storage);
pc_base::load_app_class('foreground','member');
pc_base::load_sys_class('form', '', 0);
pc_base::load_app_func('global');

class order extends foreground {
	function __construct() {
		if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
		parent::__construct();

		$this->pay_db = pc_base::load_model('pay_payment_model');
		$this->account_db = pc_base::load_model('pay_account_model');

		$this->cart_db = pc_base::load_model('order_cart_model');
		$this->content_db = pc_base::load_model('order_content_model');
		$this->logistics_db = pc_base::load_model('order_logistics_model');

		$this->pay_deposit_cls = pc_base::load_app_class('pay_deposit');

		$this->_username = param::get_cookie('_username');
		$this->_userid = param::get_cookie('_userid');
		$this->_groupid = param::get_cookie('_groupid');

		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
		define("SITEID",$siteid);
	}

	public function init() {
		pc_base::load_app_class('pay_factory','',0);
		$where = '';
		$page = $_GET['page'] ? intval($_GET['page']) : '1';
		$where = "AND `userid` = '$this->_userid' And `pay_type` = 'online' ";
		$start = $end = $status = '';
		if($_GET['dosubmit']){
			$start_addtime = $_GET['info']['start_addtime'];
			$end_addtime = $_GET['info']['end_addtime'];
			$status = $_GET['info']['status'];
			if($start_addtime && $end_addtime) {
				$start = strtotime($start_addtime.' 00:00:00');
				$end = strtotime($end_addtime.' 23:59:59');
				$where .= "AND `addtime` >= '$start' AND  `addtime` <= '$end'";
			}
			if($status) $where .= "AND `status` LIKE '%$status%' ";
		}
		if($where) $where = substr($where, 3);
		$infos = $this->account_db->listinfo($where, 'addtime DESC', $page, '15');
		if (is_array($infos) && !empty($infos)) {
			foreach($infos as $key=>$info) {
				$payment = $this->pay_deposit_cls->get_payment($info['pay_id']);
				$cfg = unserialize_config($payment['config']);
				$pay_name = ucwords($payment['pay_code']);

				$pay_fee = pay_fee($info['money'],$payment['pay_fee'],$payment['pay_method']);
				$logistics_fee = $info['logistics_fee'];
				$discount = $info['discount'];
				// calculate amount
				$info['price'] = $info['money'] + $pay_fee + $logistics_fee + $discount;
				$infos[$key]['price'] = $info['price'];
				// add order info
				$order_info['id']	= $info['trade_sn'];
				$order_info['quantity']	= $info['quantity'];
				$order_info['buyer_email']	= $info['email'];
				$order_info['order_time']	= $info['addtime'];

				//add product info
				$product_info['name'] = $info['contactname'];
				$product_info['body'] = $info['usernote'];
				$product_info['price'] = $info['price'];

				//add set_customerinfo
				$customerinfo['telephone'] = $info['telephone'];
				if($payment['is_online'] === '1') {
					$payment_handler = new pay_factory($pay_name, $cfg);
					$payment_handler->set_productinfo($product_info)->set_orderinfo($order_info)->set_customerinfo($customer_info);
					if($info['status']=='unpay' && $info['pay_id']!= 0 && $info['pay_id']) {
						$infos[$key]['pay_btn'] = $payment_handler->get_code('value="'.L('pay_btn').'" class="pay-btn"');
					} else {
						$infos[$key]['pay_btn'] = '';
					}
				}
			}
		}
		foreach(L('select') as $key=>$value) {
			$trade_status[$key] = $value;
		}
		$pages = $this->account_db->pages;
		include template('order', 'order_list');
	}
	
	public function view(){
		$trade_sn=$_GET['trade_sn'];	
		$account_data = $this->account_db->get_one(array('trade_sn'=>$trade_sn,'userid'=>$this->_userid));
		
		//支付手续费
		$payment = $this->pay_deposit_cls->get_payment($account_data['pay_id']);
		$pay_fee = pay_fee($account_data['money'],$payment['pay_fee'],$payment['pay_method']);		
		
		$logistics_data = $this->logistics_db->get_one(array('logistics_id'=>$account_data['logistics_id']));
		
		//合计
		$price = $account_data['money'] + $pay_fee + $logistics_data['fee'] + $account_data['discount'];
		
		//订单商品
		$infos = $this->content_db->select(array('trade_sn'=>$trade_sn));
		
		include template('order', 'view');
	}

	/*
	 * 充值方式支付
	*/
	public function pay_recharge() {
		if(isset($_POST['dosubmit'])) {
			$where = array('userid'=>$this->_userid);
			//验证码
			$code = isset($_POST['code']) && trim($_POST['code']) ? trim($_POST['code']) : showmessage(L('input_code'), HTTP_REFERER);
			if ($_SESSION['code'] != strtolower($code)) {
				showmessage(L('code_error'), HTTP_REFERER);
			}

			//订单号
			if(!param::get_cookie('trade_sn')) {
				showmessage(L('illegal_creat_sn'));
			}
			$trade_sn	= param::get_cookie('trade_sn');

			//统计
			$total_quantity=$this->cart_db->get_one($where, "sum(quantity) AS num");
			$total_quantity=$total_quantity['num'];
			$total_money=$this->cart_db->get_one($where, "sum(money*quantity) AS num");
			$total_money=$total_money['num'];

			if($total_quantity==0){
				showmessage(L('cart_is_empty'), HTTP_REFERER);
			}

			//购物车->order_content
			$infos = $this->cart_db->select(array('userid'=>$this->_userid));
			$infos = new_html_special_chars($infos);
			foreach ($infos as $info){
				$info['trade_sn']=$trade_sn;
				unset($info['id']);
				unset($info['userid']);
				$this->content_db->insert($info);
			}

			//支付类型
			$pay_id = $_POST['pay_type'];
			if(!$pay_id) showmessage(L('illegal_pay_method'));
			$payment = $this->pay_db->get_one(array('pay_id'=>$pay_id));
			$cfg = unserialize_config($payment['config']);
			$pay_name = ucwords($payment['pay_code']);
				
			//物流
			$logistics = $this->logistics_db->get_one(array('logistics_id'=>$_POST['logistics_type']));

			//保存支付信息
			$surplus = array(
					'userid'      => $this->_userid,
					'username'    => $this->_username,
					'money'       => $total_money,
					'quantity'    => $total_quantity,
					'telephone'   => trim($_POST['info']['telephone']),
					'contactname' => $_POST['info']['name'] ? trim($_POST['info']['name']) : $this->_username,
					'email'       => trim($_POST['info']['email']),
					'addtime'	  => SYS_TIME,
					'ip'	  => ip(),
					'pay_type'	  => 'online',
					'pay_id'     => $payment['pay_id'],
					'payment'     => trim($payment['pay_name']),
					'usernote'    => new_html_special_chars(trim($_POST['info']['usernote'])),
					'trade_sn'	  => $trade_sn,
					'logistics_fee' => trim($logistics['fee']),
					'logistics_id'=>$_POST['logistics_type'],
					'address'=>$_POST['info']['address'],
			);
			$trade_exist = $this->account_db->get_one(array('trade_sn'=>$surplus['trade_sn']));
			if($trade_exist) showmessage(L('order_closed_or_finish'));
			$this->account_db->insert($surplus);
			$recordid = $this->account_db->insert_id();
			$factory_info = $this->account_db->get_one(array('id'=>$recordid));

			//费用
			$pay_fee = pay_fee($factory_info['money'],$payment['pay_fee'],$payment['pay_method']);
			$logistics_fee = $factory_info['logistics_fee'];
			$discount = $factory_info['discount'];

			//calculate amount
			$factory_info['price'] = $factory_info['money'] + $pay_fee + $logistics_fee + $discount;

			//add order info
			$order_info['id']	= $factory_info['trade_sn'];
			$order_info['quantity']	= $factory_info['quantity'];
			$order_info['buyer_email']	= $factory_info['email'];
			$order_info['order_time']	= $factory_info['addtime'];

			//add product info
			$product_info['name'] = $factory_info['contactname'];
			$product_info['body'] = $factory_info['usernote'];
			$product_info['price'] = $factory_info['price'];

			//add set_customerinfo
			$customerinfo['telephone'] = $factory_info['telephone'];
			if($payment['is_online'] === '1') {
				pc_base::load_app_class('pay_factory','',0);
				$payment_handler = new pay_factory($pay_name, $cfg);
				$payment_handler->set_productinfo($product_info)->set_orderinfo($order_info)->set_customerinfo($customer_info);
				$code = $payment_handler->get_code('value="'.L('confirm_pay').'" class="button"');
			} else {
				$this->account_db->update(array('status'=>'waitting','pay_type'=>'offline'),array('id'=>$recordid));
				$code = '<div class="point">'.L('pay_tip').'</div>';
			}

			//清空购物车
			$this->cart_db->delete(array('userid'=>$this->_userid));
		}
		include template('order', 'payment_cofirm');
	}

}
?>