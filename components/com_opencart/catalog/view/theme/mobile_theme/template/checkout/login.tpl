<div>
  <h2><?php echo $text_new_customer; ?></h2>
  <p><b><?php echo $text_checkout; ?></b></p>
		<?php if($guest_checkout) $radio_class="radio_top";
		else $radio_class="radio_single";?>
		<label for="register" class="<?php echo $radio_class;?>">
		<?php if ($account == 'register') { ?>
			<input type="radio" name="account" value="register" id="register" checked="checked" />
		<?php } else { ?>
			<input type="radio" name="account" value="register" id="register" />
		<?php } ?>
		<b><?php echo $text_register; ?></b></label>
		<?php if ($guest_checkout) { ?>
			<label for="guest" class="radio_bottom" >
			<?php if ($account == 'guest') { ?>
				<input type="radio" name="account" value="guest" id="guest" checked="checked" />
			<?php } else { ?>
				<input type="radio" name="account" value="guest" id="guest" />
			<?php } ?>
			<b><?php echo $text_guest; ?></b></label>
		<?php } ?>
		<p><?php echo $text_register_account; ?></p>
		<input class="button" type="submit" value="<?php echo $button_continue; ?>" id="button-account" />
</div>
<div id="login">
  <h2><?php echo $text_returning_customer; ?></h2>
		<label><?php echo $entry_email; ?></label>
		<input type="text" name="email" value="" />
		<label><?php echo $entry_password; ?></label>
		<input type="password" name="password" value="" />
		<p><a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a></p>
		<input class="button" type="submit" value="<?php echo $button_login; ?>" id="button-login" />
</div>