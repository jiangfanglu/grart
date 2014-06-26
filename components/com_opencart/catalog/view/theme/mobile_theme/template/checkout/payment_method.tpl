<?php 
$text_agree_mobile = sprintf($this->language->get('text_agree'), $this->url->link('information/information', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
$coupon_status = $this->config->get('coupon_status');
$entry_payment_coupon = $this->language->get('entry_payment_coupon');
$text_payment_coupon = $this->language->get('text_payment_coupon');
$text_payment_coupon_success = $this->language->get('text_payment_coupon_success');
$button_coupon = $this->language->get('button_coupon');
?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
	<p><?php echo $text_payment_method; ?></p>
  	<?php $count_radios = sizeOf($payment_methods);
  	$count_printed_radios = 0;		
  	foreach ($payment_methods as $payment_method) {
		$count_printed_radios++;
		if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
		else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
		else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
		else $radio_class[$count_printed_radios] = "radio_middle";
		?>
		<label class="<?php echo $radio_class[$count_printed_radios];?>">
    		<?php if ($payment_method['code'] == $code || !$code) { 
				$code = $payment_method['code']; ?>
				<input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" checked="checked" />
			<?php } else { ?>
				<input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" />
			<?php } ?>
			<?php echo $payment_method['title']; ?>
		</label>
	<?php } ?>
<?php } ?>
<h3><?php echo $text_comments; ?></h3>
<textarea name="comment" rows="8"><?php echo $comment; ?></textarea>
<?php if($coupon_status){?>
<div id="coupon">
	<h3><?php echo $entry_payment_coupon; ?></h3>
	<input type="text" name="coupon" value="" />
	<a id="button-coupon" class="button"><?php echo $button_coupon; ?></a>
</div>
<?php } ?>
<?php if ($text_agree) { ?>
	<label class="checkbox_single">
		<?php if ($agree) { ?>
		<input type="checkbox" name="agree" value="1" checked="checked" />
		<?php } else { ?>
		<input type="checkbox" name="agree" value="1" />
		<?php } ?>
		<span><?php echo $text_agree_mobile; ?></span>
	</label>
<input class="button" type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" />
<?php } else { ?>
<input class="button" type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" />
<?php } ?>


<script type="text/javascript"><!--
$('#button-coupon').bind('click', function() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=checkout/cart/calculate_coupon',
		data: $('#coupon :input'),
		dataType: 'json',
		beforeSend: function() {
			$('.warning, .success').remove();
			$('#button-coupon').attr('disabled', true);
			$('#button-coupon').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-coupon').attr('disabled', false);
			$('.wait').remove();
		},		
		success: function(json) {
			if (json['error']) {
				$('#button-coupon').before('<p style="margin:0" class="warning">' + json['error'] + '</p>').hide().slideDown();
			} else {
				$("input[name=coupon]").val("");
				$('#button-coupon').before('<p style="margin-top:0" class="success"><?php echo $text_payment_coupon_success; ?></p>').hide().slideDown();
			}
		}
	});
});
//--></script> 
			