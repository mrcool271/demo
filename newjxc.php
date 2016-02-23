<?php
/**
 * 进销存改版之定时清购物车、订单失效（临时）
 * 
 * @author
 * @version 
 */
include_once 'Zend/Controller/Action.php';
class NewjxcController extends BaseController  {
	
	public function init(){
		parent::initNoPri();
		$this->_db = Zend_Registry::get('db');
	}
	/**
	 * 发送短信、邮件、cps通知信息接口
	 */
	public function sendsecAction(){
		$sql = 'select id,type,param from order_sms_email where type > 0';
		$data = $this->_db->fetchAll($sql);
		$vir = array();
		$del_str = '';
		foreach($data as $d){
			$p = unserialize($d['param']);
			if($d['type'] == 1){//短信
				$this->curl('http://sms.jiapin.com/api/sendtel',$p);
				$this->_db->query('update order_sms_email set type=-1 where id='.$d['id']);
			}else if($d['type'] ==2){//邮件
				$res = $this->curl('http://sms.jiapin.com/api/email263',$p);
				$this->_db->query('update order_sms_email set type=-1 where id='.$d['id']);
			}else if($d['type'] == 3){//cps通知
				$this->curl('http://ana.jiapin.com/cps/cpsorder',$p);
				try{
					$fp = fopen(ROOT . '/html/weblog/log_cpsorder_'.date("Ym").'.log','a');
					$str = date('Y-m-d H:i:s').'->'.print_r($p,1)."\n";
					fwrite($fp,$str);
					fclose($fp);	
				}catch(Exception $e){
					
				}
				
				$this->_db->query('update order_sms_email set type=-1 where id='.$d['id']);
			}else if($d['type'] ==4){//通知虚拟账户子母订单对应关系
				$vir[] = $p;
				$del_str .= $d['id'].',';
			}
		}
		if($vir){
			$r = '';
			$fp = fopen(ROOT . '/html/weblog/failed_virtuallog_'.date("Ym").'.log','a');
			try{
				include_once 'application/models/OrderBaseModel.php';
				$obj_base = new OrderBaseModel();
				$soap = $obj_base->getSoap(4);
				$r = $soap->VirtualLog( $vir , $obj_base->getWsCheck('VirtualLog',4));
				if($r != 1){
					fwrite($fp,date("YmdHis")."\t".json_encode($vir)."->".$r."\n");	
				}else{
					//fwrite($fp,date("YmdHis")."==\t".json_encode($vir)."->".$r."\n");
					$this->_db->query('update order_sms_email set type=-1 where id in('.substr($del_str,0,-1).')');
				}
			}catch(Exception $e){
				$s = $e->getMessage();
				fwrite($fp,date("YmdHis")."\t".json_encode($vir)."->".$r."->".$s."\n");
			}
			fclose($fp);
		}
		exit;
	}
	//15为操作的退货申请单自动撤销
	public function canclegoodsreturnAction(){
		$this->_adminlogModel = new AdminlogModel();
		//查找15天前未处理的退货申请单
		$t = time();
		$date = date('Y-m-d H:i:s',$t);
		$sql = 'select DISTINCT a.`id`,a.remark from goods_return_apply a,goods_return_detail d where a.id = d.apply_id AND d.is_reject = 0 AND a.`status`=0 AND a.add_time<'.($t-15*24*3600); 
		$data = $this->_db->fetchAll($sql);
		foreach($data as $d){
			$remark = $d['remark'].'<br />系统自动于'.$date.'撤销了申请单<br />撤销备注：超过申请操作有效期，自动撤销';
			if($this->_db->update('goods_return_apply',array('status' => -1,'remark' => $remark),'id="'.$d['id'].'"')){
				$data = array ();
				$data['log_name'] = '退货申请';
				$data['log_remark'] = '撤销退货申请单||单号:'.$d['id'].'||备注:超过申请操作有效期，自动撤销';
				$data['user_id'] = -1;
				$data['user_name'] = '系统';
				$data['user_ip'] = $_SERVER['REMOTE_ADDR']; 
				$this->_adminlogModel->insertAdminlog($data);
			}
		}
		exit;
	}
	/**
	 自动审单 : 各类中满足全部条件时，自动审核通过
	 A类
		条件1，全部支付状态，且还需支付金额为0。
		条件2，顾客备注信息为空。
		条件3，订单金额大于50元。
		条件4，礼金券支付金额小于100元。
		条件5，虚拟账户支付金额小于1000元。
	 B类条件建议修改为：
		条件1：订单为部分支付，订单金额＜1000元
		条件2：顾客备注信息为空。
		条件3：订单金额大于50元。
		条件4：支付帐户必须含礼品卡或可提现虚拟帐户中的一种，且账户支付金额小于1000元。
		条件5：礼金券支付金额小于100元。
	 */
	public function autocheckAction(){
		$sql = 'select order_id,paid_status,paid_ness,shipping_time_remark,price_all,paid_coupon,paid_virtual,paid_red,pay_id from `order` where `status`=0 and check_status=0 and receive_name!="测试" and receive_name!="测试订单" and receive_name!="监控测试"';
		$order = $this->_db->fetchAll($sql);
		include_once 'admin/models/NeworderModel.php';
		$obj_order = new NeworderModel();
		foreach($order as $o){//判断每一张订单是否符合通过审核的条件
			$suc = 0;
			$paid = $o['paid_virtual'] + $o['paid_red'];
			if($o['paid_status'] == 1 && $o['paid_ness'] == 0 && trim($o['shipping_time_remark']) == '' && $o['price_all'] > 50 && $o['paid_coupon'] <= 100 && $o['price_all'] <= 1000){//A
				$suc = 'A';
			}else if($o['pay_id'] == 1 && $o['price_all'] > 50 && $o['price_all'] <= 1000 && trim($o['shipping_time_remark']) == '' && $o['paid_coupon'] <= 100 && 0 <= $paid && $paid < 1000){//B
				$suc = 'B';
			}
			if($suc){//通过验证，可以通过审核
				$this->_db->beginTransaction();
				$sql = 'select `status`,check_status from `order` where order_id="'.$o['order_id'].'" FOR UPDATE';
				$d = $this->_db->fetchRow($sql);
				if($d['status'] == 0 && $d['check_status'] == 0){
					//操作日志
					$data = array ();
					$data ['log_name'] = '订单审核';
					$data ['user_id'] = -1;
					$data ['user_name'] = '系统';
					$data ['user_ip'] = $_SERVER ['REMOTE_ADDR'];
					$data ['order_order_id'] = $o['order_id'];
					$data ['log_remark'] = '系统自动审单，满足了' . $suc . '类条件';
					$data ['begin'] = '';
					$data ['add_time'] = time();
					$data ['end'] = '审核通过';
					if($this->_db->insert('order_log',$data)){
						if($this->_db->update('order',array('check_status' => 1),'order_id="'.$o['order_id'].'"')){
							$this->_db->commit();
							$obj_order->sendOrderEmail($o['order_id'],'order_verify');
						}else{
							$this->_db->rollback();
						}
					}
				}
			}
		}
		exit;
	}
	/**
	 * 订单未支付提醒，每分钟执行一次admin.jiapin.com/exec/sendorderpaid
	 */
	public function sendorderpaidAction(){
		$sql = 'SELECT `order_id`, `pay_name`, `paid_status`, `paid_ness`, `paid_all`, `price_all`, `sms_mobile`, `receive_mobile`, `status` FROM `order` WHERE `add_time` <= UNIX_TIMESTAMP()-900 AND `add_time` > UNIX_TIMESTAMP()-960 AND `status` = 0 AND `pay_id` != 1';
		$order_list = $this->_db->fetchAll($sql);
		foreach($order_list as $ol){
			if(!($ol['paid_status'] == 1 && $ol['paid_ness'] == 0 && $ol['paid_all'] == $ol['price_all'])){
				$param = array (); //发送短信
				$param ['send_tel'] = empty($ol['sms_mobile']) ? $ol['receive_mobile'] : $ol['sms_mobile'];
				if($param ['send_tel']){
					$param ['send_content'] = '尊敬的会员，为确保您能购得心仪商品，请尽快支付' . $ol['order_id'] . '号订单，如有问题请致电4008001999';
					$param ['time'] = time();
					$param ['sign'] = md5('send_content='.$param ['send_content'].'&send_tel='.$param ['send_tel'].'&time='.$param ['time'].'35e3fa3334a372b660db5e11ff6a3cec');
					try{
						$this->curl('http://sms.jiapin.com/api/sendtel',$param);
					}catch(exception $e){
						//echo $e->getMessage();
					}
				}
			}
		}//foreach($order_list as $ol){
		exit;
	}
	/**
	 * 配合新进销存改版的自动程序
	 */
	public function jxctempAction(){
		$ip = $this->getIP();
		//定时清除超时的购物车记录
		/*$sql = 'select member_id,goods_id,goods_size_id as size_id,goods_number as num,id,tag_id,from_code from cart where add_time <= (UNIX_TIMESTAMP() - 1805) and add_time!=1';
		$cart = $this->_db->fetchAll($sql);
		if($cart){
			$this->autovoidcart($cart);
		}*/
		//定时失效超时未支付成功的订单:现金券、礼金券暂未处理
		$order = $this->timeoutOrders();
		$fp = fopen(ROOT . '/html/weblog/log_clear_order_'.date("Ym").'.log','a');
		fwrite($fp,date("Y-m-d H:i:s")."\t".print_r($order,1)."\n\n\n");
		fclose($fp);
		if($order){
			foreach($order as $val){
				$this->autovoidorder($val['order_id'],$ip);
			}
		}
		exit;
	}
	public function autovoidcart($cart){
		include_once 'application/models/OrderBaseModel.php';
		$obj_base = new OrderBaseModel();
		$suc_num = array();//记录商品成功释放的库存数量
		try{
			$this->cache = Zend_Registry::get("cache");
			$erp_soap = $obj_base->getSoap(1);
			$this->goodsPieceLog(5,print_r($cart,1).'==cancel');
			$res = $erp_soap->cancelPieceToCart($cart, $obj_base->getWsCheck('cancelPieceToCart',1));
			$this->goodsPieceLog(5,print_r($res,1).'==cancel');
			if(is_array($res)){//释放成功
				foreach($res as $r){
					$suc_num[$r['member_id'].'_'.$r['goods_id'].'_'.$r['size_id'].'_'.$r['tag_id']] = (int)$r['num'];//释放后的占用的商品数量
				}
				unset($res);
				$del_member = array();//记录释放掉的商品所属的人ID、fromcode
				$member_id_str = '';
				$member_id_array = array();
				foreach($cart as $r){
					try{
						$full_goods_name = $this->cache->load("cart_full_buy_".$r['member_id']."_".$r['from_code']);
					}catch(Exception $e){}
					if($full_goods_name){//这个id、fromcode下有满够商品，需要验证
						$del_member[$r['member_id']][$r['from_code']] = 1;
						$member_id_str .= $r['member_id'].',';
					}
					$member_id_array[] = $r['member_id'];
					//释放后的库存总数量
					$key = $r['member_id'].'_'.$r['goods_id'].'_'.$r['size_id'].'_'.$r['tag_id'];
					$s_num = isset($suc_num[$key]) ? $suc_num[$key] : 0;
					$update = $s_num > 0 ? array('goods_number' => $s_num) : array('add_time' => 1); 
					$this->_db->update('cart',$update,'id=' . $r['id']);
				}
				if($member_id_str){//删除掉不符合规则的满够商品
					$this->checkFullbuyGoods($del_member,$member_id_str);
				}
				$member_id_array = array_unique($member_id_array);
				try{				
					foreach($member_id_array as $mid){
						if($this->cache->load($mid)){
							$this->cache->remove($mid);
						}
						if($this->cache->load('cart_goods_'.$mid)){
							$this->cache->remove('cart_goods_'.$mid);
						}
					}
				}catch(Exception $e){}
			}else{
				$str = print_R($cart,1).'::'.print_R($res,1);
				$this->cartErrlog($str);
			}
		}catch(Exception $e){
			$str = print_R($cart,1).'::'.print_R($res,1).'::'.$e->getMessage();
			$this->cartErrlog($str);
		}
	}
	/**
	 * 检查购物车中是否存在不符合规则的满够商品
	 */
	public function checkFullbuyGoods($del_member,$member_id_str){
		include_once 'application/models/CartModel.php';
		$obj_cart = new CartModel();
		$full_all = array();
		$full_buy_all = $obj_cart->getFullBuyAll();
		if($full_buy_all){//通过tag_id获取对应的满够规则
			foreach($full_buy_all as $fa){
				$full_all[$fa['from_code'].$fa['gift']] = $fa;
			}
		}
		$full_buy_all = null;
		if($full_all){
			$sql = 'select member_id,member_name,goods_id,goods_size_id,goods_number,goods_color_id,goods_price,id,tag_id,from_code from cart where add_time > (UNIX_TIMESTAMP() - 1800) and member_id in('.substr($member_id_str,0,-1).')';
			$all_goods = $this->_db->fetchAll($sql);
			$member_goods = array();
			foreach($all_goods as $ag){
				$member_goods[$ag['member_id']][] = $ag; 
			}
			$all_goods = null;
			foreach($del_member as $member_id => $cartfrom){//判断这些人ID、fromcode下是否有不符合满够规则的满够商品，如果有则删除
				foreach($cartfrom as $from_code => $sub){//$subfrom==vs hk
					$full_buy_price = 0;//满够规则的金额
					$full_buy_ranges = '';//满够规则的活动范围
					$del_goods = array();//记录满够商品信息
					$new_goods = array();
					$total = 0;
					$member_name = '';
					$cart_gooods = isset($member_goods[$member_id]) ? $member_goods[$member_id] : array();
					foreach ($cart_gooods as $val){
						//找出满够商品
						if($from_code == $val['from_code']){
							$key = $from_code.$val['tag_id'];
							$f = isset($full_all[$key]) ? $full_all[$key] : '';
							if($f){ 
								$full_buy_price = sprintf('%.2f', $f['price']);
								$full_buy_ranges = $f['ranges'];
								$del_goods['cart_id'] = $val['id'];
								$del_goods['goods_id'] = $val['goods_id'];
								$del_goods['size_id'] = $val['goods_size_id'];
								$del_goods['tag_id'] = $val['tag_id'];
								$del_goods['num'] = -$val['goods_number'];
								$del_goods['ext_num'] = $val['goods_number'];
								$del_goods['member_id'] = $member_id;
								$del_goods['color_id'] = $val['goods_color_id'];
								$member_name = $val['member_name'];
							}else{
								$new_goods[] = $val;
								$total += $val['goods_price'] * $val['goods_number'];
							}
						}
					}
					if($del_goods){//购物车中存在满够商品，判断是否满足规则，不满足则删除该满够商品
						if($full_buy_ranges){//设置了范围
							$full_buy_ranges = ','.$full_buy_ranges.',';
							foreach ($new_goods as $val){
								if(strpos($full_buy_ranges,','.$val['tag_id'].',') === false){////当前商品的活动在规则的范围内
									$total -= $val['goods_number'] * $val['goods_price'];
								}
							}	
						}
						if($total - $full_buy_price < 0 || $full_buy_price <= 0){//不满足金额限制则删除商品
							$result = $obj_cart->cart($del_goods);
							if($result == 1){
								//记录用户自己删除购物车的记录
								$data = array();
								$data['member_id'] = $member_id;
								$data['member_name'] = $member_name;
								$data['goods_id'] = $del_goods['goods_id'];
								$data['color_id'] = $del_goods['color_id'];
								$data['size_id'] = $del_goods['size_id'];
								$data['number'] = $del_goods['ext_num'];
								$data['del_time'] = date ( "Y-m-d H:i:s" );
								$obj_cart->delCartGoodsLog ( $data );
								//清除满购缓存
								$obj_cart->setFullBuyCache($member_id,$from_code,1);
							}
						}
					}
				}
			}
		}
	}
	/**
	 * 置订单失效，同时自动返还对应支付费用
	 */
	public function autovoidorder($order_id,$ip){
		$this->_db->beginTransaction();
		$sql = 'select user_id,user_name,paid_coupon,paid_coupon_id,paid_coupon_code,paid_red,paid_virtual,paid_virtual_limit,paid_all,paid_ness,price_dep,price_goods from `order` where order_id="'.$order_id.'" for update';
		$order = $this->_db->fetchRow($sql);
		try{
			//更新order_package_goods
			$r = $this->_db->update('order_package_goods',array('goods_status' => -3),'order_id = "'.$order_id.'"');
			if(!$r){
				$str = 'e1::'.$order_id.'::'.$r;
				$this->orderErrlog($str);
			}
			$obj_om = new NeworderModel();
			$goods_list = $obj_om->getOrderGoods($order_id);
			//insert  order_goods_records
			$data = array();
			$cur_time = time();
			$data['order_id'] = $order_id;
			$data['goods_type'] = '订单失效';
			$data['add_time'] = $cur_time;
			foreach($goods_list as $gl){
				$data['piece_id'] = $gl['piece_id'];
				$data['goods_id'] = $gl['goods_id'];
				$data['goods_name'] = $gl['goods_name'];
				$data['color_id'] = $gl['color_id'];
				$data['color_name'] = $gl['color_name'];
				$data['size_id'] = $gl['size_id'];
				$data['size_name'] = $gl['size_name'];
				$data['img_path'] = $gl['img_path'] ? $gl['img_path'] : ' ';
				$data['goods_price'] = $gl['init_price'];
				$data['final_price'] = $gl['final_price'];
				$data['sale_price'] = $gl['sale_price'];
				$r = $this->_db->insert('order_goods_records',$data);
				if(!$r){
					$str = 'e2::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
			}
			//记录order_log表的日志
			$data = array ();
			$data ['log_name'] = "支付超时";
			$data ['user_id'] = $order['user_id'];
			$data ['user_name'] = $order['user_name'];
			$data ['user_ip'] = $ip;
			$data ['order_order_id'] = $order_id;
			$data ['log_remark'] = '支付超时';
			$data ['begin'] = '支付超时';
			$data ['end'] = '支付超时';
			$data ['add_time'] = $cur_time;
			$r = $this->orderLog($data);
			if(!$r){
				$str = 'e3::'.print_R($data,1).'::'.$r;
				$this->orderErrlog($str);
				$this->_db->rollback();
			}
			//记录费用日志
			$sql = 'SELECT `end` FROM order_log_fee WHERE order_order_id="'.$order_id.'" AND `type`=3 ORDER BY id DESC LIMIT 1';
			$end = $this->_db->fetchOne($sql);
			$data = array ();
			$data ['user_id'] = $order['user_id'];
			$data ['user_name'] = $order['user_name'];
			$data ['user_ip'] = $ip;
			$data ['order_order_id'] = $order_id;
			$data ['order_log_id'] = $r;
			$data ['begin'] = $end;
			$data ['value'] = -$order['price_goods'];
			$data ['end'] = $end-$order['price_goods'];
			$data ['add_time'] = $cur_time;
			$data ['type'] = 3; //费用类型：1:运费   2:赔损费  3:货款
			$r = $this->writeLogFee ($data);
			if(!$r){
				$str = 'e4::'.print_R($data,1).'::'.$r;
				$this->orderErrlog($str);
				$this->_db->rollback();
			}
			//分摊数据
			$obj_om->failOrderHedge($order_id);
			//优先返还可提现金额
			$paid_virtual = sprintf('%.2f',$order['paid_virtual']);
			$return_vir = array();
			if($paid_virtual > 0){
				$return_vir['vircredittrue'] = array('value'=>$paid_virtual,'admin_id'=>$order['user_id']);
				//订单操作日志
				$data = array ();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['log_name'] = '系统自动返款';
				$data ['user_ip'] = $ip;
				$data ['order_order_id'] = $order_id;
				$data ['log_remark'] = '可提现虚拟账户返款<br />订单号'.$order_id.'||金额'.$paid_virtual;
				$data ['begin'] = '';
				$data ['end'] = '返款成功';
				$data['add_time'] = $cur_time;
				$r = $this->orderLog($data);
				if(!$r){
					$str = 'e5::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
				//支付费用日志
				$data = array();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['pay_id'] = 888;
				$data ['pay_name'] = '可提现虚拟账户';
				$data ['pay_value'] = -$paid_virtual;
				$data ['order_order_id'] = $order_id;
				$data ['order_log_id'] = $r;
				$data ['add_time'] = $cur_time;
				$r = $this->orderLogPay($data);
				if(!$r){
					$str = 'e6::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
			}
			//禁提现返款
			$paid_virtual_limit = sprintf('%.2f',$order['paid_virtual_limit']);
			if($paid_virtual_limit > 0){
				$return_vir['vircredit'] = array('value'=>$paid_virtual_limit,'admin_id'=>$order['user_id']);
				
				//订单操作日志
				$data = array ();
				$data ['log_name'] = '系统自动返款';
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['user_ip'] = $ip;
				$data ['order_order_id'] = $order_id;
				$data ['log_remark'] = '禁提现虚拟账户返款<br />订单号'.$order_id.'||金额'.$paid_virtual_limit;
				$data ['end'] = '返款成功';
				$data['add_time'] = $cur_time;
				$r = $this->orderLog($data);
				if(!$r){
					$str = 'e7::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
				//支付费用日志
				$data = array();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['add_time'] = $cur_time;
				$data ['pay_id'] = 888;
				$data ['pay_name'] = "不可提现虚拟账户";
				$data ['pay_value'] = -$paid_virtual_limit;
				$data ['order_order_id'] = $order_id;
				$data ['order_log_id'] = $r;
				$r = $this->orderLogPay($data);
				if(!$r){
					$str = 'e8::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
			}
			//礼品卡返款
			$paid_red = sprintf('%.2f',$order['paid_red']);
			if($paid_red > 0){
				$return_vir['giftcard'] = array('value'=>$paid_red);
				//订单操作日志
				$data = array ();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['log_name'] = '系统自动返还礼品卡';
				$data ['user_ip'] = $ip;
				$data ['order_order_id'] = $order_id;
				$data ['log_remark'] = '返还礼品卡<br />订单号'.$order_id.'||金额'.$paid_red;
				$data ['end'] = '返还成功';
				$data['add_time'] = $cur_time;
				$r = $this->orderLog($data);
				if(!$r){
					$str = 'e9::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
				//支付费用日志
				$data = array();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['add_time'] = $cur_time;
				$data ['pay_id'] = 777;
				$data ['pay_name'] = '礼品卡';
				$data ['pay_value'] = -$paid_red;
				$data ['order_order_id'] = $order_id;
				$data ['order_log_id'] = $r;
				$r = $this->orderLogPay($data);
				if(!$r){
					$str = 'e10::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
			}
			$paid_coupon = sprintf('%.2f',$order['paid_coupon']);
			//礼金券返款
			if($paid_coupon > 0){
				$noexist_normal_order = 1;
				$sql = 'select rel_order from order_attach where order_id="'.$order_id.'"';
				$rel_order = $this->_db->fetchOne($sql);
				$w = '';
				if($rel_order){
					$ro = explode(',',$rel_order);
					foreach($ro as $ro_id){
						if($ro_id){
							$w .= "'" . $ro_id . "',"; 
						}
					}
					$ro = $rel_order = null;
				}
				if($w){
					$sql = 'select 1 from `order` where order_id in('.substr($w,0,-1).') and `status`>=0';
					if($this->_db->fetchOne($sql)){
						$noexist_normal_order = 0;
					}	
				}
				if($noexist_normal_order){
					$return_vir['coupon'] = array('admin_id'=>$order['user_id'],'admin_name'=>$order['user_name'],'coupon_id'=>$order['paid_coupon_id'],'coupon_rule_code'=>$order['paid_coupon_code']);	
				}
				//订单操作日志
				$data = array ();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['log_name'] = '系统自动返还礼金券';
				$data ['user_ip'] = $ip;
				$data ['order_order_id'] = $order_id;
				$data ['log_remark'] = '礼金券<br />订单号'.$order_id.'||金额'.$paid_coupon;
				$data ['end'] = '返款成功';
				$data['add_time'] = $cur_time;
				$r = $this->orderLog($data);
				if(!$r){
					$str = 'e11::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
				//支付费用日志
				$data = array();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['add_time'] = $cur_time;
				$data ['pay_id'] = 999;
				$data ['pay_name'] = '礼金券';
				$data ['pay_value'] = -$paid_coupon;
				$data ['order_order_id'] = $order_id;
				$data ['order_log_id'] = $r;
				$r = $this->orderLogPay($data);
				if(!$r){
					$str = 'e12::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
			}
			if(abs($order['price_dep']) > 0){//取消赔损费
				//插入订单操作日志
				$data = array ();
				$data ['log_name'] = "赔损费";
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['user_ip'] = $ip;
				$data ['order_order_id'] = $order_id;
				$data ['log_remark'] = '订单失效自动更新赔损费';
				$data ['begin'] = $order['price_dep'];
				$data ['end'] = 0;
				$data['add_time'] = $cur_time;
				$r = $this->orderLog($data);
				if(!$r){
					$str = 'e13::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
				$sql = 'SELECT `end` FROM order_log_fee WHERE order_order_id="'.$order_id.'" AND `type`=2 ORDER BY id DESC LIMIT 1';
				$end = $this->_db->fetchOne($sql);
				$data = array ();
				$data ['user_id'] = $order['user_id'];
				$data ['user_name'] = $order['user_name'];
				$data ['user_ip'] = $ip;
				$data ['order_order_id'] = $order_id;
				$data ['order_log_id'] = $r;
				$data ['begin'] = $end;
				$data ['value'] = -$order['price_dep'];
				$data ['end'] = $end-$order['price_dep'];
				$data ['add_time'] = $cur_time;
				$data ['type'] = 2; //费用类型：1:运费   2:赔损费  3:货款
				$r = $this->writeLogFee ($data);
				if(!$r){
					$str = 'e14::'.print_R($data,1).'::'.$r;
					$this->orderErrlog($str);
					$this->_db->rollback();
				}
			}//if(abs($order['price_dep']) > 0){//取消赔损费
			//更新订单信息
			$data = array('price_goods' => 0,'price_all' => 0,'paid_ness'=>0,'status'=>-2,'paid_all'=>0,'price_dep'=>0,'paid_coupon'=>0,'paid_red'=>0,'paid_virtual'=>0,'paid_virtual_limit'=>0);
			$r = $this->_db->update('order',$data,'order_id="'.$order_id.'"');
			if(!$r){
				$str = 'e15::'.print_R($data,1).'::'.$r;
				$this->orderErrlog($str);
				$this->_db->rollback();
			}
			$this->_db->commit();
			//释放库存
			$r = $obj_om->releaseStorage($order_id,$goods_list);
			if(!$r){//释放库存失败
				$str = 'e16::'.$order_id.'::'.print_R($goods_list,1).'::'.$r;
				$this->orderErrlog($str);
			}
			//返款
			if($return_vir){
				$return_vir['userinfo'] = array('member_id'=>$order['user_id'],'member_name'=>$order['user_name'],'order_id'=>$order_id);
				include_once 'application/models/OrderBaseModel.php';
				$ob = new OrderBaseModel();
				try{
					$soap = $ob->getSoap(4);
					$r = $soap->returnInterAccount($return_vir,$ob->getWsCheck('returnInterAccount',4));
					if(isset($return_vir['coupon'])){//礼金券
						$s = isset($r['coupon']['status']) ? $r['coupon']['status'] : 0;
						if($s != 1){//礼金券返还失败
							$str = 'e17::'.print_R($return_vir,1).'::'.print_r($r,1);
							$this->orderErrlog($str);
						}
					}
					if(isset($return_vir['giftcard'])){//礼品卡
						$s = isset($r['giftcard']['status']) ? $r['giftcard']['status'] : 0;
						if($s != 1){//礼品卡返还失败
							$str = 'e18::'.print_R($return_vir,1).'::'.print_r($r,1);
							$this->orderErrlog($str);
						}
					}
					if(isset($return_vir['vircredit'])){//禁提现
						$s = isset($r['vircredit']['status']) ? $r['vircredit']['status'] : 0;
						if($s != 1){//禁提现返还失败
							$str = 'e19::'.print_R($return_vir,1).'::'.print_r($r,1);
							$this->orderErrlog($str);
						}
					}
					if(isset($return_vir['vircredittrue'])){//可提现
						$s = isset($r['vircredittrue']['status']) ? $r['vircredittrue']['status'] : 0;
						if($s != 1){//可提现返还失败
							$str = 'e20::'.print_R($return_vir,1).'::'.print_r($r,1);
							$this->orderErrlog($str);
						}
					}
				}catch(Exception $e){
					$str = 'e21::'.print_R($return_vir,1).'::'.print_r($r,1);
					$this->orderErrlog($str);
				}
			}
			try{
				//自动失效订单后更新必要的缓存
				include_once 'application/admin/models/CacheModel.php';
				$obj_cache = new CacheModel();
				$cache_data = array('cache' => $this->cache, 'member_id' => $order['user_id'], 'from' => substr($order_id,0,1), 'paid_ness' => 1);//失效前的还需支付肯定大于1
				$obj_cache->setOrderAutovoid($cache_data);
			}catch(Exception $e){
				$str = 'e42::'.$e->getMessage();
				$this->orderErrlog($str);
			}
		}catch(Exception $e){
			$str = 'e22::'.$e->getMessage();
			$this->orderErrlog($str);
		}
		return 1;
	}
	public function cartErrlog($str){
		$fp = fopen(ROOT . '/html/weblog/failed_clear_newcart_'.date("Ym").'.log','a');
		fwrite($fp,date("YmdHis")."\t".json_encode($str)."\n");
		fclose($fp);
	}
	public function orderErrlog($str){
		$fp = fopen(ROOT . '/html/weblog/failed_clear_order_'.date("Ym").'.log','a');
		fwrite($fp,date("YmdHis")."\t".json_encode($str)."\n");
		fclose($fp);
	}
	/**
	 *  符合失效条件的订单列表:排除货到付、银行汇款订单,pay_id分别对应1和3
	 */
	public function timeoutOrders(){
		$sql	=	"SELECT order_id FROM `order` WHERE add_time < UNIX_TIMESTAMP() - 86400 AND pay_id > 3 AND paid_ness > 0 AND `status` = 0 AND check_status != 1";
		return $this->_db->fetchAll($sql);
	}
	
	public function timeoutOrdersLakala(){
		$sql	=	"SELECT order_id FROM `order` ";
		$sql	.=	"WHERE add_time < UNIX_TIMESTAMP() - 86400 AND pay_id = 8 ";
		$sql	.=	"AND paid_ness > 0 AND `status` = 0 AND check_status != 1";
		return $this->_db->fetchAll($sql);
	}
	/**
	 * 荷兰拍订单失效列表：8分钟
	 * @return unknown_type
	 */
	public function timeoutOrdersHlp(){
		$sql	=	"SELECT o.order_id FROM `order` o LEFT JOIN order_attach oa ON o.order_id = oa.order_id ";
		$sql	.=	"WHERE o.add_time < UNIX_TIMESTAMP() - 86400 AND ((o.pay_id > 3 AND o.pay_id <= 200) or (o.pay_id > 500 AND o.pay_id <506)) AND o.pay_id!=8 ";
		$sql	.=	"AND o.paid_ness > 0 AND o.`status` = 0 AND o.check_status != 1 AND oa.mode_id = 8";
		return $this->_db->fetchAll($sql);
	}
	/**
	 * 取得等待完结的订单信息列表
	 */
	public function getOverOrdersAction(){
		$fp = fopen(ROOT . '/html/weblog/getoverorderdetail_'.date("Y").'.log','a');
		fwrite($fp,date("Y-m-d H:i:s")."\t\n" );
		$sql_a = "SELECT o.order_id,o.add_time FROM `order` o WHERE o.check_status=1 AND o.status=0 ";
		$sql_a .= "AND o.paid_status = 1 AND o.paid_ness = 0 AND o.paid_all = o.price_all ";
		$sql_a .= "AND o.add_time < UNIX_TIMESTAMP()-7*24*3600 GROUP BY o.order_id ORDER BY o.add_time ASC";
		$order = $this->_db->fetchAll($sql_a);
		$order_id = array();
		$order_time = array();
		foreach($order as $o){
			$order_id[] = $o['order_id'];
			$order_time[$o['order_id']] = $o['add_time'];
		}
		unset($order);
		fwrite($fp,"order_num:".count($order_id)."\n" );
		if($order_id){
			include_once 'application/models/OrderBaseModel.php';
			$ob = new OrderBaseModel();
			try{
				$soap = $ob->getSoap(6);
				//获取sale_id,sale_status,shelf_id
				$piece = $soap->getSaleStatusAndShelfId($order_id,$ob->getWsCheck('getSaleStatusAndShelfId',6));
				if(is_array($piece)){
					unset($order_id);
					$order_num = array();
					foreach($piece as $p){
						if(isset($order_num[$p['sale_id']])){
							//商品总数
							$order_num[$p['sale_id']]['goods_number']+=1;
							//发货总数
							if($p['sale_status'] == 3 && $p['shelf_id'] == -5){
								$order_num[$p['sale_id']]['send_number']+=1;
							}
						}else{
							$add_time = isset($order_time[$p['sale_id']]) ? $order_time[$p['sale_id']] : 0;
							$order_num[$p['sale_id']] = array('goods_number'=>1,'send_number' => 0,'add_time'=>$add_time);
							if($p['sale_status'] == 3 && $p['shelf_id'] == -5){
								$order_num[$p['sale_id']]['send_number']=1;
							}
						}
					}
					//将商品总数和发货总数相等的订单写入order_over
					unset($order_time);
					unset($piece);
					foreach($order_num as $order_id => $on){
						if($on['send_number'] == $on['goods_number']){
							$sql = 'SELECT order_id,is_delete FROM order_over where order_id="'.$order_id.'"';
							$over_order = $this->_db->fetchRow($sql);
							if($over_order){//存在
								if($over_order['is_delete'] == 1){
									$sql = 'update order_over set is_delete=0 where order_id="'.$order_id.'"';
								}
							}else{
								$sql = 'INSERT order_over SELECT "'.$order_id.'",'.$on['add_time'].',0';
							}
							if($sql){
								try{
									$this->_db->query($sql);	
								}catch(Exception $e){
									fwrite($fp,"e1:".$e->getMessage().'->sql:'.$sql."\n" );
								}
							}
						}
					}
				}
			}catch(Exception $e){
				fwrite($fp," e2:".$e->getMessage()."\n" );
			}	
		}
		fclose($fp);
		echo "success";
		exit;
	}
	/**
	 * 将筛选出来的符合完结条件的订单进行完结
	 */
	public function overOrdersAction(){
		$fp = fopen(ROOT . '/html/weblog/overorderdetail_'.date("Y").'.log','a');
		fwrite($fp,date("Y-m-d H:i:s")."\t\n" );
		set_time_limit(0);
		if(date("i")%2 == 0){
			$sql = "SELECT order_id FROM order_over where is_delete=0 ORDER BY add_time ASC LIMIT 100";
		} else {
			$sql = "SELECT order_id FROM order_over where is_delete=0 ORDER BY add_time DESC LIMIT 100";
		}
		$list = $this->_db->fetchCol($sql);
		$cur_time = time();
		$ip = $this->getIP();
		include_once 'application/models/OrderBaseModel.php';
		$ob = new OrderBaseModel();
		$soap = $ob->getSoap(6);
		$vir_soap = $ob->getSoap(4);
		fwrite($fp," listnum:".count($list)."\n" );
		try{
			foreach($list as $order_id){
				//删除该记录
				$this->_db->update("order_over",array('is_delete'=>1),"order_id='$order_id'");
				try{
					$result = $soap->getSheetIdAndSendTime($order_id,$ob->getWsCheck('getSheetIdAndSendTime',6));
				}catch(Exception $e){
					fwrite($fp," e1:".$e->getMessage()."\n" );
				}
				
				if(is_array($result) && $result){
					//对最后一件货发货7天后的订单进行完结：7 * 24 * 3600
					if($cur_time - strtotime($result['send_time']) > 604800) {					
						
						$sql = "SELECT order_id,user_id,user_name,pay_id,price_all,paid_virtual_limit,paid_all,paid_ness,receive_mobile, ";
						$sql .= "paid_status,fromcode,status,check_status,add_time ";
						$sql .= "FROM `order` WHERE order_id='$order_id' FOR UPDATE";
						$order = $this->_db->fetchRow($sql);
						
						//最后对将要完结订单进行条件验证
						if($order['check_status'] != 1 || $order['status'] !=0 || $order['paid_status'] != 1 
						|| $order['paid_all'] != $order['price_all'] || $order['paid_ness'] != 0){
							continue;
						}
						if(!$this->_db->update('order',array('status' => 1),"order_id='$order_id'")){
							continue;
						}
						$data = array ();
						$data ['log_name'] = '订单完结';
						$data ['user_id'] = $order['user_id'];
						$data ['user_name'] = $order['user_name'];
						$data ['user_ip'] = $ip;
						$data ['order_order_id'] = $order_id;
						$data ['log_remark'] = '订单'.$order_id.'自动完结';
						$data ['end'] = '订单完结';
						$data['add_time'] = $cur_time;
						$this->orderLog($data);
						$s = substr($order_id,0,1);
						if($s == 'V' || $s == 'v'){
							$cash = sprintf('%.2f',$this->_db->fetchOne('select sum(goods_price) from order_package_goods where order_id="'.$order_id.'" and goods_activity_id=15191 and goods_status>=0'));
							try{
								if($cash >= 1099){
									$r = $vir_soap->GetorderCoupon('order_code', $order['user_name'], $order['user_id'], $order['receive_mobile'], $ob->getWsCheck('GetorderCoupon',4));
								}else if($cash >= 699){
									$r = $vir_soap->GetorderCoupon('order_rule', $order['user_name'], $order['user_id'], $order['receive_mobile'], $ob->getWsCheck('GetorderCoupon',4));
								}	
							}catch(Exception $e){
								fwrite($fp," e2:".$e->getMessage()."\n" );
							}
						}			
						//订单完结日志
						$fp1 = fopen(ROOT . '/html/weblog/over_order_log_'.date("Y").'.log','a');
						fwrite($fp1,date("Y-m-d H:i:s")."\t".$order_id."\n" );
						fclose($fp1);
					}
				}
			}
		}catch(Exception $e){
			fwrite($fp," e3:".$e->getMessage()."\n" );
		}
		fclose($fp);
		exit;
	}
	/*
	 * 记录订单操作日志及订单支付费用变动日志
	 */
	public function orderLog($data){
		$this->_db->insert('order_log',$data);
		return $this->_db->lastInsertId();
	}
	public function orderLogPay($data){
		$sql = "select end from order_log_pay where order_order_id='".$data['order_order_id']."' order by id desc limit 1";
		$end = $this->_db->fetchOne($sql);
		$end = $end ? $end : 0;
		$data['begin'] = $end;
		$data['end'] = $data['pay_value'] + $end;
		return $this->_db->insert('order_log_pay',$data);
	}
	/**
	 * 插入费用日志表
	 * @param $type int 费用类型：1:运费   2:赔损费  3:货款
	 */
	public function writeLogFee($data){
		return $this->_db->insert('order_log_fee',$data);
	}
	//V开头订单完结30天后自动送积分
	public function sendcreditAction(){
		$ip = $this->getIP();
		//$s = 2592000;//30*24*3600;
		//$e = 2505601;//86399-30*24*3600;
		$sql = "select order_order_id from `order_log` where add_time>=UNIX_TIMESTAMP()-2592000 and add_time<UNIX_TIMESTAMP()+2505601 and log_name='订单完结' and left(order_order_id,1)='V'";
		$row = $this->_db->fetchCol($sql);
		include_once 'application/models/OrderBaseModel.php';
		$obj_base = new OrderBaseModel();
		$soap = $obj_base->getSoap(4);
		foreach($row as $r){
			//判断该订单是否已经赠送过积分，如果没有则赠送，否则不赠送
			try{
				$res = (int)$soap->getcredit($r,$obj_base->getWsCheck('getcredit',4));
			}catch(Exception $e){
				$res = 1;
			}
			if($res<=0){//没有赠送过
				$sql = 'select user_id,user_name,paid_cash,paid_virtual,paid_ness,pay_id from `order` where order_id=\''.$r.'\'';
				//echo $sql."<BR>";
				$order = $this->_db->fetchRow($sql);
				if($order['paid_ness'] <= 0){
					$credit = $order['paid_cash'] + $order['paid_virtual'] + $order['paid_ness'];
					$order['pay_id'] == 1 && $credit = floor($credit/2);//货到付款订单积分减半
					if($credit > 0){
						//调用接口，赠送积分
						try{
							$res = $soap->addcredit($order['user_id'], 'order_over', $credit, $r, $obj_base->getWsCheck('addcredit',4));
						}catch(Exception $e){
							$res = array();
						}
						if(isset($res['status']) && $res['status'] == 1){//记入订单日志
							$data = array ();
							$data ['log_name'] = "赠送积分";
							$data ['user_id'] = $order['user_id'];
							$data ['user_name'] = $order['user_name'];
							$data ['user_ip'] = $ip;
							$data ['order_order_id'] = $r;
							$data ['log_remark'] = "订单".$r."完结30天后赠送积分，赠送积分值：".$credit."<div style='display:none;'>，赠送时货币支付：".$order['paid_cash']."，可提现：".$order['paid_cash']."，还需支付：".$order['paid_ness']."，支付方式ID：".$order['pay_id'].'</div>';
							$data ['begin'] = '';
							$data ['end'] = $credit;
							$data['add_time'] = time();
							$this->orderLog($data);
						}else{//记录错误日志
							$fp = fopen(ROOT . '/html/weblog/over_order_credit_error_'.date("Y").'.log','a');
							$str = date("Y-m-d H:i:s")."\t 完结30天后赠送积分 \t user_id:".$order['user_id']."\t cash:".$order['paid_cash']."\t virtual:".$order['paid_virtual']."\t ness:".$order['paid_ness']."\t rule_name:order_over\t credit:".$credit."\t order_id;".$r."\n";
							fwrite($fp,$str);
							fclose($fp);
						}
					}
				}
			}
		}
		exit;
	}
	/**
	 * 获取IP地址
	 */
	public function getIP() {
		if (isset ( $_SERVER )) {
			if (isset ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				foreach ($arr as $val){
					$val = trim($val);
					if($val != 'unknown'){
						$ip = $val;
						break;
					}
				}
			} elseif (isset ( $_SERVER ["HTTP_CLIENT_IP"] )) {
				$ip = $_SERVER ["HTTP_CLIENT_IP"];
			} elseif (isset ( $_SERVER ["REMOTE_ADDR"] )) {
				$ip = $_SERVER ["REMOTE_ADDR"];
			} else {
				$ip = $_SERVER ["SSH_CLIENT"];
			}
		} else {
			if (getenv ( "HTTP_X_FORWARDED_FOR" )) {
				$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
			} elseif (getenv ( "HTTP_CLIENT_IP" )) {
				$ip = getenv ( "HTTP_CLIENT_IP" );
			} else {
				$ip = getenv ( "REMOTE_ADDR" );
			}
		}
		return $ip;
	}
	
	
	/**
	 * 筛选出需要导了的王府井订单
	 */
	public function checkwfjAction(){
		try {
			$sql = "SELECT a.order_id,b.piece_id,b.goods_name,b.sup_id,b.jiapin_price,a.receive_name,a.receive_area,a.receive_address,a.receive_mobile,a.add_time as order_time,c.add_time as check_time 
					FROM `order` a,order_package_goods b ,order_log c
					WHERE a.order_id = b.order_id AND a.order_id = c.order_order_id 
					AND c.log_name = '订单审核'AND c.`end` = '审核通过' AND c.add_time > UNIX_TIMESTAMP()-86400*3
					AND a.check_status = 1 AND a.`status` =0 
					AND b.goods_status >=0 AND b.storage_id = 0 AND b.sup_id = 920 AND IFNULL(b.send_time,0)=0 
					LIMIT 500";
			$order_info = $this->_db->fetchAll($sql);
//			print_r($order_info);exit;
			if($order_info){
				foreach ($order_info as $val){
					$data = array();
					if(!$this->_db->fetchRow("SELECT piece_id FROM wfj_order WHERE piece_id = ".$val['piece_id'])){
						$data['order_id'] = $val['order_id'];
						$data['piece_id'] = $val['piece_id'];
						$data['goods_name'] = $val['goods_name'];
						$data['sup_id'] = $val['sup_id'];
						$data['jiapin_price'] = $val['jiapin_price'];
						$data['receive_name'] = $val['receive_name'];
						$data['receive_area'] = $val['receive_area'];
						$data['receive_address'] = $val['receive_address'];
						$data['receive_mobile'] = $val['receive_mobile'];
						$data['order_time'] = $val['order_time'];//下单时间
						$data['check_time'] = $val['check_time'];//审核时间
						$data['add_time'] = time();
						$this->_db->insert('wfj_order',$data);
					}
				}
			}
			//查询未与进销存同步的数据
			$sql = "SELECT piece_id FROM wfj_order WHERE sheet_id = '' AND uniqe_code = '' limit 500";
			$piece_array = $this->_db->fetchCol($sql);
//			print_r($piece_array);exit;
			if($piece_array){
				//传给进销存piece_id的一维数组，返回库存详细信息二维数组 sheet_id  uniqe_code等，更新wfj_order表
				try{
					include_once 'application/models/OrderBaseModel.php';
					$obj_base = new OrderBaseModel();
					$soap = $obj_base->getSoap(6);
					$result = $soap->getGoodsCode($piece_array,$obj_base->getWsCheck('getGoodsCode',6));
//					print_r($result);
				}catch(Exception $e){
					echo $e->getMessage();exit;
				}
//				$result = array(//测试
//								array('piece_id'=>'6094422','upc_code'=>'upc_code1','uniqe_code'=>'uniqe_code1','init_price'=>'init_price1','sheet_id'=>'sheet_id1'),
//								array('piece_id'=>'6094377','upc_code'=>'upc_code2','uniqe_code'=>'uniqe_code2','init_price'=>'init_price2','sheet_id'=>'sheet_id2')
//								);
				foreach ($result as $key=>$val){
					$Piece_id = $val['piece_id'];
					$data = array();
					$data['uniqe_code'] = $val['outer_id'].'';
					$data['init_cost'] = $val['init_cost']+0;
					$data['sheet_id'] = $val['sheet_id'].'';
					$this->_db->update('wfj_order',$data,"piece_id = ".$Piece_id);
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();exit;
		}
//		echo 'over1';
		exit;
	}
	
	/**
	 * 导出王府井订单
	 */
	public function exportwfjAction(){
		try {
			$sql = "SELECT piece_id FROM wfj_order
					WHERE sheet_id = '' AND uniqe_code <> '' AND order_time>1376019600 AND sup_id = 920";
			$piece_array = $this->_db->fetchCol($sql);
//			print_r($piece_array );
			if($piece_array){
				//将未生成过发货单的piece_id一维数组传给ERP，让ERP生成发货单，并返回数据
				try{
					include_once 'application/models/OrderBaseModel.php';
					$obj_base = new OrderBaseModel();
					$soap = $obj_base->getSoap(6);
					$back_array = $soap->addOrderToBuy($piece_array,$obj_base->getWsCheck('addOrderToBuy',6));
//					print_r($back_array);
				}catch(Exception $e){
					echo $e->getMessage();exit;
				}
//				$back_array = array('sheet_id'=>'d20130730121314','send_piece'=>array('6094422','6094377'));//测试数据格式
				if(isset($back_array['send_piece']) && $back_array['send_piece']){
					$sheet_id = $back_array['sheet_id'];
					$send_piece = $back_array['send_piece'];
					$where = " sheet_id = '' AND piece_id in (".implode(",",$send_piece).")";
					$sql = "SELECT order_id,piece_id,goods_name,sup_id,uniqe_code,jiapin_price,init_cost,sheet_id,receive_name,receive_area,receive_address,receive_mobile,order_time 
							FROM wfj_order WHERE ".$where;
					$wfj_order = $this->_db->fetchAll($sql);
					if($wfj_order){
						//更新导出去数据表
						$export_time = time();
						$data = array();
						$data['sheet_id'] = $sheet_id;
						$data['export_time'] = $export_time;
						$data['admin_id'] = 0;
						$data['admin_name'] = '系统自动';
						$this->_db->update('wfj_order',$data,$where);
						
						//备份到服务器一份
						$local_path  = 'upload/wfj/'.$sheet_id.'.csv';
						$remote_path = 'jiapin/'.$sheet_id.'.csv';
						$fp = fopen($local_path,'a');
						$title = array('渠道订单号','渠道编号','商品编码','商品名称','数量','渠道售价','零售金额','顾客运费','是否要发票','发票抬头','发票内容','顾客名称','收货区域编码','是否COD','COD款项','顾客收货地区','详细地址','Email','联系电话','下单日期','送货时间');
	//					fputcsv($fp,eval('return '.iconv('utf-8','gbk',var_export($title,true)).';'));//gbk
						fputcsv($fp,$title);//utf-8
						include 'Evil.php';
						$obj_evil = new Evil ();
						foreach ($wfj_order as $row){
							if($row['receive_mobile']){
								$row['receive_mobile'] = $obj_evil->getEvil($row['receive_mobile']);
							}else{
								$row['receive_mobile'] = '';
							}
							$content = array($row['order_id'],C4,$row['uniqe_code'],str_replace(","," ",$row['goods_name']),1,
											 $row['init_cost'],$row['init_cost'],0,N,'','',
											 $row['receive_name'],'','','','北京市-北京市-朝阳区',$row['receive_area'].'-'.str_replace(","," ",$row['receive_address']),
											 '',$row['receive_mobile'],$row['order_time'],'1');
	//						fputcsv($fp,eval('return '.iconv('utf-8','gbk',var_export($content,true)).';'));//gbk
							fputcsv($fp,$content);//utf-8
						}
						fclose($fp);
						try {
							self::ftpUpload($local_path,$remote_path);
						} catch (Exception $e) {
							$msg = $e->getMessage();
							$fp = fopen(ROOT . '/html/weblog/log_wfj_export_order_'.date("Ym").'.log','a');
							fwrite($fp,date("Y-m-d H:i:s")."\t".print_r('上传文件到ftp出现异常:',1)."\n\n\n");
							fclose($fp);
						}
					}else{
						$fp = fopen(ROOT . '/html/weblog/log_wfj_export_order_'.date("Ym").'.log','a');
						fwrite($fp,date("Y-m-d H:i:s")."\t".print_r('暂无王府井可订货订单:',1)."\n\n\n");
						fclose($fp);
					}
				}
			}
		} catch (Exception $e) {
			$msg = $e->getMessage();
			$fp = fopen(ROOT . '/html/weblog/log_wfj_export_order_'.date("Ym").'.log','a');
			fwrite($fp,date("Y-m-d H:i:s")."\t".print_r('王府井订单导出异常:'.$msg,1)."\n\n\n");
			fclose($fp);
		}
//		echo 'over2';
		exit;
	}
	
	
	public function ftpUpload($local_path,$remote_path){
		//连接并登录ftp服务器（匿名）
		$wfj_ip = '116.213.215.11';//192.168.9.11
		$wfj_port = '21';//21
		$wfj_user = 'jiapin';//weifengtest
		$wfj_pass = 'jiapin';//weifengpass
		$conn = @ftp_connect($wfj_ip,$wfj_port) or die("FTP服务器连接失败");
		@ftp_login($conn,$wfj_user,$wfj_pass) or die("FTP服务器登陆失败");
		@ftp_pasv($conn,1); // 打开被动模拟
		
		$jp_path = $local_path; //本地路径
		$path = $wfj_path = $remote_path;//王府井路径
	//	$jp_path = "d:/test.txt"; //本地路径
	//	$path = $wfj_path = "jiapin/".$sheet_id;//王府井路径
			
		//创建目录
		$path_arr  = explode('/',$path);              // 取目录数组
		$file_name = array_pop($path_arr);            // 弹出文件名
		$path_div  = count($path_arr);                // 取层数
		foreach($path_arr as $val) {				  // 创建目录
			if(@ftp_chdir($conn,$val) == FALSE) {
				$tmp = @ftp_mkdir($conn,$val);
				if($tmp == FALSE){
//					echo "目录创建失败,请检查权限及路径是否正确！";
					return 0;
				}
				@ftp_chdir($conn,$val);
			}
		}
		for($i=1;$i<=$path_div;$i++) {                  // 回退到根
			ftp_cdup($conn);
		}
		//上传文件
		$result = @ftp_put($conn,$wfj_path,$jp_path,FTP_BINARY);
		@ftp_close($conn);
		return $result;
	}
	/**
	 * 同步第三方商品扣点信息
	 */
	public function synPointAction (){
		try {
			//获取需要同步的商品款号
			$sql = "SELECT DISTINCT goods_id FROM order_package_goods 
					WHERE add_time > UNIX_TIMESTAMP()-3600*60 AND cut_point=0 AND sup_id >0 limit 500";
			$goods_array = $this->_db->fetchCol($sql);
			if($goods_array){
				//从进销存获取扣点值
				try{
					include_once 'application/models/OrderBaseModel.php';
					$obj_base = new OrderBaseModel();
					$soap = $obj_base->getSoap(6);
					$back_array = $soap->getPriceRatio($goods_array,$obj_base->getWsCheck('getPriceRatio',6));
				}catch(Exception $e){
					echo $e->getMessage();exit;
				}
//				$back_array = array('100199673' => 0.1,'100227529' => 0.2,'100000040' => 0.25);//测试数据
				//更新商品扣点值
				if($back_array){
					foreach ($back_array as $goods_id => $cut_point){
						if($cut_point>0){
							$data = array();
							$data['cut_point'] = $cut_point;
							$where = "add_time > UNIX_TIMESTAMP()-3600*60 and cut_point = 0 and sup_id >0 and goods_id = '$goods_id'";
							$this->_db->update('order_package_goods',$data,$where);
						}
					}
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();exit;
		}	
		exit;
	}
	public function poptestAction(){
		exit;
		try{
			$sql = 'select  order_order_id from order_log where log_name="商品退货" and log_remark like "第三方退货%"';
			$d = $this->_db->fetchCol($sql);
			foreach($d as $dv){
				$sql = 'select o.order_id from `order` o where o.order_id="'.$dv.'" and o.`status`>=0';
				$oid = $this->_db->fetchOne($sql);
				if($oid){
					$sql = 'select goods_status from order_package_goods where order_id="'.$oid.'"';
					$gs = $this->_db->fetchCol($sql);
					$all = count($gs);
					$s = 0;
					foreach($gs as $gv){
						if($gv < 0){
							$s++;		
						}
					}
					if($s >= $all){
						echo $oid.'<BR>';
						$sql = 'update `order` set `status`=-1 where order_id="'.$oid.'"';
						$this->_db->query($sql);
					}
				}
			}	
		}catch(Exception $e){
			echo $e->getMessage();
		}
		exit;
	}
	/**
	 * 结算单数据初始化
	 */
	public function popisAction(){
		exit;
		ob_start();
		$m = $this->_getParam('m',4);
		if($m == 4){
			$mi = '04';
			$me = '05';	
		}else if($m == 5){
			$mi = '05';
			$me = '06';	
		}else if($m == 6){
			$mi = '06';
			$me = '07';	
		}else if($m == 7){
			$mi = '07';
			$me = '08';	
		}else if($m == 8){
			$mi = '08';
			$me = '09';	
		}else if($m == 9){
			$mi = '09';
			$me = '10';	
		}else if($m == 10){
			$mi = '10';
			$me = '11';	
		}else{
			exit;
		}
		$ts = strtotime('2013-'.$mi.'-01 00:00:00');
		//上月的结束时间
		$te = strtotime('2013-'.$me.'-01 00:00:00');
		try{
			self::createpop($ts,$te,'月结');	
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
		echo date('Y-m-d',$ts).'->'.date('Y-m-d',$te).'月结<BR>';
		$ts = strtotime('2013-'.$mi.'-01 00:00:00');
		//上月的结束时间
		$te = strtotime('2013-'.$mi.'-16 00:00:00');
		try{
			self::createpop($ts,$te,'半月结');	
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
		echo date('Y-m-d',$ts).'->'.date('Y-m-d',$te).'半月结<BR>';
		$ts = strtotime('2013-'.$mi.'-16 00:00:00');
		//上月的结束时间
		$te = strtotime('2013-'.$me.'-01 00:00:00');
		try{
			self::createpop($ts,$te,'半月结');	
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
		echo date('Y-m-d',$ts).'->'.date('Y-m-d',$te).'半月结<BR>';
		sleep(5);
		$m++;
		//echo $m;exit;
		echo '<script type="text/javascript">window.location="/newjxc/popis/m/'.$m.'";</script>';
		exit;
	}
	/**
	 * 生成全部的结算单
	 */
	public function allpopAction(){
		$curtime = time();
		$daytime = 86400;//一天时间的秒数24*3600
		list($year,$month,$day) = explode('-',date('Y-m-j',$curtime));
		if($day == '16'){//16号
			//月结
			$last_time = date('Y-m',$curtime - ($day + 1) * $daytime);//上月的时间
			//上月的开始时间
			$ts = strtotime($last_time . '-01 00:00:00');
			//上月的结束时间
			$te = strtotime($year . '-' . $month . '-01 00:00:00');
			echo $last_time . '-01 00:00:00'.'->'.$year . '-' . $month . '-01 00:00:00'.'<BR>';
			try{
				self::createpop($ts,$te,'月结');	
			}catch(Exception $e){
				$p = array('s' => $last_time . '-01 00:00:00','e'=>$year . '-' . $month . '-01 00:00:00','t'=>'月结','e'=>$e->getMessage());
				$fp = fopen(ROOT . '/html/weblog/log_allpop_'.date("Ym").'.log','a');
				$str = date('Y-m-d H:i:s').'->'.print_r($p,1)."\n";
				fwrite($fp,$str);
				fclose($fp);
			}
			//生成16-31日的半月结
			try{
				$ts = strtotime($last_time . '-16 00:00:00');
				$te = strtotime($year . '-' . $month . '-01 00:00:00');
				echo $last_time . '-16 00:00:00'.'->'.$year . '-' . $month . '-01 00:00:00'.'<BR>';
				self::createpop($ts,$te,'半月结');	
			}catch(Exception $e){
				$p = array('s' => $last_time . '-01 00:00:00','e'=>$year . '-' . $month . '-01 00:00:00','t'=>'月结','e'=>$e->getMessage());
				$fp = fopen(ROOT . '/html/weblog/log_allpop_'.date("Ym").'.log','a');
				$str = date('Y-m-d H:i:s').'->'.print_r($p,1)."\n";
				fwrite($fp,$str);
				fclose($fp);
			}
		}
		$days = date('t',$curtime);//当前月的天数
		if($day == $days){//最后一天
			//生成1-15日的半月结
			try{
				$ts = strtotime($year . '-' . $month . '-01 00:00:00');
				//本月的周期结束时间
				$te = strtotime($year . '-' . $month . '-16 00:00:00');
				echo $year . '-' . $month . '-01 00:00:00'.'->'.$year . '-' . $month . '-16 00:00:00'.'<BR>';
				self::createpop($ts,$te,'半月结');	
			}catch(Exception $e){
				$p = array('s' => $last_time . '-01 00:00:00','e'=>$year . '-' . $month . '-01 00:00:00','t'=>'月结','e'=>$e->getMessage());
				$fp = fopen(ROOT . '/html/weblog/log_allpop_'.date("Ym").'.log','a');
				$str = date('Y-m-d H:i:s').'->'.print_r($p,1)."\n";
				fwrite($fp,$str);
				fclose($fp);
			}
		}
		exit;
	}
	/*
	 * 生成月结的pop结算单
	 */
	public function popmonthAction(){
		//计算月结的商品，每月16日1点生成上月的月结结算单，商品发货时间+15天在上月之内的 || 
		//判断是不是16日，如果不是退出月结的计算
		$curtime = time();
		$daytime = 86400;//一天时间的秒数24*3600
		list($year,$month,$day) = explode('-',date('Y-m-j',$curtime));
		if($day == '16'){//16号
			$last_time = date('Y-m',$curtime - ($day + 1) * $daytime);//上月的时间
			//上月的开始时间
			$ts = strtotime($last_time . '-01 00:00:00');
			//上月的结束时间
			$te = strtotime($year . '-' . $month . '-01 00:00:00');
			echo $last_time . '-01 00:00:00'.'->'.$year . '-' . $month . '-01 00:00:00'.'<BR>';
			try{
				self::createpop($ts,$te,'月结');	
			}catch(Exception $e){
				echo $e->getMessage();exit;
			}
			
		}
		exit;
	}
	/*
	 * 生成1-15日的半月结的pop结算单
	 */
	public function popmonthbeforeAction(){
		//固定每月最后一天1点生成本月1日至15日的订单的结算单
		$curtime = time();
		$daytime = 86400;//一天时间的秒数24*3600
		list($year,$month,$day) = explode('-',date('Y-m-j',$curtime));
		$days = date('t',$curtime);//当前月的天数
		if($day == $days){//最后一天
			//本月的周期开始时间
			$ts = strtotime($year . '-' . $month . '-01 00:00:00');
			//本月的周期结束时间
			$te = strtotime($year . '-' . $month . '-16 00:00:00');
			self::createpop($ts,$te,'半月结');
		}
		exit;
	}
	/*
	 * 生成16-31日的半月结的pop结算单
	 */
	public function popmonthafterAction(){
		//固定每月16日1点生成上月16日至30日或31日的订单的结算单
		$curtime = time();
		$daytime = 86400;//一天时间的秒数24*3600
		list($year,$month,$day) = explode('-',date('Y-m-j',$curtime));
		if($day == '16'){//
			$last_time = date('Y-m',$curtime - ($day + 1) * $daytime);//上月的时间
			//上月的开始时间
			$ts = strtotime($last_time . '-16 00:00:00');
			//上月的结束时间
			$te = strtotime($year . '-' . $month . '-01 00:00:00');
			self::createpop($ts,$te,'半月结');
		}
		exit;
	}
	/**
	 * 生成结算单方法：$ts周期开始时间，$te周期结束时间,$jiesuan 结算方式，月结还是半月结
	 */
	public function createpop($ts,$te,$jiesuan = '月结'){
		//echo date('Y-m-d',$ts).'->'.date('Y-m-d',$te).'->'.$jiesuan.'<BR>';
		$curtime = time();
		$last_time_start = $ts;
		$last_time_end = $te;
		//判断这些供货商在这个周期内是否已存在结算单，如果存在则不在生成
		$sql = 'select sup_id from pop_statement where start>= '.$ts.' and end<'.$te.' and status=1';//1为正常状态，0为撤销的
		$exist_supid = $this->_db->fetchCol($sql);
		//调用erp接口获取全部pop供货商信息
		$sup_info = array();
		try{
			include_once 'application/models/OrderBaseModel.php';
			$obj_base = new OrderBaseModel();
			$soap = $obj_base->getSoap(6);
			$sup_info = $soap->getSupList($obj_base->getWsCheck('getSupList',6));
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
		$res = array();//将供货商分组
		foreach($sup_info as $si){
			//if($si['sup_id']!=921){continue;}
			//print_R($si);echo '<BR>';
			if($si['pay_name'] == $jiesuan && !in_array($si['sup_id'],$exist_supid)){
				$res[$si['sup_id']] = array('sup_name' => $si['sup_name'],'bank_code' => $si['sup_card'],'bank_name' => $si['sup_bank'],'order_num' => 0,'order_cash' => 0,'point_cash'=>0,'apply_num'=>0,'apply_cash'=>0,'cle_apply_num'=>0,'cle_apply_cash'=>0);	
			}
		}
		//print_r($res);echo "<BR>";
		$sup_info = null;
		//有效付款订单金额
		$sql = 'select p.order_id,sum(p.goods_price) cash,count(p.piece_id) num,sum(p.goods_price*p.cut_point) cut_point,p.sup_id,p.sup_name from `order` o, order_package_goods p where o.order_id=p.order_id and p.send_time >= ' . $last_time_start;
		$sql .= ' and p.send_time < ' . $last_time_end . ' and p.sell_id > 1 AND p.goods_status >= 0 AND o.check_status = 1 AND o.paid_status = 1 AND (o.pay_id=9 or o.pay_status = 1) ';
		$sql .= ' group by p.order_id';
		//echo  $sql."<BR>";
		$data = $this->_db->fetchAll($sql);
		//print_r($data);echo "<bR>";
		$res_order = array();//存储有效订单的详情
		foreach($data as $d){
			if(isset($res[$d['sup_id']])){
				$res[$d['sup_id']]['order_num'] = $res[$d['sup_id']]['order_num'] + 1;//有效付款订单数量
				//echo  $d['sup_id'].'->'.$res[$d['sup_id']]['order_num'].'<BR>';
				$res[$d['sup_id']]['order_cash'] = $res[$d['sup_id']]['order_cash'] + $d['cash'];//有效付款金额
				$p = sprintf('%.2f',$d['cut_point']);
				$res[$d['sup_id']]['point_cash'] = $res[$d['sup_id']]['point_cash'] + $p;//返点金额
				$res_order[$d['sup_id']][] = array('order_id' => $d['order_id'],'goods_num'=>$d['num'],'cash'=>$d['cash'],'point'=>$p);
			}
		}
		//print_r($res);echo "<BR>";
		//print_R($res_order);echo '<BR>';
		
		//申请退货的金额
		$sql = 'select a.apply_id,a.kuaidi_fee,a.order_id,a.goods_price,a.sup_id,a.order_id,a.piece_id,p.goods_price*p.cut_point as cp from order_user_return_apply  a,order_package_goods p  where a.order_id=p.order_id and a.piece_id=p.piece_id and  a.add_time>=' . $last_time_start . ' and a.add_time <' . $last_time_end.' and a.`status`!=2';
		//echo  $sql."<BR>";
		$data = $this->_db->fetchAll($sql);
		$res_apply = array();//存储申请退货详情
		$apply_order = array();
		foreach($data as $d){
			if(isset($res[$d['sup_id']])){
				if(!in_array($d['order_id'],$apply_order)){
					$res[$d['sup_id']]['apply_num'] = $res[$d['sup_id']]['apply_num']+1;//申请退货订单数量
					$apply_order[] = $d['order_id'];
				}
				$res[$d['sup_id']]['apply_cash'] = $res[$d['sup_id']]['apply_cash'] + $d['goods_price'];//申请退货金额
				$p = sprintf('%.2f',$d['cp']);
				$res[$d['sup_id']]['point_cash'] = $res[$d['sup_id']]['point_cash']-$p;//返点金额
				$res_apply[$d['sup_id']][] = array('point_cash'=>$p,'apply_id' => $d['apply_id'],'order_id' => $d['order_id'],'goods_num'=>1,'cash'=>$d['goods_price'],'kuaidi_fee'=>$d['kuaidi_fee']);
			}
		}
		//撤销的退货金额
		$sql = 'select a.apply_id,a.kuaidi_fee,a.order_id,a.goods_price,a.sup_id,p.goods_price*p.cut_point as cp from order_user_return_apply a,order_package_goods p';
		$sql .= ' where a.order_id=p.order_id and a.piece_id=p.piece_id and a.status < 0 and ';
		$sql .= ' ((a.cle_time>=' . $last_time_start . ' and a.cle_time <' . $last_time_end . ') or (reject_time >= ' . $last_time_start . ' and reject_time < ' . $last_time_end . '))';
		//echo  $sql."<BR>";
		$data = $this->_db->fetchAll($sql);
		$res_cle_apply = array();//存储撤销退货详情
		$apply_order = array();
		foreach($data as $d){
			if(isset($res[$d['sup_id']])){
				if(!in_array($d['order_id'],$apply_order)){
					$res[$d['sup_id']]['cle_apply_num']=$res[$d['sup_id']]['cle_apply_num']+1;//撤销退货订单数量
					$apply_order[] = $d['order_id'];
				}
				$res[$d['sup_id']]['cle_apply_cash'] = $res[$d['sup_id']]['cle_apply_cash']+$d['goods_price'];//撤销退货金额
				$p = sprintf('%.2f',$d['cp']);
				$res[$d['sup_id']]['point_cash'] = $res[$d['sup_id']]['point_cash']+$p;//返点金额
				$res_cle_apply[$d['sup_id']][] = array('point_cash'=>$p,'apply_id' => $d['apply_id'],'order_id' => $d['order_id'],'goods_num'=>1,'cash'=>$d['goods_price'],'kuaidi_fee'=>$d['kuaidi_fee']);
			}
		}
		//开始生产结单
		$data = null;
		if(!$res){
			return false;
		}
		//return false;
		$this->_db->beginTransaction();
		$error = 0;//没有失败的记录
		foreach($res as $supid => $r){
			if($r['order_num']+$r['apply_num']+$r['cle_apply_num']+$r['fees_num'] <=0){
				continue;
			}
			$r['sup_id'] = $supid;
			$r['start'] = $ts;
			$r['end'] = $te - 1;
			$r['type'] = 1;//月结
			$r['order_cash'] = sprintf('%.2f',$r['order_cash']);
			$r['apply_cash'] = sprintf('%.2f',$r['apply_cash']);
			$r['cle_apply_cash'] = sprintf('%.2f',$r['cle_apply_cash']);
			$r['point_cash'] = sprintf('%.2f',$r['point_cash']);
			$r['price_all'] = sprintf('%.2f',$r['order_cash'] - $r['apply_cash'] + $r['cle_apply_cash'] - $r['point_cash']);
			$r['add_time'] = $curtime;
			if($this->_db->insert('pop_statement',$r)){
				$id = $this->_db->lastInsertId();
				$order = isset($res_apply[$supid]) ? $res_apply[$supid] : array();//申请退货详情
				foreach($order as $o){
					$o['sup_id'] = $supid;
					$o['sup_name'] = $r['sup_name'];
					$o['sid'] = $id;
					$o['type'] = 1;
					try{
					if(!$this->_db->insert('pop_statement_apply',$o)){
						$error = 1;
					}	
					}catch(Exception $e){
						$error = 1;
						print_r($o);echo '<BR>';
						echo $e->getMessage().'=2=<BR>';	
					}
				}
				$order = isset($res_order[$supid]) ? $res_order[$supid] : array();
				foreach($order as $o){//有效付款订单详情
					$o['sup_id'] = $supid;
					$o['sup_name'] = $r['sup_name'];
					$o['sid'] = $id;
					try{
					if(!$this->_db->insert('pop_statement_order',$o)){
						$error = 1;
					}	
					}catch(Exception $e){
						$error = 1;
						print_r($o);echo '<BR>';
						echo $e->getMessage().'=1=<BR>';	
					}
				}
				$order = isset($res_cle_apply[$supid]) ? $res_cle_apply[$supid] : array();//撤销退货详情
				foreach($order as $o){
					$o['sup_id'] = $supid;
					$o['sup_name'] = $r['sup_name'];
					$o['sid'] = $id;
					$o['type'] = 2;
					
					try{
					if(!$this->_db->insert('pop_statement_apply',$o)){
						$error = 1;
					}	
					}catch(Exception $e){
						$error = 1;
						print_r($o);echo '<BR>';
						echo $e->getMessage().'=3=<BR>';	
					}
				}
			}else{
				$error = 1;
				break;
			}
		}
		if($error == 1){
			$this->_db->rollback();
		}else{
			$this->_db->commit();
		}
	}

	/**
	 * 双十一定时发送券
	 */
	public function sendcouponAction(){
		$send_array = array();
		$send_date = date("Y-m-d",time()-10*86400);//发货日期
//		$send_date = '2012-10-16';//发货日期
		try {
			$sql = "SELECT DISTINCT t1.user_id,t1.user_name FROM `order` t1,order_package_goods t2
					WHERE t1.order_id = t2.order_id 
					AND t1.add_time > UNIX_TIMESTAMP('2013-10-29 10:00:00')
					AND t2.add_time < UNIX_TIMESTAMP('2013-11-12 00:00:00')
					AND t1.user_id > 2706513
					AND t1.`status` >=0 
					AND t2.send_time > 1 
					AND LEFT(FROM_UNIXTIME(t2.send_time),10) = '$send_date'";
			$new_user = $this->_db->fetchAll($sql);

			$sql = "SELECT DISTINCT t1.user_id,t1.user_name FROM `order` t1,order_package_goods t2
					WHERE t1.order_id = t2.order_id 
					AND t1.add_time > UNIX_TIMESTAMP('2013-10-29 10:00:00')
					AND t2.add_time < UNIX_TIMESTAMP('2013-11-12 00:00:00')
					AND t1.price_goods >= 399
					AND t1.`status` >=0 
					AND t2.send_time > 1 
					AND LEFT(FROM_UNIXTIME(t2.send_time),10) = '$send_date'";
			$old_user = $this->_db->fetchAll($sql);
			
			if($new_user || $old_user){
				$send_array = array('new_user'=>$new_user,'old_user'=>$old_user);
			}
//			print_r($send_array);
			if($send_array){
				//调用接口发券
				try{
					include_once 'application/models/OrderBaseModel.php';
					$obj_base = new OrderBaseModel();
					$soap = $obj_base->getSoap(4);
					$result = $soap->sendcoupon($send_array,$obj_base->getWsCheck('sendcoupon',4));
//					print_r($result);
					$fp = fopen(ROOT . '/html/weblog/log_crontab_'.date("Ym").'.log','a');
					fwrite($fp,date("Y-m-d H:i:s")."\t".print_r('双十一发券成功:',1)."\n\n\n");
					fclose($fp);
				}catch(Exception $e){
					$msg = $e->getMessage();
					$fp = fopen(ROOT . '/html/weblog/log_crontab_'.date("Ym").'.log','a');
					fwrite($fp,date("Y-m-d H:i:s")."\t".print_r('双十一发券调用接口异常:'.$msg,1)."\n\n\n");
					fclose($fp);
				}
			}
		} catch (Exception $e) {
			$msg = $e->getMessage();
			$fp = fopen(ROOT . '/html/weblog/log_crontab_'.date("Ym").'.log','a');
			fwrite($fp,date("Y-m-d H:i:s")."\t".print_r('双十一发券异常:'.$msg,1)."\n\n\n");
			fclose($fp);
		}
//		echo 'complete';
		exit;
	}
}
