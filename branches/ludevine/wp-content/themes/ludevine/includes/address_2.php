<div id="ship2diff_box" style="display: none;">
<ul class="first">
	<li class="fields-group">
	<div class="field-container">
	<div class="data-name"><label class="data-required" for="s_firstname">First
	name</label><span class="star">*</span></div>
	<div class="data-value"><input type="text" value="" maxlength="32"
		size="32" name="address_book[S][firstname]" id="s_firstname"
		autocomplete="off"></div>
	</div>
	</li>
	<li class="fields-group last">
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
<script>
jQuery(document).ready(function(){	
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