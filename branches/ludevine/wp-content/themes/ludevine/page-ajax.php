<?php	 	
/*
Template Name: Ajax
*/
	$action = $_REQUEST['action'];
	if($action == null)
		die();
	try {
		$success = array('code' => 1,'data' => '');
		switch ($action) {
			case 'debug':
				debug($_SESSION['address_id']);
				//require_once 'includes/order.php';
				//$sale = Order::findSaleById('0BB8241620788551A');
				require_once 'includes/paypal.php';
				$token = Paypal::getToken();
				$response = Paypal::queryPayment($token, 'PAY-8WW46939R6382820LKG3CNJY');
				//$response = Paypal::refundSale($token,$sale,'40');
				debug($response);
				global $wpdb;
				/*$query = $wpdb->prepare('SELECT * FROM `orders` WHERE `status` = 0 AND `id` = %d',13);
				$order = $wpdb->get_row($query);
				check($order);
				debug($order);*/
				/*$data = array('test' => 'Heeello3');
				$wpdb->_insert_replace_helper('test', $data);
				$id = $wpdb->insert_id;
				echo $id.' ';
				//$wpdb->update('test', $data, array('id' => 1));
				exit;
				$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
				require_once 'includes/paypal.php';
				require_once 'includes/paypal.php';
				$token = Paypal::getToken();
				debug($token);
				//$response = Paypal::createPayment($token, $cart);
				//$response = Paypal::queryPayment($token, 'PAY-7PS78383X4832934PKG2MIMI');
				$response = Paypal::approvePayment($token,'PAY-0MG16962XC201362KKG3BEWI', 'NEU8N24L9535J');
				debug($response);*/
				break;
			case 'cart-change-quantity':
				$product_id = getParam('product_id');
				$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
				if(!isset($cart[$product_id])) throw new Exception('cart-change-quantity-1', 0);
				$quantity = parseInt(getParam('quantity',1));
				if($quantity == 0) throw new Exception('cart-change-quantity-2', 0);
				$cart[$product_id]['quantity'] = $quantity;
				$cart[$product_id]['total'] = $quantity * $cart[$product_id]['price'];
				$_SESSION['cart'] = $cart;
				$success['data'] = DOMAIN.'/checkout';
				break;
			case 'cart-remove':
				$product_id = getParam('product_id');
				$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
				unset($cart[$product_id]);
				$_SESSION['cart'] = $cart;
				$success['data'] = DOMAIN.'/checkout';
				break;
			case 'add-to-cart':
				$product_id = getParam('product_id');
				$metal = getParam('metal');
				if(empty($product_id)) throw new Exception('add-to-cart-1', 0);
				$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
				$product = get_post($product_id);
				//$metainfo = get_post_custom($product_id);
				$thumbnail_id = get_post_thumbnail_id($product_id);
				$image = wp_get_attachment_image_src( $thumbnail_id,'thumbnail', 'single-post-thumbnail' );
				$prices = get_post_meta($product_id,'product_metal_price',true);
				if(empty($prices)) throw new Exception('add-to-cart-2', 0);
				if(!isset($prices[$metal])) throw new Exception('add-to-cart-3', 0);
				$price = $prices[$metal];
				$quantity = parseInt(getParam('quantity',1));
				if($quantity == 0) throw new Exception('add-to-cart-4', 0);
				$cart[$product_id] = array(
					'product_id' => $product_id,
					'post_title' => $product->post_title,
					'url' => get_permalink($product_id),
					'image' => $image,
					'price' => $price,
					'metal' => $metal,
					'size' => getParam('size'),
					'quantity' => $quantity,
					'total' => $quantity * $price
				);
				//$cart[] = $product_id;
				$_SESSION['cart'] = $cart;
				$success['data'] = DOMAIN.'/checkout';
				break;
			case 'sign-up':
				require_once 'includes/validate.php';
				require 'includes/order.php';
				$bArress = getArray($_POST['address_book']['B']);
				$email = getParam('email');
				if(empty($email) || !is_email($email)) throw new Exception('Please check your email address.', ERR_VALIDATE);
				if(Validate::validateAddress($bArress) == false) throw new Exception('Customer info is invalid', ERR_VALIDATE_ADDRESS);
				$createAccount = getParam('create_account');
				if($createAccount == 'Y') {
					$password = getParam('passwd1');
					if(empty($password)) throw new Exception('Password is not empty', ERR_VALIDATE);
					$validateRs = Validate::validateEmail($email);
					if($validateRs != '') throw new Exception($validateRs, ERR_VALIDATE_EMAIL);
				}
				$ship2diff = getParam('ship2diff');
				if($ship2diff == 'Y') {
					$sArress = getArray($_POST['address_book']['S']);
					if(Validate::validateAddress($sArress) == false) throw new Exception('Shipping info is invalid', ERR_VALIDATE_ADDRESS);
				}
				$bArress['email'] = $email;
				$addressId = Order::addAddress($bArress,true);
				if($createAccount == 'Y') {
					$data = array(
						'email' => $email,
						'password' => $password,
						'address_id' => $addressId
					);
					$customerId = Order::addCustomer($data,true);
				}
				if($ship2diff == 'Y') {
					if(isset($customerId)) $sArress['customer_id'] = $customerId;
					$sArress['email'] = $email;
					$addressId = Order::addAddress($sArress,true);
				}
				$_SESSION['address_id'] = $addressId;
				break;
			default:
				break;
		}
		echo json_encode($success);
	} catch (Exception $e) {
		echo json_encode(array(
			'code' => $e->getCode(),
			'data' => $e->getMessage()
		));
	}
	

?>