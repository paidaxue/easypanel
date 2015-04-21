$(document).ready(function() {

	if(typeof $.fn.validate !== 'undefined'){

		$('#do-magic').validate({
			errorClass: 'validation-error',

			rules: {
				db_host: {
					required: true
				},
				db_user: {
					required: true
				},
				db_name: {
					required: true
				}
			},
			messages: {
				db_host: {
					required: "This field is required!"
				},
				db_user: {
					required: "This field is required!",
				},
				db_name: {
					required: "This field is required!"
				}
			},
			submitHandler: function(form) {
				$(form).ajaxSubmit({
					type: "POST",
					data: $(form).serialize(),
					url: "./magic.php",
					success: function(msg) {
						if (msg === 'OK') {
							$(".alert.alert-danger").hide();
							$(".alert.alert-success").show();
							$(".alert.alert-info").show();
							$('#contact-form').hide();
						} else {
							$(".alert.alert-danger").show();
						}
					},
					error: function() {
						$(".alert.alert-danger").show();
					}
				});
			}
		});

	}

});