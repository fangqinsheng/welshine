<?php
defined('IN_PHPCMS') or exit('No permission resources.');
$session_storage = 'session_'.pc_base::load_config('system','session_storage');
pc_base::load_sys_class($session_storage);
pc_base::load_app_class('foreground','member');
pc_base::load_sys_class('form', '', 0);
pc_base::load_app_func('global','pay');
pc_base::load_app_func('global');

class cart extends foreground {
	function __construct() {			
		if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists')); 
		parent::__construct();
		
		$this->cart_db = pc_base::load_model('order_cart_model');
		$this->logistics_db = pc_base::load_model('order_logistics_model');
		
		$this->handle = pc_base::load_app_class('pay_deposit','pay');

		$this->_username = param::get_cookie('_username');
		$this->_userid = param::get_cookie('_userid');
		$this->_groupid = param::get_cookie('_groupid');

		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
		define("SITEID",$siteid);
	}

	public function init() {
		$where = array('userid'=>$this->_userid);
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->cart_db->listinfo($where,$order = 'a_id DESC',$page, $pages = '100');
		$infos = new_html_special_chars($infos);
		$pages = $this->cart_db->pages;
		$total_quantity=$this->cart_db->get_one($where, "sum(quantity) AS num");
		$total_quantity=$total_quantity['num'];
		$total_money=$this->cart_db->get_one($where, "sum(money*quantity) AS num");
		$total_money=$total_money['num'];
		include template('order', 'cart');
	}

	public function add() {
		$cdb = pc_base::load_model('content_model');
		$catid = intval($_GET['a_catid']);
		$id = intval($_GET['a_id']);
		if(!$catid || !$id) showmessage(L('information_does_not_exist'),'blank');
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		if(!isset($CATEGORYS[$catid]) || $CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
		$this->category = $CAT = $CATEGORYS[$catid];
		$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
		$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
		
		$MODEL = getcache('model','commons');
		$modelid = $CAT['modelid'];
		
		$tablename = $cdb->table_name = $cdb->db_tablepre.$MODEL[$modelid]['tablename'];
		$r = $cdb->get_one(array('id'=>$id));
		if(!is_array($r)) showmessage('数据不存在!','blank');
		//print_r($r);exit;
		$data["a_id"]=$r['id'];
		$data["a_catid"]=$r['catid'];
		$data["a_title"]=$r['title'];
		$data["money"]=$r['money'];
		$data["quantity"]=intval($_POST['quantity']);
		if($data["quantity"]==0){
			$data["quantity"]=1;
		}
		$data["userid"]=$this->_userid;

		$where = array("a_id"=>$data["a_id"],"userid"=>$data["userid"]);
		if($this->cart_db->count($where)>0){
			$data["quantity"]="+=".$data["quantity"];
			$this->cart_db->update($data,$where);
		}else{
			$this->cart_db->insert($data,true);
		}
		showmessage(L('operation_success'),'?m=order&c=cart&a=init');
	}

	public function edit() {
		$buttontype = $_POST['buttontype'];
		if($buttontype=='edit'){
			if(is_array($_POST['id'])){
				for ($i = 0; $i <= count($_POST['id']); $i++) {
					$this->cart_db->update(array('quantity'=>$_POST['quantity'][$i]),array('id'=>$_POST['id'][$i],'userid'=>$this->_userid));
				}
			}
		}elseif($buttontype=='del'){
			if((!isset($_POST['selectid']) || empty($_POST['selectid']))) {
				showmessage(L('illegal_parameters'), HTTP_REFERER);
			}
			if(is_array($_POST['selectid'])){
				foreach($_POST['selectid'] as $selectid_arr) {
					$this->cart_db->delete(array('id'=>$selectid_arr,'userid'=>$this->_userid));
				}
			}
		}
		showmessage(L('operation_success'),'?m=order&c=cart&a=init');
	}
	
	public function delete() {
		if((!isset($_GET['id']) || empty($_GET['id']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
			return ;
		}
		$this->cart_db->delete(array('id'=>$_GET['id'],'userid'=>$this->_userid));
		showmessage(L('operation_success'),'?m=order&c=cart&a=init');
	}
	
	public function clear() {
		$this->cart_db->delete(array('userid'=>$this->_userid));
		showmessage(L('operation_success'),'?m=order&c=cart&a=init');		
	}
	
	public function pay() {
		$memberinfo = $this->memberinfo;
		$where = array('userid'=>$this->_userid);
		$pay_types = $this->handle->get_paytype();
		$logistics_types = $this->logistics_db->select('');
		
		//显示验证js
		$show_validator = 1;
		
		$trade_sn = create_sn();
		param::set_cookie('trade_sn',$trade_sn);

		$total_quantity=$this->cart_db->get_one($where, "sum(quantity) AS num");
		$total_quantity=$total_quantity['num'];
		$total_money=$this->cart_db->get_one($where, "sum(money*quantity) AS num");
		$total_money=$total_money['num'];
		
		if($total_quantity==0){
			showmessage(L('cart_is_empty'), HTTP_REFERER);
		}		
		include template('order', 'pay');
	}
	
	public function public_cartinfo_ajax() {
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : '';
		$_userid = param::get_cookie('_userid');

		if($_userid){
			$where = array('userid'=>$_userid);
			$total_quantity=$this->cart_db->get_one($where, "sum(quantity) AS num");
			$total_money=$this->cart_db->get_one($where, "sum(money*quantity) AS num");
			$total_count=$this->cart_db->get_one($where, "count(*) AS num");
			
			$data['userid']=intval($_userid);
			$data['quantity']=$total_quantity['num']?$total_quantity['num']:0;
			$data['money']=$total_money['num']?$total_money['num']:0;
			$data['count']=$total_count['num']?$total_count['num']:0;
			
			echo json_encode($data);
		}else{
			echo '{"userid":0}';
		}
	}

}
?>