<?php echo $header; ?>

<div id="content">
  <h1><?php echo $heading_title; ?></h1>
	<?php if ($success) { ?>
	<div class="success"><?php echo $success; ?></div>
	<?php } ?>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>  <div class="login-content">
    <div>
      <h2><?php echo $text_new_customer; ?></h2>
      <div class="content">
        <p><b><?php echo $text_register; ?></b></p>
        <p><?php echo $text_register_account; ?></p>
	  </div>
		<div class="buttons">
		  <div class="left">
			<a href="<?php echo $register; ?>" class="button"><?php echo $button_continue; ?></a>
		  </div>
		</div>
    </div>
    <div>
      <h2><?php echo $text_returning_customer; ?></h2>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="content">
          <p><?php echo $text_i_am_returning_customer; ?></p>
          <b><?php echo $entry_email; ?></b><br />
          <input type="text" name="email" value="" />
          <b><?php echo $entry_password; ?></b><br />
          <input type="password" name="password" value="" />
          <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
        </div>
		<div class="buttons">
		  <div class="left">
			  <input class="button" type="submit" value="<?php echo $button_login; ?>"/>
			  <?php if ($redirect) { ?>
			  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
			  <?php } ?>
		  </div>
		</div>
      </form>
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#login').submit();
	}
});
//--></script> 
<?php echo $footer; ?>