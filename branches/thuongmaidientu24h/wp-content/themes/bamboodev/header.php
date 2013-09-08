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
<meta name="google-site-verification" content="v_yvNPfmyZ-HMB_tb3APh9NFG6ARN5Ko9Z8jQsC2Oe4" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/thuongmaidientu24h.ico" /> 
<?php wp_head();?>
<title><?php
	global $page, $paged, $title;
	$page = getParam('page',1);
	if(isset($title)) {
		echo " | $title";
	} else {
		if ( is_home() || is_front_page() ) {
			bloginfo( 'name' );
			if ( $paged >= 2 || $page >= 2 ) {
				echo ' | Trang ' . $page;
			} else {
				echo " | Trang chủ";
			}
		} else {
			wp_title( '|', true);
			if ( $paged >= 2 || $page >= 2 )
				echo ' | Trang ' . $page;
		}
	}
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>
<body>
<div id="header">
	<a href="<?php echo DOMAIN?>" id="logo"></a>
	<h1>Thương Mại Điện Tử 24h</h1>
	<a href="<?php echo DOMAIN.'tags-cloud'?>" id="btTags"></a>
</div>
<div id="content">