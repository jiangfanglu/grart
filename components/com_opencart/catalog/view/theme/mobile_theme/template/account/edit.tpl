<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
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
         <input type="text" name="fax" value="<?php echo $fax; ?>" />    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
       <input class="button" type="submit" value="<?php echo $button_continue; ?>"/>
      </div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>