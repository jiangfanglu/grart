<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <div class="checkout">
    <div id="checkout">
      <div class="checkout-heading"><?php echo $text_checkout_option; ?></div>
      <div class="checkout-content"></div>
    </div>
    <?php if (!$logged) { ?>
    <div id="payment-address">
      <div class="checkout-heading"><span><?php echo $text_checkout_account; ?></span></div>
      <div class="checkout-content"></div>
    </div>
    <?php } else { ?>
    <div id="payment-address">
      <div class="checkout-heading"><span><?php echo $text_checkout_payment_address; ?></span></div>
      <div class="checkout-content"></div>
    </div>
    <?php } ?>
    <?php if ($shipping_required) { ?>
    <div id="shipping-address">
      <div class="checkout-heading"><?php echo $text_checkout_shipping_address; ?></div>
      <div class="checkout-content"></div>
    </div>
    <div id="shipping-method">
      <div class="checkout-heading"><?php echo $text_checkout_shipping_method; ?></div>
      <div class="checkout-content"></div>
    </div>
    <?php } ?>
    <div id="payment-method">
      <div class="checkout-heading"><?php echo $text_checkout_payment_method; ?></div>
      <div class="checkout-content"></div>
    </div>
    <div id="confirm">
      <div class="checkout-heading"><?php echo $text_checkout_confirm; ?></div>
      <div class="checkout-content"></div>
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#checkout .checkout-content input[name=\'account\']').live('change', function() {
	if ($(this).attr('value') == 'register') {
		$('#payment-address .checkout-heading span').html('<?php echo $text_checkout_account; ?>');
	} else {
		$('#payment-address .checkout-heading span').html('<?php echo $text_checkout_payment_address; ?>');
	}
});

$('.checkout-heading a').live('click', function() {
	$('.checkout-content').slideUp('slow');
	
	$(this).parent().parent().find('.checkout-content').slideDown('slow');
});
<?php if (!$logged) { ?> 
$(document).ready(function() {
	$.ajax({
		url: 'index.php?route=checkout/login',
		dataType: 'html',
		success: function(html) {
			$('#checkout .checkout-content').html(html);
				
			$('#checkout .checkout-content').slideDown('slow');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});		
<?php } else { ?>
$(document).ready(function() {
	$.ajax({
		url: 'index.php?route=checkout/payment_address',
		dataType: 'html',
		success: function(html) {
			$('#payment-address .checkout-content').html(html);
			$('#payment-address .checkout-content').slideDown('slow');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});
<?php } ?>

// Checkout
$('#button-account').live('click', function(event) {
	event.preventDefault();
	$.ajax({
		url: 'index.php?route=checkout/' + $('input[name=\'account\']:checked').attr('value'),
		dataType: 'html',
		beforeSend: function() {
			$('#button-account').attr('disabled', true);
			$('#button-account').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},		
		complete: function() {
			$('#button-account').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(html) {
			$('.warning').remove();
			$('#payment-address .checkout-content').html(html);
			$('#checkout .checkout-content').slideUp('slow');
			$('#payment-address .checkout-content').slideDown('slow');
			$('.checkout-heading a').remove();
			$('#checkout .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Login
$('#button-login').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/login/validate',
		type: 'post',
		data: $('#checkout #login :input'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-login').attr('disabled', true);
			$('#button-login').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-login').attr('disabled', false);
			$('.wait').remove();
		},				
		success: function(json) {
			$('.warning').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
									
			if (json['error']) {
				$('#button-login').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

// Register
$('#button-register').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/register/validate',
		type: 'post',
		data: $('#payment-address input[type=\'text\'], #payment-address input[type=\'password\'], #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-register').attr('disabled', true);
			$('#button-register').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-register').attr('disabled', false); 
			$('.wait').remove();
		},			
		success: function(json) {
			$('.warning, .error').remove();
						
			if (json['redirect']) {
				location = json['redirect'];
			}
						
			if (json['error']) {
				if (json['error']['warning']) {
					$('#button-register').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
					
					$('.warning').fadeIn('slow');
				}
				
				processErrors(json,$('#payment-address'));
				
			} else {
				<?php if ($shipping_required) { ?>				
				var shipping_address = $('#payment-address input[name=\'shipping_address\']:checked').attr('value');
				
				if (shipping_address) {
					$.ajax({
						url: 'index.php?route=checkout/shipping_method',
						dataType: 'html',
						success: function(html) {
							$('#shipping-method .checkout-content').html(html);
   							$('#payment-address .checkout-content').slideUp('slow');			
							$('#shipping-method .checkout-content').slideDown('slow');
							$('#checkout .checkout-heading a').remove();
							$('#payment-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-method .checkout-heading a').remove();
							$('#payment-method .checkout-heading a').remove();											
							$('#shipping-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');									
							$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	

							$.ajax({
								url: 'index.php?route=checkout/shipping_address',
								dataType: 'html',
								success: function(html) {
									$('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});	
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});	
				} else {
					$.ajax({
						url: 'index.php?route=checkout/shipping_address',
						dataType: 'html',
						success: function(html) {
							$('#shipping-address .checkout-content').html(html);
							$('#payment-address .checkout-content').slideUp('slow');
							$('#shipping-address .checkout-content').slideDown('slow');
							$('#checkout .checkout-heading a').remove();
							$('#payment-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-method .checkout-heading a').remove();
							$('#payment-method .checkout-heading a').remove();							
							$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});			
				}
				<?php } else { ?>
				$.ajax({
					url: 'index.php?route=checkout/payment_method',
					dataType: 'html',
					success: function(html) {
						$('#payment-method .checkout-content').html(html);
						$('#payment-address .checkout-content').slideUp('slow');
						$('#payment-method .checkout-content').slideDown('slow');
						$('#checkout .checkout-heading a').remove();
						$('#payment-address .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();								
						$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});					
				<?php } ?>
				
				$.ajax({
					url: 'index.php?route=checkout/payment_address',
					dataType: 'html',
					success: function(html) {
						$('#payment-address .checkout-content').html(html);
						$('#payment-address .checkout-heading span').html('<?php echo $text_checkout_payment_address; ?>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}	 
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

// Payment Address	
$('#button-payment-address').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/payment_address/validate',
		type: 'post',
		data: $('#payment-address input[type=\'text\'], #payment-address input[type=\'password\'], #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-payment-address').attr('disabled', true);
			$('#button-payment-address').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-payment-address').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(json) {
			$('.error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {
			
				processErrors(json,$('#payment-address'));
				
			} else {
				<?php if ($shipping_required) { ?>
				$.ajax({
					url: 'index.php?route=checkout/shipping_address',
					dataType: 'html',
					success: function(html) {
						$('#shipping-address .checkout-content').html(html);
						$('#payment-address .checkout-content').slideUp('slow');
						$('#shipping-address .checkout-content').slideDown('slow');
						$('#payment-address .checkout-heading a').remove();
						$('#shipping-address .checkout-heading a').remove();
						$('#shipping-method .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
						$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
				<?php } else { ?>
				$.ajax({
					url: 'index.php?route=checkout/payment_method',
					dataType: 'html',
					success: function(html) {
						$('#payment-method .checkout-content').html(html);
						$('#payment-address .checkout-content').slideUp('slow');
						$('#payment-method .checkout-content').slideDown('slow');
						$('#payment-address .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
						$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});	
				<?php } ?>
				
				$.ajax({
					url: 'index.php?route=checkout/payment_address',
					dataType: 'html',
					success: function(html) {
						$('#payment-address .checkout-content').html(html);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});					
			}	  
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

// Shipping Address			
$('#button-shipping-address').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/shipping_address/validate',
		type: 'post',
		data: $('#shipping-address input[type=\'text\'], #shipping-address input[type=\'password\'], #shipping-address input[type=\'checkbox\']:checked, #shipping-address input[type=\'radio\']:checked, #shipping-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-shipping-address').attr('disabled', true);
			$('#button-shipping-address').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-shipping-address').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(json) {
			$('.error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {
			
				processErrors(json,$('#shipping-address'));
			
			} else {
				$.ajax({
					url: 'index.php?route=checkout/shipping_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-method .checkout-content').html(html);
						$('#shipping-address .checkout-content').slideUp('slow');
						$('#shipping-method .checkout-content').slideDown('slow');
						$('#shipping-address .checkout-heading a').remove();
						$('#shipping-method .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
						$('#shipping-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');							
						
						$.ajax({
							url: 'index.php?route=checkout/shipping_address',
							dataType: 'html',
							success: function(html) {
								$('#shipping-address .checkout-content').html(html);
							},
							error: function(xhr, ajaxOptions, thrownError) {
								alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
							}
						});						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});	
			}  
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

// Guest
$('#button-guest').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/guest/validate',
		type: 'post',
		data: $('#payment-address input[type=\'text\'], #payment-address input[type=\'checkbox\']:checked, #payment-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-guest').attr('disabled', true);
			$('#button-guest').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-guest').attr('disabled', false); 
			$('.wait').remove();
		},			
		success: function(json) {
			$('.error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {
			
				processErrors(json,$('#payment-address'));
				
			} else {
				<?php if ($shipping_required) { ?>	
				var shipping_address = $('#payment-address input[name=\'shipping_address\']:checked').attr('value');
				
				if (shipping_address) {
					$.ajax({
						url: 'index.php?route=checkout/shipping_method',
						dataType: 'html',
						success: function(html) {
							$('#shipping-method .checkout-content').html(html);
							$('#payment-address .checkout-content').slideUp('slow');
							$('#shipping-method .checkout-content').slideDown('slow');
							$('#payment-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-method .checkout-heading a').remove();
							$('#payment-method .checkout-heading a').remove();		
							$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
							$('#shipping-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');									
							
							$.ajax({
								url: 'index.php?route=checkout/guest_shipping',
								dataType: 'html',
								success: function(html) {
									$('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});					
				} else {
					$.ajax({
						url: 'index.php?route=checkout/guest_shipping',
						dataType: 'html',
						success: function(html) {
							$('#shipping-address .checkout-content').html(html);
    						$('#payment-address .checkout-content').slideUp('slow');
							$('#shipping-address .checkout-content').slideDown('slow');
							$('#payment-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-method .checkout-heading a').remove();
							$('#payment-method .checkout-heading a').remove();
							$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				}
				<?php } else { ?>				
				$.ajax({
					url: 'index.php?route=checkout/payment_method',
					dataType: 'html',
					success: function(html) {
						$('#payment-method .checkout-content').html(html);
						$('#payment-address .checkout-content').slideUp('slow');
						$('#payment-method .checkout-content').slideDown('slow');
						$('#payment-address .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
						$('#payment-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});				
				<?php } ?>
			}	 
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

// Guest Shipping
$('#button-guest-shipping').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/guest_shipping/validate',
		type: 'post',
		data: $('#shipping-address input[type=\'text\'], #shipping-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-guest-shipping').attr('disabled', true);
			$('#button-guest-shipping').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-guest-shipping').attr('disabled', false); 
			$('.wait').remove();
		},			
		success: function(json) {
			$('.error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {
			
				processErrors(json,$('#shipping-address'));
			
			} else {
				$.ajax({
					url: 'index.php?route=checkout/shipping_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-method .checkout-content').html(html);
						$('#shipping-address .checkout-content').slideUp('slow');
						$('#shipping-method .checkout-content').slideDown('slow');
						$('#shipping-address .checkout-heading a').remove();
						$('#shipping-method .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
						$('#shipping-address .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});				
			}	 
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

$('#button-shipping-method').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/shipping_method/validate',
		type: 'post',
		data: $('#shipping-method input[type=\'radio\']:checked, #shipping-method textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-shipping-method').attr('disabled', true);
			$('#button-shipping-method').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-shipping-method').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(json) {
			$('.warning').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('#shipping-method .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
					
					$('.warning').fadeIn('slow');
				}			
			} else {
				$.ajax({
					url: 'index.php?route=checkout/payment_method',
					dataType: 'html',
					success: function(html) {
						$('#payment-method .checkout-content').html(html);
						$('#shipping-method .checkout-content').slideUp('slow');
     					$('#payment-method .checkout-content').slideDown('slow');
						$('#shipping-method .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
     					$('#shipping-method .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});					
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

$('#button-payment-method').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/payment_method/validate', 
		type: 'post',
		data: $('#payment-method input[type=\'radio\']:checked, #payment-method input[type=\'checkbox\']:checked, #payment-method textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-payment-method').attr('disabled', true);
			$('#button-payment-method').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-payment-method').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(json) {
			$('.warning').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('#button-payment-method').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
					
					$('.warning').fadeIn('slow');
				}			
			} else {
				$.ajax({
					url: 'index.php?route=checkout/confirm',
					dataType: 'html',
					success: function(html) {
						$('#confirm .checkout-content').html(html);
    					$('#payment-method .checkout-content').slideUp('slow');
						$('#confirm .checkout-content').slideDown('slow');
						$('#payment-method .checkout-heading a').remove();
						$('#payment-method .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});					
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});
function processErrors(json,container){
	if (json['error']['firstname']) {
		container.find('input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
	}
	if (json['error']['lastname']) {
		container.find('input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
	}	
	if (json['error']['email']) {
		container.find('input[name=\'email\']').after('<span class="error">' + json['error']['email'] + '</span>');
	}
	if (json['error']['telephone']) {
		container.find('input[name=\'telephone\']').after('<span class="error">' + json['error']['telephone'] + '</span>');
	}		
	if (json['error']['address_1']) {
		container.find('input[name=\'address_1\']').after('<span class="error">' + json['error']['address_1'] + '</span>');
	}	
	if (json['error']['city']) {
		container.find('input[name=\'city\']').after('<span class="error">' + json['error']['city'] + '</span>');
	}	
	if (json['error']['postcode']) {
		container.find('input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
	}	
	if (json['error']['country']) {
		container.find('select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
	}	
	if (json['error']['zone']) {
		container.find('select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
	}
	if (json['error']['password']) {
		container.find('input[name=\'password\']').after('<span class="error">' + json['error']['password'] + '</span>');
	}	
	if (json['error']['confirm']) {
		container.find('input[name=\'confirm\']').after('<span class="error">' + json['error']['confirm'] + '</span>');
	}		
	if ($('.error').length>0){
		scrollToFirstError()
	}
}
function scrollToFirstError(){
	var firstError = $('.error').first().prevAll('label').offset();
	$('html,body').animate({scrollTop:firstError.top},'slow');
}
//--></script> 
<?php echo $footer; ?>