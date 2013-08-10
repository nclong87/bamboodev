<?php/** * The Template for displaying all single posts. * * @package BamBooDev * @author LongNC * @since Shop 1.0 */global $cat;$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );$categories = get_the_category($post->ID);$cat = null;$titleLink = '';foreach($categories as $category) {	if($category->category_parent == 66) continue;	$cat = $category;	$titleLink = '<a style="color:#fff" href="'.get_category_link( $cat->term_id ).'">'.$cat->name.'</a>';	break;}get_header(); ?>	<?php get_sidebar('left'); ?><div style="float: right; width: 776px;"><?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?><div style="float: left; width: 100%; margin-top: 5px;">	<div id="center">		<h3><?php echo $titleLink?></h3>		<h1><?php echo $post->post_title?></h1>		<?php 		$rs = getSize($image,400,400);		$width = $rs[0];		$height = $rs[1];		$padding = 0;		if($rs[2] == 1 && $width < 250) { //them padding cho hinh co chieu rong nho			$padding = floor((400 - $width)/2);		}		$descWidth = 590 - ($width + $padding * 2 + 35);		if($padding != 0) {			$padding = $padding.'px';		} else {			$padding = '';		}		$price = get_post_meta($post->ID,'catalog_product_price',true);		?>		<img width="<?php echo $width?>" height="<?php echo $height?>" src="<?php echo $image[0]?>" alt="<?php echo $post->post_title?>"  style="float: left; margin-left: 3px; margin-top: 5px; max-width: 400px; border: 1px solid gray; padding: 2px <?php echo $padding?>;"/>		<div id="more_detail" style="width:<?php echo $descWidth?>px">			<div style="display: block; float: left; margin-top: 8px; text-align: left; width: 100%;">Giá :				<?php if(!empty($price)) {					?>					<span class="font-normal color-red"><?php echo format_number($price); ?></span> <b class="vnd">VNĐ</b>					<?php				} else {					?>					<span class="font-normal color-red">Call</span>					<?php				}				?>			</div>		<?php		$content = $post->post_content;		$content = apply_filters('the_content', $content);		$content = str_replace(']]>', ']]&gt;', $content);		echo $content;		?>		</div>		<?php require_once 'includes/similar_products.php';?>	</div>	<?php get_sidebar('right'); ?></div></div><?php get_footer(); ?>