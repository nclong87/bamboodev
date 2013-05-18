<?php 
add_filter('attachment_fields_to_edit', 'ms_attachment_fields_to_edit', 11, 2);
add_filter('attachment_fields_to_save', 'ms_image_attachment_fields_to_save', 11, 2);

function ms_attachment_fields_to_edit($form_fields, $post) {
	// Define categories we want to use
	$post_id = $post->ID;
	$meta = wp_get_attachment_metadata($post_id);
	if(isset($meta['image_meta']['image_link'])) {
		$image_link = $meta['image_meta']['image_link'];
		if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
			$form_fields['image_link'] = array(
			'label' => __('Image Link'),
			'input' => 'html',
			'helps' => __('Link to external websites (for Press page)'),
			'html' => '<input type="text" value="'.$image_link.'" name="attachments['.$post_id.'][image_link]" id="attachments['.$post_id.'][image_link]" class="text">'
		);} 
	}
	return $form_fields;
}

function ms_image_attachment_fields_to_save($post, $attachment) {
	if ( substr($post['post_mime_type'], 0, 5) == 'image' ) {
		$attachment_id = $post['ID'];
		$meta = wp_get_attachment_metadata( $attachment_id );
		$meta['image_meta']['image_link'] = $_POST['attachments'][$attachment_id]['image_link'];
		wp_update_attachment_metadata( $attachment_id, $meta );
	}
	return $post;
}

?>