<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html class="ie" id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="ie" id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie" id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="ie" id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/ntch.ico" /> 
<?php wp_head();?>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $title;
	//wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	
	if(isset($title)) {
		echo " | $title";
	} else {
		// Add the blog description for the home/front page.
		if ( is_home() || is_front_page() ) {
			echo " | Trang chủ";
		} else {
			wp_title( '|', true);
		}
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	}
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css?v=2405" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.core.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.button.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.placeholder.min.js" type="text/javascript"></script>
</head>

<body class="gradients">
	<div id="page">
		<center>
		<div id="main">
			<div id="header">
				<a href="<?php bloginfo('siteurl'); ?>/" id="logo"></a>
				<div id="navigation">
					<div class="menu"><a href="<?php bloginfo('siteurl'); ?>/">Trang chủ</a></div>
					<div class="menu"><a href="<?php echo get_permalink(43); ?>">Giới thiệu</a></div>
					<div class="menu" style="width: 80px"><a href="<?php echo get_permalink(60); ?>">Khuyến Mãi</a></div>
					<div class="menu" style="width: 60px"><a href="<?php echo get_permalink(52); ?>">Liên hệ</a></div>
				</div>
				<span id="slogan"><marquee behavior="scroll" scrollamount="5" direction="left" id="slogan marquee">Sản xuất, cung cấp các sản phẩm chuyên ngành nội thất. Vui lòng liên hệ số điện thoại 0918 695 839.</marquee></span>
			</div>
			<div id="content">