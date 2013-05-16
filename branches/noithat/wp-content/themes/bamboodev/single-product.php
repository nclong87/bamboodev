<?php/** * The Template for displaying all single posts. * * @package BamBooDev * @author LongNC * @since Shop 1.0 */$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );get_header(); ?>	<?php get_sidebar('left'); ?><div style="float: right; width: 776px;"><?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?><div style="float: left; width: 100%; margin-top: 5px;">	<div id="center">		<h3><?php echo $post->post_title?></h3>		<img width="<?php echo $image[1]?>" height="<?php echo $image[2]?>" style="float: left; margin-left: 3px; margin-top: 5px; max-width: 500px;" src="<?php echo $image[0]?>" alt="<?php echo $post->post_title?>"/>		<div style="display: block; width: 100%; float: left; margin-top: 8px; text-align: left;">Giá : <span class="font-normal color-red"><?php echo format_number(get_post_meta($post->ID,'catalog_product_price',true)); ?></span> <b class="vnd">đ</b></div>		<div id="more_detail">		<?php		$content = $post->post_content;		$content = apply_filters('the_content', $content);		$content = str_replace(']]>', ']]&gt;', $content);		echo $content;		?>		</div>	</div>	<?php get_sidebar('right'); ?></div></div><?php get_footer(); ?>