<?php 
$text_agree_mobile = sprintf($this->language->get('text_agree'), $this->url->link('information/information', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
?>
<div>
  <h2><?php echo $text_your_details; ?></h2>
  <label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
  <input type="text" name="firstname" value=""  />
  <label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
  <input type="text" name="lastname" value=""  />
  <label><span class="required">*</span> <?php echo $entry_email; ?></label>
  <input type="text" name="email" value=""  />
  <label><span class="required">*</span> <?php echo $entry_telephone; ?></label>
  <input type="text" name="telephone" value=""  />
  <label><?php echo $entry_fax; ?></label>
  <input type="text" name="fax" value=""  />
</div>
<div>
  <h2><?php echo $text_your_password; ?></h2>
  <label><span class="required">*</span> <?php echo $entry_password; ?></label>
  <input type="password" name="password" value=""  />
  <label><span class="required">*</span> <?php echo $entry_confirm; ?></label>
  <input type="password" name="confirm" value=""  />
</div>
<div>
  <h2><?php echo $text_your_address; ?></h2>
  <label><?php echo $entry_company; ?></label>
  <input type="text" name="company" value=""  />
  <div  class="nomargin" style="display: <?php echo (count($customer_groups) > 1 ? 'block' : 'none'); ?>;">
  	<label><?php echo $entry_customer_group; ?></label>
    <select name="customer_group_id">
      <?php foreach ($customer_groups as $customer_group) { ?>
      <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
      <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
      <?php } else { ?>
      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
      <?php } ?>
      <?php } ?>
    </select>
  </div>
  <div id="company-id-display" class="nomargin">
    <label><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id; ?></label>
    <input type="text" name="company_id" value=""/>
  </div>
  <div id="tax-id-display" class="nomargin">
  	<label><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?></label>
    <input type="text" name="tax_id" value=""/>
  </div>
  <label><span class="required">*</span> <?php echo $entry_address_1; ?></label>
  <input type="text" name="address_1" value=""  />
  <label><?php echo $entry_address_2; ?></label>
  <input type="text" name="address_2" value=""  />
  <label><span class="required">*</span> <?php echo $entry_city; ?></label>
  <input type="text" name="city" value=""  />
  <label><span class="required">*</span> <?php echo $entry_zone; ?></label>
  <select name="zone_id">
  </select>
  <label><span id="payment-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></label>
  <input type="text" name="postcode" value="<?php echo $postcode; ?>"/>
  <label><span class="required">*</span> <?php echo $entry_country; ?></label>
  <select name="country_id">
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
<label class="checkbox_single" for="newsletter"><input type="checkbox" name="newsletter" value="1" id="newsletter" />
<span><?php echo $entry_newsletter; ?></span></label>
<?php if ($shipping_required) { ?>
  <label class="checkbox_single" for="shipping"><input type="checkbox" name="shipping_address" value="1" id="shipping" checked="checked" />
  <span><?php echo $entry_shipping; ?></span></label>
<?php } ?>  
<?php if ($text_agree) { ?>
  <label  class="checkbox_single"for="agree"><input id="agree" type="checkbox" name="agree" value="1" />
  <span><?php echo $text_agree_mobile; ?></span></label>
  <input class="button" type="button" value="<?php echo $button_continue; ?>" id="button-register" />
<?php } else { ?>
  <input type="button" value="<?php echo $button_continue; ?>" id="button-register" class="button" />
<?php } ?>
<script type="text/javascript"><!--
$('#payment-address select[name=\'customer_group_id\']').live('change', function() {
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

$('#payment-address select[name=\'customer_group_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('#payment-address select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#payment-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#payment-postcode-required').show();
			} else {
				$('#payment-postcode-required').hide();
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
			
			$('#payment-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#payment-address select[name=\'country_id\']').trigger('change');
//--></script> 
