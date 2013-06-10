<?php	 	
/*
Template Name: Confirm
*/
	try {
		global $wpdb; 
		$params = getParams();
		Utils::log('payment::confirm_BEGIN',$params);
		$customer_id = Utils::getCustomerId();
		if(empty($customer_id)) {
			
		}
		$time = Utils::getCurrentDateSQL();
		$action = getParam('action');
		$orderId = getParam('order_id');
		if(empty($action) || empty($orderId)) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM);
		if($action == 'cancel') {
			$wpdb->update('orders', array('status' => -1,'time_update' => $time), array('id' => $orderId));
			wp_redirect(DOMAIN.'/payment');
			exit;
		} else if ($action =='approve') {
			$payerId = getParam('PayerID');
			Utils::log('payment::confirm_getOrder_BEGIN',array('order_id' => $orderId));
			$query = $wpdb->prepare('SELECT * FROM `orders` WHERE `status` = 1 AND `id` = %d',$orderId);
			$order = $wpdb->get_row($query,ARRAY_A);
			if($order == null) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM_ORDER_NULL);
			Utils::log('payment::confirm_getOrder_END',$order);
			if($order['customer_id'] != $customer_id) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM);
			require_once 'includes/paypal.php';
			$token = Paypal::getToken();
			Utils::log('payment::confirm_approvePayment_BEGIN',array('token' => $token,'paypal_id' => $order['paypal_id'],'payerId' => $payerId));
			$response = Paypal::approvePayment($token,$order['paypal_id'], $payerId);
			Utils::log('payment::confirm_approvePayment_END',$response);
			if(!isset($response['id'])) throw new Exception('payment::confirm', ERR_PAYMENT_CONFIRM);
			$wpdb->update('orders', array('status' => 2,'time_update' => $time), array('id' => $orderId));
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
					$wpdb->insert('sales', $saleData);
				}
			}
			
			//debug($response);
		}
	} catch (Exception $e) {
		Utils::logException($e);
		exit;
		//wp_redirect('/');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Order success</title>
<link href="<?php echo get_template_directory_uri(); ?>/payment.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<center>
<div id="main">
	Pay success!
</div>
</center>
</body>
</html>