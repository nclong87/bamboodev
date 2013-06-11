<?php
/*
Template Name: Payment
*/
$countries = Utils::loadAllCountry();
$states = Utils::loadState();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Profile Details :: Checkout</title>
<link href="<?php echo get_template_directory_uri(); ?>/payment.css" type="text/css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/temp_payment.css" type="text/css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<center>
<div id="main">
	<h1 style="margin-top: 30px; margin-bottom: 30px; font-size: 30px; font-weight: normal;">Wrap it up! Check out in one page!</h1>
<ul id="payment-sections">
  <li class="payment-section">
    <div id="payment_profile">
  <h2>Name and address</h2>
    <form name="registerform" method="post" action="cart.php?mode=checkout" class="skip-auto-validation">
      <fieldset class="registerform" id="personal_details">
		<?php require_once 'includes/address_1.php';?>
		<ul>
			<li class="single-field">
			<div class="field-container">
			<div class="data-name">
			<label class="data-required" for="email">Email</label><span class="star">*</span>
			</div>
			<div class="data-value">
			<input type="text" value="" maxlength="128" size="32" class="input-required input-email" name="email" id="email" autocomplete="off">
			<div style="display: none;" class="note-box" id="email_note">Make sure you enter a valid email address because the store will send you notifications to this address.</div>
			</div>
			</div>
			</li>
		</ul>
		<ul id="create_account_box" style="display: none;">
			<li class="single-field">
			<div class="field-container">
			<div class="data-name">
			<label class="data-required" for="passwd1">Password</label><span class="star">*</span>
			</div>
			<div class="data-value">
			<input type="hidden" value="N" id="password_is_modified" name="password_is_modified" autocomplete="off">
			<input type="password" value="" maxlength="64" size="32" name="passwd1" id="passwd1" autocomplete="off">
			</div>
			</div>
			<div class="field-container">
			<div class="data-name">
			<label class="data-required" for="passwd2">Confirm password</label><span class="star">*</span>
			</div>
			<div class="data-value">
			<input type="password" value="" maxlength="64" size="32" name="passwd2" id="passwd2" autocomplete="off">
			<span class="validate-mark"><img width="15" height="15" alt="" src="/skin/common_files/images/spacer.gif"></span>
			</div>
			</div>
			</li>
		</ul>
		<div class="optional-label">
			<label for="create_account" class="pointer" style="height:20px">
			<input type="checkbox" onclick="javascript: $('#create_account_box').toggle();" value="Y" name="create_account" autocomplete="off" id="create_account">
			Create account for this Email
			</label>
			<label for="ship2diff" class="pointer">
			<input type="checkbox" onclick="javascript: $('#ship2diff_box').toggle();" value="Y" name="ship2diff" id="ship2diff" autocomplete="off">
			Ship to a different address
			</label>
		</div>
		<?php require_once 'includes/address_2.php';?>
        <div align="center" class="button-row" style="float: right;">
			<button title="Continue" type="submit" >
			<span class="button-right"><span class="button-left">Continue</span></span>
			</button>
        </div>
      </fieldset>
    </form>
</div>  </li>
  <li id="payment_shipping_payment" class="payment-section">
              <div id="payment_shipping">
  <h2>Shipping method</h2>
  <form name="shippingsform" method="post" action="cart.php">
    <input type="hidden" value="checkout" name="mode" disabled="" autocomplete="off">
    <input type="hidden" value="cart_operation" name="cart_operation" disabled="" autocomplete="off">
    <input type="hidden" value="update" name="action" disabled="" autocomplete="off">
    <div class="payment-section-container payment-shipping-options">
  <div >$20 flat rate for packaging and shipping throughout the US</div>
  <div class="checkout-customer-notes">
    <label for="customer_notes">Customer notes:</label>
    <textarea name="Customer_Notes" id="customer_notes" rows="3" cols="47"></textarea>
  </div>
  <input type="hidden" value="0" name="shippingid" disabled="" autocomplete="off">
      <div class="clearing"></div>
    </div>
  </form>
</div>
<?php require_once 'includes/payment_order_summary.php';?>
</ul>
</div>
</center>
</body>
</html>
<script type="text/javascript">
var selected_country = 'United States';
$(function() {
	$("#b_country,#s_country").val(selected_country);
});
</script>