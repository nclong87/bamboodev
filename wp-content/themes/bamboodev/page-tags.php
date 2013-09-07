<?php
/**
* Template Name: Tag Cloud
* Description: A Page Template that adds a sidebar to pages
*
* @package BamBooDev
* @author LongNC
* @since Shop 1.0
*/
get_header();
?>
<p id="breadcrumbs">
	<a href="<?php echo DOMAIN?>">Trang chủ</a> » 
	<strong>Tags Cloud</strong>
</p>
<div style="padding-left: 10px; padding-top: 5px; float: left; width: 95%;">
<?php wp_tag_cloud(array(
	'orderby' => 'count', 
	'order'   => 'DESC',
	'smallest' => 10,
	'largest' => 18,
	'separator' => '<span class="tag_separator"></span>'
)); ?>
</div>
<?php
get_footer(); ?>
