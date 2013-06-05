<?php 
$text_agree_mobile = sprintf($this->language->get('text_agree'), $this->url->link('information/information', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
?>
<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div id="content">

  <h1><?php echo $heading_title; ?></h1>
  <p><?php echo $text_account_already; ?></p>
  <p><?php echo $text_signup; ?></p>
  <form id="affiliate_form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
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
    <h2><?php echo $text_your_address; ?></h2>
    <div class="content">
        <label><?php echo $entry_company; ?></label>
        <input type="text" name="company" value="<?php echo $company; ?>" />
        <label><?php echo $entry_website; ?></label>
        <input type="text" name="website" value="<?php echo $website; ?>" />
        
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
    <h2><?php echo $text_payment; ?></h2>
    <div class="content">
      <label><?php echo $entry_tax; ?></label>
      <input type="text" name="tax" value="<?php echo $tax; ?>" />
      <label><?php echo $entry_payment; ?></label>
	  <label for="cheque" class="radio_top">
		  <?php if ($payment == 'cheque') { ?>
				  <input type="radio" name="payment" value="cheque" id="cheque" checked="checked" />
			  <?php } else { ?>
				  <input type="radio" name="payment" value="cheque" id="cheque" />
		  <?php } ?>
		  <?php echo $text_cheque; ?>
      </label>
	  <label for="paypal" class="radio_middle">
		  <?php if ($payment == 'paypal') { ?>
			  <input type="radio" name="payment" value="paypal" id="paypal" checked="checked" />
		  <?php } else { ?>
			  <input type="radio" name="payment" value="paypal" id="paypal" />
		  <?php } ?>
		  <?php echo $text_paypal; ?>
	  </label>
	  <label for="bank" class="radio_bottom">
          <?php if ($payment == 'bank') { ?>
              <input type="radio" name="payment" value="bank" id="bank" checked="checked" />
          <?php } else { ?>
              <input type="radio" name="payment" value="bank" id="bank" />
          <?php } ?>
          <?php echo $text_bank; ?>
	  </label>
      <fieldset id="payment-cheque" class="payment">
          <label><?php echo $entry_cheque; ?></label>
          <input type="text" name="cheque" value="<?php echo $cheque; ?>" />
      </fieldset>
      <fieldset class="payment" id="payment-paypal">
          <label><?php echo $entry_paypal; ?></label>
          <input type="text" name="paypal" value="<?php echo $paypal; ?>" />
      </fieldset>
      <fieldset id="payment-bank" class="payment">
          <label><?php echo $entry_bank_name; ?></label>
          <input type="text" name="bank_name" value="<?php echo $bank_name; ?>" />
          <label><?php echo $entry_bank_branch_number; ?></label>
          <input type="text" name="bank_branch_number" value="<?php echo $bank_branch_number; ?>" />
          <label><?php echo $entry_bank_swift_code; ?></label>
          <input type="text" name="bank_swift_code" value="<?php echo $bank_swift_code; ?>" />
          <label><?php echo $entry_bank_account_name; ?></label>
          <input type="text" name="bank_account_name" value="<?php echo $bank_account_name; ?>" />
          <label><?php echo $entry_bank_account_number; ?></label>
          <input type="text" name="bank_account_number" value="<?php echo $bank_account_number; ?>" />
	  </fieldset>
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
    <?php if ($text_agree) { ?>
    <div class="buttons">
      	<label class="checkbox_single">
        <?php if ($agree) { ?>
        <input type="checkbox" name="agree" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="agree" value="1" />
        <?php } ?>
		<span><?php echo $text_agree_mobile; ?></span>
		</label>
		<div class="left">
        <input class="button" type="submit" value="<?php echo $button_continue; ?>"/>
        </div>
    </div>
    <?php } else { ?>
    <div class="buttons">
      <div class="right">
        <input class="button" type="submit" value="<?php echo $button_continue; ?>"/>
      </div>
    </div>
    <?php } ?>
  </form>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=affiliate/register/country&country_id=' + this.value,
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
$('input[name=\'payment\']').bind('change', function() {
	$('.payment').hide();
	
	$('#payment-' + this.value).show();
});

$('input[name=\'payment\']:checked').trigger('change');
//--></script> 

<?php echo $footer; ?>