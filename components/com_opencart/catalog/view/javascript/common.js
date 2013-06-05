jQuery(document).ready(function() {
	/* Search */
	item_id='';	
	click_id=0;
	if(jQuery('input[name=\'item_param_id\']').val())
		item_id=jQuery('input[name=\'item_param_id\']').val();
		
	http_serv_url='';	
	if(jQuery('input[name=\'http_serv\']').val())
		http_serv_url=jQuery('input[name=\'http_serv\']').val();
	
	jQuery('.button-search').bind('click', function() {
		url = http_serv_url + 'index.php?option=com_opencart&'+item_id+'route=product/search';
		 
		var filter_name = jQuery('input[name=\'filter_name\']').attr('value');
		
		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}
		
		location = url;
	});
	
	jQuery('#header_ext input[name=\'filter_name\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
			url = http_serv_url + 'index.php?option=com_opencart&'+item_id+'route=product/search';
			 
			var filter_name = jQuery('input[name=\'filter_name\']').attr('value');
			
			if (filter_name) {
				url += '&filter_name=' + encodeURIComponent(filter_name);
			}
			
			location = url;
		}
	});
	
	/* Ajax Cart */
	jQuery('#cart > .heading a').live('click', function() {
		jQuery('#cart').addClass('active');
		// click_id=click_id+1;
		click_id=Math.floor(Math.random()*100);
		jQuery('#cart').load(http_serv_url + 'index.php?option=com_opencart&'+item_id+'tmpl=component&click_id='+click_id+'&route=module/cart #cart > *',
		function(response, status, xhr) {
			if(response.search('class="content"')>0){
				response=response.replace(/class="content"/g,'class="content_ext"');
				response=response.replace(/class="right"/g,'class="right_ext"');					
				jQuery('#cart').html(response);
			}
			response=response.replace(/<div id="cart">/g,'<div id="cart_none">');
			response=response.replace(/<td class="image">/g,'<td style="display:none;" class="image">');
			response=response.replace(/<div class="heading">/g,'<div style="display:none;" class="heading">');
			response=response.replace(/remove-small.png"/g,'remove.png"');
			response=response.replace(/id="cart-total"/g,'id="cart-module-total"');					
			jQuery('#cart_module').html(response);
			
		});	
		
		jQuery('#cart').live('mouseleave', function() {
			jQuery(this).removeClass('active');
		});
	});
	
	/* Mega Menu */
	jQuery('#menu_ext ul > li > a + div').each(function(index, element) {
		// IE6 & IE7 Fixes
		if (jQuery.browser.msie && (jQuery.browser.version == 7 || jQuery.browser.version == 6)) {
			var category = jQuery(element).find('a');
			var columns = jQuery(element).find('ul').length;
			
			jQuery(element).css('width', (columns * 143) + 'px');
			jQuery(element).find('ul').css('float', 'left');
		}		
		
		var menu = jQuery('#menu_ext').offset();
		var dropdown = jQuery(this).parent().offset();
		
		i = (dropdown.left + jQuery(this).outerWidth()) - (menu.left + jQuery('#menu_ext').outerWidth());
		
		if (i > 0) {
			jQuery(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// IE6 & IE7 Fixes
	if (jQuery.browser.msie) {
		if (jQuery.browser.version <= 6) {
			jQuery('#column-left + #column-right + #content_ext, #column-left + #content_ext').css('margin-left', '195px');
			
			jQuery('#column-right + #content_ext').css('margin-right', '195px');
		
			jQuery('.box-category ul li a.active + ul').css('display', 'block');	
		}
		
		if (jQuery.browser.version <= 7) {
			jQuery('#menu_ext > ul > li').bind('mouseover', function() {
				jQuery(this).addClass('active');
			});
				
			jQuery('#menu_ext > ul > li').bind('mouseout', function() {
				jQuery(this).removeClass('active');
			});	
		}
	}
	
	jQuery('.success img, .warning img, .attention img, .information img').live('click', function() {
		jQuery(this).parent().fadeOut('slow', function() {
			jQuery(this).remove();
		});
	});	
});

function getURLVar(urlVarName) {
	var urlHalves = String(document.location).toLowerCase().split('?');
	var urlVarValue = '';
	
	if (urlHalves[1]) {
		var urlVars = urlHalves[1].split('&');

		for (var i = 0; i <= (urlVars.length); i++) {
			if (urlVars[i]) {
				var urlVarPair = urlVars[i].split('=');
				
				if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
					urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	
	return urlVarValue;
} 
function addToCart(product_id, quantity) {
	quantity = typeof(quantity) != 'undefined' ? quantity : 1;

	jQuery.ajax({
		url: http_serv_url + 'index.php?option=com_opencart&'+item_id+'tmpl=component&route=checkout/cart/add',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + quantity,
		dataType: 'json',
		success: function(json) {
			jQuery('.success, .warning, .attention, .information, .error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['success']) {
				jQuery('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="'+http_serv_url+'components/com_opencart/catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				jQuery('.success').fadeIn('slow');
				
				jQuery('#cart-total').html(json['total']);
				// click_id=click_id+1;
				click_id=Math.floor(Math.random()*100);
				jQuery('#cart').load(http_serv_url + 'index.php?option=com_opencart&'+item_id+'tmpl=component&click_id='+click_id+'&route=module/cart #cart > *',
				function(response, status, xhr) {
					if(response.search('class="content"')>0){
						response=response.replace(/class="content"/g,'class="content_ext"');
						response=response.replace(/class="right"/g,'class="right_ext"');					
						jQuery('#cart').html(response);
					}
					response=response.replace(/<div id="cart">/g,'<div id="cart_none">');
					response=response.replace(/<td class="image">/g,'<td style="display:none;" class="image">');
					response=response.replace(/<div class="heading">/g,'<div style="display:none;" class="heading">');
					response=response.replace(/remove-small.png"/g,'remove.png"');
					response=response.replace(/id="cart-total"/g,'id="cart-module-total"');					
					jQuery('#cart_module').html(response);
					
				});
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}	
		}
	});
}
function removeCart(key) {
	click_id=Math.floor(Math.random()*100);
	if (jQuery("#cart").length > 0){
		jQuery('#cart').load(http_serv_url +'index.php?option=com_opencart&'+item_id+'tmpl=component&click_id='+click_id+'&route=module/cart&remove='+key+' #cart > *',
		function(response, status, xhr) {
			if(response.search('class="content"')>0){
				response=response.replace(/class="content"/g,'class="content_ext"');
				response=response.replace(/class="right"/g,'class="right_ext"');					
				jQuery('#cart').html(response);
			}
			response=response.replace(/<div id="cart">/g,'<div id="cart_none">');
			response=response.replace(/<td class="image">/g,'<td style="display:none;" class="image">');
			response=response.replace(/<div class="heading">/g,'<div style="display:none;" class="heading">');
			response=response.replace(/remove-small.png"/g,'remove.png"');
			response=response.replace(/id="cart-total"/g,'id="cart-module-total"');					
			jQuery('#cart_module').html(response);
			
		});
	}
	else if(jQuery("#cart_module").length > 0){		
		jQuery('#cart_module').load(http_serv_url +'index.php?option=com_opencart&'+item_id+'tmpl=component&click_id='+click_id+'&route=module/cart&remove='+key+' #cart > *',
		function(response, status, xhr) {
			response=response.replace(/<div id="cart">/g,'<div id="cart_none">');
			response=response.replace(/<td class="image">/g,'<td style="display:none;" class="image">');
			response=response.replace(/<div class="heading">/g,'<div style="display:none;" class="heading">');
			response=response.replace(/remove-small.png"/g,'remove.png"');
			response=response.replace(/id="cart-total"/g,'id="cart-module-total"');					
			jQuery('#cart_module').html(response);
			
		});
	}
}
function addToWishList(product_id) {
	jQuery.ajax({
		url: http_serv_url + 'index.php?option=com_opencart&'+item_id+'tmpl=component&route=account/wishlist/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			jQuery('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				jQuery('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="'+http_serv_url+'components/com_opencart/catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				jQuery('.success').fadeIn('slow');
				
				jQuery('#wishlist-total').html(json['total']);
				
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
			}	
		}
	});
}

function addToCompare(product_id) { 
	jQuery.ajax({
		url: http_serv_url + 'index.php?option=com_opencart&'+item_id+'tmpl=component&route=product/compare/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			jQuery('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				jQuery('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="'+http_serv_url+'components/com_opencart/catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				jQuery('.success').fadeIn('slow');
				
				jQuery('#compare-total').html(json['total']);
				
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}	
		}
	});
}