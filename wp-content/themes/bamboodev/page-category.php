<?php
/*
Template Name: Category
*/
global $title;
$catSlug = isset($_GET['cat'])?$_GET['cat']:'vai-ren-thuong';
$pagenum = isset($_GET['pagenum'])?$_GET['pagenum']:1;
$cat = get_category_by_slug($catSlug);
$title = $cat->cat_name;
get_header();
$posts = query_posts( array('post_type' => 'product','cat' => $cat->cat_ID, 'orderby' => 'created', 'order' => 'ASC','posts_per_page' => POSTS_PER_PAGE,'paged' => $pagenum));
?>	
<?php get_sidebar('left'); ?>
<div id="right_col">
	<div style="width: 100%" class="small_box_container">
		<div class="header" style="text-align:left"><?php echo $title?></div>
		<div class="content">
			<?php
			foreach($posts as $post) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
				?>
				<div class="vip_sanpham_container" title="<?php echo $post->post_title?>">
					<center>
					<a class="wraptocenter sanpham_image_thumb" href="<?php the_permalink();?>">
						<span></span>
						<img alt="<?php echo $post->post_title?>" src="<?php echo $image[0]?>">
					</a>
					</center>
					<a href="<?php the_permalink();?>" class="title"><?php echo $post->post_title?></a>
					<span class="price"><span class="font-normal color-red"><?php echo format_number(get_post_meta($post->ID,'catalog_product_price',true)); ?></span> <b class="vnd font11">đ</b></span>
					<span></span>
				</div>
				<?php
			}
			?>
		</div>
		<div id="paging">
			<a href="?cat=<?php echo $catSlug.'&pagenum='.($pagenum-1)?>"><button id="btPrev" data-ref="<?php echo $pagenum-1?>">Trang trước</button></a>
			<a href="?cat=<?php echo $catSlug.'&pagenum='.($pagenum+1)?>"><button id="btNext" data-ref="<?php echo $pagenum+1?>">Trang sau</button></a>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<script>
$(document).ready(function(){
	$("#cssmenu li#<?php echo $catSlug?>").addClass('active');
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