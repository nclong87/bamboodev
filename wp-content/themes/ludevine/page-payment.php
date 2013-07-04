<?php
/*
Template Name: Payment
*/
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
if(empty($cart)) {
	wp_redirect(DOMAIN.'/');
	exit;
}
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
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.min.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script>
var baseUrl = '<?php echo DOMAIN ?>';
var selected_country = 'United States';
</script>
</head>
<body>
<center>
<div id="main">
	<h1 style="font-size: 30px; font-weight: normal; margin-bottom: 10px; margin-top: 10px;">Wrap it up! Check out in one page!</h1>
	<div id="message">
	<?php
	$error_code = getParam('error_code');
	if(!empty($error_code)) {
		require 'includes/messages.php';
		echo '<span class="error_msg">'.Messages::getErrorMessage($error_code).'<span>';
	}
	?>
	</div>
    <div id="payment_profile" class="payment-section" style="text-align: left; float: left; width: 300px;">
	<h2><span class="black circle">1</span>Name and address</h2>
	<?php
	require 'includes/order.php';
	if(isset($_SESSION['shippingAddr'])) {
		require 'includes/address_2.php';
	} else {
		require 'includes/address_1.php';
	}
	?>
</div> 
<?php require 'includes/payment_order_summary.php';?>
</div>
</center>
</body>
</html>
<script type="text/javascript">
var selected_country = 'United States';
$(function() {
	$("#b_country,#s_country").val(selected_country);
	$('#registerform').ajaxForm(function(response) {
		response = jQuery.parseJSON(response);
		if(response.code == 1) {
			location.href = baseUrl + "/payment";
		} else {
			alert(response.data);
			$("#message").html('<span class="error_msg">'+response.data+'</span>');
			$("#btSubmit")[0].disabled = false;
			location.href = "#message";
		}
	});
	$("#btSubmit").click(function(){
		/*resetMarkedErrorFields();
		if($('input#firstname').is(':visible')) {
			if($('input#firstname').val() == '' ) {
					alert("The required field 'First name' is empty!");
					markErrorField('firstname');
			} else if($('input#lastname').val() == '' ) {
					alert("The required field 'Last name' is empty!");
					markErrorField('lastname');
			} else if($('input#address').val() == '' ) {
					alert("The required field 'Address' is empty!");
					markErrorField('address');		
			} else if($('input#address').val() == '' ) {
					alert("The required field 'Address' is empty!");
					markErrorField('address');		
			} else if($('input#city').val() == '' ) {
					alert("The required field 'City' is empty!");
					markErrorField('city');		
			} else if($('select#address_book_state').val() == '' ) {
					alert("The required field 'State' is not selected!");
					markErrorField('address_book_state');		
			} else if($('select#country').val() == '' ) {
					alert("The required field 'Country' is not selected!");
					markErrorField('country');		
			} else if($('input#zipcode').val() == '' ) {
					alert("The required field 'Zip Code' is empty!");
					markErrorField('zipcode');		
			} else if($('input#phone').val() == '' ) {
					alert("The required field 'Phone' is empty!");
					markErrorField('phone');		
			}else{
					this.disabled = true;
					$('#registerform').submit();
			} 
		}else{
			
        }*/
		//this.disabled = true;
		//$('#registerform').submit();
	});
	$('#email')
		.live('blur submit', function(){
		$('#email_note').hide();
		})
		.live('focus', function(){
		showNote('email_note', this)
		}); 
	
});

/**
* Show note next to element
*/
function showNote(id, next_to) {
	if ( typeof showNote.isReadyToShow == 'undefined' ) {
	showNote.isReadyToShow = true;
	}
	if (
	showNote.isReadyToShow
	&& $('#' + id).css('display') == 'none'
	) {
	showNote.isReadyToShow = false;
	var div = $('#' + id).get();
	$('#' + id).remove();
	$('body').append(div);
	$('#' + id).show();
	var sw = getRealWidth('#' + id);
	$('#' + id).css('left', $(next_to).offset().left + $(next_to).width() + 'px');
	$('#' + id).css('top', $(next_to).offset().top + 'px');
	if (sw > $('#' + id).width()) {
	$('#' + id).css('width', sw + 'px');
	}
	showNote.isReadyToShow = true;
	}
} 

function getRealWidth(jsel) {
	var sw = $(jsel).attr('scrollWidth');
	if ($.browser.opera)
	return sw;
	var pl = parseInt($(jsel).css('padding-left'));
	if (!isNaN(pl)) sw -= pl;
	var pr = parseInt($(jsel).css('padding-right'));
	if (!isNaN(pr))
	sw -= pr;
	return sw;
}

</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/validation.js" type="text/javascript"></script>