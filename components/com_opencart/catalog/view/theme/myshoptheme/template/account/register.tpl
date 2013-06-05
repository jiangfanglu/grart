<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div style="margin-top: 30px;">
    <div id="join_heading">
        <div class="join_heading_left">
            Create Account
        </div>
        <div class="join_heading_right">
            Already have an account? &nbsp;&nbsp;&nbsp;<input type="button" id="r_login" value="Login" class="product-button" />
        </div>
        <script>
            jQuery('#r_login').click(function(){
                jQuery('#login_anywhere_out').fadeIn('slow');
            });
        </script>
    </div>
    <div class="social_row">
        <a><img src='/templates/shop_template/images/social_signup/facebook.png' /></a>
        <a><img src='/templates/shop_template/images/social_signup/google.png' /></a>
        <a><img src='/templates/shop_template/images/social_signup/twitter.png' /></a>
        <a><img src='/templates/shop_template/images/social_signup/openid.png' /></a>
    </div>
    <div style='width:630px;padding-left:410px; border-top:1px dotted #eee;font-size:14px;'>
        <div style='background:#fff;padding:10px; color:#ccc;margin-top: -20px;width: 220px;text-align: center;'>
            Or, Sign Up With GRArt membership
        </div>
    </div>
    <div class="form_content">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="regi_left">
            <div class="form_content_item">
                <input type="text" name="firstname" id="rego_firstname" value="<?php echo $firstname; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_firstname) { 
                    echo $error_firstname; 
                } ?>
            </div>
            <div class="form_content_item">
                <input type="text" name="lastname" id="rego_lastname" value="<?php echo $lastname; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_lastname) { 
                    echo $error_lastname; 
                } ?>
            </div>
            <div class="form_content_item">
                <input type="text" name="email" id="rego_email" value="<?php echo $email; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_email) { 
                    echo $error_email; 
                } ?>
            </div>
            <div class="form_content_item">
                <input type="<?php echo $password == 'Password' ? 'text' : 'password' ; ?>" name="password" id="rego_password" value="<?php echo $password; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_password) { 
                    echo $error_password; 
                } ?>
            </div>
            <div class="form_content_item">
                <input type="<?php echo $confirm == 'Retype Password' ? 'text' : 'password' ; ?>" name="confirm" id="rego_confirm" value="<?php echo $confirm; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_confirm) { 
                    echo $error_confirm; 
                } ?>
            </div>
            
        </div>
        <div class="regi_right">
            <div class="ca_extrainfo"> 
                We need your shipping address as well. Save your time when you check out. 
            </div>
            <div class="form_content_item">
                <input type="text" name="address_1" id="rego_address_1" value="<?php echo $address_1; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_address_1) { 
                    echo $error_address_1; 
                } ?>
            </div>
            <div class="form_content_item">
                <input type="text" name="city" id="rego_city" value="<?php echo $city; ?>" />
            </div>
            <div class="form_content_note">
                <?php if ($error_city) { 
                    echo $error_city; 
                } ?>
            </div>
            <div class="form_content_item">
                <select class="grart" name="country_id">
                    <option value=""><?php echo $text_select; ?></option>
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $country_id) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
            </div>
            <div class="form_content_note">
                <?php if ($error_country) { 
                    echo $error_country; 
                } ?>
            </div>
            <div class="form_content_item">
                <select class="grart" name="zone_id">
                </select>
            </div>
            <div class="form_content_note">
                <?php if ($error_zone) { 
                            echo $error_zone; 
                        } ?>
            </div>
            <div class="form_content_item ca_nsletter">
                Email me weekly newsletters, specials. 
        <?php if ($newsletter) { ?>
                <input type="radio" name="newsletter" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="newsletter" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="newsletter" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="newsletter" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
            </div>
        </div>
            <script>
            jQuery("#rego_firstname").focus(function(){
                formFocus(this, 'First Name',1)
            });
            jQuery("#rego_firstname").blur(function(){
                formFocus(this, 'First Name',0)
            });
            jQuery("#rego_lastname").focus(function(){
                formFocus(this, 'Last Name',1)
            });
            jQuery("#rego_lastname").blur(function(){
                formFocus(this, 'Last Name',0)
            });
            jQuery("#rego_email").focus(function(){
                formFocus(this, 'Email',1)
            });
            jQuery("#rego_email").blur(function(){
                formFocus(this, 'Email',0)
            });
            jQuery("#rego_address_1").focus(function(){
                formFocus(this, 'Address',1)
            });
            jQuery("#rego_address_1").blur(function(){
                formFocus(this, 'Address',0)
            });
            jQuery("#rego_city").focus(function(){
                formFocus(this, 'Suburb',1)
            });
            jQuery("#rego_city").blur(function(){
                formFocus(this, 'Suburb',0)
            });
            jQuery("#rego_password").focus(function(){
                formFocus(this, 'Password',1)
            });
            jQuery("#rego_password").blur(function(){
                formFocus(this, 'Password',0)
            });
            jQuery("#rego_confirm").focus(function(){
                formFocus(this, 'Retype Password',1)
            });
            jQuery("#rego_confirm").blur(function(){
                formFocus(this, 'Retype Password',0)
            });
            function formFocus(obj, text,state){
            if(state==1){
                if (obj.value == text)
                {
                    if(text=='Password' || text=='Retype Password'){
                        obj.type="password";
                    }
                    obj.value = "";
                    jQuery(obj).css('color','#2e2d2d');
                 }
            }else{
                if (obj.value == "")
                {
                    if(text=='Password' || text=='Retype Password'){
                        obj.type="text";
                    }
                    obj.value = text;
                    jQuery(obj).css('color','#ccc');
                }
            }
        }
    </script>
    <div class="full_screen createaccount">
        <input type="submit" value="Create Account" class="product-button" />
    </div>
    <div class="full_screen ca_text">
        By clicking "Create Account", you agree to our <a>Privacy Policy</a> and <a>Terms of Service</a>. You can always get <a>Help</a> from us.
    </div>
            
<!--            <div class="regi_content">
        <h2><?php echo $text_newsletter; ?></h2>
        <div class="content_line">
            <div class="form_label"><?php echo $entry_newsletter; ?></div>
            <div class="form_input">
                <?php if ($newsletter) { ?>
                <input type="radio" name="newsletter" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="newsletter" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="newsletter" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="newsletter" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
            </div>
            <div class="form_note">
            </div>
        </div>
    </div>
    <?php if ($text_agree) { ?>
    <div class="regi_content">
      <div class="right"><?php echo $text_agree; ?>
        <?php if ($agree) { ?>
        <input type="checkbox" name="agree" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="agree" value="1" />
        <?php } ?>
        <input type="submit" value="Join" class="submit_btn" />
      </div>
    </div>
    <?php } else { ?>
    <div class="regi_content">
      <div class="right">
        <input type="submit" value="Join" class="submit_btn" />
      </div>
    </div>
    <?php } ?>-->
        </form>
                        
        
    </div>
</div>



<!--  <h1><?php echo $heading_title; ?></h1>
  <p><?php echo $text_account_already; ?></p>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      <div class="regi_left">
          <div class="content" style="width:500px;float:left;">
            <h2><?php echo $text_your_details; ?></h2>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_firstname; ?></div>
                    <div class="form_input">
                        <input type="text" name="firstname" value="<?php echo $firstname; ?>" />
                    </div>
                    <div class="form_note">
                        <?php if ($error_firstname) { 
                            echo $error_firstname; 
                        } ?>
                    </div>
                </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_lastname; ?></div>
                    <div class="form_input">
                        <input type="text" name="lastname" value="<?php echo $lastname; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_lastname) { 
                            echo $error_lastname; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_email; ?></div>
                    <div class="form_input">
                        <input type="text" name="email" value="<?php echo $email; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_email) { 
                            echo $error_email; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_telephone; ?></div>
                    <div class="form_input">
                        <input type="text" name="telephone" value="<?php echo $telephone; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_telephone) { 
                            echo $error_telephone; 
                        } ?>
                    </div>
             </div>
             <div class="content_line">
                    <div class="form_label login_width"><?php echo $entry_fax; ?></div>
                    <div class="form_input">
                        <input type="text" name="fax" value="<?php echo $fax; ?>" />

                    </div>
                    <div class="form_note">
                    </div>
             </div>
        </div>
          <div class="content" style="width:400px;float:left;">
            <h2><?php echo $text_your_password; ?></h2>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_password; ?></div>
                    <div class="form_input">
                        <input type="password" name="password" value="<?php echo $password; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_password) { 
                            echo $error_password; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_confirm; ?></div>
                    <div class="form_input">
                        <input type="password" name="confirm" value="<?php echo $confirm; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_confirm) { 
                            echo $error_confirm; 
                        } ?>
                    </div>
             </div>
        </div>
      </div>
      <div class="regi_right">
          <div class="content" style="width:500px;float:left;">
            <h2><?php echo $text_your_address; ?></h2>
            <div class="content_line">
                    <div class="form_label login_width"><?php echo $entry_company; ?></div>
                    <div class="form_input">
                        <input type="text" name="company" value="<?php echo $company; ?>" />

                    </div>
                    <div class="form_note">
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_address_1; ?></div>
                    <div class="form_input">
                        <input type="text" name="address_1" value="<?php echo $address_1; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_address_1) { 
                            echo $error_address_1; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><?php echo $entry_address_2; ?></div>
                    <div class="form_input">
                        <input type="text" name="address_2" value="<?php echo $address_2; ?>" />

                    </div>
                    <div class="form_note">
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_city; ?></div>
                    <div class="form_input">
                        <input type="text" name="city" value="<?php echo $city; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_city) { 
                            echo $error_city; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span id="postcode-required" class="required">*</span><?php echo $entry_postcode; ?></div>
                    <div class="form_input">
                        <input type="text" name="postcode" value="<?php echo $postcode; ?>" />

                    </div>
                    <div class="form_note">
                        <?php if ($error_postcode) { 
                            echo $error_postcode; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_country; ?></div>
                    <div class="form_input login_width">
                        <select class="grart" name="country_id">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($countries as $country) { ?>
                            <?php if ($country['country_id'] == $country_id) { ?>
                            <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                    </div>
                    <div class="form_note">
                        <?php if ($error_country) { 
                            echo $error_country; 
                        } ?>
                    </div>
             </div>
            <div class="content_line">
                    <div class="form_label login_width"><span class="required">*</span><?php echo $entry_zone; ?></div>
                    <div class="form_input login_width">
                        <select class="grart" name="zone_id">
                </select>
                    </div>
                    <div class="form_note">
                        <?php if ($error_zone) { 
                            echo $error_zone; 
                        } ?>
                    </div>
             </div>
        </div>
      </div>
    
    
    
    
    

  </form>-->
<script type="text/javascript"><!--
$('input[name=\'customer_group_id\']:checked').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('input[name=\'customer_group_id\']:checked').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('.colorbox').colorbox({
	width: 640,
	height: 480
});
//--></script> 