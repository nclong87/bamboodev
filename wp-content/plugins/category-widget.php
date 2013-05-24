<?php
/*
Plugin Name: Danh Mục Sản Phẩm Widget
Plugin URI: http://bamboodev.us/
Description: Hiển thị list danh mục loại sản phẩm
Author: LongNC
Version: 1
Author URI: http://bamboodev.us/
*/
 
 
class DanhMucSanPhamWidget extends WP_Widget
{
  function DanhMucSanPhamWidget()
  {
    $widget_ops = array('classname' => 'DanhMucSanPhamWidget', 'description' => 'Hiển thị list danh mục loại sản phẩm' );
    $this->WP_Widget('DanhMucSanPhamWidget', 'Danh Mục Sản Phẩm', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
	global $cat;
    extract($args, EXTR_SKIP);
 
    //echo $before_widget;
    //$title = isset($instance['title'])?$instance['title']:'Sản Phẩm';
    /* if (!empty($title))
      echo $before_title . $title . $after_title;; */
	
    // WIDGET CODE GOES HERE
	$args = array(
		'hide_empty' => 0,
		'exclude' => 1,
	);
	//$items = wp_get_nav_menu_items('product_menu');  
	$items = wp_get_nav_menu_items('product_menu'); 
	$array = array();
	foreach($items as $item) {
		$item->childs = array();
		$array[$item->ID] = $item;
	}
	foreach($array as $id => $item) {
		if($item->menu_item_parent != 0) {
			if(isset($array[$item->menu_item_parent])) {
				$array[$item->menu_item_parent]->childs[$id] = $item;
			}
			unset($array[$id]);
		}
	}
	//$categories = get_categories($args);
	?>
	<div class="small_box_container">
		<div class="header-menu"></div>
		<h3 class="title-menu" style="height: 45px;"><a href="<?php bloginfo('siteurl'); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/images/sanpham.jpg" height="40"/></a></h3>
		<div class="content">
		<ul id="menu">
			<li>
			<?php
			$i = !empty($cat)?$cat->category_parent:4;
			foreach($array as $item) {
				if(empty($item->childs)) {
					echo '<a href="'.$item->url.'">'.$item->title.'</a>';
				} else {
					if($i == $item->object_id) {
						echo '<a href="#" class="ico_posts active">'.$item->title.'</a>';
					} else {
						echo '<a href="#" class="ico_posts">'.$item->title.'</a>';
					}
					echo '<ul>';
					foreach($item->childs as $child) {
						echo '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';
					}
					echo '</ul>';
				}
			}
			?>
			</li>
		</ul>
	<?php
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("DanhMucSanPhamWidget");') );?>