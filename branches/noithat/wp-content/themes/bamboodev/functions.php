<?php
 
require_once(TEMPLATEPATH . "/meta-box.php");
require_once(TEMPLATEPATH . "/meta-boxes.php");

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 99999, 150);
	add_image_size('thumbnail', 99999, 150);

}

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'wpdocs' ),
        'collection' => __( 'Collection Navigation', 'wpdocs' ),
        'lookbooks' => __( 'Look Books Navigation', 'wpdocs' ),
	) );
function my_init() {
?>