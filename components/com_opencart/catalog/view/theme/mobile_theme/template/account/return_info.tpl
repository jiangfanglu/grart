<?php echo $header; ?>
<div id="content">
  <ul class="link_list">
  	<li><a href="<?php echo $breadcrumbs[2]['href']; ?>"><?php echo $breadcrumbs[2]['text']; ?></a></li>
  </ul>
  <h1><?php echo $heading_title; ?></h1>
  <h2><?php echo $text_return_detail; ?></h2>
  <div class="return_details">
	  <p class="nomargin"><b><?php echo $text_return_id; ?></b> #<?php echo $return_id; ?></p>
	  <p><b><?php echo $text_date_added; ?></b> <?php echo $date_added; ?></p>
	  <p class="nomargin"><b><?php echo $text_order_id; ?></b> #<?php echo $order_id; ?></p>
	  <p><b><?php echo $text_date_ordered; ?></b> <?php echo $date_ordered; ?></p>
  </div>
  <h2><?php echo $text_product; ?></h2>
  <div class="return_details">
  		<p class="nomargin"><b><?php echo $column_product; ?>:</b> <?php echo $product; ?></p>
		<p class="nomargin"><b><?php echo $column_model; ?>:</b> <?php echo $model; ?></p>
		<p><b><?php echo $column_quantity; ?>:</b> <?php echo $quantity; ?></p>
		<p class="nomargin"><b><?php echo $column_reason; ?>:</b> <?php echo $reason; ?></p>
		<p class="nomargin"><b><?php echo $column_opened; ?>:</b> <?php echo $opened; ?></p>
		<p><b><?php echo $column_action; ?>:</b> <?php echo $action; ?></p>
		<?php if ($comment) { ?>
    		<p><b><?php echo $text_comment; ?>:</b> <?php echo $comment; ?></p>
  		<?php } ?>  
  </div>
    
  <?php if ($histories) { ?>
  <h2><?php echo $text_history; ?></h2>
  <table class="list">
    <thead>
      <tr>
        <td class="left" style="width: 33.3%;"><?php echo $column_date_added; ?></td>
        <td class="left" style="width: 33.3%;"><?php echo $column_status; ?></td>
        <td class="left" style="width: 33.3%;"><?php echo $column_comment; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($histories as $history) { ?>
      <tr>
        <td class="left"><?php echo $history['date_added']; ?></td>
        <td class="left"><?php echo $history['status']; ?></td>
        <td class="left"><?php echo $history['comment']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>