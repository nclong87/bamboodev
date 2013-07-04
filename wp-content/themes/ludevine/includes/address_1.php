<form name="registerform" id="registerform" method="post" action="<?php echo DOMAIN?>/ajax" class="skip-auto-validation">
	<input type="hidden" name="action" value="sign-up"/>
	<fieldset class="registerform" id="personal_details">
	<ul class="first">
		<li class="single-field">
			If you already have an account please <a href="<?php echo DOMAIN?>/login?ref=/payment">sign in</a>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_firstname">First
		name</label><span class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[B][firstname]" id="b_firstname"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_lastname">Last
		name</label><span class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[B][lastname]" id="b_lastname"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="clearing"></li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_address">Address</label><span
			class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[B][address]" id="b_address"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_city">City</label><span
			class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[B][city]" id="b_city" autocomplete="off">
		</div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required"
			for="address_book_B_state">State</label><span class="star">*</span></div>
		<div class="data-value">
			<select style="width: 250px;"
			class="input-style" id="address_book_B_state"
			name="address_book[B][state]" autocomplete="off">
				<option value="">--Select State---</option>
				<?php
				foreach($states as $item) {
					echo '<option value="'.$item.'">'.$item.'</option>';
				}
				?>
			</select>
			<span style="display:none">The selected country doesn't require 'state' field</span>
		</div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_country">Country</label><span
			class="star">*</span></div>
		<div class="data-value">
			<select style="width: 250px;"
			class="input-style" id="b_country" name="address_book[B][country]"
			autocomplete="off">
			<?php
				foreach($countries as $item) {
					echo '<option value="'.$item.'">'.$item.'</option>';
				}
				?>
			</select>
		</div>
		</div>
		</li>
		<li class="fields-group">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_zipcode">Zip/Postal
		code</label><span class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[B][zipcode]" class="zipcode billing"
			id="b_zipcode" autocomplete="off"></div>
		</div>
		</li>
		<li class="fields-group last">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_phone">Phone</label><span
			class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[B][phone]" id="b_phone"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="clearing"></li>
	</ul>
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
	<div id="ship2diff_box" style="display: none;">
	<ul class="first">
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_firstname">First
		name</label><span class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[S][firstname]" id="s_firstname"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_lastname">Last
		name</label><span class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[S][lastname]" id="s_lastname"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="clearing"></li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_address">Address</label><span
			class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[S][address]" id="s_address"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_city">City</label><span
			class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[S][city]" id="s_city" autocomplete="off">
		</div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required"
			for="address_book_S_state">State</label><span class="star">*</span></div>
		<div class="data-value">
			<select style="width: 250px;"
			class="input-style" id="address_book_S_state"
			name="address_book[S][state]" autocomplete="off">
				<option value="">--Select State---</option>
				<?php
				foreach($states as $item) {
					echo '<option value="'.$item.'">'.$item.'</option>';
				}
				?>
			</select>
			<span style="display:none">The selected country doesn't require 'state' field</span>
		</div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_country">Country</label><span
			class="star">*</span></div>
		<div class="data-value">
			<select style="width: 250px;"
			class="input-style" id="s_country" name="address_book[S][country]"
			autocomplete="off">
			<?php
				foreach($countries as $item) {
					echo '<option value="'.$item.'">'.$item.'</option>';
				}
				?>
			</select>
		</div>
		</div>
		</li>
		<li class="fields-group">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_zipcode">Zip/Postal
		code</label><span class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[S][zipcode]" class="zipcode shipping"
			id="s_zipcode" autocomplete="off"></div>
		</div>
		</li>
		<li class="fields-group last">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="s_phone">Phone</label><span
			class="star">*</span></div>
		<div class="data-value"><input type="text" value="" maxlength="32"
			size="32" name="address_book[S][phone]" id="s_phone"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="clearing"></li>
	</ul>
	</div>
	<div align="center" class="button-row" style="float: left; margin-top: 5px; margin-left: 17px;">
		<input class="button" type="button" title="Continue" id="btSubmit" value="Continue"/>
	</div>
	</fieldset>
</form>
<script>
jQuery(document).ready(function(){	
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
				return false;
			} else if($('input#b_lastname').val() == '' ) {
					alert("The required field 'Last name' is empty!");
					markErrorField('b_lastname');
					return false;
			} else if($('input#b_address').val() == '' ) {
					alert("The required field 'Address' is empty!");
					markErrorField('b_address');
					return false;					
			} else if($('input#b_address').val() == '' ) {
					alert("The required field 'Address' is empty!");
					markErrorField('b_address');
					return false;					
			} else if($('input#b_city').val() == '' ) {
					alert("The required field 'City' is empty!");
					markErrorField('b_city');
					return false;										
			} else if($('select#address_book_B_state').val() == '' ) {
					alert("The required field 'State' is not selected!");
					markErrorField('address_book_B_state');
					return false;										
			} else if($('select#b_country').val() == '' ) {
					alert("The required field 'Country' is not selected!");
					markErrorField('b_country');
					return false;										
			} else if($('input#b_zipcode').val() == '' ) {
					alert("The required field 'Zip Code' is empty!");
					markErrorField('b_zipcode');
					return false;										
			} else if($('input#b_phone').val() == '' ) {
					alert("The required field 'Phone' is empty!");
					markErrorField('b_phone');
					return false;										
			} else {
				if($('#ship2diff').attr('checked')){
					if($('input#s_firstname').val() == '' ) {
						alert("The required field 'First name' is empty!");
						markErrorField('s_firstname');
						return false;					
					} else if($('input#s_lastname').val() == '' ) {
							alert("The required field 'Last name' is empty!");
							markErrorField('s_lastname');
							return false;					
					} else if($('input#s_address').val() == '' ) {
							alert("The required field 'Address' is empty!");
							markErrorField('s_address');
							return false;												
					} else if($('input#s_address').val() == '' ) {
							alert("The required field 'Address' is empty!");
							markErrorField('s_address');
							return false;																			
					} else if($('input#s_city').val() == '' ) {
							alert("The required field 'City' is empty!");
							markErrorField('s_city');
							return false;																			
					} else if($('select#address_book_S_state').val() == '' ) {
							alert("The required field 'State' is not selected!");
							markErrorField('address_book_S_state');
							return false;																			
					} else if($('select#s_country').val() == '' ) {
							alert("The required field 'Country' is not selected!");
							markErrorField('s_country');
							return false;																			
					} else if($('input#s_zipcode').val() == '' ) {
							alert("The required field 'Zip Code' is empty!");
							markErrorField('s_zipcode');
							return false;																			
					} else if($('input#s_phone').val() == '' ) {
							alert("The required field 'Phone' is empty!");
							markErrorField('s_phone');
							return false;												
					}
				}
			}
			this.disabled = true;
			$('#registerform').submit();
	});
	$("#b_country").change(function(){
		var selectState = $("#address_book_B_state");
		if(this.value == 'United States') {
			selectState.show();
			selectState.next().hide();
		} else {
			selectState.val("");
			selectState.hide();
			selectState.next().show();
		}
	});
	$("#s_country").change(function(){
		var selectState = $("#address_book_S_state");
		if(this.value == 'United States') {
			selectState.show();
			selectState.next().hide();
		} else {
			selectState.val("");
			selectState.hide();
			selectState.next().show();
		}
	});
});
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/validation.js" type="text/javascript"></script>