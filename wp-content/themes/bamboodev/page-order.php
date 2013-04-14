<?php
/*
Template Name: Order
*/
global $title,$wpdb;
$title = "Đặt hàng thành công";
get_header();
if(!isset($_POST['sanpham_soluong']) || empty($_POST['sanpham_soluong'])) {
	wp_redirect(get_bloginfo('siteurl'), 301 ); exit;
}
$sec_id = genKey();
$wpdb->insert( 
	'order', 
	array( 
		'hoten' => $_POST['hoten'], 
		'dienthoai' => $_POST['dienthoai'], 
		'email' => $_POST['email'], 
		'diachi' => $_POST['diachi'], 
		'ghichu' => $_POST['ghichu'], 
		'total' => $_POST['total'], 
		'sec_id' => $sec_id 
	)
);
$orderId = $wpdb->insert_id;
foreach($_POST['sanpham_soluong'] as $item) {
	$parts = explode(';', $item);
	$product_id = $parts[0];
	$soluong = intval($parts[1]);
	$thanhtien = $parts[2];
	$wpdb->insert( 
		'order_products', 
		array( 
			'product_id' => $product_id, 
			'soluong' => $soluong,
			'thanhtien' => $thanhtien,
			'order_id' => $orderId
		)
	);
}
$link = get_bloginfo('siteurl').'/view-order?id='.$orderId.'&sec_id='.$sec_id;
$content = 'Link xem chi tiết đơn đặt hàng :<br/><a href="'.$link.'">'.$link.'</a>';
$subject = '['.get_bloginfo( 'name' ).'] Đơn đặt hàng mới!';
$admin_email = get_settings('admin_email');
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
wp_mail( $admin_email, $subject, $content, $headers, null );
?>	
<?php get_sidebar('left'); ?>
<div id="right_col">
	<div style="width: 100%" class="small_box_container">
		<div class="header" style="text-align:left">THÔNG BÁO</div>
		<div class="content" style="padding:10px">
			<div class="ui-state-highlight ui-corner-all" style=" padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong>Success! </strong> Bạn đã đặt hàng thành công.</p>
			</div>
			<span style="display: block; margin-top: 20px; font-weight: bold;">Chúng tôi sẽ liên hệ với bạn để xác nhận đơn đặt hàng này trong thời gian sớm nhất. <br/>Cảm ơn bạn đã mua hàng tại gian hàng của chúng tôi.</span>
			<a href="<?php bloginfo('siteurl')?>">Về trang chủ.</a>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<script>
$(document).ready(function(){
	
});
</script>