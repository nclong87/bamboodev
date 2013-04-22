<?php
/**
* Template Name: Article
* Description: A Page Template that adds a sidebar to pages
*
* @package BamBooDev
* @author LongNC
* @since Shop 1.0
*/
get_header();
$pagenum = isset($_GET['page'])?$_GET['page']:1;
?>	
<?php get_sidebar('left'); ?>
<div style="float: right; width: 770px;">
<div id="slider">
	<img src="<?php echo get_template_directory_uri(); ?>/images/slider.jpg"/>
</div>
<div style="float: left; width: 100%; margin-top: 5px;">
	<div id="center">
		<h3>Tin tức</h3>
		<?php
		$posts = query_posts( array('post_type' => 'article', 'orderby' => 'created', 'order' => 'DESC','posts_per_page' => 30,'paged' => $pagenum));
		$htmlPaging =  paginate_links( array(
			'total' => $wp_query->max_num_pages,
			'base' => @add_query_arg('page','%#%'),
			'format' => '',
			'current' => $pagenum
		) );
		foreach($posts as $post) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
		?>
		<div class="article_item">
			<img width="125" height="125" alt="<?php echo $post->post_title?>" src="<?php echo $image[0]?>">
			<a title="<?php echo $post->post_title?>" class="title" href="<?php echo get_permalink( $post->ID );?>"><?php echo $post->post_title?></a>
		</div>
		<?php
		}
		wp_reset_query();
		?>
		<div class="paging"><?php echo $htmlPaging;?></div>
	</div>
	<?php get_sidebar('right'); ?>
</div>
</div>
<?php get_footer(); ?>
