<?php
/*
Template Name: Ajax
*/
	$action = $_REQUEST['action'];
	if($action == null)
		die();
	switch($action) {
		case 'contact':
			$content = $_POST['content'];
			if(empty($content))
				die("ERROR");
			$subject = '[Shop Vải] Email liên hệ từ khách hàng';
			$admin_email = get_settings('admin_email');
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			if(wp_mail( $admin_email, $subject, $content, $headers, null )==false)
				die("ERROR");
			die("OK");
			break;
		case 'add-to-cart' :
			$product_id = $_GET['product_id'];
			$cart = $_SESSION['cart'];
			if(!isset($cart))
				$cart = array();
			if(isset($cart[$product_id]))
				die('EXIST');
			$cart[$product_id] = $product_id;
			$_SESSION['cart'] = $cart;
			die('OK');
			break;
		case 'remove-out-cart' :
			$product_id = $_GET['product_id'];
			$cart = $_SESSION['cart'];
			if(!isset($cart) || count($cart) == 0)
				die('EMPTY');
			if(!isset($cart[$product_id]))
				die('NOPRODUCT');
			unset($cart[$product_id]);
			$_SESSION['cart'] = $cart;
			echo 'OK';
			break;
		case 'test' :
			$_SESSION['cart'] = array();
			//print_r($cart);
			break;
		default:
			break;
	};

?>