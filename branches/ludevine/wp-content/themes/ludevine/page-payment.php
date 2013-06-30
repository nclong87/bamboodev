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
		$address = $_SESSION['shippingAddr'];
		require 'includes/address_3.php';
	} else {
	?>
	<form name="registerform" id="registerform" method="post" action="<?php echo DOMAIN?>/ajax" class="skip-auto-validation">
		<input type="hidden" name="action" value="sign-up"/>
      <fieldset class="registerform" id="personal_details">
		<?php require 'includes/address_1.php';?>
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
			</div>
			</div>
			</li>
		</ul>
		<ul>
			<li>
			<label for="create_account" class="pointer" style="height:20px">
			<input type="checkbox" onclick="javascript: $('#create_account_box').toggle();" value="Y" name="create_account" autocomplete="off" id="create_account">
			Create account for this Email
			</label>
			</li>
			<li>
			<label for="ship2diff" class="pointer">
			<input type="checkbox" onclick="javascript: $('#ship2diff_box').toggle();" value="Y" name="ship2diff" id="ship2diff" autocomplete="off">
			Ship to a different address
			</label>
			</li>
		</ul>
		<?php require 'includes/address_2.php';?>
        <div align="center" class="button-row" style="float: left; margin-top: 5px; margin-left: 17px;">
			<input class="button" type="button" title="Continue" id="btSubmit" value="Continue"/>
        </div>
      </fieldset>
    </form>
	<?php
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
		resetMarkedErrorFields();
		if($('input#b_firstname').val() == '' ) {
            alert("The required field 'First name' is empty!");
			markErrorField('b_firstname');
			
		} else if($('input#b_lastname').val() == '' ) {
				alert("The required field 'Last name' is empty!");
				markErrorField('b_lastname');
		} else if($('input#b_address').val() == '' ) {
				alert("The required field 'Address' is empty!");
				markErrorField('b_address');		
        } else if($('input#b_address').val() == '' ) {
				alert("The required field 'Address' is empty!");
				markErrorField('b_address');		
        } else if($('input#b_city').val() == '' ) {
				alert("The required field 'City' is empty!");
				markErrorField('b_city');		
        } else if($('select#address_book_B_state').val() == '' ) {
				alert("The required field 'State' is not selected!");
				markErrorField('address_book_B_state');		
        } else if($('#b_country').val() == '' ) {
				alert("The required field 'Country' is not selected!");
				markErrorField('b_country');		
        } else if($('input#b_zipcode').val() == '' ) {
				alert("The required field 'Zip Code' is empty!");
				markErrorField('b_zipcode');		
        } else if($('input#b_phone').val() == '' ) {
				alert("The required field 'Phone' is empty!");
				markErrorField('b_phone');		
        } else {
			this.disabled = true;
            $('#registerform').submit();
        };
		
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

/**
* Mark an input field as error one
*/
function markErrorField(id){
	var div = $('#' + id).get();
	$("label[for='"+id+"']").css('color', 'red');
	$('#' + id).css('border', '1px solid red');
	$('#' + id).css('background-color', '#FFEBEB');
}

/**
* Reset an input field from marked as error to normal state
*/
function unmarkErrorField(id){
	var div = $('#' + id).get();
	$("label[for='"+id+"']").css('color', 'black');
	$('#' + id).css('border', '1px solid black');
	$('#' + id).css('background-color', 'white');
}

function resetMarkedErrorFields(){
	unmarkErrorField('b_firstname');
	unmarkErrorField('b_lastname');
	unmarkErrorField('b_address');
	unmarkErrorField('b_city');
	unmarkErrorField('address_book_B_state');
	unmarkErrorField('b_country');
	unmarkErrorField('b_zipcode');
	unmarkErrorField('b_phone');
}
</script>