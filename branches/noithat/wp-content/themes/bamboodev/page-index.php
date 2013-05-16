<?php
/**
* Template Name: Index
* Description: A Page Template that adds a sidebar to pages
*
* @package BamBooDev
* @author LongNC
* @since Shop 1.0
*/
get_header();
$pagenum = isset($_GET['pagenum'])?$_GET['pagenum']:1;
?>	
<?php get_sidebar('left'); ?>
<div style="float: right; width: 776px;">
<!--<div id="slider">
	<img src="<?php //echo get_template_directory_uri(); ?>/images/slider.jpg"/>
</div>-->
<?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
<div style="float: left; width: 100%; margin-top: 5px;">
	<div id="center">
		<h3 style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/NTVP.jpg'); color: transparent;">Nội Thất Văn Phòng</h3>
		<?php
		
		//$posts = query_posts( array('post_type' => 'product', 'orderby' => 'created', 'order' => 'DESC','posts_per_page' => 30,'paged' => 1));
		$categories = get_categories( array('orderby' => 'created', 'order' => 'ASC', 'parent'=> 4));
		foreach($categories as $category) {
		$posts = query_posts( array('post_type' => 'product', 'orderby' => 'name', 'order' => 'ASC', 'category_name' => $category->slug));
		
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($posts[0]->ID),'thumbnail', 'single-post-thumbnail' );
		?>
		<a class="product_item" href="<?php echo get_category_link( $category->term_id );?>" title="<?php echo $category->name?>">
			<span class="title"><?php echo $category->name?></span>
			<!--<img width="150" height="150" alt="<?php //echo $category->name?>" src="<?php //echo $image[0]?>">-->
			<div class="wraptocenter">
				<img width="<?php echo $image[1]?>" height="<?php echo $image[2]?>" alt="<?php echo $category->name?>" src="<?php echo $image[0]?>">
			</div>
		</a>
		<?php
		}
		wp_reset_query();
		?>
	</div>
	<?php get_sidebar('right'); ?>
</div>
</div>
<?php get_footer(); ?>
