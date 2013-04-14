<?php
/*
Template Name: Cart
*/
global $title;
$title = "Thông tin đặt hàng";
get_header();
if(!isset($_SESSION['cart']) || empty($_SESSION['cart']))
	$posts = array();
else
	$posts = query_posts( array('post_type' => 'product','post__in' => $_SESSION['cart']));
if(isset($_GET['debug'])) {
	print_r($posts);die;
}
 ?>	
<?php get_sidebar('left'); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/cart.css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js" type="text/javascript" ></script>
<div id="right_col">
	<div style="width: 100%" class="small_box_container">
		<div class="header" style="text-align:left">THÔNG TIN ĐẶT HÀNG</div>
		<div class="content container">
			<form action="<?php bloginfo('siteurl'); ?>/order" method="post" id="form_cart" >
			<input type="text" style="display:none" name="total" id="total" value="0"/>
			<fieldset>
				<legend class="title">Danh sách sản phẩm đặt mua </legend>
				<table cellspacing="0" cellpadding="3" border="0" class="tblGiohang">
					<thead>
						<tr><th width="5px">STT</th>
						<th>Tên sản phẩm</th>
						<th width="130px">Đơn giá (VNĐ)</th>
						<th width="60px">Số lượng</th>
						<th width="130px">Thành tiền (VNĐ)</th>
						<th width="50px">Xóa</th>
					</tr></thead>
					<tbody id="lstSanpham">
						<?php
						$i = 1;
						foreach($posts as $post) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail', 'single-post-thumbnail' );
							$price = get_post_meta($post->ID,'catalog_product_price',true);
							?>
							<tr data-ref-id="<?php echo $post->ID?>" data-ref-price="<?php echo $price?>">
								<td align="center"><?php echo $i?></td>
								<td><a href="<?php the_permalink();?>" target="_blank" class="link"><?php echo $post->post_title?></a></td>
								<td align="right"><?php echo format_number($price)?></td>
								<td align="center">
									<input type="text" value="" id="sanpham_soluong" name="sanpham_soluong[]" style="display:none">
									<select class="soluong">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</td>
								<td align="right" class="td_thanhtien"><?php echo $price?></td>
								<td align="center">
								<img class="img_button remove" src="<?php echo get_template_directory_uri(); ?>/images/delete_32.png" height="25" alt="Remove" title="Xóa sản phẩm này khỏi giỏ hàng của bạn" data-ref='{"product_id":<?php echo $post->ID?>}'/>
								</td>
							</tr>
							<?php
							$i++;
						}
						?>
						
					</tbody>
					<tfoot>
						<tr><td align="right" colspan="4">Tổng cộng :</td>
						<td align="right"><span id="total_display" class="price">0</span></td>
						<td></td>
					</tr></tfoot>
				</table>
			</fieldset>
			<fieldset>
				<legend class="title">Thông tin liên hệ khách hàng</legend>
				<table style="width:100%">
					<tbody><tr>
						<td style="width: 150px; text-align: right; font-weight: bold;">Họ tên <span class="required">*</span> : </td>
						<td>
							<input type="text" name="hoten" id="hoten" class="input">
							<label class="error" generated="false" for="hoten"></label>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold;">Điện thoại <span class="required">*</span> : </td>
						<td>
							<input type="text" name="dienthoai" id="dienthoai" class="input">
							<label class="error" generated="false" for="dienthoai"></label>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold;">Email <span class="required">*</span> : </td>
						<td>
							<input type="text" name="email" id="email" class="input">
							<label class="error" generated="false" for="email"></label>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold;">Địa chỉ :</td>
						<td>
							<input type="text" name="diachi" id="diachi" class="input">
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold;">Ghi chú :</td>
						<td>
							<textarea name="ghichu" style="width: 350px;" rows="3"></textarea>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; font-weight: bold;"></td>
						<td>
							<button id="btSubmit" >Xác nhận mua</button>
						</td>
					</tr>
				</tbody></table>
			</fieldset>
			</form>
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
function update_cart() {
	var i = 0;
	var total = 0;
	var call = 0;
	$("tbody#lstSanpham tr").each(function() {
		var price = parseInt($(this).attr("data-ref-price"));
		var sanpham_id = $(this).attr("data-ref-id");
		var quantity = parseInt($(".soluong",this).val());
		if(isNaN(quantity)) quantity = 0;
		if(!isNaN(price)) {
			var thanhtien = price*quantity;
			$(".td_thanhtien",this).text(formatMoney(thanhtien));
			total+= thanhtien;
			$("#sanpham_soluong",this).val(sanpham_id+";"+quantity+";"+thanhtien);
		}
		i++;
	});
	$("#form_cart #total").val(total);
	$("#total_display").text(formatMoney(total));
	if(i == 0) $("#btSubmit").button({disabled:true});
}
$(document).ready(function(){
	$('#btSubmit').button({
		icons: {
			primary: "ui-icon-check"
		}
	});
	update_cart();
	$("select.soluong").live("change",function(){
		update_cart();
	});
	$("tbody#lstSanpham img.remove").live("click", function() {	
		var tr = $(this).parents("tr");
		var data_ref = $.parseJSON($(this).attr("data-ref"));
		if(data_ref == null) return;
		$.get("<?php echo get_bloginfo('wpurl'); ?>/ajax?action=remove-out-cart&product_id="+data_ref.product_id,function(response){
			if(response == "OK") {
				tr.remove();
				update_cart();
			} else {
				location.reload();
			}
		});
	});
	$("#form_cart").validate({
		onkeyup: false,
		onfocusout:false,
		rules: {
			email: {
				required: true,
				email :true
			},
			hoten: {
				required: true
			},
			dienthoai: {
				required: true
			}
		},
		messages: {
			hoten: "Vui lòng nhập họ tên",
			email: {
				required: "Vui lòng nhập email",
				email : "Email không hợp lệ"
			},
			dienthoai: {
				required: "Vui lòng nhập số điện thoại"
			}
		}
	}).submit(function(){
		$('#btSubmit').button({disabled:true});
		return true;
	});
});
</script>