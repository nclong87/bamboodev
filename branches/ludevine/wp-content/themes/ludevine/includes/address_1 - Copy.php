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
<script>
jQuery(document).ready(function(){	
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
});
</script>