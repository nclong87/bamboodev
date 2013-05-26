<?php	 	
/*
Template Name: Ajax
*/
	$action = $_REQUEST['action'];
	if($action == null)
		die();
	switch ($action) {
		case 'debug':
			debug($_SESSION['cart']);
			break;
		case 'add-to-cart':
			$product_id = getParam('product_id');
			if(empty($product_id)) exit;
			$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
			$product = get_post($product_id);
			//$metainfo = get_post_custom($product_id);
			$thumbnail_id = get_post_thumbnail_id($product_id);
			$image = wp_get_attachment_image_src( $thumbnail_id,'thumbnail', 'single-post-thumbnail' );
			//debug($image);
			$price = get_post_meta($product_id,'catalog_product_price',true);
			$quantity = parseInt(getParam('quantity',1));
			if($quantity == 0) exit;
			$cart[$product_id] = array(
				'product_id' => $product_id,
				'post_title' => $product->post_title,
				'url' => get_permalink($product_id),
				'image' => $image,
				'price' => $price,
				'size' => getParam('size'),
				'quantity' => $quantity,
				'total' => $quantity * $price
			);
			//$cart[] = $product_id;
			$_SESSION['cart'] = $cart;
			die('OK');
			break;
		case 'remove-from-cart':
			$product_id = getParam('product_id');
			$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
			unset($cart[$product_id]);
			$_SESSION['cart'] = $cart;
			die('OK');
			break;
		default:
			break;
	}

?>