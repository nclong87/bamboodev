<?php
/**
* Template Name: Page Content
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
		<h3><?php echo $post->post_title?></h3>
		<div id="more_detail">
		<?php
		$content = $post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		echo $content;
		?>
		</div>
	</div>
	<?php get_sidebar('right'); ?>
</div>
</div>
<?php get_footer(); ?>
