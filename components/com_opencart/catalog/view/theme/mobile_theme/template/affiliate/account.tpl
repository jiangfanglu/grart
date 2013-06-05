<?php 
$text_logout = $this->language->get('text_logout');
$logout = $this->url->link('affiliate/logout', '', 'SSL');
?>
<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <h2><?php echo $text_my_account; ?></h2>
    <ul class="link_list">
	  <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
	  <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
      <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
      <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
      <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
    </ul>
  <h2><?php echo $text_my_tracking; ?></h2>
    <ul class="link_list">
      <li><a href="<?php echo $tracking; ?>"><?php echo $text_tracking; ?></a></li>
    </ul>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>