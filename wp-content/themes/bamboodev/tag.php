<?php
/**
 * The Template for displaying all tags.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
global $wp_query;
get_header();
$tag = get_queried_object(); 
?>
<p id="breadcrumbs">
	<a href="<?php echo DOMAIN?>">Trang chủ</a> » 
	<strong><?php echo $tag->name?></strong>
</p>
<?php
if($page == 0) $page = 1;
$posts = query_posts( array(
	'post_type' => 'post', 
	'orderby' => 'created', 
	'order' => 'DESC',
	'posts_per_page' => POSTS_PER_PAGE,
	'paged' => $page,
	'tax_query' => array( 
		array(
			'taxonomy' => 'post_tag',
			'terms'    => array($tag->term_id),
		) 
	)
));
$max_num_pages = $wp_query->max_num_pages;
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
				$arr_tags[] = '<a href="'.DOMAIN.'tag/'.$tag->slug.'">'.$tag->name.'</a>';
			}
			if(!empty($arr_tags)) echo join(', ',$arr_tags);
			?>
		</div>
	</div>
	<span class="time"><?php echo format_date($post->post_modified,'d/m/Y')?></span>
</div>
<?php
if($i < $len-1) echo '<div class="break_list"></div>';
}
?>	
<div id="paging">
	<center>
	<div style="width: 300px">
	<?php
	if($page > 1) echo '<a class="btPrev" href="?page='.($page-1).'"></a>';
	if($page < $max_num_pages) echo '<a class="btNext" href="?page='.($page+1).'"></a>';
	?>
	</div>
	</center>
</div>
<?php get_footer(); ?>