<?php	 	
/*
Template Name: Paypal
*/
	try {
		global $wpdb; 
		$params = getParams();
		$cart = getCart();
		
		/*
		 * Step 1 : Save customer info
		 */
		
		
		/*
		 * Step 2 : Save order info
		 */
		$total = 0;
		foreach ($cart as $product_id => $item) {
			$total+= $item['total'];
		}
		$customer_id = ''; //get customer_id in step 1
		$shippingInfo = array(
			'firstname' => '',
			'lastname' => '',
			'address' => '',
			'city' => '',
			'state_id' => '',
			'country_id' => '',
			'zip_code' => '',
			'phone' => '',
			'email' => '',
			'notes' => ''
		); //shipping info in step 1
		
		$time = Utils::getCurrentDateSQL();
		$orderData = array(
			'customer_id' => $customer_id,
			'total' => $total,
			'shipping_fee' => PAYMENT_SHIPPING_FEE,
			'time_create' => $time,
			'time_update' => $time
		);
		$orderData = array_merge($orderData,$shippingInfo);
		Utils::log('payment::createOrder_BEGIN',$orderData);
		$wpdb->insert('orders', $orderData);
		$orderId = $wpdb->insert_id;
		Utils::log('payment::createOrder_END','OrderId ='.$orderId);
		if($orderId=='') throw new Exception('payment::createOrder', ERR_PAYMENT_CREATE_ORDER);
		
		//insert order_products
		foreach ($cart as $product_id => $item) {
			$data = array(
				'order_id' => $orderId,
				'product_id' => $product_id,
				'price' => $item['price'],
				'quantity' => $item['quantity']
			);
			Utils::log('payment::addOrderProducts',$data);
			$wpdb->insert('order_products', $data);
		}
		
		/*
		 * Step 3 : Call Paypal api to process payment
		 */
		require_once 'includes/paypal.php';
		$token = Paypal::getToken();
		$logInfo = array(
			'token' => $token,
			'cart' => $cart
		);
		Utils::log('payment::createPayment_BEGIN',$logInfo);
		$response = Paypal::createPayment($token, $cart);
		Utils::log('payment::createPayment_END',$response);
		if(!isset($response['id'])) throw new Exception('payment::createPayment', ERR_PAYMENT_PAYPAL_CREATE_ORDER);
		$rs = $wpdb->update('orders', array('paypal_id' => $response['id']), array('id' => $orderId));
		if(empty($rs)) throw new Exception('payment::createPayment', ERR_PAYMENT);
		
		debug($response);
		
	} catch (Exception $e) {
		Utils::logException($e);
		exit;
		//wp_redirect('/');
	}
	

?>