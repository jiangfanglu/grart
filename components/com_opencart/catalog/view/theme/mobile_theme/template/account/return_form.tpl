<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <?php echo $text_description; ?>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_order; ?></h2>
    <div class="content">
      <div>
	  	<label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>"  />
        <?php if ($error_firstname) { ?>
        <span class="error"><?php echo $error_firstname; ?></span>
        <?php } ?>
        <label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>"  />
        <?php if ($error_lastname) { ?>
        <span class="error"><?php echo $error_lastname; ?></span>
        <?php } ?>
        <label><span class="required">*</span> <?php echo $entry_email; ?></label>
        <input type="text" name="email" value="<?php echo $email; ?>"  />
        <?php if ($error_email) { ?>
        <span class="error"><?php echo $error_email; ?></span>
        <?php } ?>
        <label><span class="required">*</span> <?php echo $entry_telephone; ?></label>
        <input type="text" name="telephone" value="<?php echo $telephone; ?>"  />
        <?php if ($error_telephone) { ?>
        <span class="error"><?php echo $error_telephone; ?></span>
        <?php } ?>
        <label><span class="required">*</span> <?php echo $entry_order_id; ?></label>
        <input type="text" name="order_id" value="<?php echo $order_id; ?>"  />
        <?php if ($error_order_id) { ?>
        <span class="error"><?php echo $error_order_id; ?></span>
        <?php } ?>
        <label><?php echo $entry_date_ordered; ?></label>
        <input type="text" name="date_ordered" value="<?php echo $date_ordered; ?>" class="large-field date" />
      </div>
    </div>
    <h2><?php echo $text_product; ?></h2>
    <div id="return-product">
      <div class="content">
		<label><span class="required">*</span> <?php echo $entry_product; ?></label>
		<input type="text" name="product" value="<?php echo $product; ?>" />
		<?php if ($error_product) { ?>
		<span class="error"><?php echo $error_product; ?></span>
		<?php } ?>
		<label><span class="required">*</span> <?php echo $entry_model; ?></label>
		<input type="text" name="model" value="<?php echo $model; ?>" />
		<?php if ($error_model) { ?>
		<span class="error"><?php echo $error_model; ?></span>
		<?php } ?>
		<label><?php echo $entry_quantity; ?></label>
		<input type="text" name="quantity" value="<?php echo $quantity; ?>" />
		<label><span class="required">*</span> <?php echo $entry_reason; ?></label>
		<?php $count_radios = sizeOf($return_reasons);
		$count_printed_radios = 0;		
		foreach ($return_reasons as $return_reason) {
			$count_printed_radios++;
			if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
			else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
			else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
			else $radio_class[$count_printed_radios] = "radio_middle";
			?>
			<?php if ($return_reason['return_reason_id'] == $return_reason_id) { ?>
				<label class="<?php echo $radio_class[$count_printed_radios];?>" >
					<input type="radio" name="return_reason_id" value="<?php echo $return_reason['return_reason_id']; ?>" id="return-reason-id<?php echo $return_reason['return_reason_id']; ?>" checked="checked" />
					<?php echo $return_reason['name']; ?>
				</label>
			<?php } else { ?>
				<label class="<?php echo $radio_class[$count_printed_radios];?>" >
					<input type="radio" name="return_reason_id" value="<?php echo $return_reason['return_reason_id']; ?>" id="return-reason-id<?php echo $return_reason['return_reason_id']; ?>" />
					<?php echo $return_reason['name']; ?>
				</label>
			<?php  } ?>
		<?php  } ?>
        <?php if ($error_reason) { ?>
            <span class="error"><?php echo $error_reason; ?></span>
        <?php } ?>
        <label><?php echo $entry_opened; ?></label>
		<label for="opened" class="radio_top">
			<?php if ($opened) { ?>
				<input type="radio" name="opened" value="1" id="opened" checked="checked" />
			<?php } else { ?>
				<input type="radio" name="opened" value="1" id="opened" />
			<?php } ?>
			<?php echo $text_yes; ?>
		</label>
		<label for="unopened" class="radio_bottom">
            <?php if (!$opened) { ?>
            <input type="radio" name="opened" value="0" id="unopened" checked="checked" />
            <?php } else { ?>
            <input type="radio" name="opened" value="0" id="unopened" />
            <?php } ?>
            <?php echo $text_no; ?>
		</label>
        <label><?php echo $entry_fault_detail; ?></label>
        <textarea name="comment" cols="150" rows="6"><?php echo $comment; ?></textarea>
        <label><?php echo $entry_captcha; ?></label>
        <input type="text" name="captcha" value="<?php echo $captcha; ?>" />
        <img src="index.php?route=account/return/captcha" alt="" />
		<?php if ($error_captcha) { ?>
			<span class="error"><?php echo $error_captcha; ?></span>
		<?php } ?>
      </div>
    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input class="button" type="submit" value="<?php echo $button_continue; ?>"/>
      </div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script> 
<?php echo $footer; ?>