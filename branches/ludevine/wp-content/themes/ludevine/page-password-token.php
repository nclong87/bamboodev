<?php
/*
Template Name: Password Token
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Password Token</title>
<link href="<?php echo get_template_directory_uri(); ?>/payment.css" type="text/css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
label.error {
  color: red;
  display: block;
}
</style>
</head>
<body class="center">
<center>
<div class="wrap_center">
	<?php
	$code = getParam('code');
	$message = '';
	if(!empty($code)) {
		require 'includes/date.php';
		global $wpdb;
		$now = time();
		$query = $wpdb->prepare('SELECT * FROM `keys` WHERE `status` = 1 AND `expired` > %s AND `key` = %s',Date::time2SqlDate($now),$code);
		$row = $wpdb->get_row($query,ARRAY_A);
		if($row == null) {
			$message = 'Sorry that password token is not recognized, please try entering it again or get another password token.';
		} else {
			$wpdb->update('keys', array('status' => '0','use_time' => Date::getCurrentDateSQL()), array('id' => $row['id']));
			require 'includes/customer.php';
			$customer = Customer::findById($row['customer_id']);
			if($customer == null) die('Your email address is not registered');
			if($customer['status'] != 1) die('This account has been blocked');
			$_SESSION['customer'] = $customer;
			$bAddress = Customer::findAddressById($customer['address_id']);
			$_SESSION['billAddr'] = $bAddress;
			$sArress = Customer::findShippingInfo($customer['id']);
			if($sArress != null) {
				$_SESSION['shippingAddr'] = $sArress;
			}
			wp_redirect(DOMAIN.'/change-password');
			exit;
		}
	}
	?>
	<form id="form" action="" method="post">
	<table style="width:285px">
		<tr>
			<td colspan="2" align="left"><h3 style="margin: 0px 0px 5px; border-bottom: 1px dashed gray;">Enter your code</h3></td>
		</tr>
		<tr>
			<td id="message" colspan="2" align="left">
		<?php 
		if(!empty($message)) {
			?>
			<span class="error_msg"><?php echo $message?></span>
			<?php
		}
		?>
			</td>
		</tr>
		<tr>
			<td style="width:70px" valign="top">Code</td>
			<td>
				<input type="text" id="code" name="code" value="<?php echo $code?>" placeholder="Enter your temporary code" style="width:99%"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="Submit" id="btSubmit"/>
				<a href="<?php echo DOMAIN?>/" style="display: block; text-decoration: none; text-align: right;">Back to Ludevine</a>
			</td>
		</tr>
	</table>
	</form>
</div>
</center>
</body>
</html>
<script type="text/javascript">
var baseUrl = '<?php echo DOMAIN?>';
$(function() {
	$("#form").validate({
		onkeyup : false,
		//onfocusout : false,
		rules : {
			"code" : {
				required : true
			}
		}
	});
});
</script>