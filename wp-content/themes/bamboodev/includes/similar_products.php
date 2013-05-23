<?php
if($cat != null) {
	$args = array(
	   'post_type' => 'product',
	   'numberposts' => 9,
	   'post_status' => null,
	   'orderby' => 'rand',
	   'cat' => $cat->cat_ID,
	   'exclude' => $post->ID,
	);
	$similars = get_posts( $args );
}
?>
<div id="similar_products">
	<h3>Các sản phẩm khác</h3>
<?php
foreach($similars as $item) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID),'thumbnail', 'single-post-thumbnail' );
	$sSize = '';
	$width = $image[1];
	$height = $image[2];
	if($width/$height < 1.3) {
		$sSize = ' height = "113" ';
	} else {
		$sSize = ' width = "150" ';
	}
?>
<a class="product_item" href="<?php echo get_permalink( $item->ID );?>" title="<?php echo $item->post_title?>">
	<span class="title"><?php echo $item->post_title?></span>
	<div class="wraptocenter">
		<img <?php echo $sSize?> alt="<?php echo $item->post_title?>" src="<?php echo $image[0]?>">
	</div>
	<div class="detail-link">Chi tiết</div>
</a>
<?php
}
?>
</div>