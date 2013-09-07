<?php
/*
Template Name: Ajax
*/
	$action = $_REQUEST['action'];
	if($action == null)
		die();
	switch($action) {
		case 'test' :
			echo '<pre><br/>';
			/* $array = query_posts( array('post_type' => 'post', 'orderby' => 'created', 'order' => 'DESC','posts_per_page' => POSTS_PER_PAGE)); */
			
			$tags = wp_get_post_tags(7);
			$array = array();
			foreach($tags as $tag) {
				$array[]= $tag->term_id;
			}
			$array = query_posts(array(
				'orderby' => 'rand',
				'post__not_in' => array(7),
				'posts_per_page' => 5,
				'tax_query' => array( array(
				  'taxonomy' => 'post_tag',
				  'terms'    => $array,
				) )
			));
			print_r($array);
			exit;
			$args=array(
				'tag__in' => array($array),
				'post__not_in' => array(7),
				'posts_per_page'=>5,
				'caller_get_posts'=>1
				);
			$my_query = new WP_Query($args);
			debug($my_query);
			exit;
			global $title,$wpdb;
			$mam_global_where = "AND $wpdb->posts.post_title LIKE '%VP DT - 01%'";
			$array = query_posts( array('post_type' => 'product', 'orderby' => 'created', 'order' => 'ASC','posts_per_page' => POSTS_PER_PAGE));
			/* $args = array(
				'type'                     => 'product',
				'hierarchical'             => 1,
				'parent'                   => 0,
				'order'                    => 'DESC',
				'hide_empty' => 0,
				'taxonomy'                 => 'category',
				'pad_counts'               => false 
			);
			$array = get_categories($args); */
			/*$array = array();
			foreach($items as $item) {
				$array[$item->cat_ID] = $item;
			}
			foreach($array as $cat_ID => $item) {
				if($item->parent != 0) {
					if(isset($array[$item->parent])) {
						$array[$item->parent]->childs[$cat_ID] = $item;
					}
					unset($array[$cat_ID]);
				}
			} */
			/* $items = wp_get_nav_menu_items('product_menu'); 
			$array = array();
			foreach($items as $item) {
				$array[$item->ID] = $item;
			}
			foreach($array as $id => $item) {
				if($item->menu_item_parent != 0) {
					if(isset($array[$item->menu_item_parent])) {
						$array[$item->menu_item_parent]->childs[$id] = $item;
					}
					unset($array[$id]);
				}
			} */
			/* $array = query_posts( array('post_type' => 'product', 'orderby' => 'created', 'order' => 'DESC','posts_per_page' => 3,'paged' => 1));
			Cache::set( 'test', $array);
			die('OK');  */
			print_r($array);die;
			break;
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