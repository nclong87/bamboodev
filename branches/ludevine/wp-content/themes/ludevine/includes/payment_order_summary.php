<?php
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
$nItem = 0;
$total = 0;
$shippingCost = PAYMENT_SHIPPING_FEE;
$disabled = '';
if(isset($shippingAddr)) {
	if($shippingAddr['country'] != 'United States') {
		$shippingCost = 0;
	}
} else {
	$disabled = 'disabled';
}
foreach($cart as $item) {
	$nItem++;
	$total+=$item['total'];
}
?>
<div id="payment_summary" style="background-color: rgb(244, 244, 244); text-align: left; float: right; width: 300px;" class="payment-section last">
  <h2><span class="black circle">2</span>Order summary</h2>
  <div id="payment_totals" class="cart-totals">
  <table cellspacing="0" summary="Total" class="totals">
    <tbody>
		<tr>
			<td class="total-name">Subtotal ( <a title="Your cart" id="cart-contents-link" class="dotted toggle-link" href="<?php echo DOMAIN.'/checkout'?>"><?php echo $nItem?> item(s)</a> ):</td>
			<td class="total-value">$<?php echo format_number($total) ?></td>
		</tr>
		<tr id="cart-contents-box" style="display:none;">
			<td colspan="3"></td>
		</tr>
		<tr>
			<td class="total-name dcoupons-clear">
			Shipping cost:
			</td>
			<td class="total-value">
			<?php
			if($shippingCost == 0) {
				echo 'N/A';
			} else {
				echo '$'.format_number($shippingCost);
			}
			?>
			</td>
		</tr>
		<tr>
			<td class="total-name dcoupons-clear">
			<span style="font-size:20px">Total:</span>
			</td>
			<td class="total-value"><span class="currency" style="font-size:20px">$<?php echo format_number($total + $shippingCost) ?></span></td>
		</tr>
	</tbody>
  </table>
  <form method="post" action="<?php echo DOMAIN?>/paypal" id="frmPaypal">
  <div class="checkout-customer-notes">
    <label for="customer_notes">Customer notes:</label>
    <textarea <?php echo $disabled?> name="notes" id="customer_notes" rows="3" cols="44"></textarea>
	<?php
	if($shippingCost == 0) {
		echo '<input style="margin-top: 10px; margin-right: -2px;" class="button" type="submit" value="Order Now!" id="btSubmitOrderNow"/>';
	} else {
		echo '<input '.$disabled.' class="button" type="submit" value="Checkout with PayPal" id="btSubmitCheckoutPaypal" style="margin-top: 10px; margin-right: -2px;"/>';
	}
	?>
  </div>
  </form>
</div>
</div>
<script type="text/javascript">
$(function() {
	$('#frmPaypal').submit(function(){
		$("input",this).attr("disabled","true");
		return true;
	});
});
</script>