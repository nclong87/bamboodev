<?php
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
$nItem = 0;
$total = 0;
$shippingCost = 20;
foreach($cart as $item) {
	$nItem++;
	$total+=$item['total'];
}
?>
<li id="payment_summary_li" class="payment-section last">
<div id="payment_summary">
  <h2>Order summary</h2>
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
			<td class="total-value">$<?php echo format_number($shippingCost) ?></td>
		</tr>
		<tr>
			<td class="total-name dcoupons-clear">
			<span style="font-size:20px">Total:</span>
			</td>
			<td class="total-value"><span class="currency" style="font-size:20px">$<?php echo format_number($total + $shippingCost) ?></span></td>
		</tr>
	</tbody>
  </table>
  <hr>
</div>
<!--div class="coupon-info" id="payment_coupon">
  <div style="display:none;" id="coupon-applied-container">
    <strong>Discount coupon applied</strong>
    <a title="Unset coupon" href="cart.php?mode=unset_coupons" class="dotted unset-coupon-link">Unset coupon</a>
  </div>
  <hr>
</div-->
</div>

<form method="post" action="<?php echo DOMAIN?>/paypal" id="form">
	<input type="submit" value="" class="wp_cart_checkout_button" src="<?php bloginfo('template_url'); ?>/images/paypal_checkout_EN.png" />
</form>
</li>