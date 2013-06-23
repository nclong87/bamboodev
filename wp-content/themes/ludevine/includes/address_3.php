<form name="registerform" id="registerform" method="post" action="<?php echo DOMAIN?>/ajax" class="skip-auto-validation">
	<input type="hidden" name="action" value="save-shipping"/>
	<input type="hidden" name="id" value="<?php echo $address['id']?>"/>
	<fieldset class="registerform" id="personal_details">
	<ul class="first">
		<?php
		if(!isset($_SESSION['customer'])){
		?>
		<li class="single-field">
		If you already have an account please <a href="<?php echo DOMAIN?>/login?ref=/payment">sign in</a>
		</li>
		<?php
		} else {
		?>
		<li class="single-field">
		Hello <?php echo $_SESSION['customer']['fullname']?>. <a href="<?php echo DOMAIN?>/process?action=logout&ref=/payment">Logout</a>
		</li>
		<?php
		}
		?>
		<li>
		<input type="checkbox" id="chkChangeShippingAddr" style="margin-right: 6px;"> <label for="chkChangeShippingAddr">Change your shipping address.</label>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_firstname">First
		name</label><span class="star">*</span></div>
		<div class="data-value"><input class="input" disabled type="text" value="<?php echo $address['firstname']?>" maxlength="32" size="32" name="address_book[firstname]" id="firstname"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_lastname">Last
		name</label><span class="star">*</span></div>
		<div class="data-value"><input class="input" disabled type="text" value="<?php echo $address['lastname']?>" maxlength="32" size="32" name="address_book[lastname]" id="lastname"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="clearing"></li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_address">Address</label><span
			class="star">*</span></div>
		<div class="data-value"><input class="input" disabled type="text" value="<?php echo $address['address']?>" maxlength="32" size="32" name="address_book[address]" id="address"
			autocomplete="off"></div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_city">City</label><span
			class="star">*</span></div>
		<div class="data-value"><input class="input" disabled type="text" value="<?php echo $address['city']?>" maxlength="32" size="32" name="address_book[city]" id="city" autocomplete="off">
		</div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required"
			for="address_book_B_state">State</label><span class="star">*</span></div>
		<div class="data-value">
			<select disabled style="width: 250px;"
			class="input-style input" id="address_book_state"
			name="address_book[state]" autocomplete="off">
				<option value="">--Select State---</option>
				<?php
				foreach($states as $item) {
					if($item == $address['state']) 
						echo '<option selected value="'.$item.'">'.$item.'</option>';
					else
						echo '<option value="'.$item.'">'.$item.'</option>';
				}
				?>
			</select>
			<span style="display:none" id="s3_non_state">The selected country doesn't require 'state' field</span>
		</div>
		</div>
		</li>
		<li class="single-field">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_country">Country</label><span
			class="star">*</span></div>
		<div class="data-value">
			<select disabled style="width: 250px;"
			class="input-style input" id="country" name="address_book[country]"
			autocomplete="off">
			<?php
				foreach($countries as $item) {
					if($item == $address['country']) 
						echo '<option selected value="'.$item.'">'.$item.'</option>';
					else
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
		<div class="data-value"><input class="input" disabled type="text" value="<?php echo $address['zipcode']?>" maxlength="32" size="32" name="address_book[zipcode]" class="zipcode billing" id="zipcode" autocomplete="off"></div>
		</div>
		</li>
		<li class="fields-group last">
		<div class="field-container">
		<div class="data-name"><label class="data-required" for="b_phone">Phone</label><span
			class="star">*</span></div>
		<div class="data-value"><input class="input" disabled type="text" value="<?php echo $address['phone']?>" maxlength="32" size="32" name="address_book[phone]" id="phone"
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
		<input disabled type="text" value="<?php echo $address['email']?>" maxlength="128" size="32" class="input-required input-email input" name="email" id="email" autocomplete="off">
		</div>
		</div>
		</li>
		<li >
			<input class="button" type="submit" value="Save" style="display:none" id="btSubmit"/>
		</li>
	</ul>
	</fieldset>
</form>
<script>
jQuery(document).ready(function(){	
	$("#chkChangeShippingAddr").click(function(){
		if(this.checked == true) {
			$("#registerform .input").removeAttr("disabled");
			$("#btSubmit").show();
			$("#frmPaypal input").attr("disabled","true");
		} else {
			$("#registerform .input").attr("disabled","true");
			$("#btSubmit").hide();
			$("#frmPaypal input").removeAttr("disabled");
		}
	});
	$("#country").change(function(){
		if(this.value == 'United States') {
			$("#address_book_state").show();
			$("#s3_non_state").hide();
		} else {
			$("#address_book_state").val("");
			$("#address_book_state").hide();
			$("#s3_non_state").show();
		}
	});
});
</script>