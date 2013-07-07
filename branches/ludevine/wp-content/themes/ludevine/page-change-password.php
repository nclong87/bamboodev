<?php
/*
Template Name: Change Password 
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Change Password</title>
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
	$email = getParam('email');
	if(!empty($email)) {
	?>
	<div>
		<strong>An email has been sent to <?php echo $email?> which is the primary email address for your account.</strong> It includes information on changing and confirming your new password. Please reset your password within the next 6 hours.
	</div>
	<?php
	} else {
	?>
	<form id="form" action="<?php echo DOMAIN?>/ajax" method="post" onsubmit="return false">
	<input type="hidden" name="action" value="change_password"/>
	<table style="width:335px">
		<tr>
			<td colspan="2" align="left"><h3 style="margin: 0px 0px 5px; border-bottom: 1px dashed gray;">Change your password</h3></td>
		</tr>
		<tr>
			<td id="message" colspan="2" align="left"></td>
		</tr>
		<tr>
			<td style="width:110px" valign="top">Password</td>
			<td>
				<input type="password" id="passwd1" name="passwd1" placeholder="Your new password" style="width:99%"/>
			</td>
		</tr>
		<tr>
			<td valign="top">Confirm password</td>
			<td>
				<input type="password" id="passwd2" name="passwd2" placeholder="Confirm your new password" style="width:99%"/>
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
	<?php
	}
	?>
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
			"passwd1" : {
				required : true,
				minlength: 6
			},
			"passwd2" : {
				required : true,
				equalTo: "#passwd1"
			}
		},
		submitHandler : function(form){
			var bt = $("#btSubmit")[0];
			bt.disabled = true;
			$.ajax({
				url: baseUrl + "/ajax",
				type: "POST",
				data: $(form).serialize(),
				success: function(response) {
					response = jQuery.parseJSON(response);
					bt.disabled = false;
					if(response.code == 1) {
						$("#message").html('<span class="success_msg">Change your password successfully!</span>');
					} else {
						$("#message").html('<span class="error_msg">'+response.data+'</span>');
					}
					location.href = "#message";
				},
				error : function() {
					$("#message").html('<span class="error_msg">'+MSG_SYSTEM_ERROR+'</span>');
					bt.disabled = false;
					location.href = "#message";
				}
			});
		}
	});
});
</script>