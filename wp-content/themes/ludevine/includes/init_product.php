<?php
/****************************
 * Let's add the custom post type
 ****************************/
add_action('init', 'catalog_init');
function catalog_init()
{
  $labels = array(
    'name' => _x('Products', 'post type general name'),
    'singular_name' => _x('Product', 'post type singular name'),
    'add_new' => _x('Add New', 'product'),
    'add_new_item' => __('Add New Product'),
    'edit_item' => __('Edit Product'),
    'new_item' => __('New Product'),
    'view_item' => __('View Product'),
    'search_items' => __('Search Products'),
    'not_found' =>  __('No products found'),
    'not_found_in_trash' => __('No products found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Products'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug'=>'product','with_front'=>false),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail')
  );
  register_post_type('product',$args);
  register_taxonomy(
		'size',
		'product',
		array(
			'label' => __( 'Size' ),
			'rewrite' => array( 'slug' => 'size' ),
			'hierarchical' => true
		)
	);
}
/**********************************************************************************
 * The custom meta boxes to handle paypal button and product price
 *********************************************************************************/
add_action('add_meta_boxes', 'catalog_add_custom_box');
function catalog_add_custom_box() {
    add_meta_box('catalog_priceid', 'Product Prices', 'catalog_price_box', 'product','side');
}

function catalog_price_box() {
    $price = 0;
    if ( isset($_REQUEST['post']) ) {
        $prices = get_post_meta((int)$_REQUEST['post'],'product_metal_price',true);
		if($prices == null) {
			$prices = array(
				'Bronze' => '',
				'Sterling Silver' => '',
				'Solid 14K Gold' => '',
				'Solid 14k Gold with Diamonds' => '',
				'Solid 18k Gold' => ''
			);
		}
        //$price = (float) $price;
    }
	foreach($prices as $metal => $price) {
	?>
	<label style="float: left;"><?php echo $metal?> : </label><input class="widefat" name="product_metal_price[<?php echo $metal?>]" value="<?php echo $price?>" type="text" style="float: left; width: 150px; margin-bottom: 8px;">
	<br clear="all">
	<?php
	}
?>
<?php
}

add_action( 'init', 'enable_category_taxonomy_for_products', 500 );
function enable_category_taxonomy_for_products() {
    register_taxonomy_for_object_type('category','product');
}

add_action('save_post','catalog_save_meta');
function catalog_save_meta($postID) {
    if ( is_admin() ) {
		global $wpdb;
        if ( isset($_POST['product_metal_price']) ) {
            update_post_meta($postID,'product_metal_price',
                                $_POST['product_metal_price']);
        }
		if($_POST['post_type'] == 'product') {
			/* $myrows = $wpdb->get_results( "SELECT * FROM `data_index` WHERE `post_id` = {$postID}" );
			if(empty($myrows)) {
				$wpdb->insert( 
					'data_index', 
					array( 
						'post_id' => $postID, 
						'text_search' => $_POST['post_title'],
						'category_id' => json_encode( $_POST['post_category'])
					)
				);
			} else {
				$wpdb->update( 
					'data_index', 
					array( 
						'text_search' => $_POST['post_title'],
						'category_id' => json_encode( $_POST['post_category'])
					),
					array( 'post_id' => $postID )
				);
			} */
		}
    }
}
?>