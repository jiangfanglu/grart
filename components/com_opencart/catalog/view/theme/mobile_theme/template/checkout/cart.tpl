<?php echo $header; ?>
<?php if ($attention) { ?>
<div class="attention"><?php echo $attention; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>

<div id="content">
  <h1><?php echo $heading_title; ?>
    <?php if ($weight) { ?>
    &nbsp;(<?php echo $weight; ?>)
    <?php } ?>
  </h1>
  <form id="cart_form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="cart-info">
          <?php foreach ($products as $product) { ?>
		  	 <div class="product">
				<div class="product_summary">
					<h2 <?php if (!$product['stock']) echo 'class="warning"';?>><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
						<?php if (!$product['stock']) { ?>
							  <span class="stock">***</span>
						<?php } ?>
					</h2>
					<div>
						<?php foreach ($product['option'] as $option) { ?>
							- <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
						<?php } ?>
					</div>
					<?php if ($product['reward']) { ?>
						<small><?php echo $product['reward']; ?></small>
					<?php } ?>
					<label class="quantity">
						<span><?php echo $column_quantity; ?>: </span>
						<input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" />
					</label>
					<p>
						<?php echo $column_price; ?>: <b><?php echo $product['price']; ?></b>
						<?php echo $column_total; ?>: <b><?php echo $product['total']; ?></b>
					</p>
					<a class="button" id="update" type="submit"><?php echo $button_update; ?></a>
					<a class="button" href="<?php echo $product['remove']; ?>"><?php echo $button_remove; ?></a>
				</div>
					
				<?php if ($product['thumb']) { ?>
					<a class="product_thumb" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
				<?php } ?>
		 		</div>
			<?php } ?>
          	<?php foreach ($vouchers as $vouchers) { ?>
          		<?php echo $vouchers['description']; ?>
            	<input type="text" name="" value="1" size="1" disabled="disabled" />
              	<a href="<?php echo $vouchers['remove']; ?>">
					<img src="catalog/view/theme/default/image/remove.png" alt="<?php echo $text_remove; ?>" title="<?php echo $button_remove; ?>" />
				</a>
            	<?php echo $vouchers['amount']; ?>
            	<?php echo $vouchers['amount']; ?>
         <?php } ?>
	  </div>
  </form>
  <?php if ($coupon_status || $voucher_status || $reward_status || $shipping_status) { ?>
  <h2><?php echo $text_next; ?></h2>
  <div class="content">
    <p><?php echo $text_next_choice; ?></p>
	<?php $count_radios = $coupon_status + $voucher_status + $reward_status;
	$count_printed_radios = 0;?>
      <?php if ($coupon_status) { 
	    $count_printed_radios++;
		if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
		else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
		else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
		else $radio_class[$count_printed_radios] = "radio_middle";
		?>
		<label class="<?php echo $radio_class[$count_printed_radios];?>"><input class="radio"  type="radio" name="next" value="coupon" id="use_coupon" />
		<?php echo $text_use_coupon; ?></label>
	  <?php } ?>
      <?php if ($voucher_status) { 
	    $count_printed_radios++;
		if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
		else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
		else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
		else $radio_class[$count_printed_radios] = "radio_middle";
		?>
		<label class="<?php echo $radio_class[$count_printed_radios];?>"><input class="radio"  type="radio" name="next" value="voucher" id="use_voucher" />
		<?php echo $text_use_voucher; ?></label>
      <?php } ?>
      <?php if ($reward_status) { 
	    $count_printed_radios++;
		if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
		else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
		else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
		else $radio_class[$count_printed_radios] = "radio_middle";
		?>
		<label class="<?php echo $radio_class[$count_printed_radios];?>"><input class="radio"  type="radio" name="next" value="reward" id="use_reward" />
		<?php echo $text_use_reward; ?></label>
      <?php } ?>
  </div>
  <div class="cart-module">
    <div id="coupon" class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	  	<fieldset>
			<?php echo $entry_coupon; ?>
			<input type="text" name="coupon" value="<?php echo $coupon; ?>" />
			<input type="hidden" name="next" value="coupon" />
			<input type="submit" value="<?php echo $button_coupon; ?>"/>
		</fieldset>
      </form>
    </div>
    <div id="voucher" class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	  	<fieldset>
			<?php echo $entry_voucher; ?>
			<input type="text" name="voucher" value="<?php echo $voucher; ?>" />
			<input type="hidden" name="next" value="voucher" />
			<input type="submit" value="<?php echo $button_voucher; ?>" />
		</fieldset>     
	  </form>
    </div>
    <div id="reward" class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	  	<fieldset>
			<?php echo $entry_reward; ?>
			<input type="text" name="reward" value="<?php echo $reward; ?>" />
			<input type="hidden" name="next" value="reward" />
			<input type="submit" value="<?php echo $button_reward; ?>" /></a>
	  	</fieldset>
      </form>
    </div>
    <?php } ?>
  </div>
  <div class="cart-total">
    <table id="total">
      <?php foreach ($totals as $total) { ?>
      <tr>
        <td colspan="5" class="right"><b><?php echo $total['title']; ?>:</b></td>
        <td class="right"><?php echo $total['text']; ?></td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_shopping; ?></a></div>
    <div class="right"><a href="<?php echo $checkout; ?>" class="button"><?php echo $button_checkout; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#update').click(function(event){
	$('#cart_form').submit();
});
$('input[name=\'next\']').bind('change', function() {
	$('.cart-module > div').hide();
	
	$('#' + this.value).show();
});

<?php if ($next == 'coupon') { ?>
$('#use_coupon').trigger('click');
<?php } ?>
<?php if ($next == 'voucher') { ?>
$('#use_voucher').trigger('click');
<?php } ?>
<?php if ($next == 'reward') { ?>
$('#use_reward').trigger('click');
<?php } ?>
<?php if ($next == 'shipping') { ?>
$('#shipping_estimate').trigger('click');
<?php } ?>
//--></script>
<?php if ($shipping_status) { ?>
<script type="text/javascript"><!--
$('select[name=\'zone_id\']').load('index.php?route=checkout/cart/zone&country_id=<?php echo $country_id; ?>&zone_id=<?php echo $zone_id; ?>');
//--></script>
<?php } ?>
<?php echo $footer; ?>