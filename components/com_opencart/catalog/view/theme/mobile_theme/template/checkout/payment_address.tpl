<?php if ($addresses) { ?>
<label class="radio_top" for="payment-address-existing">
	<input type="radio" name="payment_address" value="existing" id="payment-address-existing" checked="checked" />
	<?php echo $text_address_existing; ?>
</label>
<label class="radio_bottom" for="payment-address-new">
  <input type="radio" name="payment_address" value="new" id="payment-address-new" />
  <?php echo $text_address_new; ?>
</label>
<div id="payment-existing">
  <select name="address_id" style="width: 100%;" size="2">
    <?php foreach ($addresses as $address) { ?>
    <?php if ($address['address_id'] == $address_id) { ?>
    <option value="<?php echo $address['address_id']; ?>" selected="selected"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
    <?php } else { ?>
    <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
    <?php } ?>
    <?php } ?>
  </select>
</div>
<?php } ?>

<div id="payment-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
  <label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
  <input type="text" name="firstname" value=""  />
  <label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
  <input type="text" name="lastname" value=""  />
  <label><?php echo $entry_company; ?></label>
  <input type="text" name="company" value=""  />
  
  <div id="company-id-display" class="nomargin" style="display: <?php echo ($company_id_display ? 'block' : 'none'); ?>;">
    <label><span style="display: <?php echo ($company_id_required ? 'block' : 'none'); ?>;" class="required">*</span> <?php echo $entry_company_id; ?></label>
    <input type="text" name="company_id" value=""/>
  </div>
  <div id="tax-id-display" class="nomargin" style="display: <?php echo ($tax_id_display ? 'block' : 'none'); ?>;">
  	<label><span style="display: <?php echo ($tax_id_required ? 'table-row' : 'none'); ?>;" class="required">*</span> <?php echo $entry_tax_id; ?></label>
    <input type="text" name="tax_id" value=""/>
  </div>  
  
  <label><span class="required">*</span> <?php echo $entry_address_1; ?></label>
  <input type="text" name="address_1" value=""  />
  <label><?php echo $entry_address_2; ?></label>
  <input type="text" name="address_2" value=""  />
  <label><span class="required">*</span> <?php echo $entry_city; ?></label>
  <input type="text" name="city" value=""  />
   <label><span class="required">*</span> <?php echo $entry_zone; ?></label>
   <select name="zone_id" >
   </select>  
   <label><span class="required">*</span> <?php echo $entry_postcode; ?></label>
  <input type="text" name="postcode" value=""  />
  <label><span class="required">*</span> <?php echo $entry_country; ?></label>
  <select name="country_id" >
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
<input class="button" type="submit" value="<?php echo $button_continue; ?>" id="button-payment-address" />
<script type="text/javascript"><!--
$('#payment-address input[name=\'payment_address\']').live('change', function() {
	if (this.value == 'new') {
		$('#payment-existing').hide();
		$('#payment-new').show();
	} else {
		$('#payment-existing').show();
		$('#payment-new').hide();
	}
});
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