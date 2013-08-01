<?php
/*
Template Name: Success
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Order success</title>
<link href="<?php echo get_template_directory_uri(); ?>/payment.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<?php
$orderId = getParam('order_id');
?>
<center>
<div id="main">
	<a href="http://www.ludevine.com" class="logo">LUDEVINE</a>
	<h2>YOU'RE CHECKED OUT!</h2>
	<h3 style="font-size: 12px; font-weight: normal;">NEED HELP? Email to <a href="mailto:info@ludevine.com">info@ludevine.com</a></h3>
	<div style="display: block; height: 300px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); text-align: center; padding-top: 30px;">
		<span style="display: block; font-size: 30px; font-weight: bold; padding-bottom: 20px;">THANK YOU!</span>
		An order confirmation email with tracking details will be sent to you shortly.<br/>
		ORDER NUMBER: <?php echo $orderId?>
	</div>
</div>
</center>
</body>
</html>