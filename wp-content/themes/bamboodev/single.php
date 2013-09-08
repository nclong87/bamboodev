<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header(); 
$tags = wp_get_post_tags($post->ID);
$arr_tags = array();
foreach($tags as $tag) {
	$arr_tags[] = getTagLink($tag);
}
?>
<p id="breadcrumbs">
	<a href="<?php echo DOMAIN?>">Trang chủ</a> » 
	<?php if(isset($arr_tags[0])) echo $arr_tags[0]?> » 
	<strong><?php echo $post->post_title?></strong>
</p>
<div class="list" style="width: 98%; padding-left: 10px;">
	<h2 class="title"><?php echo $post->post_title?></h2>
	<div class="content">
		<?php
		$content = $post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		echo $content;
		?>
	</div>
</div>
<h2 class="page_title">Bài viết cùng thể loại</h2>
<?php
$tags = wp_get_post_tags($post->ID);
$array = array();
foreach($tags as $tag) {
	$array[]= $tag->term_id;
}
$posts = query_posts(array(
	'orderby' => 'rand',
	'post__not_in' => array($post->ID),
	'posts_per_page' => 5,
	'tax_query' => array( array(
	  'taxonomy' => 'post_tag',
	  'terms'    => $array,
	) )
));
$len = count($posts);
foreach($posts as $i => $post) {
$permance_link = get_permalink($post->ID);
$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
?>
<div class="list">
	<div class="top">
		<a class="title" href="<?php echo $permance_link?>" title="<?php echo $post->post_title?>"><?php echo $post->post_title?></a>
	</div>
	<div class="short_content">
		<a href="<?php echo $permance_link?>"><img alt="<?php echo $post->post_title?>" class="f_image" src="<?php echo $image[0]?>" width="175"/></a>
		<?php echo get_description($post->post_content)?>...
		<div class="info">
			Tags :
			<?php
			$tags = wp_get_post_tags($post->ID);
			$arr_tags = array();
			foreach($tags as $tag) {
				$arr_tags[] = getTagLink($tag);
			}
			if(!empty($arr_tags)) echo join(', ',$arr_tags);
			?>
		</div>
	</div>
	<span class="time"><?php echo format_date($post->post_modified,'Y/m/d')?></span>
</div>
<?php
if($i < $len-1) echo '<div class="break_list"></div>';
}
?>
<?php get_footer(); ?>