<?php 
//配送方式
function mk_logistics_btn($data,$attr='class="payment-show"',$ishow='1') {
	$btn_type = '';
	if(is_array($data)){
		foreach ($data as $v) {
			$btn_type .= '<label '.$attr.'>';
			$btn_type .='<input name="logistics_type" type="radio" value="'.$v['logistics_id'].'"> <em>'.$v['name'].'</em>';
			$btn_type .=$v['fee']?"&nbsp;&nbsp;手续费:".$v['fee']:"";
			$btn_type .=$ishow ? '<span class="payment-desc">'.$v['desc'].'</span>' :'';
			$btn_type .= '</label>';
		}
	}
	return $btn_type;
}
?>