<?php	 	
/*
Template Name: Payment
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ludevine :: Profile Details :: Checkout</title>
<link href="<?php echo get_template_directory_uri(); ?>/payment.css" type="text/css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/temp_payment.css" type="text/css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<center>
<div id="main">
	<h1 style="margin-top: 30px; margin-bottom: 30px; font-size: 30px; font-weight: normal;">Wrap it up! Check out in one page!</h1>
<ul id="payment-sections">
  <li class="payment-section">
    <div id="payment_profile">
  <h2>Name and address</h2>
    <form name="registerform" method="post" action="cart.php?mode=checkout" class="skip-auto-validation">
      <fieldset class="registerform" id="personal_details">

        <input type="hidden" value="C" name="usertype" autocomplete="off">
        <input type="hidden" value="Y" name="anonymous" autocomplete="off">
        <input type="hidden" value="8a13300997a144440d570c79372cc7dd" name="xid_c84cc" autocomplete="off">
<ul class="first">                           
    <li class="fields-group"> 
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_firstname">First name</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
          <input type="text" value="" maxlength="32" size="32" name="address_book[B][firstname]" id="b_firstname" autocomplete="off">

              
  </div>
  </div>
    </li>

    
  
                                                    
    <li class="fields-group last">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_lastname">Last name</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
          <input type="text" value="" maxlength="32" size="32" name="address_book[B][lastname]" id="b_lastname" autocomplete="off">

              
  </div>
  </div>
    </li>

          <li class="clearing"></li>
    
  
                        
    <li class="single-field">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_address">Address</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
          <input type="text" value="" maxlength="32" size="32" name="address_book[B][address]" id="b_address" autocomplete="off">

              
  </div>
  </div>
    </li>

    
  
                        
    <li class="single-field">

      
      <div class="field-container">
  <div class="data-name">
    <label for="b_address_2">Address (line 2)</label>
  </div>

  <div class="data-value">
    
        
          <input type="text" value="" maxlength="32" size="32" name="address_book[B][address_2]" id="b_address_2" autocomplete="off">

              
  </div>
  </div>
    </li>

    
  
                        
    <li class="single-field">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_city">City</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
                  
          <input type="text" value="" maxlength="32" size="32" name="address_book[B][city]" id="b_city" autocomplete="off">

              
  </div>
  </div>
    </li>

    
  
  
                        
    <li class="single-field">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="address_book_B_state">State</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
                    <select style="width: 250px;" class="input-style" id="address_book_B_state" name="address_book[B][state]" autocomplete="off">
<option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="AA">Armed Forces Americas</option><option value="AE">Armed Forces Europe, Middle East &amp; Canada</option><option value="AP">Armed Forces Pacific</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="GU">Guam</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="PR">Puerto Rico</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VI">Virgin Islands</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>

              
  </div>
  </div>
    </li>

    
  
                        
    <li class="single-field">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_country">Country</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
          <select style="width: 250px;" class="input-style" onchange="check_zip_code_field(this, $('#b_zipcode'))" id="b_country" name="address_book[B][country]" autocomplete="off">
                          <option value="AF">Afghanistan</option>
                          <option value="AX">Aland Islands</option>
                          <option value="AL">Albania</option>
                          <option value="DZ">Algeria</option>
                          <option value="AS">American Samoa</option>
                          <option value="AD">Andorra</option>
                          <option value="AO">Angola</option>
                          <option value="AI">Anguilla</option>
                          <option value="AQ">Antarctica</option>
                          <option value="AG">Antigua and Barbuda</option>
                          <option value="AR">Argentina</option>
                          <option value="AM">Armenia</option>
                          <option value="AW">Aruba</option>
                          <option value="AU">Australia</option>
                          <option value="AT">Austria</option>
                          <option value="AZ">Azerbaijan</option>
                          <option value="BS">Bahamas</option>
                          <option value="BH">Bahrain</option>
                          <option value="BD">Bangladesh</option>
                          <option value="BB">Barbados</option>
                          <option value="BY">Belarus</option>
                          <option value="BE">Belgium</option>
                          <option value="BZ">Belize</option>
                          <option value="BJ">Benin</option>
                          <option value="BM">Bermuda</option>
                          <option value="BT">Bhutan</option>
                          <option value="BO">Bolivia</option>
                          <option value="BA">Bosnia and Herzegovina</option>
                          <option value="BW">Botswana</option>
                          <option value="BV">Bouvet Island</option>
                          <option value="BR">Brazil</option>
                          <option value="IO">British Indian Ocean Territory</option>
                          <option value="VG">British Virgin Islands</option>
                          <option value="BN">Brunei Darussalam</option>
                          <option value="BG">Bulgaria</option>
                          <option value="BF">Burkina Faso</option>
                          <option value="BI">Burundi</option>
                          <option value="KH">Cambodia</option>
                          <option value="CM">Cameroon</option>
                          <option value="CA">Canada</option>
                          <option value="CV">Cape Verde</option>
                          <option value="KY">Cayman Islands</option>
                          <option value="CF">Central African Republic</option>
                          <option value="TD">Chad</option>
                          <option value="CL">Chile</option>
                          <option value="CN">China</option>
                          <option value="CX">Christmas Island</option>
                          <option value="CC">Cocos (Keeling) Islands</option>
                          <option value="CO">Colombia</option>
                          <option value="KM">Comoros</option>
                          <option value="CG">Congo</option>
                          <option value="CK">Cook Islands</option>
                          <option value="CR">Costa Rica</option>
                          <option value="CI">Cote D'ivoire</option>
                          <option value="HR">Croatia</option>
                          <option value="CU">Cuba</option>
                          <option value="CY">Cyprus</option>
                          <option value="CZ">Czech Republic</option>
                          <option value="CD">Democratic Republic of the Congo</option>
                          <option value="DK">Denmark</option>
                          <option value="DJ">Djibouti</option>
                          <option value="DM">Dominica</option>
                          <option value="DO">Dominican Republic</option>
                          <option value="EC">Ecuador</option>
                          <option value="EG">Egypt</option>
                          <option value="SV">El Salvador</option>
                          <option value="GQ">Equatorial Guinea</option>
                          <option value="ER">Eritrea</option>
                          <option value="EE">Estonia</option>
                          <option value="ET">Ethiopia</option>
                          <option value="FK">Falkland Islands (Malvinas)</option>
                          <option value="FO">Faroe Islands</option>
                          <option value="FJ">Fiji</option>
                          <option value="FI">Finland</option>
                          <option value="FR">France</option>
                          <option value="GF">French Guiana</option>
                          <option value="PF">French Polynesia</option>
                          <option value="TF">French Southern Territories</option>
                          <option value="GA">Gabon</option>
                          <option value="GM">Gambia</option>
                          <option value="GE">Georgia</option>
                          <option value="DE">Germany</option>
                          <option value="GH">Ghana</option>
                          <option value="GI">Gibraltar</option>
                          <option value="GR">Greece</option>
                          <option value="GL">Greenland</option>
                          <option value="GD">Grenada</option>
                          <option value="GP">Guadeloupe</option>
                          <option value="GU">Guam</option>
                          <option value="GT">Guatemala</option>
                          <option value="GG">Guernsey</option>
                          <option value="GN">Guinea</option>
                          <option value="GW">Guinea-Bissau</option>
                          <option value="GY">Guyana</option>
                          <option value="HT">Haiti</option>
                          <option value="HM">Heard and McDonald Islands</option>
                          <option value="HN">Honduras</option>
                          <option value="HK">Hong Kong</option>
                          <option value="HU">Hungary</option>
                          <option value="IS">Iceland</option>
                          <option value="IN">India</option>
                          <option value="ID">Indonesia</option>
                          <option value="IQ">Iraq</option>
                          <option value="IE">Ireland</option>
                          <option value="IR">Islamic Republic of Iran</option>
                          <option value="IM">Isle of Man</option>
                          <option value="IL">Israel</option>
                          <option value="IT">Italy</option>
                          <option value="JM">Jamaica</option>
                          <option value="JP">Japan</option>
                          <option value="JE">Jersey</option>
                          <option value="JO">Jordan</option>
                          <option value="KZ">Kazakhstan</option>
                          <option value="KE">Kenya</option>
                          <option value="KI">Kiribati</option>
                          <option value="KP">Korea</option>
                          <option value="KR">Korea, Republic of</option>
                          <option value="KW">Kuwait</option>
                          <option value="KG">Kyrgyzstan</option>
                          <option value="LA">Laos</option>
                          <option value="LV">Latvia</option>
                          <option value="LB">Lebanon</option>
                          <option value="LS">Lesotho</option>
                          <option value="LR">Liberia</option>
                          <option value="LY">Libyan Arab Jamahiriya</option>
                          <option value="LI">Liechtenstein</option>
                          <option value="LT">Lithuania</option>
                          <option value="LU">Luxembourg</option>
                          <option value="MO">Macau</option>
                          <option value="MK">Macedonia</option>
                          <option value="MG">Madagascar</option>
                          <option value="MW">Malawi</option>
                          <option value="MY">Malaysia</option>
                          <option value="MV">Maldives</option>
                          <option value="ML">Mali</option>
                          <option value="MT">Malta</option>
                          <option value="MH">Marshall Islands</option>
                          <option value="MQ">Martinique</option>
                          <option value="MR">Mauritania</option>
                          <option value="MU">Mauritius</option>
                          <option value="YT">Mayotte</option>
                          <option value="MX">Mexico</option>
                          <option value="FM">Micronesia</option>
                          <option value="MD">Moldova, Republic of</option>
                          <option value="MC">Monaco</option>
                          <option value="MN">Mongolia</option>
                          <option value="ME">Montenegro</option>
                          <option value="MS">Montserrat</option>
                          <option value="MA">Morocco</option>
                          <option value="MZ">Mozambique</option>
                          <option value="MM">Myanmar</option>
                          <option value="NA">Namibia</option>
                          <option value="NR">Nauru</option>
                          <option value="NP">Nepal</option>
                          <option value="NL">Netherlands</option>
                          <option value="AN">Netherlands Antilles</option>
                          <option value="NC">New Caledonia</option>
                          <option value="NZ">New Zealand</option>
                          <option value="NI">Nicaragua</option>
                          <option value="NE">Niger</option>
                          <option value="NG">Nigeria</option>
                          <option value="NU">Niue</option>
                          <option value="NF">Norfolk Island</option>
                          <option value="MP">Northern Mariana Islands</option>
                          <option value="NO">Norway</option>
                          <option value="OM">Oman</option>
                          <option value="PK">Pakistan</option>
                          <option value="PW">Palau</option>
                          <option value="PS">Palestinian Territory</option>
                          <option value="PA">Panama</option>
                          <option value="PG">Papua New Guinea</option>
                          <option value="PY">Paraguay</option>
                          <option value="PE">Peru</option>
                          <option value="PH">Philippines</option>
                          <option value="PN">Pitcairn</option>
                          <option value="PL">Poland</option>
                          <option value="PT">Portugal</option>
                          <option value="PR">Puerto Rico</option>
                          <option value="QA">Qatar</option>
                          <option value="RE">Reunion</option>
                          <option value="RO">Romania</option>
                          <option value="RU">Russian Federation</option>
                          <option value="RW">Rwanda</option>
                          <option value="WS">Samoa</option>
                          <option value="SM">San Marino</option>
                          <option value="ST">Sao Tome and Principe</option>
                          <option value="SA">Saudi Arabia</option>
                          <option value="SN">Senegal</option>
                          <option value="RS">Serbia</option>
                          <option value="SC">Seychelles</option>
                          <option value="SL">Sierra Leone</option>
                          <option value="SG">Singapore</option>
                          <option value="SK">Slovakia</option>
                          <option value="SI">Slovenia</option>
                          <option value="SB">Solomon Islands</option>
                          <option value="SO">Somalia</option>
                          <option value="ZA">South Africa</option>
                          <option value="GS">South Georgia and the South Sandwich Islands</option>
                          <option value="ES">Spain</option>
                          <option value="LK">Sri Lanka</option>
                          <option value="BL">St. Barthelemy</option>
                          <option value="SH">St. Helena</option>
                          <option value="KN">St. Kitts and Nevis</option>
                          <option value="LC">St. Lucia</option>
                          <option value="MF">St. Martin</option>
                          <option value="PM">St. Pierre and Miquelon</option>
                          <option value="VC">St. Vincent and the Grenadines</option>
                          <option value="SD">Sudan</option>
                          <option value="SR">Suriname</option>
                          <option value="SJ">Svalbard and Jan Mayen Islands</option>
                          <option value="SZ">Swaziland</option>
                          <option value="SE">Sweden</option>
                          <option value="CH">Switzerland</option>
                          <option value="SY">Syrian Arab Republic</option>
                          <option value="TW">Taiwan</option>
                          <option value="TJ">Tajikistan</option>
                          <option value="TZ">Tanzania, United Republic of</option>
                          <option value="TH">Thailand</option>
                          <option value="TL">Timor-Leste</option>
                          <option value="TG">Togo</option>
                          <option value="TK">Tokelau</option>
                          <option value="TO">Tonga</option>
                          <option value="TT">Trinidad and Tobago</option>
                          <option value="TN">Tunisia</option>
                          <option value="TR">Turkey</option>
                          <option value="TM">Turkmenistan</option>
                          <option value="TC">Turks and Caicos Islands</option>
                          <option value="TV">Tuvalu</option>
                          <option value="UG">Uganda</option>
                          <option value="UA">Ukraine</option>
                          <option value="AE">United Arab Emirates</option>
                          <option value="GB">United Kingdom (Great Britain)</option>
                          <option selected="selected" value="US">United States</option>
                          <option value="UM">United States Minor Outlying Islands</option>
                          <option value="VI">United States Virgin Islands</option>
                          <option value="UY">Uruguay</option>
                          <option value="UZ">Uzbekistan</option>
                          <option value="VU">Vanuatu</option>
                          <option value="VA">Vatican City State</option>
                          <option value="VE">Venezuela</option>
                          <option value="VN">Vietnam</option>
                          <option value="WF">Wallis And Futuna Islands</option>
                          <option value="EH">Western Sahara</option>
                          <option value="YE">Yemen</option>
                          <option value="ZM">Zambia</option>
                          <option value="ZW">Zimbabwe</option>
                      </select>

              
  </div>
  </div>
    </li>

    
  
                              
    <li class="fields-group">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_zipcode">Zip/Postal code</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
          
    <input type="text" value="" maxlength="32" size="32" name="address_book[B][zipcode]" class="zipcode billing" id="b_zipcode" autocomplete="off">
  

              
  </div>
  </div>
    </li>

    
  
                                                    
    <li class="fields-group last">

      
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="b_phone">Phone</label><span class="star">*</span>
  </div>

  <div class="data-value">
    
        
          <input type="text" value="" maxlength="32" size="32" name="address_book[B][phone]" id="b_phone" autocomplete="off">

              
  </div>
  </div>
    </li>

          <li class="clearing"></li>
    
  
  
  <li style="display:none">
      <span style="display:none;">
<input type="text" value="NY" id="b_country_state_value" autocomplete="off">
<input type="text" value="" id="b_country_county_value" autocomplete="off">
</span>
<script type="text/javascript">
//&lt;![CDATA[
init_js_states(document.getElementById('b_country'), 'address_book[B][state]', 'address_book[B][county]', 'b_country');
//]]&gt;
</script>
  </li>

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


      <div class="optional-label">
    <!--  <label for="create_account" class="pointer">
        <input type="checkbox" value="Y" name="create_account" id="create_account" autocomplete="off">
        Create account for this Email
      </label>-->
    </div>
  
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
        <span class="validate-mark"><img width="15" height="15" alt="" src="/skin/common_files/images/spacer.gif"></span>
      
  </div>
  </div>
    </li>
  
  </ul>
    <div class="optional-label">
      <label for="ship2diff" class="pointer">
        <input type="checkbox" onclick="javascript: $('#ship_box').toggle();" value="Y" name="ship2diff" id="ship2diff" autocomplete="off">
        Ship to a different address
      </label>
    </div>
    <div id="ship2diff_box" style="display: none;">
<ul class="first">                          
    <li class="fields-group">   
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_firstname">First name</label><span class="star">*</span>
  </div>
  <div class="data-value">     
          <input type="text" value="" maxlength="32" size="32" name="address_book[S][firstname]" id="s_firstname" autocomplete="off">             
  </div>
  </div>
    </li>                                                  
    <li class="fields-group last">   
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_lastname">Last name</label><span class="star">*</span>
  </div>
  <div class="data-value">
        <input type="text" value="" maxlength="32" size="32" name="address_book[S][lastname]" id="s_lastname" autocomplete="off">            
  </div>
  </div>
    </li>
     <li class="clearing"></li>                    
    <li class="single-field"> 
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_address">Address</label><span class="star">*</span>
  </div>
  <div class="data-value">   
          <input type="text" value="" maxlength="32" size="32" name="address_book[S][address]" id="s_address" autocomplete="off">          
  </div>
  </div>
    </li>                   
    <li class="single-field">
      <div class="field-container">
  <div class="data-name">
    <label for="s_address_2">Address (line 2)</label>
  </div>
  <div class="data-value">
       <input type="text" value="" maxlength="32" size="32" name="address_book[S][address_2]" id="s_address_2" autocomplete="off">      
  </div>
  </div>
    </li>                
    <li class="single-field">
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_city">City</label><span class="star">*</span>
  </div>
  <div class="data-value">          
          <input type="text" value="" maxlength="32" size="32" name="address_book[S][city]" id="s_city" autocomplete="off">   
  </div>
  </div>
    </li>                
    <li class="single-field">
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="address_book_S_state">State</label><span class="star">*</span>
  </div>
  <div class="data-value">
                    <select style="width: 250px;" class="input-style" id="address_book_S_state" name="address_book[S][state]" autocomplete="off">
<option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="AA">Armed Forces Americas</option><option value="AE">Armed Forces Europe, Middle East &amp; Canada</option><option value="AP">Armed Forces Pacific</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="GU">Guam</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="PR">Puerto Rico</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VI">Virgin Islands</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>          
  </div>
  </div>
    </li>                
    <li class="single-field">
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_country">Country</label><span class="star">*</span>
  </div>
  <div class="data-value">
          <select style="width: 250px;" class="input-style" onchange="check_zip_code_field(this, $('#s_zipcode'))" id="s_country" name="address_book[S][country]" autocomplete="off">
                          <option value="AF">Afghanistan</option>
                          <option value="AX">Aland Islands</option>
                          <option value="AL">Albania</option>
                          <option value="DZ">Algeria</option>
                          <option value="AS">American Samoa</option>
                          <option value="AD">Andorra</option>
                          <option value="AO">Angola</option>
                          <option value="AI">Anguilla</option>
                          <option value="AQ">Antarctica</option>
                          <option value="AG">Antigua and Barbuda</option>
                          <option value="AR">Argentina</option>
                          <option value="AM">Armenia</option>
                          <option value="AW">Aruba</option>
                          <option value="AU">Australia</option>
                          <option value="AT">Austria</option>
                          <option value="AZ">Azerbaijan</option>
                          <option value="BS">Bahamas</option>
                          <option value="BH">Bahrain</option>
                          <option value="BD">Bangladesh</option>
                          <option value="BB">Barbados</option>
                          <option value="BY">Belarus</option>
                          <option value="BE">Belgium</option>
                          <option value="BZ">Belize</option>
                          <option value="BJ">Benin</option>
                          <option value="BM">Bermuda</option>
                          <option value="BT">Bhutan</option>
                          <option value="BO">Bolivia</option>
                          <option value="BA">Bosnia and Herzegovina</option>
                          <option value="BW">Botswana</option>
                          <option value="BV">Bouvet Island</option>
                          <option value="BR">Brazil</option>
                          <option value="IO">British Indian Ocean Territory</option>
                          <option value="VG">British Virgin Islands</option>
                          <option value="BN">Brunei Darussalam</option>
                          <option value="BG">Bulgaria</option>
                          <option value="BF">Burkina Faso</option>
                          <option value="BI">Burundi</option>
                          <option value="KH">Cambodia</option>
                          <option value="CM">Cameroon</option>
                          <option value="CA">Canada</option>
                          <option value="CV">Cape Verde</option>
                          <option value="KY">Cayman Islands</option>
                          <option value="CF">Central African Republic</option>
                          <option value="TD">Chad</option>
                          <option value="CL">Chile</option>
                          <option value="CN">China</option>
                          <option value="CX">Christmas Island</option>
                          <option value="CC">Cocos (Keeling) Islands</option>
                          <option value="CO">Colombia</option>
                          <option value="KM">Comoros</option>
                          <option value="CG">Congo</option>
                          <option value="CK">Cook Islands</option>
                          <option value="CR">Costa Rica</option>
                          <option value="CI">Cote D'ivoire</option>
                          <option value="HR">Croatia</option>
                          <option value="CU">Cuba</option>
                          <option value="CY">Cyprus</option>
                          <option value="CZ">Czech Republic</option>
                          <option value="CD">Democratic Republic of the Congo</option>
                          <option value="DK">Denmark</option>
                          <option value="DJ">Djibouti</option>
                          <option value="DM">Dominica</option>
                          <option value="DO">Dominican Republic</option>
                          <option value="EC">Ecuador</option>
                          <option value="EG">Egypt</option>
                          <option value="SV">El Salvador</option>
                          <option value="GQ">Equatorial Guinea</option>
                          <option value="ER">Eritrea</option>
                          <option value="EE">Estonia</option>
                          <option value="ET">Ethiopia</option>
                          <option value="FK">Falkland Islands (Malvinas)</option>
                          <option value="FO">Faroe Islands</option>
                          <option value="FJ">Fiji</option>
                          <option value="FI">Finland</option>
                          <option value="FR">France</option>
                          <option value="GF">French Guiana</option>
                          <option value="PF">French Polynesia</option>
                          <option value="TF">French Southern Territories</option>
                          <option value="GA">Gabon</option>
                          <option value="GM">Gambia</option>
                          <option value="GE">Georgia</option>
                          <option value="DE">Germany</option>
                          <option value="GH">Ghana</option>
                          <option value="GI">Gibraltar</option>
                          <option value="GR">Greece</option>
                          <option value="GL">Greenland</option>
                          <option value="GD">Grenada</option>
                          <option value="GP">Guadeloupe</option>
                          <option value="GU">Guam</option>
                          <option value="GT">Guatemala</option>
                          <option value="GG">Guernsey</option>
                          <option value="GN">Guinea</option>
                          <option value="GW">Guinea-Bissau</option>
                          <option value="GY">Guyana</option>
                          <option value="HT">Haiti</option>
                          <option value="HM">Heard and McDonald Islands</option>
                          <option value="HN">Honduras</option>
                          <option value="HK">Hong Kong</option>
                          <option value="HU">Hungary</option>
                          <option value="IS">Iceland</option>
                          <option value="IN">India</option>
                          <option value="ID">Indonesia</option>
                          <option value="IQ">Iraq</option>
                          <option value="IE">Ireland</option>
                          <option value="IR">Islamic Republic of Iran</option>
                          <option value="IM">Isle of Man</option>
                          <option value="IL">Israel</option>
                          <option value="IT">Italy</option>
                          <option value="JM">Jamaica</option>
                          <option value="JP">Japan</option>
                          <option value="JE">Jersey</option>
                          <option value="JO">Jordan</option>
                          <option value="KZ">Kazakhstan</option>
                          <option value="KE">Kenya</option>
                          <option value="KI">Kiribati</option>
                          <option value="KP">Korea</option>
                          <option value="KR">Korea, Republic of</option>
                          <option value="KW">Kuwait</option>
                          <option value="KG">Kyrgyzstan</option>
                          <option value="LA">Laos</option>
                          <option value="LV">Latvia</option>
                          <option value="LB">Lebanon</option>
                          <option value="LS">Lesotho</option>
                          <option value="LR">Liberia</option>
                          <option value="LY">Libyan Arab Jamahiriya</option>
                          <option value="LI">Liechtenstein</option>
                          <option value="LT">Lithuania</option>
                          <option value="LU">Luxembourg</option>
                          <option value="MO">Macau</option>
                          <option value="MK">Macedonia</option>
                          <option value="MG">Madagascar</option>
                          <option value="MW">Malawi</option>
                          <option value="MY">Malaysia</option>
                          <option value="MV">Maldives</option>
                          <option value="ML">Mali</option>
                          <option value="MT">Malta</option>
                          <option value="MH">Marshall Islands</option>
                          <option value="MQ">Martinique</option>
                          <option value="MR">Mauritania</option>
                          <option value="MU">Mauritius</option>
                          <option value="YT">Mayotte</option>
                          <option value="MX">Mexico</option>
                          <option value="FM">Micronesia</option>
                          <option value="MD">Moldova, Republic of</option>
                          <option value="MC">Monaco</option>
                          <option value="MN">Mongolia</option>
                          <option value="ME">Montenegro</option>
                          <option value="MS">Montserrat</option>
                          <option value="MA">Morocco</option>
                          <option value="MZ">Mozambique</option>
                          <option value="MM">Myanmar</option>
                          <option value="NA">Namibia</option>
                          <option value="NR">Nauru</option>
                          <option value="NP">Nepal</option>
                          <option value="NL">Netherlands</option>
                          <option value="AN">Netherlands Antilles</option>
                          <option value="NC">New Caledonia</option>
                          <option value="NZ">New Zealand</option>
                          <option value="NI">Nicaragua</option>
                          <option value="NE">Niger</option>
                          <option value="NG">Nigeria</option>
                          <option value="NU">Niue</option>
                          <option value="NF">Norfolk Island</option>
                          <option value="MP">Northern Mariana Islands</option>
                          <option value="NO">Norway</option>
                          <option value="OM">Oman</option>
                          <option value="PK">Pakistan</option>
                          <option value="PW">Palau</option>
                          <option value="PS">Palestinian Territory</option>
                          <option value="PA">Panama</option>
                          <option value="PG">Papua New Guinea</option>
                          <option value="PY">Paraguay</option>
                          <option value="PE">Peru</option>
                          <option value="PH">Philippines</option>
                          <option value="PN">Pitcairn</option>
                          <option value="PL">Poland</option>
                          <option value="PT">Portugal</option>
                          <option value="PR">Puerto Rico</option>
                          <option value="QA">Qatar</option>
                          <option value="RE">Reunion</option>
                          <option value="RO">Romania</option>
                          <option value="RU">Russian Federation</option>
                          <option value="RW">Rwanda</option>
                          <option value="WS">Samoa</option>
                          <option value="SM">San Marino</option>
                          <option value="ST">Sao Tome and Principe</option>
                          <option value="SA">Saudi Arabia</option>
                          <option value="SN">Senegal</option>
                          <option value="RS">Serbia</option>
                          <option value="SC">Seychelles</option>
                          <option value="SL">Sierra Leone</option>
                          <option value="SG">Singapore</option>
                          <option value="SK">Slovakia</option>
                          <option value="SI">Slovenia</option>
                          <option value="SB">Solomon Islands</option>
                          <option value="SO">Somalia</option>
                          <option value="ZA">South Africa</option>
                          <option value="GS">South Georgia and the South Sandwich Islands</option>
                          <option value="ES">Spain</option>
                          <option value="LK">Sri Lanka</option>
                          <option value="BL">St. Barthelemy</option>
                          <option value="SH">St. Helena</option>
                          <option value="KN">St. Kitts and Nevis</option>
                          <option value="LC">St. Lucia</option>
                          <option value="MF">St. Martin</option>
                          <option value="PM">St. Pierre and Miquelon</option>
                          <option value="VC">St. Vincent and the Grenadines</option>
                          <option value="SD">Sudan</option>
                          <option value="SR">Suriname</option>
                          <option value="SJ">Svalbard and Jan Mayen Islands</option>
                          <option value="SZ">Swaziland</option>
                          <option value="SE">Sweden</option>
                          <option value="CH">Switzerland</option>
                          <option value="SY">Syrian Arab Republic</option>
                          <option value="TW">Taiwan</option>
                          <option value="TJ">Tajikistan</option>
                          <option value="TZ">Tanzania, United Republic of</option>
                          <option value="TH">Thailand</option>
                          <option value="TL">Timor-Leste</option>
                          <option value="TG">Togo</option>
                          <option value="TK">Tokelau</option>
                          <option value="TO">Tonga</option>
                          <option value="TT">Trinidad and Tobago</option>
                          <option value="TN">Tunisia</option>
                          <option value="TR">Turkey</option>
                          <option value="TM">Turkmenistan</option>
                          <option value="TC">Turks and Caicos Islands</option>
                          <option value="TV">Tuvalu</option>
                          <option value="UG">Uganda</option>
                          <option value="UA">Ukraine</option>
                          <option value="AE">United Arab Emirates</option>
                          <option value="GB">United Kingdom (Great Britain)</option>
                          <option selected="selected" value="US">United States</option>
                          <option value="UM">United States Minor Outlying Islands</option>
                          <option value="VI">United States Virgin Islands</option>
                          <option value="UY">Uruguay</option>
                          <option value="UZ">Uzbekistan</option>
                          <option value="VU">Vanuatu</option>
                          <option value="VA">Vatican City State</option>
                          <option value="VE">Venezuela</option>
                          <option value="VN">Vietnam</option>
                          <option value="WF">Wallis And Futuna Islands</option>
                          <option value="EH">Western Sahara</option>
                          <option value="YE">Yemen</option>
                          <option value="ZM">Zambia</option>
                          <option value="ZW">Zimbabwe</option>
                      </select>
  </div>
  </div>
    </li>                   
    <li class="fields-group">
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_zipcode">Zip/Postal code</label><span class="star">*</span>
  </div>
  <div class="data-value">
    <input type="text" value="" maxlength="32" size="32" name="address_book[S][zipcode]" class="zipcode shipping" id="s_zipcode" autocomplete="off">
  </div>
  </div>
    </li>                                           
    <li class="fields-group last">
      <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="s_phone">Phone</label><span class="star">*</span>
  </div>
  <div class="data-value">
          <input type="text" value="" maxlength="32" size="32" name="address_book[S][phone]" id="s_phone" autocomplete="off">
  </div>
  </div>
    </li>
          <li class="clearing"></li
  <li style="display:none">
      <span style="display:none;">
<input type="text" value="NY" id="s_country_state_value" autocomplete="off">
<input type="text" value="" id="s_country_county_value" autocomplete="off">
</span>
<script type="text/javascript">
//&lt;![CDATA[
init_js_states(document.getElementById('s_country'), 'address_book[S][state]', 'address_book[S][county]', 's_country');
//]]&gt;
</script>
  </li>

</ul>

  </div>

        
        
      <h3>_____________________</h3>
  
  <ul class="first">
  
      
    
                            
      <li class="fields-group">

                <div class="field-container">
  <!--<div class="data-name">
    <label class="data-required" for="firstname">First name</label><span class="star">*</span>
  </div>

  <div class="data-value">
                          <input type="text" value="" id="firstname" name="firstname" autocomplete="off">
                  
  </div>-->
  </div>
      </li>

      
    
                                              
     <!-- <li class="fields-group last">

                <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="lastname">Last name</label><span class="star">*</span>
  </div>

  <div class="data-value">
                          <input type="text" value="" id="lastname" name="lastname" autocomplete="off">
                  
  </div>
  </div>
      </li>
-->
      
      
      
      
        </ul>

    
          
                
        
          
                <div align="center" class="button-row">
            
  
    


  <button title="Continue" type="submit" >
  <span class="button-right"><span class="button-left">Continue</span></span>
  </button>


        </div>
          
      </fieldset>
    </form>
    
    <script type="text/javascript">
//&lt;![CDATA[
var is_run = false;
var unique_key = 'be7d602fe7513fd2c4340ecdfeee7d41';

function checkRegFormFields(form) {

  if (is_run) {
    return false;
  }

  var is_valid_card_number = true;
  var is_valid_cvv2 = true;

  
  is_run = false;
  if (
      check_zip_code(form)
      && is_valid_card_number 
      && is_valid_cvv2
        ) {
    return true;
  }

  is_run = false;

  return false;
}


var anonymousFlag = true;



$(function() {
  $('#email')
    .live('blur submit', function(){
      $('#email_note').hide();
    })
    .live('focus', function(){
      showNote('email_note', this)
    });

  $('#passwd1, #passwd2')
    .bind('change', function() {
      $('#password_is_modified').val('Y');
    })
    .bind('keydown', function() {
    })
    .bind('blur', function() {
      $('#passwd_note').hide();
    })
    .bind('focus', function() {
      showNote('passwd_note', this)
    });

  $('#passwd1, #passwd2')
    .bind('change', function() {

      var pwd1 = $('#passwd1').val();
      var pwd2 = $('#passwd2').val();
      var vm   = $('#passwd2').parent().find('span.validate-mark');

      if (vm === undefined) {
        return true;
      }

      if (pwd1 == '' || pwd2 == '') {
        vm.removeClass('validate-matched validate-non-matched');
      } else if (pwd1 != pwd2) {
        vm.removeClass('validate-matched').addClass('validate-non-matched');
      } else {
        vm.removeClass('validate-non-matched').addClass('validate-matched');
      }
    });


  $('#create_account, #ship2diff')
    .bind('click', function(){
      if ($(this).is(':checked')) {
        $('#' + $(this).attr('id') + '_box').show();
        $(this).parents('.register-exp-section').removeClass('register-sec-minimized'); 
      }
      else {
        $('#' + $(this).attr('id') + '_box').hide();
        $(this).parents('.register-exp-section').addClass('register-sec-minimized'); 
      }
      
            
    });



$('#ship2diff_box').hide();
$('#create_account_box').hide();


});


//]]&gt;
</script>  
  
</div>  </li>

  <li id="payment_shipping_payment" class="payment-section">
              <div id="payment_shipping">
  <h2>Shipping method</h2>

  <form name="shippingsform" method="post" action="cart.php">

    <input type="hidden" value="checkout" name="mode" disabled="" autocomplete="off">
    <input type="hidden" value="cart_operation" name="cart_operation" disabled="" autocomplete="off">
    <input type="hidden" value="update" name="action" disabled="" autocomplete="off">

    <div class="payment-section-container payment-shipping-options">
      
  <div >$20 flat rate for packaging and shipping throughout the US</div>


  <div class="checkout-customer-notes">
    <label for="customer_notes">Customer notes:</label>
    <textarea name="Customer_Notes" id="customer_notes" rows="3" cols="47"></textarea>
  </div>


  <input type="hidden" value="0" name="shippingid" disabled="" autocomplete="off">


      <div class="clearing"></div>
    </div>

    
  </form>
</div>            
<!--<div id="payment_payment">
  <h2>Payment method</h2>

  <form name="paymentform" method="post" action="cart.php">
    <input type="hidden" value="checkout" name="mode" disabled="" autocomplete="off">
    <input type="hidden" value="cart_operation" name="cart_operation" disabled="" autocomplete="off">
    <input type="hidden" value="update" name="action" disabled="" autocomplete="off">

    <div class="payment-section-container payment-payment-options">
      <div class="checkout-payments">
  <script language="JavaScript 1.2" type="text/javascript">
//&lt;![CDATA[
var card_types = new Array();
var card_cvv2 = new Array();
card_types["VISA"] = "Visa";
card_cvv2["VISA"] = "1";
card_types["MC"] = "MasterCard";
card_cvv2["MC"] = "1";
card_types["AMEX"] = "American Express";
card_cvv2["AMEX"] = "1";
card_types["DICL"] = "Diners Club";
card_cvv2["DICL"] = "";
card_types["JCB"] = "JCB";
card_cvv2["JCB"] = "";
card_types["CARTE"] = "Carte Blanche";
card_cvv2["CARTE"] = "";
card_types["ABC"] = "Australian BankCard";
card_cvv2["ABC"] = "";
card_types["DINO"] = "Discover/Novus";
card_cvv2["DINO"] = "";
card_types["SW"] = "Maestro/Switch";
card_cvv2["SW"] = "";
card_types["SO"] = "Solo";
card_cvv2["SO"] = "";
card_types["ERT"] = "enRoute";
card_cvv2["ERT"] = "";
card_types["UKE"] = "Visa Electron";
card_cvv2["UKE"] = "1";
var force_cvv2 = false;
var txt_cc_number_invalid = "Credit Card checksum is invalid! Please correct";
var current_year = parseInt(('2013').replace(/^0/gi, ""));
var current_month = parseInt(('05').replace(/^0/gi, ""));
var lbl_is_this_card_expired = "Is this card expired?";
var lbl_cvv2_is_empty = "CVV2 is empty";
var lbl_cvv2_isnt_correct = "CVV2 isn\'t correct";
var lbl_cvv2_must_be_number = "CVV2 must be a number";
//]]&gt;
</script>
<script src="/skin/common_files/js/check_cc_number_script.js" type="text/javascript"></script>


<table cellspacing="0" summary="Payment methods" class="checkout-payments">


  <tbody><tr>
    <td>
      <input type="radio" checked="checked" value="20" id="pm20" name="paymentid" disabled="" autocomplete="off">
    </td>

    
      <td class="checkout-payment-name">
      <label for="pm20">Credit Card
              </label>
      <div class="checkout-payment-descr">
        
          
              </div>
    </td>

    </tr>

<tr id="pmbox_20" class="payment-details">
  <td colspan="3">
    <div class="payment-payment-options">
    <fieldset class="registerform"><script type="text/javascript">
//&lt;![CDATA[

  $(document).ready(function(){
    $("input,select").attr({ 
          autocomplete: "off"
        });
  });

//]]&gt;
</script>

  
          
      

<ul>
  <li class="single-field">
        <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="card_type">Credit card type</label><span class="star">*</span>
  </div>

  <div class="data-value">
              <select id="card_type" onchange="javascript: markCVV2(this)" name="card_type[be7d602fe7513fd2c4340ecdfeee7d41]" disabled="" autocomplete="off">
                  <option value="VISA">Visa</option>
                  <option value="MC">MasterCard</option>
                  <option value="AMEX">American Express</option>
                  <option value="DICL">Diners Club</option>
                  <option value="JCB">JCB</option>
                  <option value="CARTE">Carte Blanche</option>
                  <option value="ABC">Australian BankCard</option>
                  <option value="DINO">Discover/Novus</option>
                  <option value="SW">Maestro/Switch</option>
                  <option value="SO">Solo</option>
                  <option value="ERT">enRoute</option>
                  <option value="UKE">Visa Electron</option>
              </select>
        
  </div>
  </div>  </li>

  <li class="single-field">
        <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="card_name">Cardholder's name</label><span class="star">*</span>
  </div>

  <div class="data-value">
        
                    
                    
      <input type="text" id="card_name" value="" maxlength="50" size="32" name="card_name[be7d602fe7513fd2c4340ecdfeee7d41]" disabled="" autocomplete="off">

        
  </div>
  </div>  </li>

  <li class="single-field">
        <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="card_number">Credit card number (no spaces or dashes)</label><span class="star">*</span>
  </div>

  <div class="data-value">
              <input type="text" id="card_number" value="" maxlength="20" size="32" name="card_number[be7d602fe7513fd2c4340ecdfeee7d41]" disabled="" autocomplete="off">

      
        
  </div>
  </div>  </li>

  
  <li class="single-field">
        <div class="field-container">
  <div class="data-name">
    <label class="data-required">Expiration date (month/year)</label><span class="star">*</span>
  </div>

  <div class="data-value">
              <select name="card_expire_Month[be7d602fe7513fd2c4340ecdfeee7d41]" disabled="" autocomplete="off">
<option value="01" label="01">01</option>
<option value="02" label="02">02</option>
<option value="03" label="03">03</option>
<option value="04" label="04">04</option>
<option selected="selected" value="05" label="05">05</option>
<option value="06" label="06">06</option>
<option value="07" label="07">07</option>
<option value="08" label="08">08</option>
<option value="09" label="09">09</option>
<option value="10" label="10">10</option>
<option value="11" label="11">11</option>
<option value="12" label="12">12</option>
</select>

<select name="card_expire_Year[be7d602fe7513fd2c4340ecdfeee7d41]" disabled="" autocomplete="off">
<option selected="selected" value="2013" label="2013">2013</option>
<option value="2014" label="2014">2014</option>
<option value="2015" label="2015">2015</option>
<option value="2016" label="2016">2016</option>
<option value="2017" label="2017">2017</option>
<option value="2018" label="2018">2018</option>
<option value="2019" label="2019">2019</option>
<option value="2020" label="2020">2020</option>
<option value="2021" label="2021">2021</option>
<option value="2022" label="2022">2022</option>
<option value="2023" label="2023">2023</option>
</select>
        
  </div>
  </div>  </li>
  
                                                                                                                                  <li class="single-field">
            <div class="field-container">
  <div class="data-name">
    <label class="data-required" for="card_cvv2">CVV2</label><span class="star">*</span>
  </div>

  <div class="data-value">
                  <input type="text" id="card_cvv2" style="width:50px;" value="" maxlength="4" size="4" name="card_cvv2[be7d602fe7513fd2c4340ecdfeee7d41]" disabled="" autocomplete="off">
          <a target="_blank" class="popup-link" onclick="javascript: return typeof(window.popupOpen) == 'undefined' || !popupOpen('popup_info.php?action=CVV2', 'What is CVV2?');" href="popup_info.php?action=CVV2"><img alt="What is it?" src="/skin/common_files/images/spacer.gif"></a>
            
  </div>
  </div>    </li>
  
  
</ul></fieldset>
  </div>
  </td>
</tr>

 
</tbody></table></div>

<script type="text/javascript">
//&lt;![CDATA[
var paymentsCOD = [];
display_cod(false);


function display_cod(flag) {
  for (var i = 0; i &lt; paymentsCOD.length; i++) {
    if (paymentsCOD[i] &amp;&amp; document.getElementById('cod_tr' + paymentsCOD[i]))
      document.getElementById('cod_tr' + paymentsCOD[i]).style.display = flag ? "" : "none";
  }

  return true;
}

//]]&gt;
</script>
      <div class="clearing"></div>
    </div>
  </form>
</div>  </li>
-->
	<?php require_once 'includes/payment_order_summary.php';?>
</ul>
</div>
</center>
</body>
</html>
<script>
</script>