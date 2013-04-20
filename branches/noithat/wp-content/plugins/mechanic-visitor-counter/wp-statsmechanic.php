<?php
/*
Plugin Name: Mechanic Visitor Counter
Plugin URI: http://www.balimechanicweb.net/24-products/wordpress/plugins/37-mechanic-visitor-counter
Description: Mechanic Visitor Counter is a widgets which will display the Visitor counter and traffic statistics on WordPress.
Version: 2.3
Author: Aditya Subawa
Author URI: http://www.adityawebs.com
*/
global $wpdb;
define('BMW_TABLE_NAME', $wpdb->prefix . 'mech_statistik');
define('BMW_PATH', ABSPATH . 'wp-content/plugins/mechanic-visitor-counter');
require_once(ABSPATH . 'wp-includes/pluggable.php');

function install(){
global $wpdb;
if ( $wpdb->get_var('SHOW TABLES LIKE "' . BMW_TABLE_NAME . '"') != BMW_TABLE_NAME )
{
$sql = "CREATE TABLE IF NOT EXISTS `". BMW_TABLE_NAME . "` (";
$sql .= "`ip` varchar(20) NOT NULL default '',";
$sql .= "`tanggal` date NOT NULL,";
$sql .= "`hits` int(10) NOT NULL default '1',";
$sql .= "`online` varchar(255) NOT NULL,";
$sql .= "PRIMARY KEY  (`ip`)";
$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1;";
$wpdb->query($sql);
 }
}
	 
function uninstall(){
global $wpdb;
$sql = "DROP TABLE `". BMW_TABLE_NAME . "`;";
$wpdb->query($sql);
}

function acak($path, $exclude = ".|..|.svn|.DS_Store", $recursive = true) {
    $path = rtrim($path, "/") . "/";
    $folder_handle = opendir($path) or die("Eof");
    $exclude_array = explode("|", $exclude);
    $result = array();
    while(false !== ($filename = readdir($folder_handle))) {
        if(!in_array(strtolower($filename), $exclude_array)) {
            if(is_dir($path . $filename . "/")) {
                if($recursive) $result[] = acak($path . $filename . "", $exclude, true);
            } else {
                if ($filename === '0.gif') {
                    if (!$done[$path]) {
                        $result[] = $path;
                        $done[$path] = 1;
                    }
                }
            }
        }
    }
    return $result;
}
register_activation_hook(__FILE__, 'install');
register_deactivation_hook(__FILE__, 'uninstall');

                                  
class Wp_StatsMechanic extends WP_Widget{
    
    function __construct(){
	 $params=array(
            'description' => 'Display Visitor Counter and Statistics Traffic', //plugin description
            'name' => 'Mechanic - Visitor Counter'  //title of plugin
        );
        
        parent::__construct('WP_StatsMechanic', '', $params);
    }
       
  // extract($instance);
	 public function form($instance)  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];


?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('font_color'); ?>">Font Color: <input class="widefat" id="<?php echo $this->get_field_id('font_color'); ?>" name="<?php echo $this->get_field_name('font_color'); ?>" type="text" value="<?php echo $instance['font_color']; ?>" /></label></p>
<p><font size='2'>To change the font color, fill the field with the HTML color code. example: #333 </font></p>
<p><font size='2'><a href="http://blog.balimechanicweb.net/html-color-code/" target="_blank">Click here</a> to select another color variation.</font></p>
<p><label for="<?php echo $this->get_field_id('ip_display'); ?>"><?php _e('Enable IP address display? '); ?><input type="checkbox" class="checkbox" <?php checked( $instance['ip_display'], 'on' ); ?> id="<?php echo $this->get_field_id('ip_display'); ?>" name="<?php echo $this->get_field_name('ip_display'); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('server_time'); ?>"><?php _e('Enable Server Time display? '); ?><input type="checkbox" class="checkbox" <?php checked( $instance['server_time'], 'on' ); ?> id="<?php echo $this->get_field_id('server_time'); ?>" name="<?php echo $this->get_field_name('server_time'); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('author_credit'); ?>"><?php _e('Give credit to plugin author? '); ?><input type="checkbox" class="checkbox" <?php checked( $instance['author_credit'], 'on' ); ?> id="<?php echo $this->get_field_id('author_credit'); ?>" name="<?php echo $this->get_field_name('author_credit'); ?>" /></label></p>
<p><p><label for="<?php echo $this->get_field_id('statsmechanic_align'); ?>"><?php _e('Plugins align? '); ?>
		<select class="select" id="<?php echo $this->get_field_id('statsmechanic_align'); ?>" name="<?php echo $this->get_field_name('statsmechanic_align'); ?>" selected="<?php echo $instance['statsmechanic_align']; ?>">
		  <option value="<?php echo $instance['statsmechanic_align']; ?>" selected="<?php echo $instance['statsmechanic_align']; ?>"></option>
		  <option value="Left">Left</option>
		  <option value="Center">Center</option>
		  <option value="Right">Right</option>
		 </select></label></p>
<p>Please go to <a href="options-general.php?page=plugin_statsmechanic_menu">Settings -> Visitor Counter Options</a> to configure image counter</p>
<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ZMEZEYTRBZP5N&lc=ID&item_name=Aditya%20Subawa&item_number=426267&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" target="_blank"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" alt="<?_e('Donate')?>" /></a></p>
<?php

  }
    public function widget($args, $instance){
        extract($args, EXTR_SKIP);
    $authorcredit = isset($instance['author_credit']) ? $instance['author_credit'] : false ; // give plugin author credit
	$ipaddress = isset($instance['ip_display']) ? $instance['ip_display'] : false ; // display ip address
	$stime = isset($instance['server_time']) ? $instance['server_time'] : false ; // display server time
	$fontcolor= $instance['font_color'];
	$style = get_option ('statsmechanic_style');
	$align = $instance['statsmechanic_align'];
	
	echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	
 
    if (!empty($title))
      echo $before_title . $title . $after_title;?>
	 <?php 
	 		  $ip      = $_SERVER['REMOTE_ADDR']; // Getting the user's computer IP
              $tanggal = date("y-m-d"); // Getting the current date
              $waktu   = time(); 
              // Check your IP, whether the user has had access to today's 
              $sql = mysql_query("SELECT * FROM `". BMW_TABLE_NAME . "` WHERE ip='$ip' AND tanggal='$tanggal'");
              // If not there, save the user data to the database
              if(mysql_num_rows($sql) == 0){
                mysql_query("INSERT INTO `". BMW_TABLE_NAME . "`(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
              } 
              else{
                mysql_query("UPDATE `". BMW_TABLE_NAME . "` SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
              }
				//variable
              $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM `". BMW_TABLE_NAME . "` WHERE tanggal='$tanggal' GROUP BY ip"));
              $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM `". BMW_TABLE_NAME . "`"), 0); 
              $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM `". BMW_TABLE_NAME . "` WHERE tanggal='$tanggal' GROUP BY tanggal")); 
              $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM `". BMW_TABLE_NAME . "`"), 0); 
              $tothitsgbr      = mysql_result(mysql_query("SELECT COUNT(hits) FROM `". BMW_TABLE_NAME . "`"), 0);
              $bataswaktu       = time() - 300;
              $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM `". BMW_TABLE_NAME . "` WHERE online > '$bataswaktu'"));
			
              $ext = ".gif";
			//image print
					$tothitsgbr = sprintf("%06d", $tothitsgbr);
					$length = strlen($tothitsgbr);
					$str = '';
					for ($i=0; $i<$length; $i++) {
						$num = $tothitsgbr[$i];
						$str .= "<img src='".WP_PLUGIN_URL."/mechanic-visitor-counter/styles/$style/$num$ext' alt='$num'>";
					}
			   	    //image
			  		$imgvisit= "<img src='".plugins_url ('counter/visit.png' , __FILE__ ). "'>";
					$imgtotal="<img src='".plugins_url ('counter/line_chart.png' , __FILE__ ). "'>";
					$imghits="<img src='".plugins_url ('counter/hits.png' , __FILE__ ). "'>";
					$imgtotalhits="<img src='".plugins_url ('counter/bar_chart.png' , __FILE__ ). "'>";
					$imgonline="<img src='" .plugins_url ('counter/online.png' , __FILE__ ). "'>";
					//align
					?>
			  <div style="text-align:center"><?php echo $str ?><br/><div style="text-align: left; margin-left: 10px;"><table width='100%'>
			  <tr><td><?php echo $imgvisit ?><font color='<?php echo $fontcolor ?>' size='2'> Visit Today : <?php echo $pengunjung ?> </font></td></tr>
              <tr><td><?php echo $imgtotal ?><font color='<?php echo $fontcolor ?>' size='2'> Total Visit :<?php echo $totalpengunjung ?></font></td></tr>
              <tr><td><?php echo $imghits ?><font color='<?php echo $fontcolor ?>' size='2'> Hits Today :<?php echo $hits['hitstoday'] ?></font></td></tr>
              <tr><td><?php echo $imgtotalhits ?><font color='<?php echo $fontcolor ?>' size='2'> Total Hits :<?php echo $totalhits ?></font></td></tr>
              <tr><td><?php echo $imgonline ?><font color='<?php echo $fontcolor ?>' size='2'> Who's Online :<?php echo $pengunjungonline ?></font></td></tr>
			  </table></div><br/><?php
			  if ($ipaddress) { ?>
					<font color='<?php echo $fontcolor ?>' size='2'>Your IP : <?php echo $ip ?></font><br/>
					<?php } ?>
					<?php
					if ($stime) { ?>
					<font color='<?php echo $fontcolor ?>' size='2'>Server Time : <?php echo $tanggal ?></font><br/>
					<?php } ?>
				</div>
			<?php
	echo $after_widget;
  }}
add_action('widgets_init', 'register_wp_statsmechanic');
function register_wp_statsmechanic() {
register_widget('Wp_StatsMechanic', 'statsmechanic_style');
}	
//admin setting
add_action('admin_menu', 'statsmechanic_menu');
function statsmechanic_menu() {
register_setting('plugin_statsmechanic_menu', 'statsmechanic_style');
add_options_page('Plugin Stats Mechanic', 'Visitor Counter Options', 1, 'plugin_statsmechanic_menu', 'statsmechanic_options');
}
function statsmechanic_options() {
if (!current_user_can(1))  {
wp_die( __('You do not have sufficient permissions to access this page.') );
}
echo '
<div class="wrap">';
echo '<h2>Plugin Options Mechanic Visitor Counter</h2><br/>';
echo 'Join our mailing list for tips, tricks, and Website secrets.';
echo '<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open("http://feedburner.google.com/fb/a/mailverify?uri=balimechanicblog", "popupwindow", "scrollbars=yes,width=550,height=520");return true">
  <p>Enter your email address: 
    <input type="text" style="width:140px" name="email"/> 
    <input type="hidden" value="balimechanicblog" name="uri"/>
    <input type="hidden" name="loc" value="en_US"/>
    <input type="submit" value="Subscribe" />
  </p>
  </form>';
echo 'If you like and helped with our plugins, please donate to the developer. how much your nominal will help developers to develop these plugins. Also, dont forget to follow us on <a href="http://www.twitter.com/balimechanicweb" target="_blank">Twitter</a>.<br/>';
echo '<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ZMEZEYTRBZP5N&lc=ID&item_name=Aditya%20Subawa&item_number=426267&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" target="_blank"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" alt="Donate" /></a></p>';

?>
<form method="post" action="options.php">
<?php settings_fields( 'plugin_statsmechanic_menu' ); ?>
       <?php
            $data = acak(WP_CONTENT_DIR . '/plugins/mechanic-visitor-counter/styles/');
            foreach ($data as $parent_folder => $records) {
                foreach ($records as $style_folder => $style_records) {
                    foreach ($style_records as $style => $test) {
                        preg_match('/styles\/(.*?)\/(.*?)\//', $test, $match);
                        $groups[$match[1]][] = $match[2];
                    }
                }
            }
        ?>
		  <?php
            foreach ($groups as $style_name => $style) {
?>
 					<h3>Choose one of the <?php echo $style_name; ?> counter styles below:</h3>
						<table class="form-table">
						<?php
                foreach ($style as $name) {
                    ?>
                    	<tr>
                		<td>
                		<input type="radio" id="img1" name="statsmechanic_style" value="<?php echo $style_name . '/' . $name; ?>" <?php echo checked($style_name . '/' . $name, get_option ('statsmechanic_style')) ?> />
                		<img src='<?php echo WP_PLUGIN_URL?>/mechanic-visitor-counter/styles/<?php echo $style_name . '/' . $name . '/'; ?>0.gif'>
                		<img src='<?php echo WP_PLUGIN_URL?>/mechanic-visitor-counter/styles/<?php echo $style_name . '/' . $name . '/'; ?>1.gif'>
                		<img src='<?php echo WP_PLUGIN_URL?>/mechanic-visitor-counter/styles/<?php echo $style_name . '/' . $name . '/'; ?>2.gif'>
                		<img src='<?php echo WP_PLUGIN_URL?>/mechanic-visitor-counter/styles/<?php echo $style_name . '/' . $name . '/'; ?>3.gif'>
                		<img src='<?php echo WP_PLUGIN_URL?>/mechanic-visitor-counter/styles/<?php echo $style_name . '/' . $name . '/'; ?>4.gif'>
                		</td>
                	</tr>
					
					 <?php
                }
			?>
		  </table>
<?php
            }
        ?>
        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
</form>
<?php
echo '</div>';
}
?>