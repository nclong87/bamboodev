<?php
/*
Template Name: Process
*/
	$action = $_REQUEST['action'];
	if($action == null)
		die();
	$return_url = DOMAIN.getParam('ref','/');
	$err_url = DOMAIN;
	try {
		switch ($action) {
			case 'logout':
				unset($_SESSION['customer']);
				unset($_SESSION['shippingAddr']);
				unset($_SESSION['billAddr']);
				wp_redirect($return_url);exit;
				break;
			case 'paypal_cancel' :
				$err_url = DOMAIN.'/payment?';
				global $wpdb; 
				$params = getParams();
				Utils::log('payment::confirm_BEGIN',$params);
				$time = Utils::getCurrentDateSQL();
				$action = getParam('action');
				$orderId = getParam('order_id');
				if(empty($action) || empty($orderId)) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM);
				Utils::log('payment::confirm_getOrder_BEGIN',array('order_id' => $orderId));
				$query = $wpdb->prepare('SELECT * FROM `orders` WHERE `id` = %d',$orderId);
				$order = $wpdb->get_row($query,ARRAY_A);
				if($order == null) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_ORDER_NULL);
				Utils::log('payment::confirm_getOrder_END',$order);
				$orderToken = getParam('token');
				if($order['token'] != $orderToken) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_TOKEN);
				if($order['status'] == -1 ||$order['status'] == 2) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_ALREADY);
				$wpdb->update('orders', array('status' => -1,'time_update' => $time), array('id' => $orderId));
				wp_redirect(DOMAIN.'/payment');
				exit;
				break;
			case 'paypal_approve' :
				$err_url = DOMAIN.'/payment?';
				global $wpdb; 
				$params = getParams();
				Utils::log('payment::confirm_BEGIN',$params);
				$time = Utils::getCurrentDateSQL();
				$action = getParam('action');
				$orderId = getParam('order_id');
				if(empty($action) || empty($orderId)) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM);
				Utils::log('payment::confirm_getOrder_BEGIN',array('order_id' => $orderId));
				$query = $wpdb->prepare('SELECT * FROM `orders` WHERE `id` = %d',$orderId);
				$order = $wpdb->get_row($query,ARRAY_A);
				if($order == null) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_ORDER_NULL);
				Utils::log('payment::confirm_getOrder_END',$order);
				$orderToken = getParam('token');
				if($order['token'] != $orderToken) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_TOKEN);
				if($order['status'] == -1 ||$order['status'] == 2) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_ALREADY);
				$payerId = getParam('PayerID');
				require 'includes/paypal.php';
				$token = Paypal::getToken();
				Utils::log('payment::confirm_approvePayment_BEGIN',array('token' => $token,'paypal_id' => $order['paypal_id'],'payerId' => $payerId));
				$response = Paypal::approvePayment($token,$order['paypal_id'], $payerId);
				Utils::log('payment::confirm_approvePayment_END',$response);
				if(!isset($response['id'])) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM);
				$payer_email = $response['payer']['payer_info']['email'];
				$payer_firstname = $response['payer']['payer_info']['first_name'];
				$payer_last_name = $response['payer']['payer_info']['last_name'];
				$refund_link = '';
				foreach ($response['transactions'] as $transaction) {
					foreach ($transaction['related_resources'] as $related_resource) {
						$saleData = array(
							'id' => $related_resource['sale']['id'],
							'state' => $related_resource['sale']['state'],
							'parent_payment' => $related_resource['sale']['parent_payment'],
							'self_link' => $related_resource['sale']['links'][0]['href'],
							'refund_link' => $related_resource['sale']['links'][1]['href'],
							'parent_payment_link' => $related_resource['sale']['links'][2]['href'],
							'order_id' => $orderId,
							'payer_id' => $payerId,
							'payer_email' => $response['payer']['payer_info']['email'],
							'payer_firstname' => $response['payer']['payer_info']['first_name'],
							'payer_lastname' => $response['payer']['payer_info']['last_name'],
							'time_create' => $time,
							'time_update' => $time,
							'status' => 1
						);
						$refund_link = $related_resource['sale']['links'][1]['href'];
						$wpdb->insert('sales', $saleData);
					}
				}
				$wpdb->update('orders', array(
					'status' => 2,
					'time_update' => $time,
					'refund_link' => $refund_link,
					'payer_id' => $payerId,
					'payer_email' => $payer_email,
					'payer_firstname' => $payer_firstname,
					'payer_lastname' => $payer_last_name
				), array('id' => $orderId));
				
				Utils::log('payment::confirm_sendMail_BEGIN',array('order_id' => $orderId));
				require 'includes/order.php';
				$rs = Order::sendMail($orderId);
				Utils::log('payment::confirm_sendMail_END',array('$rs' => $rs));
				wp_redirect(DOMAIN.'/success?order_id='.$orderId);
				exit;
				break;
			default:
				break;
		}
	} catch (Exception $e) {
		if(WP_DEBUG) {
			echo '<pre>';
			echo $e->getMessage().' at line '.$e->getLine().'<br>';
			echo $e->getTraceAsString();
		}
		Utils::logException($e);
		wp_redirect($return_url.'&error_code='.$e->getCode());
	}
	

?>