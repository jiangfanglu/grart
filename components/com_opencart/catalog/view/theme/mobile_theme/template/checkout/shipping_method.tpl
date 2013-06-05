<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
	<p><?php echo $text_shipping_method; ?></p>
    <?php foreach ($shipping_methods as $shipping_method) { ?>
		<h3><?php echo $shipping_method['title']; ?></h3>
	  	<?php if (!$shipping_method['error']) {
		    $count_radios = sizeOf($shipping_method['quote']);
			$count_printed_radios = 0;		
			foreach ($shipping_method['quote'] as $quote) { 
	    		$count_printed_radios++;
				if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
				else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
				else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
				else $radio_class[$count_printed_radios] = "radio_middle";
				?>
				<label class="<?php echo $radio_class[$count_printed_radios];?>">
					<?php if ($quote['code'] == $code || !$code) { ?>
						<?php $code = $quote['code']; ?>
						<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
			  		<?php } else { ?>
						<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" />
			  		<?php } ?>
					<?php echo $quote['title'].": "; ?><?php echo $quote['text']; ?>
		  		</label>
		  	<?php } 
	  	} else { ?>
		<div class="error"><?php echo $shipping_method['error']; ?></div>
	  	<?php } ?>
  	<?php } ?>
<?php } ?>
<h3><?php echo $text_comments; ?></h3>
<textarea name="comment" rows="8"><?php echo $comment; ?></textarea>
<input class="button" type="button" value="<?php echo $button_continue; ?>" id="button-shipping-method" />
</div>
