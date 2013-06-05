<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <p><?php echo $text_description; ?></p>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
  <div class="content">
    <label><span class="required">*</span> <?php echo $entry_to_name; ?></label>
    <input type="text" name="to_name" value="<?php echo $to_name; ?>" />
          <?php if ($error_to_name) { ?>
          <span class="error"><?php echo $error_to_name; ?></span>
          <?php } ?>
    <label><span class="required">*</span> <?php echo $entry_to_email; ?></label>
    <input type="text" name="to_email" value="<?php echo $to_email; ?>" />
          <?php if ($error_to_email) { ?>
          <span class="error"><?php echo $error_to_email; ?></span>
          <?php } ?>
    <label><span class="required">*</span> <?php echo $entry_from_name; ?></label>
    <input type="text" name="from_name" value="<?php echo $from_name; ?>" />
          <?php if ($error_from_name) { ?>
          <span class="error"><?php echo $error_from_name; ?></span>
          <?php } ?>
    <label><span class="required">*</span> <?php echo $entry_from_email; ?></label>
    <input type="text" name="from_email" value="<?php echo $from_email; ?>" />
          <?php if ($error_from_email) { ?>
          <span class="error"><?php echo $error_from_email; ?></span>
          <?php } ?>
    <label><span class="required">*</span> <?php echo $entry_theme; ?></label>
	<?php $count_radios = sizeOf($voucher_themes);
	$count_printed_radios = 0;
    foreach ($voucher_themes as $voucher_theme) { 
	
			$count_printed_radios++;
			if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
			else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
			else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
			else $radio_class[$count_printed_radios] = "radio_middle";
			?>
	
          <?php if ($voucher_theme['voucher_theme_id'] == $voucher_theme_id) { ?>
          	   	<label class="<?php echo $radio_class[$count_printed_radios];?>">
			   		<input type="radio" name="voucher_theme_id" value="<?php echo $voucher_theme['voucher_theme_id']; ?>" id="voucher-<?php echo $voucher_theme['voucher_theme_id']; ?>" checked="checked" />
          			<?php echo $voucher_theme['name']; ?>
				</label>
          <?php } else { ?>
				<label class="<?php echo $radio_class[$count_printed_radios];?>">          			
					<input type="radio" name="voucher_theme_id" value="<?php echo $voucher_theme['voucher_theme_id']; ?>" id="voucher-<?php echo $voucher_theme['voucher_theme_id']; ?>" />
          			<?php echo $voucher_theme['name']; ?>
				</label>
          <?php } ?>
     <?php } ?>
	  <?php if ($error_theme) { ?>
	  <span class="error"><?php echo $error_theme; ?></span>
	  <?php } ?>
      <label><?php echo $entry_message; ?></label>
      <textarea name="message" cols="40" rows="5"><?php echo $message; ?></textarea>
	  <label><span class="required">*</span> <?php echo $entry_amount; ?></label>
      <input type="text" name="amount" value="<?php echo $amount; ?>" size="5" />
          <?php if ($error_amount) { ?>
          <span class="error"><?php echo $error_amount; ?></span>
          <?php } ?>
    </div>
    <div class="buttons">
	  	<label class="checkbox_single">
			<?php if ($agree) { ?>
				<input type="checkbox" name="agree" value="1" checked="checked" />
			<?php } else { ?>
				<input type="checkbox" name="agree" value="1" />
			<?php } ?>
			<span><?php echo $text_agree; ?></span>
		</label>
		<div class="left">
			<input class="button" type="submit" value="<?php echo $button_continue; ?>" />
		</div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>