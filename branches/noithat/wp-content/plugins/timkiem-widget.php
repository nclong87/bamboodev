<?php
/*
Plugin Name: Tìm Kiếm Sản Phẩm Widget
Plugin URI: http://bamboodev.us/
Description: Tìm kiếm sản phẩm theo từ khóa
Author: LongNC
Version: 1
Author URI: http://bamboodev.us/
*/
 
 
class SearchSPWidget extends WP_Widget
{
  function SearchSPWidget()
  {
    $widget_ops = array('classname' => 'SearchSPWidget', 'description' => 'Tìm kiếm sản phẩm theo từ khóa' );
    $this->WP_Widget('SearchSPWidget', 'Tìm kiếm sản phẩm', $widget_ops);
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
    extract($args, EXTR_SKIP);
	global $keyword;
	if(!isset($keyword)) $keyword = '';
	?>
	<form id="searchform" method="get" style="float: left; margin-bottom: 20px;" role="search" action="<?php bloginfo('siteurl'); ?>/">
	<input onfocus="$(this).select()" type="text" name="s" value="<?php echo $keyword?>" id="s" placeholder="Search" style="width: 170px; height: 25px;"/>
	</form>
	<?php
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SearchSPWidget");') );?>