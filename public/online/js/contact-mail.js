jQuery(function($){

var WISHHOUSE = window.WISHHOUSE || {};

/* ==================================================
	Contact Form Validations
================================================== */
	WISHHOUSE.ContactForm = function(){
		$('.contact-form').each(function(){
			var formInstance = $(this);
			formInstance.submit(function(){

			var action = $(this).attr('action');

			$("#message").slideUp(750,function() {
			$('#message').hide();

			$('#submit')
				.after('<img src="assets/images/ajax-loader-bg.gif" class="loader" />')
				.attr('disabled','disabled');

			$.post(action, {
				name: $('#name').val(),
				email: $('#email').val(),
				phone: $('#phone').val(),
				comments: $('#comments').val()
			},
				function(data){
					document.getElementById('message').innerHTML = data;
					$('#message').slideDown('slow');
					$('.contact-form img.loader').fadeOut('slow',function(){$(this).remove()});
					$('#submit').removeAttr('disabled');
					if(data.match('success') != null) $('.contact-form').slideUp('slow');

				}
			);
			});
			return false;
		});
		});
	}

/* ==================================================
	Newsletter Form Validations
================================================== */
	WISHHOUSE.Newsletter = function(){
		$('.newsletter-form').each(function(){
			var formInstance = $(this);
			formInstance.submit(function(){

			var action = $(this).attr('action');

			$("#nl-message").slideUp(750,function() {
			$('#nl-message').hide();

			$('#nl-submit')
				.after('<img src="assets/images/ajax-loader-bg.gif" class="loader" />')
				.attr('disabled','disabled');

			$.post(action, {
				email: $('#nl-email').val()
			},
				function(data){
					document.getElementById('nl-message').innerHTML = data;
					$('#nl-message').slideDown('slow');
					$('.newsletter-form img.loader').fadeOut('slow',function(){$(this).remove()});
					$('#nl-submit').removeAttr('disabled');
					if(data.match('success') != null) $('.newsletter-form').slideUp('slow');

				}
			);
			});
			return false;
		});
		});
	}

  /* ==================================================
   Init Functions
================================================== */
$(document).ready(function(){
	WISHHOUSE.ContactForm();
	WISHHOUSE.Newsletter();
});

	});
