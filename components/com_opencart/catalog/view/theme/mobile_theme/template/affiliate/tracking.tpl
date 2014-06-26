<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <p><?php echo $text_description; ?></p>
  <div class="content">
	  <label><?php echo $text_code; ?></label>
	  <input type="text" disabled value="<?php echo $code; ?>"/>
	  
	  <label><?php echo $text_generator; ?></label>
	  <input type="text" name="product" value="" />
	  
	  <label><?php echo $text_link; ?></label>
		<textarea name="link" cols="40" rows="5"></textarea>
  </div>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=affiliate/tracking/autocomplete&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.link
					}
				}));
			}
		});
	},
	select: function(event, ui) {
		$('input[name=\'product\']').attr('value', ui.item.label);
		$('textarea[name=\'link\']').attr('value', ui.item.value);
						
		return false;
	}
});
//--></script> 
<?php echo $footer; ?>