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
    $yahoo = $instance['yahoo'];
    $nicks = isset($instance['nicks'])?$instance['nicks']:'';
    $types = isset($instance['types'])?$instance['types']:'';
	//$array = $this->get_field_id('supports');
	if(empty($nicks)) {
		$nicks = array(
			'','',''
		);
	}
	if(empty($types)) {
		$nicks = array(
			1,1,1
		);
	}
	//debug($supports);
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  <p style="margin-bottom:5px"><label for="<?php echo $this->get_field_id('support0'); ?>">Nick supports: </label></p>
  <?php
  foreach($nicks as $index => $item) {
	$selected = array(
		1 => '',2 => ''
	);
	$selected[$types[$index]] = 'selected'
	?>
	<input class="widefat" style="width: 60%; margin-bottom: 5px;" id="<?php echo $this->get_field_id('nicks').$index; ?>" name="<?php echo $this->get_field_name('nicks'); ?>[]" type="text" value="<?php echo esc_attr($item); ?>" />
	<select style="width: 80px;" id="<?php echo $this->get_field_id('types').$index; ?>" name="<?php echo $this->get_field_name('types'); ?>[]">
		<option value="1" <?php echo $selected[1]?>>Yahoo</option>
		<option value="2" <?php echo $selected[2]?>>Skype</option>
	</select>
	<?php
  }
  ?>
  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['nicks'] = $new_instance['nicks'];
    $instance['types'] = $new_instance['types'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
	echo $before_widget;
    $title = empty($instance['title'])?'Hỗ trợ khách hàng':$instance['title'];
	
    if (!empty($title))
      echo $before_title . $title . $after_title;;
	$nicks = $instance['nicks']; 
	$types = $instance['types']; 
    // WIDGET CODE GOES HERE
	?>
	<div style="clear:both;margin-top:10px"></div>
	<center>
	<img  src="<?php echo get_template_directory_uri(); ?>/images/support.png"/>
	<div style="padding-top: 10px;">
	<?php
	foreach($nicks as $index => $item) {
		if(!empty($item)) {
			if($types[$index] == 1) { //yahoo
				?>
				<a border="0" mce_href="ymsgr:sendim?<?php echo $item?>" href="ymsgr:sendim?<?php echo $item?>"><img mce_src="http://opi.yahoo.com/online?u=<?php echo $item?>&amp;t=2" src="http://opi.yahoo.com/online?u=<?php echo $item?>&amp;t=2"></a>
				<?php
			} else if($types[$index] == 2) { //skype
				?>
				<a href="skype:<?php echo $item?>?chat"><img width="97" height="23" src="http://download.skype.com/share/skypebuttons/buttons/chat_blue_transparent_97x23.png" style="border: none;" alt="Chat with me" /></a>
				<?php
			}
		}
	}
	?>
	</div>
	</center>
	<?php
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SupportWidget");') );?>