<?php
/*
Plugin Name: Sản Phẩm Widget
Plugin URI: http://bamboodev.us/
Description: Hiển thị list sản phẩm
Author: LongNC
Version: 1
Author URI: http://bamboodev.us/
*/
 
 
class ProductsWidget extends WP_Widget
{
  function ProductsWidget()
  {
    $widget_ops = array('classname' => 'ProductsWidget', 'description' => 'Sản phẩm' );
    $this->WP_Widget('ProductsWidget', 'Sản phẩm', $widget_ops);
  }
 
  function form($instance)
  {
	$args = array(
		'type'                     => 'product',
		'hierarchical'             => 1,
		'parent'                   => 0,
		'order'                    => 'DESC',
		'hide_empty' => 0,
		'taxonomy'                 => 'category',
		'pad_counts'               => false 
	);
	$array = get_categories($args);
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
    $category = $instance['category'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
   <p><label for="<?php echo $this->get_field_id('category'); ?>">Danh mục: 
	<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
		<option value=""></option>
	<?php
	foreach($array as $item) {
		if($category == $item->cat_ID) {
			echo '<option selected value="'.$item->cat_ID.'">'.$item->cat_name.'</option>';
		} else {
			echo '<option value="'.$item->cat_ID.'">'.$item->cat_name.'</option>';
		}
	}
	?>
	</select>
   </label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['category'] = $new_instance['category'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
	$category = $instance['category'];
	if(empty($category)) return;
    echo $before_widget;
    $title = isset($instance['title'])?$instance['title']:'Sản Phẩm';
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
	$posts = query_posts( array('post_type' => 'product','cat' => $category, 'orderby' => 'created', 'order' => 'ASC','posts_per_page' => 15));
	//$items = wp_get_nav_menu_items('product_menu');  
	//$categories = get_categories($args);
	foreach($posts as $post) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
	?>
	<div>
	<a class="product_item" style="width:175px" href="<?php echo get_permalink( $post->ID );?>" title="<?php echo $post->post_title?>">
		<span class="title"><?php echo $post->post_title?></span>
		<img width="150" height="150" alt="<?php echo $post->post_title?>" src="<?php echo $image[0]?>">
	</a>
	</div>
	<?php
	}
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ProductsWidget");') );?>