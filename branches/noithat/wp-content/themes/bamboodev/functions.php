<?phpdefine('POSTS_PER_PAGE',30);
 
require_once(TEMPLATEPATH . "/meta-box.php");
require_once(TEMPLATEPATH . "/meta-boxes.php");
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true);
	add_image_size('thumbnail', 150, 150, true);		if ( function_exists( 'add_image_size' ) ) { 		add_image_size('large', 500, 9999);	}		//add_image_size('medium', 500, 9999);

}

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'wpdocs' ),
        'collection' => __( 'Collection Navigation', 'wpdocs' ),
        'lookbooks' => __( 'Look Books Navigation', 'wpdocs' ),
	) );
function my_init() {	if (!is_admin()) {		wp_enqueue_script('jquery');	}	register_sidebar( 		array(		'name' => 'Left sidebar',		'id' => 'left',		'before_widget' => '<div class="small_box_container">',		'after_widget' => '</div><div class="footer"></div></div>',		'before_title' => '<div class="header"></div><h3 class="title">',		'after_title' => '</h3><div class="content">',		)	);	register_sidebar( 		array(		'name' => 'Right sidebar',		'id' => 'right',		'before_widget' => '<div class="small_box_container">',		'after_widget' => '</div><div class="footer"></div></div>',		'before_title' => '<div class="header"></div><h3 class="title">',		'after_title' => '</h3><div class="content">',		)	);}add_action('init', 'my_init');/** *    init_sessions() * *    @uses session_id() *    @uses session_start() */function init_sessions() {    if (!session_id()) {        session_start();		if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();    }}add_action('init', 'init_sessions');/**************************** * Let's add the custom post type ****************************/add_action('init', 'catalog_init');function catalog_init(){  $labels = array(    'name' => _x('Products', 'post type general name'),    'singular_name' => _x('Product', 'post type singular name'),    'add_new' => _x('Add New', 'product'),    'add_new_item' => __('Add New Product'),    'edit_item' => __('Edit Product'),    'new_item' => __('New Product'),    'view_item' => __('View Product'),    'search_items' => __('Search Products'),    'not_found' =>  __('No products found'),    'not_found_in_trash' => __('No products found in Trash'),    'parent_item_colon' => '',    'menu_name' => 'Products'  );  $args = array(    'labels' => $labels,    'public' => true,    'publicly_queryable' => true,    'show_ui' => true,    'show_in_menu' => true,    'query_var' => true,    'rewrite' => array('slug'=>'product','with_front'=>false),    'capability_type' => 'post',    'has_archive' => true,    'hierarchical' => false,    'menu_position' => null,    'supports' => array('title','editor','thumbnail','excerpt')  );  register_post_type('product',$args);}/********************************************************************************** * The custom meta boxes to handle paypal button and product price *********************************************************************************/add_action('add_meta_boxes', 'catalog_add_custom_box');function catalog_add_custom_box() {    add_meta_box('catalog_priceid', 'Product Price', 'catalog_price_box', 'product','side');}function catalog_price_box() {    $price = 0;    if ( isset($_REQUEST['post']) ) {        $price = get_post_meta((int)$_REQUEST['post'],'catalog_product_price',true);        //$price = (float) $price;    }?><label for="catalog_product_price">Product Price</label><input id="catalog_product_price" class="widefat" name="catalog_product_price" value="<?php echo $price; ?>" type="text"><?php}add_action( 'init', 'enable_category_taxonomy_for_products', 500 );function enable_category_taxonomy_for_products() {    register_taxonomy_for_object_type('category','product');}add_action('save_post','catalog_save_meta');function catalog_save_meta($postID) {    if ( is_admin() ) {		global $wpdb;        if ( isset($_POST['catalog_product_price']) ) {            update_post_meta($postID,'catalog_product_price',                                $_POST['catalog_product_price']);        }		if($_POST['post_type'] == 'product') {			$myrows = $wpdb->get_results( "SELECT * FROM `data_index` WHERE `post_id` = {$postID}" );			if(empty($myrows)) {				$wpdb->insert( 					'data_index', 					array( 						'post_id' => $postID, 						'text_search' => $_POST['post_title'],						'category_id' => json_encode( $_POST['post_category'])					)				);			} else {				$wpdb->update( 					'data_index', 					array( 						'text_search' => $_POST['post_title'],						'category_id' => json_encode( $_POST['post_category'])					),					array( 'post_id' => $postID )				);			}		}    }}function genKey($email=null) {	if($email == null) {		$key = '';		list($usec, $sec) = explode(' ', microtime());		mt_srand((float) $sec + ((float) $usec * 100000));		$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));		for($i=0; $i<32; $i++)		{			$key .= $inputs{mt_rand(0,61)};		}		return $key;	} else {		return hash('ripemd160', $email);	}	//return ord($email)  & 0x1FE;}function format_number($num){	return number_format($num,0,',','.');}class Cache {	public static function get($fileName) {		$fileName = ROOT.DS.'tmp'.DS.'cache'.DS.$fileName;		if (file_exists($fileName)) {			$handle = fopen($fileName, 'rb');			$variable = fread($handle, filesize($fileName));			fclose($handle);			return unserialize($variable);		} else {			return null;		}	}		public static function set($fileName,$variable) {		$fileName = ROOT.DS.'tmp'.DS.'cache'.DS.$fileName;		$handle = fopen($fileName, 'w');		fwrite($handle, serialize($variable));		fclose($handle);	}}function mam_posts_where ($where) {   global $mam_global_where;   if ($mam_global_where) $where .= " $mam_global_where";   return $where;}function SearchFilter($query) {    // If 's' request variable is set but empty    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){        $query->is_search = true;        $query->is_home = false;    }    return $query;}add_filter('pre_get_posts','SearchFilter');
?>