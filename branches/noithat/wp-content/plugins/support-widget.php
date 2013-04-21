<?php
/*
Plugin Name: Hỗ trợ khách hàng Widget
Plugin URI: http://bamboodev.us/
Description: Hỗ trợ khách hàng
Author: LongNC
Version: 1
Author URI: http://bamboodev.us/
*/
 
 
class SupportWidget extends WP_Widget
{
  function SupportWidget()
  {
    $widget_ops = array('classname' => 'SupportWidget', 'description' => 'Hỗ trợ khách hàng' );
    $this->WP_Widget('SupportWidget', 'Hỗ trợ khách hàng', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('yahoo'); ?>">Yahoo: <input class="widefat" id="<?php echo $this->get_field_id('yahoo'); ?>" name="<?php echo $this->get_field_name('yahoo'); ?>" type="text" value="<?php echo esc_attr($yahoo); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['yahoo'] = $new_instance['yahoo'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
	echo $before_widget;
    $title = empty($instance['title'])?'Hỗ trợ khách hàng':$instance['title'];
	
    if (!empty($title))
      echo $before_title . $title . $after_title;;
	$yahoo = $instance['yahoo']; 
    // WIDGET CODE GOES HERE
	?>
	<center>
	<div style="background-color: rgb(188, 189, 192); border-radius: 10px 10px 10px 10px; text-align: center; width: 120px; padding-bottom: 5px; padding-top: 5px;">
		<span class="phone">0613. 849 959</span>
		<span class="phone">0933. 976 045</span>
		<span class="phone">0935. 063 848</span>
	</div>
	<div style="padding-top: 10px;">
	<?php
	if(!empty($yahoo)) {
	?>
		<a border="0" mce_href="ymsgr:sendim?<?php echo $yahoo?>" href="ymsgr:sendim?<?php echo $yahoo?>"><img mce_src="http://opi.yahoo.com/online?u=<?php echo $yahoo?>&amp;t=2" src="http://opi.yahoo.com/online?u=<?php echo $yahoo?>&amp;t=2"></a>
	<?php
	}
	?>
	</div>
	</center>
	<?php
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SupportWidget");') );?>