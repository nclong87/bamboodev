<?php
/*
Plugin Name: Order_List_Table
*/

if (! class_exists ( 'WP_List_Table' )) {
	require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Order_List_Table extends WP_List_Table {
	private $per_page = 10;
	function __construct() {
		global $status, $page;
		
		parent::__construct ( array ('singular' => __ ( 'order', 'mylisttable' ), //singular name of the listed records
'plural' => __ ( 'orders', 'mylisttable' ), //plural name of the listed records
'ajax' => false )//does this table support ajax?


		 );
		
		add_action ( 'admin_head', array (&$this, 'admin_header' ) );
	
	}
	
	function admin_header() {
		$page = (isset ( $_GET ['page'] )) ? esc_attr ( $_GET ['page'] ) : false;
		if ('list_order' != $page)
			return;
		echo '<style type="text/css">';
		echo '.wp-list-table .column-id { width: 5%; }';
		echo '.wp-list-table .column-booktitle { width: 40%; }';
		echo '.wp-list-table .column-author { width: 35%; }';
		echo '.wp-list-table .column-isbn { width: 20%;}';
		echo '</style>';
	}
	
	function no_items() {
		_e ( 'No orders found.' );
	}
	
	function get_sortable_columns() {
		$sortable_columns = array ('booktitle' => array ('booktitle', false ), 'author' => array ('author', false ), 'isbn' => array ('isbn', false ) );
		return $sortable_columns;
	}
	
	function get_columns() {
		$columns = array (
			'id' => __ ( 'ID', 'mylisttable' ), 
			'total' => __ ( 'Total', 'mylisttable' ), 
			'shipping_fee' => __ ( 'ShippingFee', 'mylisttable' ), 
			'country' => __ ( 'ShipTo', 'mylisttable' ),
			'payment_method' => __ ( 'PaymentMethod', 'mylisttable' ),
			'time_create' => __ ( 'DateOrder', 'mylisttable' ),
			'status' => __ ( 'Status', 'mylisttable' ),
			'action' => __ ( 'Actions', 'mylisttable' ),
		);
		return $columns;
	}
	function column_default($item, $column_name) {
		switch ($column_name) {
			case 'total' :
				return '$' . format_number ( $item [$column_name] );
			case 'shipping_fee':
				if($item['shipping_fee'] == 0) return 'N/A'; else return '$'.$item['shipping_fee'];
			case 'payment_method':
				if(!empty($item['paypal_id'])) {
					return 'PayPal';
				} else {
					return '';
				}
			case 'status':
				if($item['status'] == 3) return 'Processed';
				if($item['status'] == 2) return 'Payed';
				if($item['status'] == 1) return 'Pending';
				if($item['status'] == 0 && $item['shipping_fee'] == 0) return 'Contact';
				return '';
			default :
				return $item [$column_name];
		}
	}
	function usort_reorder($a, $b) {
		// If no sort, default to title
		$orderby = (! empty ( $_GET ['orderby'] )) ? $_GET ['orderby'] : 'booktitle';
		// If no order, default to asc
		$order = (! empty ( $_GET ['order'] )) ? $_GET ['order'] : 'asc';
		// Determine sort order
		$result = strcmp ( $a [$orderby], $b [$orderby] );
		// Send final sort direction to usort
		return ($order === 'asc') ? $result : - $result;
	}
	
	function column_action($item){
  		$actions = array(
            'view'      => sprintf('<a href="?page=%s&action=%s&book=%s">Detail</a>',$_REQUEST['page'],'view',$item['id']),
  			'delete'      => sprintf('<a href="?page=%s&action=%s&book=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
  		return sprintf('%1$s', $this->row_actions($actions) );
	}
	
	function get_bulk_actions() {
		$actions = array ('delete' => 'Delete' );
		return $actions;
	}
	
	function column_cb($item) {
		return sprintf ( '<input type="checkbox" name="book[]" value="%s" />', $item ['ID'] );
	}
	
	function prepare_items() {
		$columns = $this->get_columns ();
		$hidden = array ();
		$sortable = $this->get_sortable_columns ();
		$this->_column_headers = array ($columns, $hidden, $sortable );
		//usort( $this->example_data, array( &$this, 'usort_reorder' ) );
		

		global $wpdb;
		$current_page = $this->get_pagenum ();
		$query = $wpdb->prepare ( 'SELECT SQL_CALC_FOUND_ROWS t0.*,t1.`country` FROM `orders` t0 LEFT JOIN `address` t1 ON t0.`address_id`=t1.`id` WHERE t0.status >= 0  ORDER BY t0.id DESC LIMIT %d,%d', (($current_page - 1) * $this->per_page), $this->per_page );
		$this->found_data = $wpdb->get_results ( $query, ARRAY_A );
		$row = $wpdb->get_row ( 'SELECT FOUND_ROWS() as num' );
		$total_items = $row->num;
		
		$this->set_pagination_args ( array ('total_items' => $total_items, //WE have to calculate the total number of items
'per_page' => $this->per_page )//WE have to determine how many items to show on a page
 );
		$this->items = $this->found_data;
	}

} //class


function my_add_menu_items() {
	$hook = add_menu_page ( 'Orders', 'Orders', 'activate_plugins', 'list_order', 'my_render_list_page' );
	add_action ( "load-$hook", 'add_options' );
}

function add_options() {
	global $myListTable;
	$option = 'per_page';
	$args = array ('label' => 'Orders', 'default' => 10, 'option' => 'orders_per_page' );
	add_screen_option ( $option, $args );
	$myListTable = new Order_List_Table ();
}
add_action ( 'admin_menu', 'my_add_menu_items' );

function my_render_list_page() {
	global $myListTable;
	echo '</pre><div class="wrap"><h2>List Orders</h2>';
	$myListTable->prepare_items ();
	?>
<form method="post"><input type="hidden" name="page"
	value="ttest_list_table">
    <?php
	$myListTable->search_box ( 'search', 'search_id' );
	
	$myListTable->display ();
	echo '</form></div>';
}

