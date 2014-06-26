<h2><?php echo $text_credit_card; ?></h2>
<div id="payment">
  <label><?php echo $entry_cc_number; ?></label>
  <input type="text" name="cc_number" value="" />
  <label><?php echo $entry_cc_start_date; ?></label>
	  <select class="small_field" name="cc_start_date_month">
			  <?php foreach ($months as $month) { ?>
			  <option value="<?php echo $month['value']; ?>"><?php echo $month['text']; ?></option>
			  <?php } ?>
	  </select>
        /
        <select class="small_field" name="cc_start_date_year">
          <?php foreach ($year_valid as $year) { ?>
          <option value="<?php echo $year['value']; ?>"><?php echo $year['text']; ?></option>
          <?php } ?>
        </select>
        <?php echo $text_start_date; ?>
    <label><?php echo $entry_cc_expire_date; ?></label>
    <select class="small_field" name="cc_expire_date_month">
          <?php foreach ($months as $month) { ?>
          <option value="<?php echo $month['value']; ?>"><?php echo $month['text']; ?></option>
          <?php } ?>
        </select>
        /
        <select class="small_field" name="cc_expire_date_year">
          <?php foreach ($year_expire as $year) { ?>
          <option value="<?php echo $year['value']; ?>"><?php echo $year['text']; ?></option>
          <?php } ?>
        </select>
    <label><?php echo $entry_cc_cvv2; ?></label>
    <input type="text" name="cc_cvv2" value="" size="3" />
    <label><?php echo $entry_cc_issue; ?></label>
    <input type="text" name="cc_issue" value="" size="1" />
        <?php echo $text_issue; ?>
</div>
    <input class="button" type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" /></a>

<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({
		url: 'index.php?route=payment/perpetual_payments/send',
		type: 'post',
		data: $('#payment :input'),
		dataType: 'json',		
		beforeSend: function() {
			$('#button-confirm').attr('disabled', true);
			
			$('#payment').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		success: function(json) {
			if (json['error']) {
				alert(json['error']);
				
				$('#button-confirm').attr('disabled', false);
			}
			
			$('.attention').remove();
			
			if (json['success']) {
				location = json['success'];
			}
		}
	});
});
//--></script> 