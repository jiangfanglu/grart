<?php
//show a message at the top of the product page if the user has clicked add to basket from a catgroy page but the product requires an option selecting
if(isset($this->request->get['select'])){
	$information = $this->language->get('information_select');;
} else {
	$information = false;
}
?>
<?php echo $header; ?>

<div id="content">
  <?php if(sizeOf($breadcrumbs)>2) { ?>
  		<ul class="link_list">
		<li><a href="<?php echo $breadcrumbs[1]['href']; ?>"><?php echo $breadcrumbs[1]['text']; ?></a></li>
		</ul>
  <?php } ?> 
   <h1><?php echo $heading_title; ?></h1>
	<?php if ($information) { ?>
	<div class="information"><?php echo $information; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
	<?php } ?>
  <div class="product-info">
    <?php if ($thumb || $images) { ?>
      <?php if ($thumb) { ?>
      <div class="image"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></div>
      <?php } ?>
      <?php if ($images) { ?>
      <div class="image-additional">
		<img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/><?php foreach ($images as $image) { ?><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /><?php } ?>
      </div>
      <?php } ?>
    <?php } ?>
      <div class="description">
        <?php if ($manufacturer) { ?>
        <b><?php echo $text_manufacturer; ?></b> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
        <?php } ?>
        <b><?php echo $text_model; ?></b> <?php echo $model; ?><br />
        <?php if ($reward) { ?>
        <b><?php echo $text_reward; ?></b> <?php echo $reward; ?><br />
        <?php } ?>
        <b><?php echo $text_stock; ?></b> <?php echo $stock; ?></div>
      <?php if ($price) { ?>
      <div class="price"><?php echo $text_price; ?>
        <?php if (!$special) { ?>
        <?php echo $price; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $price; ?></span> <span class="price-new"><?php echo $special; ?></span>
        <?php } ?>
        <br />
        <?php if ($tax) { ?>
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br />
        <?php } ?>
        <?php if ($points) { ?>
        <span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span><br />
        <?php } ?>
        <?php if ($discounts) { ?>
        <br />
        <div class="discount">
          <?php foreach ($discounts as $discount) { ?>
          <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($options) { ?>
      <div class="options">
        <h2><?php echo $text_option; ?></h2>
        <?php foreach ($options as $option) { ?>
        <?php if ($option['type'] == 'select') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
          	  <?php echo $option['name']; ?>:
		  </b></label>
          <select name="option[<?php echo $option['product_option_id']; ?>]">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'radio') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option-radio">
          <label><b>
		  	<?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
          	  <?php echo $option['name']; ?>:
		  </b></label>
		  <?php $count_radios = sizeOf($option['option_value']);
		  $count_printed_radios = 0;?>	
          <?php foreach ($option['option_value'] as $option_value) { 
			$count_printed_radios++;
			if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
			else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
			else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
			else $radio_class[$count_printed_radios] = "radio_middle";
			?>
			<label class="<?php echo $radio_class[$count_printed_radios];?>" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
          		<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          		<?php echo $option_value['name']; ?>
				<?php if ($option_value['price']) { ?>
				(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
				<?php } ?>
            </label>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'checkbox') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option-checkbox">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
		  <?php $count_radios = sizeOf($option['option_value']);
		  $count_printed_radios = 0;?>	
          <?php foreach ($option['option_value'] as $option_value) { 
			    $count_printed_radios++;
				if ($count_radios == 1) $radio_class[$count_printed_radios] = "checkbox_single";
				else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "checkbox_top";
				else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "checkbox_bottom";
				else $radio_class[$count_printed_radios] = "checkbox_middle";
				?>
		  	  <label class="<?php echo $radio_class[$count_printed_radios];?>" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">	
			  	<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
			  	<span><?php echo $option_value['name']; ?>
					<?php if ($option_value['price']) { ?>
						(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
					<?php } ?>
				</span>
			  </label>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option-image">
          <label><b>
		  	<?php if ($option['required']) { ?>
         		 <span class="required">*</span>
          	<?php } ?>
          	<?php echo $option['name']; ?>:
		  </b></label>
		  <?php $count_radios = sizeOf($option['option_value']);
		  $count_printed_radios = 0;?>	
          <?php foreach ($option['option_value'] as $option_value) { 
			$count_printed_radios++;
			if ($count_radios == 1) $radio_class[$count_printed_radios] = "radio_single";
			else if($count_printed_radios == 1) $radio_class[$count_printed_radios] = "radio_top";
			else if($count_printed_radios == $count_radios) $radio_class[$count_printed_radios] = "radio_bottom";
			else $radio_class[$count_printed_radios] = "radio_middle";
			?>
              <label class="<?php echo $radio_class[$count_printed_radios];?>" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
			  	<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
			    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" />
                <span>
					<?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    	(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
				</span>
              </label>
           <?php } ?>
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'text') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'textarea') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
          <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'file') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
          <a id="button-option-<?php echo $option['product_option_id']; ?>" class="button"><?php echo $button_upload; ?></a>
          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'date') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'datetime') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
        </div>
        <?php } ?>
        <?php if ($option['type'] == 'time') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <label><b>
			  <?php if ($option['required']) { ?>
			  <span class="required">*</span>
			  <?php } ?>
			  <?php echo $option['name']; ?>:
		  </b></label>
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
        </div>
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
      <div class="cart">
        <div><?php echo $text_qty; ?>
          <input class="small_field" id="quantity" type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
          <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
          </div>
		  <input class="button" type="button" value="<?php echo $button_cart; ?>" id="button-cart" />

        <p><a onclick="addToWishList('<?php echo $product_id; ?>',$(this));"><?php echo $button_wishlist; ?></a></p>
        <?php if ($minimum > 1) { ?>
        <div class="minimum"><?php echo $text_minimum; ?></div>
        <?php } ?>
      </div>
      <?php if ($review_status) { ?>
      <div class="review">
        <div><img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $text_write; ?></a></div>
        <div class="share"><!-- AddThis Button BEGIN -->
          <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
          <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
          <!-- AddThis Button END --> 
        </div>
      </div>
      <?php } ?>
    </div>
  <div id="accordion">
  	<h3><a href="#tab-description"><?php echo $tab_description; ?></a></h3>
	<div><?php echo $description; ?></div>
	
	<?php if ($attribute_groups) {?>
		<h3><a href="#tab-attribute"><?php echo $tab_attribute; ?></a></h3>
		<div id="tab-attribute" class="tab-content">
			<?php foreach ($attribute_groups as $attribute_group) { ?>
				<h4><?php echo $attribute_group['name']; ?></h4>
				<dl>

					<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
						<dt><?php echo $attribute['name']; ?>: </dt>
						<dd><?php echo $attribute['text']; ?></dd>
					<?php } ?>
				</dl>
			<?php } ?>
		</div>
    <?php } ?>
	
    <?php if ($review_status) { ?>
    	<h3><a href="#tab-review"><?php echo $tab_review; ?></a></h3>
		<div id="reviews">
			<div id="review"></div>
			<h4 id="review-title"><?php echo $text_write; ?></h4>
			<label for="review_name"><?php echo $entry_name; ?></label>
			<input type="text" id="review_name" name="name" value="" />
			<label for="review_text"><?php echo $entry_review; ?></label>
			<textarea id="review_text" name="text" cols="40" rows="8" style="width: 98%;"></textarea>
			<span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
			<label><?php echo $entry_rating; ?></label> 
			<span><?php echo $entry_bad; ?></span>&nbsp;
			<input type="radio" name="rating" value="1" />
			&nbsp;
			<input type="radio" name="rating" value="2" />
			&nbsp;
			<input type="radio" name="rating" value="3" />
			&nbsp;
			<input type="radio" name="rating" value="4" />
			&nbsp;
			<input type="radio" name="rating" value="5" />
			&nbsp; <span><?php echo $entry_good; ?></span>
			<label for="review_captcha"><?php echo $entry_captcha; ?></label>
			<input id="review_captcha" type="text" name="captcha" value="" />
			<img src="index.php?route=product/product/captcha" alt="" id="captcha" />
			<div><a id="button-review" class="button"><?php echo $button_continue; ?></a></div>
		</div>
    <?php } ?>
	
    <?php if ($products) { ?>
    	<h3><a href="#tab-related"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</a></h3>
		<div id="tab-related" class="tab-content">
			<div class="product-grid">
				<?php foreach ($products as $product) { ?><div>
						<?php if ($product['thumb']) { ?>
							<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
						<?php } ?>
						<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
						<?php if ($product['price']) { ?>
							<div class="price">
							  <?php if (!$product['special']) { ?>
							  <?php echo $product['price']; ?>
							  <?php } else { ?>
							  <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
							  <?php } ?>
							</div>
						<?php } ?>
						<?php if ($product['rating']) { ?>
							<div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
						<?php } ?>
						<a onclick="addToCart('<?php echo $product['product_id']; ?>',$(this));" class="button"><?php echo $button_cart; ?></a>
					</div><?php } ?>
			</div>
		</div>
    <?php } ?>
</div>
  
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php foreach ($tags as $tag) { ?>
    <a href="<?php echo $tag['href']; ?>"><?php echo $tag['tag']; ?></a>,
    <?php } ?>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#accordion').accordion({autoHeight:false,collapsible:true,active:false});
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				if ($('#m_basket_count').length>0) {
					$('#m_basket_count').html(parseInt($('#m_basket_count').html())+parseInt($('#quantity').val()));
				} else {
					$('#m_basket').append('(<span id="m_basket_count">'+parseInt($('#quantity').val())+'</span>)');
				}
				$('#cart-total').html(json['total']);
				$('#button-cart').before('<p class="added success" style="margin:0">Product added to cart!</p>');
				$('.added').slideDown().delay(2000).slideUp(function(){$(this).remove();});				
			}	
		}
	});
});
//--></script>
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
	},
	onComplete: function(file, json) {
		$('.error').remove();
		
		if (json.success) {
			alert(json.success);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json.file);
		}
		
		if (json.error) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json.error + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('.image-additional img').addClass('pointer').click(function(){
	var newImage = $(this);
	$('#image').fadeOut('fast',function(){
		$(this).attr('src',newImage.attr('src')).fadeIn('fast');
	});
});

$('#review .pagination a').live('click', function() {
	$('#review').slideUp('slow');
		
	$('#review').load(this.href);
	
	$('#review').slideDown('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data.error) {
				$('#review-title').after('<div class="warning">' + data.error + '</div>');
			}
			
			if (data.success) {
				$('#review-title').after('<div class="success">' + data.success + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script> 
 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--


$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<?php echo $footer; ?>