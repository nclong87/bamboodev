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
				/*global $wpdb;
				$data = array('test' => 'Heeello3');
				$wpdb->_insert_replace_helper('test', $data);
				$id = $wpdb->insert_id;
				echo $id.' ';
				//$wpdb->update('test', $data, array('id' => 1));
				exit;
				$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
				require_once 'includes/paypal.php';*/
				require_once 'includes/paypal.php';
				$token = Paypal::getToken();
				//$response = Paypal::createPayment($token, $cart);
				$response = Paypal::queryPayment($token, 'PAY-7PS78383X4832934PKG2MIMI');
				//$response = Paypal::approvePayment($token,'PAY-7PS78383X4832934PKG2MIMI', 'NEU8N24L9535J');
				debug($response);
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
			default:
				break;
		}
		echo json_encode($success);
	} catch (Exception $e) {
		echo json_encode(array(
			'code' => 0,
			'data' => $e->getMessage()
		));
	}
	

?>