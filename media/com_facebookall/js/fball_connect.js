// JavaScript Document
jQuery.noConflict();
(function($) { 
	$(function() {
	var fball_facebook_connect = function() {
			var facebook_auth = $('#fball_facebook_auth');
			var client_id = facebook_auth.find('input[type=hidden][name=client_id]').val();
			var redirect_uri = facebook_auth.find('input[type=hidden][name=redirect_uri]').val();
			if(client_id == "") {
				alert("You have not configure facebook api settings.")
			} else {
				window.open('https://graph.facebook.com/oauth/authorize?client_id=' + client_id + '&redirect_uri=' + redirect_uri + '&scope=email,publish_stream',
				'','scrollbars=no,menubar=no,height=400,width=800,resizable=yes,toolbar=no,status=no');
			}
		};
		$(".fball_login_facebook").click(function() {
			fball_facebook_connect();
		});
   });
})(jQuery);
window.wp_fball = function(config) {
	jQuery('#loginform').unbind('submit.simplemodal-login');
	var form_id = '#loginform';
		// create the login form
			var login_uri = jQuery("#fball_login_form_uri").val();
			jQuery('body').append("<form id='loginform' method='post' action='" + login_uri + "'></form>");
			jQuery('#loginform').append("<input type='hidden' id='redirect_to' name='redirect_to' value='" + login_uri + "'>");
	jQuery.each(config, function(key, value) { 
	jQuery("#" + key).remove();
		jQuery(form_id).append("<input type='hidden' id='" + key + "' name='" + key + "' value='" + value + "'>");
	});  
	if(jQuery("#simplemodal-login-form").length) {
		var current_url = jQuery("#fball_login_form_uri").val();
		jQuery("#redirect_to").remove();
		jQuery(form_id).append("<input type='hidden' id='redirect_to' name='redirect_to' value='" + current_url + "'>");
	}
   jQuery(form_id).submit();
}
