<?php
class wctest{
    public function __construct(){
        if(is_admin()){
	    add_action('admin_menu', array($this, 'add_plugin_page'));
	    add_action('admin_init', array($this, 'page_init'));
	}
    }
	
    public function add_plugin_page(){
        // This page will be under "Settings"
	add_options_page('Settings Shop', 'Shop Settings', 'manage_options', 'test-setting-admin', array($this, 'create_admin_page'));
    }

    public function create_admin_page(){
        ?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Shop Settings</h2>			
	    <form method="post" action="options.php">
	        <?php
                    // This prints out all hidden setting fields
		    settings_fields('test_option_group');	
		    do_settings_sections('test-setting-admin');
		?>
	        <?php submit_button(); ?>
	    </form>
	</div>
	<?php
    }
	
    public function page_init(){		
	register_setting('test_option_group', 'array_key', array($this, 'check_ID'));
		
        add_settings_section(
	    'setting_section_id',
	    'Setting',
	    array($this, 'print_section_info'),
	    'test-setting-admin'
	);	
		
	add_settings_field(
	    'quantity', 
	    'Quantity :', 
	    array($this, 'create_an_id_field'), 
	    'test-setting-admin',
	    'setting_section_id'			
	);		
    }
	
    public function check_ID($input){
        if(is_numeric($input['quantity'])){
	    $mid = $input['quantity'];			
	    if(get_option('shop_quantity') === FALSE){
		add_option('shop_quantity', $mid);
	    }else{
		update_option('shop_quantity', $mid);
	    }
	}else{
	    $mid = '';
	}
	return $mid;
    }
	
    public function print_section_info(){
	print 'Enter your setting below:';
    }
	
    public function create_an_id_field(){
        ?><input type="text" id="input_whatever_unique_id_I_want" name="array_key[quantity]" value="<?php echo get_option('shop_quantity');?>" /><?php
    }
}

$wctest = new wctest();