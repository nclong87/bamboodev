﻿<?php/** * The Template for displaying all single posts. * * @package BamBooDev * @author LongNC * @since Shop 1.0 */global $wp_query,$title,$cat;$pagenum = isset($_GET['page'])?$_GET['page']:1;//$cat = get_category_by_slug($catSlug);$cat = get_queried_object();$title = $cat->cat_name;get_header();?>	<?php get_sidebar('left'); ?><div style="float: right; width: 776px;"><?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?><div style="float: left; width: 100%; margin-top: 5px;">	<div id="center">		<h3><?php echo $title?></h3>		<?php		$posts = query_posts( array('post_type' => 'product','cat' => $cat->cat_ID, 'orderby' => 'created', 'order' => 'ASC','posts_per_page' => POSTS_PER_PAGE,'paged' => $pagenum));		$htmlPaging =  paginate_links( array(			'total' => $wp_query->max_num_pages,			'base' => @add_query_arg('page','%#%'),			'format' => '',			'current' => $pagenum		) );		foreach($posts as $post) {			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );			$sSize = '';			$width = $image[1];			$height = $image[2];			if($width/$height < 1.3) {				$sSize = ' height = "113" ';			} else {				$sSize = ' width = "150" ';			}		?>		<a class="product_item" href="<?php echo get_permalink( $post->ID );?>" title="<?php echo $post->post_title?>">			<span class="title"><?php echo $post->post_title?></span>			<!--<img width="150" height="150" alt="<?php //echo $category->name?>" src="<?php //echo $image[0]?>">-->			<div class="wraptocenter">				<img <?php echo $sSize?> alt="<?php echo $post->post_title?>" src="<?php echo $image[0]?>">			</div>			<div class="detail-link">Chi tiết</div>		</a>		<?php		}		wp_reset_query();		?>		<div class="paging"><?php echo $htmlPaging;?></div>	</div>	<?php get_sidebar('right'); ?></div></div><?php get_footer(); ?>