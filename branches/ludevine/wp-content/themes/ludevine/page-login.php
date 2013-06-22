<?php
/*
Template Name: Login
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Login</title>
<link href="<?php echo get_template_directory_uri(); ?>/payment.css" type="text/css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.min.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body class="center">
<center>
<div class="wrap_center">
	<form id="frmLogin" action="<?php echo DOMAIN?>/ajax" method="post">
	<input type="hidden" name="action" value="login"/>
	<table>
		<tr>
			<td colspan="2" align="left"><h3 style="margin: 0px 0px 5px; border-bottom: 1px dashed gray;">Login</h3></td>
		</tr>
		<tr>
			<td id="message" colspan="2" align="left"></td>
		</tr>
		<tr>
			<td style="width:70px">Email</td>
			<td>
				<input type="text" id="email" name="email" value="" placeholder="email"/>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" id="password" name="password" placeholder="password"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="Login" id="btSubmit"/>
				<a href="<?php echo DOMAIN.getParam('ref')?>" style="display: block; text-decoration: none; text-align: right;">Back</a>
			</td>
		</tr>
	</table>
	</form>
</div>
</center>
</body>
</html>
<script type="text/javascript">
var ref = '<?php echo getParam('ref')?>';
var baseUrl = '<?php echo DOMAIN?>';
$(function() {
	$('#frmLogin').ajaxForm(function(response) {
		response = jQuery.parseJSON(response);
		if(response.code == 1) {
			location.href = baseUrl + ref;
		} else {
			$("#message").html('<span class="error_msg">'+response.data+'</span>');
			$("#btSubmit")[0].disabled = false;
			location.href = "#message";
		}
	});
	$("#btSubmit").click(function(){
		this.disabled = true;
		$('#frmLogin').submit();
	});
});
</script>