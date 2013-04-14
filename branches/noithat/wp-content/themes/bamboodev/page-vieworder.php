<?php
/*
Template Name: View Order
*/
get_header();
global $title;
$title = "Thông tin đặt hàng";
$orderId = $_GET['id'];
$secId = $_GET['sec_id'];
if(empty($orderId)) {
	die('Lỗi : liên kết không hợp lệ!');
}
$order = $wpdb->get_row("SELECT * FROM `order` WHERE `id` = {$orderId}");
if($order == null){
	die('Lỗi : mã đơn hàng không hợp lệ!');
}
if($order->sec_id != $secId){
	die('Lỗi : mã bảo mật không đúng!');
}
$order_products = $wpdb->get_results("SELECT * FROM `order_products` WHERE `order_id` = {$orderId}");
if(!isset($order_products) || empty($order_products))
	$posts = array();
else {
	$ids = array();
	$data = array();
	foreach($order_products as $item) {
		$ids[] = $item->product_id;
		$data[$item->product_id] = $item;
	}
	$posts = query_posts( array('post_type' => 'product','post__in' => $ids));
}
?>	
<?php get_sidebar('left'); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/cart.css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js" type="text/javascript" ></script>
<div id="right_col">
	<div style="width: 100%" class="small_box_container">
		<div class="header" style="text-align:left">THÔNG TIN ĐẶT HÀNG</div>
		<div class="content container">
			<fieldset>
				<legend class="title">Danh sách sản phẩm đặt mua </legend>
				<table cellspacing="0" cellpadding="3" border="0" class="tblGiohang">
					<thead>
						<tr><th width="5px">STT</th>
						<th>Tên sản phẩm</th>
						<th width="130px">Đơn giá (VNĐ)</th>
						<th width="60px">Số lượng</th>
						<th width="130px">Thành tiền (VNĐ)</th>
					</tr></thead>
					<tbody id="lstSanpham">
						<?php
						$i = 1;
						foreach($posts as $post) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
							$price = get_post_meta($post->ID,'catalog_product_price',true);
							?>
							<tr>
								<td align="center"><?php echo $i?></td>
								<td><a href="<?php the_permalink();?>" target="_blank" class="link"><?php echo $post->post_title?></a></td>
								<td align="right"><?php echo format_number($price)?></td>
								<td align="center">
									<?php echo $data[$post->ID]->soluong?>
								</td>
								<td align="right" class="td_thanhtien"><?php echo format_number($data[$post->ID]->thanhtien)?></td>
							</tr>
							<?php
							$i++;
						}
						?>
						
					</tbody>
					<tfoot>
						<tr><td align="right" colspan="4">Tổng cộng :</td>
						<td align="right"><span id="total_display" class="price"><?php echo format_number($order->total) ?></span></td>
					</tr></tfoot>
				</table>
			</fieldset>
			<fieldset>
				<legend class="title">Thông tin liên hệ khách hàng</legend>
				<table style="width:100%">
					<tbody><tr>
						<td style="width: 100px; text-align: left; font-weight: bold;">Họ tên : </td>
						<td>
							<?php echo $order->hoten ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: bold;">Điện thoại :</td>
						<td>
							<?php echo $order->dienthoai ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: bold;">Email : </td>
						<td>
							<?php echo $order->email ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: bold;">Địa chỉ :</td>
						<td>
							<?php echo $order->diachi ?>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: bold;">Ghi chú :</td>
						<td>
							<?php echo $order->ghichu ?>
						</td>
					</tr>
				</tbody></table>
			</fieldset>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<script>
function formatMoney(num) {
	if(num>=1000) {
		num = num.toString().replace(/\$|\,|\./g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = num.toString();
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		num = (((sign)?'':'-') + num );
	}
	return num;
}

$(document).ready(function(){
	
});
</script>