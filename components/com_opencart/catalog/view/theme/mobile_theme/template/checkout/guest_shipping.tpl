<label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
<input type="text" name="firstname" value="<?php echo $firstname; ?>"  />
<label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
<input type="text" name="lastname" value="<?php echo $lastname; ?>"  />
<label><?php echo $entry_company; ?></label>
<input type="text" name="company" value="<?php echo $company; ?>"  />
<label><span class="required">*</span> <?php echo $entry_address_1; ?></label>
<input type="text" name="address_1" value="<?php echo $address_1; ?>"  />
<label><?php echo $entry_address_2; ?></label>
<input type="text" name="address_2" value="<?php echo $address_2; ?>"  />
<label><span class="required">*</span> <?php echo $entry_city; ?></label>
<input type="text" name="city" value="<?php echo $city; ?>"  />
<label><span class="required">*</span> <?php echo $entry_postcode; ?></label>
<input type="text" name="postcode" value="<?php echo $postcode; ?>"  />
<label><span class="required">*</span> <?php echo $entry_zone; ?></label>
<select name="zone_id" >
</select>
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
  
<input class="button" type="button" value="<?php echo $button_continue; ?>" id="button-guest-shipping"/>

<script type="text/javascript"><!--
$('#shipping-address select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#shipping-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#shipping-postcode-required').show();
			} else {
				$('#shipping-postcode-required').hide();
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
			
			$('#shipping-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#shipping-address select[name=\'country_id\']').trigger('change');
//--></script>