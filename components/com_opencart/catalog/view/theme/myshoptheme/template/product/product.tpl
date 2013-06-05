<?php echo $header; ?>
    
     <div id="content">
        <div class="cm_content_left">
            <?php echo $column_left; ?>
            <div style="padding-top: 20px;display:table;">
                 <div class="tags"><b><?php echo $text_tags; ?></b>
                    <?php for ($i = 0; $i < count($tags); $i++) { ?>
                    <?php if ($i < (count($tags) - 1)) { ?>
                    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
                    <?php } else { ?>
                    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
                    <?php } ?>
                    <?php } ?>
                  </div>
            </div>
        </div>
        <div class="cm_content_main">
              <div class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                <?php } ?>
              </div>
    
  <div class="box">
  
  
  <div class="box-content">
      
  <div class="product-info">
      
    <?php if ($thumb || $images) { ?>
    <div class="left">
      <?php if ($thumb) { ?>
      <div class="image"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox" rel="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a></div>
      <?php } ?>
      <?php if ($images) { ?>
      <div class="image-additional">
        <?php foreach ($images as $image) { ?>
        <a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox" rel="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    
    
    <div class="right">
        <div class="product_info_divs">
            <div id="title_category">
                <div id="title">
                    <?php echo $heading_title; ?>
                </div>
                <div id="category">
                    <?php echo $category_name ?>
                </div>
                <div id="price">
                <?php if (!$special) { ?>
                    <?php echo $price; ?>
                  <?php } else { ?>
                    <span class="price-old"><?php echo $price; ?></span> <span class="price-new"><?php echo $special; ?></span>
                  <?php } ?>
                </div>
            </div>
            <div id="artist">
                <?php if($artist) { ?>
                    <div id="artist_thumb_product" style="font-style:italic;">
                        Created by
                        <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.$artist['artist']->user_id ?>">
                            <img src="<?php echo JURI::base().'/media/userthumbs/'.$artist['artist']->user_id.'/thumb_120.jpg' ?>"
                                 title="<?php echo $artist['artist']->name ?>"/>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="product_info_divs">
            <?php if ($price) { ?>
                <div class="price">
                  

<!--                  <?php if ($tax) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span>
                  <?php } ?>-->
                  
                  <?php if ($points) { ?>
                  <span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span>
                  <?php } ?>
                  
<!--                  <?php if ($discounts) { ?>
                  <div class="discount">
                    <?php foreach ($discounts as $discount) { ?>
                    <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?>
                    <?php } ?>
                  </div>
                  <?php } ?>-->
                  
                </div>
                <?php } ?>
                <input type="hidden" name="item_param"  value="<?php echo ITEM_ID; ?>" />
        </div>
        <div class="product_info_divs">
            <div id="product_options">
                  <?php if ($options) { ?>
                    <div class="options">
                      <?php foreach ($options as $option) { ?>
                          <?php if ($option['type'] == 'select') { ?>
                          <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                            <?php if ($option['required']) { ?>
                            <span class="required">*</span>
                            <?php } ?>
                            <b><?php echo $option['name']; ?>:</b>
                            <select name="option_ext[<?php echo $option['product_option_id']; ?>]">
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
                      <?php } ?>
                    </div>
                    <?php } ?>
            </div>
            <div id="add_to_cart_btn">
                     <div class="cart">
                        <div><?php echo $text_qty; ?>
                          <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" style="width:30px!important;" />
                          <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
                          &nbsp;<input type="button" value="<?php echo $button_cart; ?>" id="button-cart" class="product-button" />

                                &nbsp;<input onclick="addToWishList('<?php echo $product_id; ?>');" type="button" value="<?php echo $button_wishlist; ?>" id="button-wishlist" class="product-button" />

                        </div>
                        <?php if ($minimum > 1) { ?>
                        <div class="minimum"><?php echo $text_minimum; ?></div>
                        <?php } ?>
                      </div>
            </div>
<!--            <div id="sold">
                <b>Sold:</b> <?php echo $total_sold ?>
            </div>-->
        </div>
        <div class="product_info_divs_alt">
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
        <div class="product_info_divs">
            <div id="description">
                <?php echo $description; ?>
            </div>
        </div>
    </div>
  </div>
      
      
      
      <?php if($other_product_images) { ?>
   <div style="width:100%;">
       <div style="width:100%;margin-bottom: 10px; padding-bottom:10px; border-bottom: 1px solid #eee; font-family: Oswald-Light;font-size:18px;">More from this artist</div>

          <div style="width:100%;padding-bottom:5px;float:left;">
              <?php foreach($other_product_images as $p){ ?>
              <div style="width:74px;margin-right:5px;margin-bottom: 5px;float:left;">
                <a href="<?php echo JURI::base().'index.php?option=com_opencart&route=product/product&product_id='.$p['product_id'].'&path='.$p['category_id'] ?>">
                    <img src="<?php echo $p['thumb'] ?>" title="<?php echo $p['title'] ?>" />
                </a>
                  </div>
              <?php } ?>

          </div>
          
   </div>    
      <?php } ?>

  <div id="tabs" class="htabs">
    <?php if ($review_status) { ?>
    <div style="width:100%;padding-bottom:5px;"><a href="#tab-review"><?php echo $tab_review; ?></a></div>
      
    <?php } ?>
  </div>

  <?php if ($review_status) { ?>
  <div id="tab-review" class="tab-content">
      
    <div id="review"></div>
    <h2 id="review-title"><?php echo $text_write; ?></h2>
    
    
    <?php if((int)JFactory::getUser()->id == 0){ ?>
         <?php //$_SESSION['redirect_after_login'] = JURI::base().'index.php?option=com_opencart&route=product/product&product_id='.$_GET['product_id'].'&path='.$_GET['path'] ?>
         You have to login to post a review. <input type="button" value="Login" id="requirelogin" class="submit_btn" />
    <?php }else{ ?>
        <input type="hidden" name="name" value="<?php echo JFactory::getUser()->name ?>" />

        <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
        <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
        <br />
        <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
        <input type="radio" name="rating" value="1" />
        &nbsp;
        <input type="radio" name="rating" value="2" />
        &nbsp;
        <input type="radio" name="rating" value="3" />
        &nbsp;
        <input type="radio" name="rating" value="4" />
        &nbsp;
        <input type="radio" name="rating" value="5" />
        &nbsp; <span><?php echo $entry_good; ?></span><br />
        <br />
        <b><?php echo $entry_captcha; ?></b><br />
        <input type="text" name="captcha" value="" autocomplete="off" />
        <br />
        <img src="<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&route=product/product/captcha" alt="" id="captcha" /><br />
        <br />
        <div class="buttons">
            <div class="right"><input type="button" id="button-review" class="product-button" value="Post"></div>
        </div>
    <?php } ?>
  </div>
  <?php } ?>
 
  </div>
  </div>
        
        </div>
    </div>

<script type="text/javascript"><!--
click_id=0;
$('#button-cart').bind('click', function() {
	$.ajax({
		url: '<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&route=checkout/cart/add',
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
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
				$('.success').fadeIn('slow');
					
				$('#cart-total').html(json['total']);
				// click_id=click_id+1;
				click_id=Math.floor(Math.random()*100);
				jQuery('#cart').load('<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&click_id='+click_id+'&route=module/cart #cart > *',
				function(response, status, xhr) {
					response=response.replace(/<div id="cart">/g,'<div id="cart_none">');
					response=response.replace(/<td class="image">/g,'<td style="display:none;" class="image">');
					response=response.replace(/<div class="heading">/g,'<div style="display:none;" class="heading">');
					response=response.replace(/remove-small.png"/g,'remove.png"');
					response=response.replace(/id="cart-total"/g,'id="cart-module-total"');					
					jQuery('#cart_module').html(response);
					
				});
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
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
	action: '<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('fast');
		
	$('#review').load(this.href,function(response,status){
            if (status=="success"){ 
                $("a[href='#tab-review']").trigger('click');
                $('#review').fadeIn('fast');
            }
        });
	
	return false;
});			

$('#review').load('<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#requirelogin').click(function(){
    $('#login_anywhere_out').fadeIn('slow');
});
//$('#login_anywhere_out').click(function(){
//    var isHovered = $('#login_anywhere_in').is(":hover");
//    if(!isHovered){
//        $('#login_anywhere_out').fadeOut('slow');
//    }
//});

$('#button-review').bind('click', function() {
	$.ajax({
		url: '<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&route=product/product/write&product_id=<?php echo $product_id; ?>',
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
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				//$('#review-title').after('<div class="success">' + data['success'] + '</div>');

                                $('#review').load('<?php echo HTTP_SERVER;?>index.php?option=com_opencart&tmpl=component&route=product/product/review&product_id=<?php echo $product_id; ?>',function(response,status){
                                    if (status=="success"){ 
                                        $("a[href='#tab-review']").trigger('click');
                                    }
                                });
                                //$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				//$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
if ($.browser.msie && $.browser.version == 6) {
	$('.date, .datetime, .time').bgIframe();
}
jQuery(document).ready(function() {
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
$('.colorbox').colorbox({
	overlayClose: true,
	opacity: 0.5
});
});
//--></script> 

<!--Back ups-->
<!--        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
            <table class="option-image">
              <?php foreach ($option['option_value'] as $option_value) { ?>
              <tr>
                <td style="width: 1px;"><input type="radio" name="option_ext[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
                <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
                <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label></td>
              </tr>
              <?php } ?>
            </table>
        </div>
        <?php } ?>-->
