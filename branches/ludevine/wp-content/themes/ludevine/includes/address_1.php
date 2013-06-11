<ul class="first">
	<li class="fields-group">
	<div class="field-container">
	<div class="data-name"><label class="data-required" for="b_firstname">First
	name</label><span class="star">*</span></div>
	<div class="data-value"><input type="text" value="" maxlength="32"
		size="32" name="address_book[B][firstname]" id="b_firstname"
		autocomplete="off"></div>
	</div>
	</li>
	<li class="fields-group last">
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
			<?php
			foreach($states as $item) {
				echo '<option value="'.$item.'">'.$item.'</option>';
			}
			?>
		</select>
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
	<li style="display: none"><span style="display: none;"> <input
		type="text" value="NY" id="b_country_state_value" autocomplete="off">
	<input type="text" value="" id="b_country_county_value"
		autocomplete="off"> </span></li>
</ul>