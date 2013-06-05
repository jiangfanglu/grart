<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_location; ?></h2>
    <div class="contact-info">
      <div class="content">
	    <h3><?php echo $text_address; ?></h3>
        <?php echo $store; ?><br />
        <?php echo $address; ?>
        <?php if ($telephone) { ?>
        <h3><?php echo $text_telephone; ?></h3>
        <?php echo $telephone; ?>
        <?php } ?>
        <?php if ($fax) { ?>
        <h3><?php echo $text_fax; ?></h3>
        <?php echo $fax; ?>
        <?php } ?>
    </div>
    </div>
    <h2><?php echo $text_contact; ?></h2>
    <div class="content">
    <label><?php echo $entry_name; ?></label>
    <input type="text" name="name" value="<?php echo $name; ?>" />
    <?php if ($error_name) { ?>
    <span class="error"><?php echo $error_name; ?></span>
    <?php } ?>
    <label><?php echo $entry_email; ?></label>
    <input type="text" name="email" value="<?php echo $email; ?>" />
    <?php if ($error_email) { ?>
    <span class="error"><?php echo $error_email; ?></span>
    <?php } ?>
    <label><?php echo $entry_enquiry; ?></label>
    <textarea name="enquiry" cols="40" rows="10"><?php echo $enquiry; ?></textarea>
    <?php if ($error_enquiry) { ?>
    <span class="error"><?php echo $error_enquiry; ?></span>
    <?php } ?>
    <label><?php echo $entry_captcha; ?></label>
    <input type="text" name="captcha" value="<?php echo $captcha; ?>" />
    <img src="index.php?route=information/contact/captcha" alt="" />
    <?php if ($error_captcha) { ?>
    <span class="error"><?php echo $error_captcha; ?></span>
    <?php } ?>
    </div>
    <div class="buttons">
      <div class="left"><input class="button" type="submit" value="<?php echo $button_continue; ?>" /></div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>