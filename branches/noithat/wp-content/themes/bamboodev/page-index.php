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
<div style="float: right; width: 770px;">
<div id="slider">
	<img src="<?php echo get_template_directory_uri(); ?>/images/slider.jpg"/>
</div>
<div style="float: left; width: 100%; margin-top: 5px;">
	<div id="center">
		<h3>Sản Phẩm Mới</h3>
		<?php
		$posts = query_posts( array('post_type' => 'product', 'orderby' => 'created', 'order' => 'DESC','posts_per_page' => 30,'paged' => 1));
		foreach($posts as $post) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
		?>
		<a class="product_item" href="<?php echo get_permalink( $post->ID );?>" title="<?php echo $post->post_title?>">
			<span class="title"><?php echo $post->post_title?></span>
			<img width="150" height="150" alt="<?php echo $post->post_title?>" src="<?php echo $image[0]?>">
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
