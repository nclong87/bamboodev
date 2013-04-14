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
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
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
		<div id="header">
			<div id="menu_bar"> 
				
			</div>
			<center>
			<div style="width: 978px; height: 120px; position: relative;">
				<a id="cart" href="<?php bloginfo('siteurl'); ?>/gio-hang" title="Xem sản phẩm đã đặt mua">
					<span class="icon"><?php echo count($_SESSION['cart'])?></span>
					<span class="title">Giỏ hàng</span>
				</a>
				<div class="search-main">  
					<div class="search-filed"> 
						<form id="quickSearch" class="nav-searchbar-inner" name="site-search" method="get" action="<?php bloginfo('siteurl'); ?>/search-result">
							<div class="nav-searchfield-outer nav-sprite">
							  <div class="nav-searchfield-inner nav-sprite">
								<div class="nav-searchfield-width">
								  <div style="padding-left: 5px;" id="nav-iss-attach">
									<input type="text" style="padding-right: 0px; " name="keyword" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'Vui lòng nhập từ khóa tìm kiếm'?>" class="search_default" onfocus="if(this.value=='Vui lòng nhập từ khóa tìm kiếm'){this.value='';$(this).removeClass('search_default')}" onblur="if(this.value==''){this.value='Vui lòng nhập từ khóa tìm kiếm';$(this).addClass('search_default')}" title="Search For" id="twotabsearchtextbox">
								  </div>
								</div>
							  </div>
							</div>
							<div class="nav-submit-button nav-sprite">
							  <input id="btSearch" type="submit" title="" class="nav-submit-input" value="">
							</div>
						</form> 
						<script>
						$(document).ready(function(){
							$('#quickSearch').submit( function() {
								var keyword = $("#twotabsearchtextbox",this).val();
								if( keyword == '' || keyword=='Vui lòng nhập từ khóa tìm kiếm') {
									alert("Vui lòng nhập từ khóa tìm kiếm!");
									return false;
								}
								return true;
							});
						});
						</script>						
					</div>   
				</div>
				<a class="logo" style="text-decoration: none; text-align: center;" href="<?php bloginfo('siteurl'); ?>"/><img style="border: medium none; " src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="logo"/>
				<span class="slogan">Shop online</span></a>
				<div class="tbl-right-box box-176 padd-bg-hotline ui-corner-tbl-top"><span class="ui-hotline-2"></span><p class="padd-hotline-2"><span>hotline <b class="color-oran"></b></span> </p><h4 class="num-hot">0932 337 487</h4><p></p></div>
			</div>
			</center>
		</div>
		<center>
		<div id="main">