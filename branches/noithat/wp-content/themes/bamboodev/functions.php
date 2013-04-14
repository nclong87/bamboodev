<?php
 
require_once(TEMPLATEPATH . "/meta-box.php");
require_once(TEMPLATEPATH . "/meta-boxes.php");

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true);
	add_image_size('thumbnail', 150, 150, true);
	add_image_size('medium', 500, 9999, true);
	add_image_size('large', 1024, 500, true);
}

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'wpdocs' ),
        'collection' => __( 'Collection Navigation', 'wpdocs' ),
        'lookbooks' => __( 'Look Books Navigation', 'wpdocs' ),
	) );
function my_init() {
?>