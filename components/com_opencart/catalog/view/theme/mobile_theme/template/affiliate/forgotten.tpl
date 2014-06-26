<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <p><?php echo $text_email; ?></p>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_your_email; ?></h2>
    <div class="content">
         <label><span class="required">*</span> <?php echo $entry_email; ?></label>
         <input type="text" name="email" value="" />
    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input class="button" type="submit" value="<?php echo $button_continue; ?>"/>
      </div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>