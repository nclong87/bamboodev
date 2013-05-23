<?php/** * The Template for displaying all single posts. * * @package BamBooDev * @author LongNC * @since Shop 1.0 */global $cat;$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );$categories = get_the_category($post->ID);$cat = null;$titleLink = '';if(isset($categories[0])) {	$cat = $categories[0];	$titleLink = '<a style="color:#fff" href="'.get_category_link( $cat->term_id ).'">'.$cat->name.'</a>';}get_header(); ?>	<?php get_sidebar('left'); ?><div style="float: right; width: 776px;"><?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?><div style="float: left; width: 100%; margin-top: 5px;">	<div id="center">		<h3><?php echo $post->post_title?></h3>		<h1><?php echo $post->post_title?></h1>		<?php 		$sSize = '';	   $width = $image[1];	   $height = $image[2];	   if($width > 600 || $height > 600){			$width = 500;			$height = 500;		}	   if($width/$height < 0.7) {	   $pad1 = ($height-$width)/4;		$sSize = 'padding-right: '.$pad1.'px; padding-left: '.$pad1.'px;' ;	   } else if ($width/$height > 1.3) {		$pad2 = ($width - $height)/4;		$sSize = 'padding-top: '.$pad2.'px; padding-bottom: '.$pad2.'px;' ;	   }		?>		<img width="<?php echo $width?>" height="<?php echo $height?>"  src="<?php echo $image[0]?>" alt="<?php echo $post->post_title?>"  style="float: left; margin-left: 3px; margin-top: 5px; max-width: 400px; border: 1px solid gray; padding: 2px; <?php echo $sSize;?>"/>		<div style="display: block; float: left; margin-top: 8px; text-align: left;margin-left: 10px;">Giá : <span class="font-normal color-red"><?php echo format_number(get_post_meta($post->ID,'catalog_product_price',true)); ?></span> <b class="vnd">đ</b></div>		<div id="more_detail" style="width:25%">		<?php		$content = $post->post_content;		$content = apply_filters('the_content', $content);		$content = str_replace(']]>', ']]&gt;', $content);		echo $content;		?>		</div>		<?php require_once 'includes/similar_products.php';?>	</div>	<?php get_sidebar('right'); ?></div></div><?php get_footer(); ?>