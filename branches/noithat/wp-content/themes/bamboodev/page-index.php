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
$posts = query_posts( array('post_type' => 'product', 'orderby' => 'created', 'order' => 'ASC','posts_per_page' => POSTS_PER_PAGE,'paged' => $pagenum));
?>	
<?php get_sidebar('left'); ?>
<div id="right_col">
	
</div>
<?php get_footer(); ?>
<script>
$(document).ready(function(){
	var flag = parseInt($("#btPrev").attr("data-ref"))>0?null:true;
	$("#btPrev").button({
		disabled : flag,
		text: false,
		icons: {
			primary: "ui-icon-triangle-1-w"
		}
	});
	$("#btNext").button({
		disabled : <?php echo count($posts)<POSTS_PER_PAGE?'true':'null'?>,
		text: false,
		icons: {
			primary: "ui-icon-triangle-1-e"
		}
	});
});
</script>