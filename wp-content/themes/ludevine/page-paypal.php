<?php	 	
/*
Template Name: Paypal
*/
	try {
		global $wpdb; 
		$cart = getCart();
		
		/*
		 * Step 1 : Check customer info
		 */
		if(!isset($_SESSION['shippingAddr']) || empty($_SESSION['shippingAddr'])) throw new Exception('payment::checkShippingInfo', ERR_PAYMENT_SHIPPING_INFO);
		$address = $_SESSION['shippingAddr'];
		$customer_id = 0; 
		if(!isset($_SESSION['customer'])){
			$customer_id = $_SESSION['customer']['id'];
		}
		/*
		 * Step 2 : Save order info
		 */
		$total = 0;
		foreach ($cart as $product_id => $item) {
			$total+= $item['total'];
		}
		$shippingFee = PAYMENT_SHIPPING_FEE;
		if($address['country'] != 'United States') {
			$shippingFee = 0;
		}
		
		$time = Utils::getCurrentDateSQL();
		$orderData = array(
			'customer_id' => $customer_id,
			'total' => $total,
			'shipping_fee' => $shippingFee,
			'address_id' => $address['id'],
			'notes' => getParam('notes'),
			'time_create' => $time,
			'time_update' => $time
		);
		Utils::log('payment::createOrder_BEGIN',$orderData);
		$wpdb->insert('orders', $orderData);
		$orderId = $wpdb->insert_id;
		Utils::log('payment::createOrder_END',array('order_id' => $orderId));
		if($orderId=='') throw new Exception('payment::createOrder', ERR_PAYMENT_CREATE_ORDER);
		
		//insert order_products
		foreach ($cart as $product_id => $item) {
			$data = array(
				'order_id' => $orderId,
				'product_id' => $product_id,
				'price' => $item['price'],
				'quantity' => $item['quantity'],
				'metal' => $item['metal'],
				'size' => $item['size']
			);
			Utils::log('payment::addOrderProducts',$data);
			$wpdb->insert('order_products', $data);
		}
		
		/*
		 * Step 3 : Call Paypal api to process payment
		 */
		if($shippingFee == 0) { //international order
			//send order detail to seller
			
		} else { //usa order
			require_once 'includes/paypal.php';
			$token = Paypal::getToken();
			$logInfo = array(
				'token' => $token,
				'cart' => $cart
			);
			Utils::log('payment::createPayment_BEGIN',$logInfo);
			$response = Paypal::createPayment($token, $cart,$orderId);
			Utils::log('payment::createPayment_END',$response);
			if(!isset($response['id'])) throw new Exception('payment::createPayment', ERR_PAYMENT_PAYPAL_CREATE_ORDER);
			$link = getValue($response['links'][1], 'href');
			$info = getParamsUrl($link);
			$token = getValue($info, 'token');
			if(empty($token)) throw new Exception('payment::createPayment', ERR_PAYMENT_ORDER_TOKEN);
			$rs = $wpdb->update('orders', array('paypal_id' => $response['id'],'status' => 1,'time_update' => $time,'token' => $token), array('id' => $orderId));
			if(empty($rs)) throw new Exception('payment::createPayment', ERR_PAYMENT);
			foreach ($response['links'] as $link) {
				if($link['rel'] == 'approval_url') wp_redirect($link['href']);
			}
		}
		exit;
	} catch (Exception $e) {
		Utils::logException($e);
		exit;
		//wp_redirect('/');
	}
	

?>