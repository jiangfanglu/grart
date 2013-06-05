jQuery(document).ready(function() {
	/* Search */
	jQuery('.button-search').bind('click', function() {
		url = jQuery('base').attr('href') + 'index.php?option=com_opencart&tmpl=component&route=product/search';
				 
		var filter_name = jQuery('input[name=\'filter_name\']').attr('value');
		
		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}
		
		location = url;
	});
	
	jQuery('#header input[name=\'filter_name\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
			url = jQuery('base').attr('href') + 'index.php?option=com_opencart&tmpl=component&route=product/search';
			 
			var filter_name = jQuery('input[name=\'filter_name\']').attr('value');
			
			if (filter_name) {
				url += '&filter_name=' + encodeURIComponent(filter_name);
			}
			
			location = url;
		}
	});
	
	jQuery('.success img, .warning img, .attention img, .information img').live('click', function() {
		jQuery(this).parent().slideUp('slow', function() {
			jQuery(this).remove();
		});
	});	
});

function addToCart(product_id, caller, quantity) {
	quantity = typeof(quantity) != 'undefined' ? quantity : 1;

	jQuery.ajax({
		url: 'index.php?option=com_opencart&tmpl=component&route=checkout/cart/add',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + quantity,
		dataType: 'json',
		success: function(json) {
			jQuery('.success, .warning, .attention, .information, .error').remove();
			
			if (json['redirect']) {
				location = json['redirect']+'&select';//pass a get if a select is required so we can give the customer an indication
			}
			
			if (json['success']) {
		
				if (jQuery('#m_basket_count').length>0) {
					jQuery('#m_basket_count').html(parseInt(jQuery('#m_basket_count').html())+parseInt(quantity));
				} else {
					jQuery('#m_basket').append(' (<span id="m_basket_count">'+parseInt(quantity)+'</span>)');
				}
				caller.before('<p class="added success">Product added to cart!</p>');
				jQuery('.added').slideDown().delay(2000).slideUp(function(){jQuery(this).remove();});
			}	
		}
	});
}
function addToWishList(product_id,caller) {
	jQuery.ajax({
		url: 'index.php?option=com_opencart&tmpl=component&route=account/wishlist/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			jQuery('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				
				jQuery('#wishlist-total').html(json['total']);
				caller.before('<p class="added success">Product added to wish list!</p>');
				jQuery('.added').slideDown().delay(2000).slideUp(function(){jQuery(this).remove();});				
			}	
		}
	});
}

