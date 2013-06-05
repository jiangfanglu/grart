<?php 
$text_agree_mobile = sprintf($this->language->get('text_agree'), $this->url->link('information/information', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
?>
<?php echo $header; ?>
<div id="content">

  <h1><?php echo $heading_title; ?></h1>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>  <p><?php echo $text_account_already; ?></p>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_your_details; ?></h2>
    <div class="content">
        <label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>" />
              <?php if ($error_firstname) { ?>
              <span class="error"><?php echo $error_firstname; ?></span>
              <?php } ?>
        <label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>" />
              <?php if ($error_lastname) { ?>
              <span class="error"><?php echo $error_lastname; ?></span>
              <?php } ?>
         <label><span class="required">*</span> <?php echo $entry_email; ?></label>
         <input type="text" name="email" value="<?php echo $email; ?>" />
              <?php if ($error_email) { ?>
              <span class="error"><?php echo $error_email; ?></span>
              <?php } ?>
         <label><span class="required">*</span> <?php echo $entry_telephone; ?></label>
         <input type="text" name="telephone" value="<?php echo $telephone; ?>" />
              <?php if ($error_telephone) { ?>
              <span class="error"><?php echo $error_telephone; ?></span>
              <?php } ?>
         <label><?php echo $entry_fax; ?></label>
         <input type="text" name="fax" value="<?php echo $fax; ?>" />
    </div>
    <h2><?php echo $text_your_address; ?> </h2>
    <div class="content">
        <label><?php echo $entry_company; ?></label>
        <input type="text" name="company" value="<?php echo $company; ?>" />
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
            <?php if ($error_company_id) { ?>
            <span class="error"><?php echo $error_company_id; ?></span>
            <?php } ?>
		  </div>		
		  <div id="company-id-display" class="nomargin">
			<label><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id; ?></label>
			<input type="text" name="company_id" value=""/>
            <?php if ($error_company_id) { ?>
            <span class="error"><?php echo $error_company_id; ?></span>
            <?php } ?>
		  </div>		
		  <div id="tax-id-display" class="nomargin">
			<label><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?></label>
			<input type="text" name="tax_id" value=""/>
            <?php if ($error_tax_id) { ?>
            <span class="error"><?php echo $error_tax_id; ?></span>
            <?php } ?>			
		  </div>		  
		  
        <label><span class="required">*</span> <?php echo $entry_address_1; ?></label>
        <input type="text" name="address_1" value="<?php echo $address_1; ?>" />
              <?php if ($error_address_1) { ?>
              <span class="error"><?php echo $error_address_1; ?></span>
              <?php } ?>
       <label><?php echo $entry_address_2; ?></label>
       <input type="text" name="address_2" value="<?php echo $address_2; ?>" />
        <label><span class="required">*</span> <?php echo $entry_city; ?></label>
        <input type="text" name="city" value="<?php echo $city; ?>" />
              <?php if ($error_city) { ?>
              <span class="error"><?php echo $error_city; ?></span>
              <?php } ?>
       <label><span class="required">*</span> <?php echo $entry_zone; ?></label>
       <select name="zone_id">
		</select>
              <?php if ($error_zone) { ?>
              <span class="error"><?php echo $error_zone; ?></span>
              <?php } ?>
       <label id="postcode"><span class="required">*</span> <?php echo $entry_postcode; ?></label>
       <input type="text" name="postcode" value="<?php echo $postcode; ?>" />
			  <?php if ($error_postcode) { ?>
              <span class="error"><?php echo $error_postcode; ?></span>
              <?php } ?>
       <label><span class="required">*</span> <?php echo $entry_country; ?></label>
       <select name="country_id" id="country_id">
                <option value="FALSE"><?php echo $text_select; ?></option>
                <?php foreach ($countries as $country) { ?>
                <?php if ($country['country_id'] == $country_id) { ?>
                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php if ($error_country) { ?>
              <span class="error"><?php echo $error_country; ?></span>
              <?php } ?>
	    </div>
    <h2><?php echo $text_your_password; ?></h2>
    <div class="content">
        <label><span class="required">*</span> <?php echo $entry_password; ?></label>
        <input type="password" name="password" value="<?php echo $password; ?>" />
              <?php if ($error_password) { ?>
              <span class="error"><?php echo $error_password; ?></span>
              <?php } ?>
         <label><span class="required">*</span> <?php echo $entry_confirm; ?></label>
         <input type="password" name="confirm" value="<?php echo $confirm; ?>" />
              <?php if ($error_confirm) { ?>
              <span class="error"><?php echo $error_confirm; ?></span>
              <?php } ?>
    </div>
    <h2><?php echo $text_newsletter; ?></h2>
    <div class="content">
        <label ><?php echo $entry_newsletter; ?></label>
              <label class="radio_top" for="news_yes"><input id="news_yes" class="radio" type="radio" name="newsletter" value="1" checked="checked"/>
              <?php echo $text_yes; ?></label>
              <label class="radio_bottom" for="news_no"><input id="news_no" class="radio" type="radio" name="newsletter" value="0"  />
              <?php echo $text_no; ?></label>
	</div>
    <?php if ($text_agree) { ?>
    <div class="buttons">
		   <label for="terms" class="checkbox_single">
				<?php if ($agree) { ?>
				  <input id="terms" type="checkbox" name="agree" value="1" checked="checked" />
				  <?php } else { ?>
				  <input id="terms" type="checkbox" name="agree" value="1" />
				  <?php } ?>
			<span><?php echo $text_agree_mobile; ?></span>
			</label>
			<div class="left"><input class="button" type="submit" value="<?php echo $button_continue; ?>" /></div>
    </div>
    <?php } else { ?>
    <div class="buttons">
      <div class="left">
        <input class="button" type="submit" value="<?php echo $button_continue; ?>"/>
      </div>
    </div>
    <?php } ?>
  </form>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('select[name=\'customer_group_id\']').live('change', function() {
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

$('select[name=\'customer_group_id\']').trigger('change');
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
 

<?php echo $footer; ?>