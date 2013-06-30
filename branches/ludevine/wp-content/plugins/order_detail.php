<?php
$plugins_url = plugins_url();
echo '</pre>';
global $wpdb;
$order_id = getParam('id');
$query = $wpdb->prepare('SELECT o.*,b.`address` AS b_address,b.`city` AS b_city,b.`country` AS b_country,b.`email` AS b_email,b.`firstname` as b_firstname,b.`lastname` as b_lastname,b.`phone` as b_phone,b.`state` as b_state,b.`zipcode` as b_zipcode,s.`address` as s_address,s.`city` as s_city,s.`country` as s_country,s.`email` as s_email,s.`firstname` as s_firstname,s.`lastname` AS s_lastname,s.`phone` as s_phone,s.`state` as s_state,s.`zipcode` as s_zipcode FROM `orders` o LEFT JOIN `address` b ON o.`billaddr_id` = b.id LEFT JOIN `address` s ON o.`address_id`=s.id WHERE o.`id` = %d',$order_id);
$order = $wpdb->get_row($query,ARRAY_A);
$query = $wpdb->prepare('SELECT * FROM `order_products` WHERE `order_id` = %d',$order_id);
$list = $wpdb->get_results($query,ARRAY_A);
$shipping_fee = $order['shipping_fee'];
$sub_total = $order['total'] + $order['shipping_fee'];
?>
<link href="<?php echo $plugins_url ?>/order.css" type="text/css" rel="stylesheet">
<div class="wrap">
<h3 class="title">Order Detail</h3>
<table style="width:100%">
<tr>
	<td class="label">#</td>
	<td class="data">
		<?php echo $order['id']?>
	</td>
</tr>
<tr>
	<td class="label">Date order</td>
	<td class="data">
		<?php echo $order['time_create']?>
	</td>
</tr>
<tr>
	<td class="label">Total</td>
	<td class="data">
		<?php echo '$'.format_number($order['total'])?>
	</td>
</tr>
<tr>
	<td class="label">Shipping fee</td>
	<td class="data">
		<?php 
		if($order['shipping_fee'] > 0) {
			echo '$'.format_number($order['shipping_fee']);
		} else {
			echo 'N/A';
		}
		?>
	</td>
</tr>
<tr>
	<td class="label">Notes</td>
	<td class="data">
		<?php echo $order['notes']?>
	</td>
</tr>
<?php
if($order['paypal_id'] != '') {
?>
<tr>
	<td class="label">Paypal Id</td>
	<td class="data">
		<?php echo $order['paypal_id']?>
	</td>
</tr>
<tr>
	<td class="label">Payer Id</td>
	<td class="data">
		<?php echo $order['payer_id']?>
	</td>
</tr>
<tr>
	<td class="label">Payer Email</td>
	<td class="data">
		<?php echo $order['payer_email']?>
	</td>
</tr>
<tr>
	<td class="label">Payer Firstname</td>
	<td class="data">
		<?php echo $order['payer_firstname']?>
	</td>
</tr>
<tr>
	<td class="label">Payer Lastname</td>
	<td class="data">
		<?php echo $order['payer_lastname']?>
	</td>
</tr>
<?php
}
?>
<tr>
	<td class="label">Status</td>
	<td class="data">
		<?php 
		if($order['status'] < 0) {
			echo 'Cancel';
		} else if($order['status'] == 0) {
			echo 'Contact';
		} else if($order['status'] == 1) {
			echo 'Pending';
		} else if($order['status'] == 2) {
			echo 'Payed';
		}
		?>
	</td>
</tr>
</table>
<table style="width: 50%; float: left;">
<tr>
	<td colspan="2">
		<h3 class="title">Billing Address</h3>
	</td>
</tr>
<tr>
	<td class="label">Firstname</td>
	<td class="data">
		<?php echo $order['b_firstname']?>
	</td>
</tr>
<tr>
	<td class="label">Lastname</td>
	<td class="data">
		<?php echo $order['b_lastname']?>
	</td>
</tr>
<tr>
	<td class="label">Email</td>
	<td class="data">
		<?php echo $order['b_email']?>
	</td>
</tr>
<tr>
	<td class="label">Phone</td>
	<td class="data">
		<?php echo $order['b_phone']?>
	</td>
</tr>
<tr>
	<td class="label">Lastname</td>
	<td class="data">
		<?php echo $order['b_lastname']?>
	</td>
</tr>
<tr>
	<td class="label">Address</td>
	<td class="data">
		<?php echo $order['b_address']?>
	</td>
</tr>
<tr>
	<td class="label">City</td>
	<td class="data">
		<?php echo $order['b_city']?>
	</td>
</tr>
<tr>
	<td class="label">Country</td>
	<td class="data">
		<?php echo $order['b_country']?>
	</td>
</tr>
<tr>
	<td class="label">State</td>
	<td class="data">
		<?php echo $order['b_state']?>
	</td>
</tr>
<tr>
	<td class="label">Zipcode</td>
	<td class="data">
		<?php echo $order['b_zipcode']?>
	</td>
</tr>
</table>
<table style="width: 50%; float: left;">
<tr>
	<td colspan="2">
		<h3 class="title">Shipping Address</h3>
	</td>
</tr>
<tr>
	<td class="label">Firstname</td>
	<td class="data">
		<?php echo $order['s_firstname']?>
	</td>
</tr>
<tr>
	<td class="label">Lastname</td>
	<td class="data">
		<?php echo $order['s_lastname']?>
	</td>
</tr>
<tr>
	<td class="label">Email</td>
	<td class="data">
		<?php echo $order['s_email']?>
	</td>
</tr>
<tr>
	<td class="label">Phone</td>
	<td class="data">
		<?php echo $order['s_phone']?>
	</td>
</tr>
<tr>
	<td class="label">Lastname</td>
	<td class="data">
		<?php echo $order['s_lastname']?>
	</td>
</tr>
<tr>
	<td class="label">Address</td>
	<td class="data">
		<?php echo $order['s_address']?>
	</td>
</tr>
<tr>
	<td class="label">City</td>
	<td class="data">
		<?php echo $order['s_city']?>
	</td>
</tr>
<tr>
	<td class="label">Country</td>
	<td class="data">
		<?php echo $order['s_country']?>
	</td>
</tr>
<tr>
	<td class="label">State</td>
	<td class="data">
		<?php echo $order['s_state']?>
	</td>
</tr>
<tr>
	<td class="label">Zipcode</td>
	<td class="data">
		<?php echo $order['s_zipcode']?>
	</td>
</tr>
</table>
<h3 class="title">Products</h3>
<table style="margin-top: 15px; border: 1px solid rgb(187, 187, 187); width: 100%;" border="0" cellpadding="0">
<tbody>
	<tr style="background-color: rgb(233, 233, 233); font-weight: bold;">
		<td style="text-align: center;">Code</td>
		<td style="text-align: left;">Product</td>
		<td style="text-align: center;">Quantity</td>
		<td style="text-align: center;">Price</td>
		<td style="text-align: right;">Total</td>
	</tr>
	<?php
	foreach($list as $i => $item) {
		$total = $item['price'] * $item['quantity'];
		if($i % 2 == 0) {
			$tr_style = ' style="background-color: papayawhip;" ';
		} else {
			$tr_style = '';
		}
	?>
	<tr <?php echo $tr_style?>>
		<td style="width: 50px; text-align: center;"><?php echo $item['product_id']?></td>
		<td style="text-align: left;">
			<b><?php echo $item['product_name']?></b>
			<?php
			if(!empty($item['metal'])) echo '<br/>Metal: <b>'.$item['metal'].'</b>';
			if(!empty($item['size'])) echo '<br/>Size: <b>'.$item['size'].'</b>';
			?>
		</td>
		<td style="width: 50px; text-align: center;"><?php echo $item['quantity']?></td>
		<td style="width: 80px; text-align: center;">$<?php echo format_number($item['price'])?></td>
		<td style="width: 80px; text-align: right;">$<?php echo format_number($total)?></td>
	</tr>
	<?php
	}
	?>
</tbody>
<tfoot style="font-weight: bold; font-style: italic; color: red; background-color: rgb(233, 233, 233);">
	<tr>
		<td colspan="4" align="right">Shipping fee: </td>
		<td align="right">
		<?php
		if($shipping_fee == 0) {
			echo 'N/A';
		} else {
			echo '$'.format_number($shipping_fee);
		}
		?>
		</td>
	</tr>
	<tr>
		<td colspan="4" align="right">Total: </td>
		<td align="right">$<?php echo format_number($sub_total)?></td>
	</tr>
</tfoot>
</table>
</div>