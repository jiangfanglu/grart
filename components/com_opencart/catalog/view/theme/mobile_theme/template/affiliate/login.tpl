<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div id="content">

  <h1><?php echo $heading_title; ?></h1>
  <?php echo $text_description; ?>
  <div class="login-content">
    <div>
      <h2><?php echo $text_new_affiliate; ?></h2>
      <div class="content"><?php echo $text_register_account; ?> <a href="<?php echo $register; ?>" class="button"><?php echo $button_continue; ?></a></div>
    </div>
    <div class="right">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo $text_returning_affiliate; ?></h2>
        <div class="content">
          <p><?php echo $text_i_am_returning_affiliate; ?></p>
          <label><?php echo $entry_email; ?></label>
          <input type="text" name="email" value="" />
          <label><?php echo $entry_password; ?></label>
          <input type="password" name="password" value="" />
          <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
          <input class="button" type="submit" value="<?php echo $button_login; ?>" />
          <?php if ($redirect) { ?>
          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>