<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <form id="affiliate_form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_your_payment; ?></h2>
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
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right"><input class="button" type="submit" value="<?php echo $button_continue; ?>" /></div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('input[name=\'payment\']').bind('change', function() {
	$('.payment').hide();
	
	$('#payment-' + this.value).show();
});

$('input[name=\'payment\']:checked').trigger('change');
//--></script> 
<?php echo $footer; ?> 