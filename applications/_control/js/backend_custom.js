$(document).ready(function() {

	//===== Login =====//

	$(".inputError").hide();
	$("label.error").hide();
	$('#log_in_error').hide();

	$("#log_in").click(function() {

		$(".inputError").hide();
		$('#log_in_error').hide();

		var user = $("input#user").val();

		if ( user == '' ) {

			$("#username").fadeIn();
			$("#username").children('label#required').fadeIn();
			return false;

		}

		var pass = $("input#pass").val();

		if ( pass == '' ) {

			$("#password").fadeIn();
			$("#password").children('label#required').fadeIn();
			return false;

		}

		$.post( base_url + "/login/log_in", {
												user: $('input#user').val(),
												pass: $('input#pass').val()
											},
			function( data ){

				if ( data == 1 ){

					document.location = base_url + '/dashboard';

				} else {

					$('#log_in_error').fadeIn();

				}

		});

		return false;

	});


	//===== User settings =====//

	$("#user_submit").click(function() {

		$(".inputError").hide();

		var user = $("input#user").val();

		if ( ! user.length ) {

			$("#username").fadeIn();
			$("#username").children('label#required').fadeIn();
			return false;

		}

	});

	//===== Pages - form verification =====//

	$('.allRequired').hide();

	$('#submitPages').click( function() {

		$('.allRequired').hide();

		var title = $("input#title").val();

		if ( title == '' ) {

			$('.allRequired').fadeIn();
			return false;

		}

		return true;

	});

	//===== Alert windows =====//

	$(".bConfirm").click( function() {

		id_page = $( this ).attr( 'id' );

		if($(this).hasClass('page-delete')){

			jConfirm('Are you sure you want to delete this page?', 'Delete page', function(r) {

				if( r ) {

					delete_page( id_page );

				}

			});
		}

		if($(this).hasClass('sidebar-delete')){
			jConfirm('Are you sure you want to delete this sidebar?', 'Delete sidebar', function(e) {

				if( e ) {

					delete_sidebar( id_page );


				}

			});
		}

	});

	function delete_page( id_page ) {

		$.ajax({
			url: base_url + '/pages/page_delete',
			type: 'POST',
			data: { id_page: id_page },
			success: function(data) {
				location.reload();
			}
	 	});

	}

	function delete_sidebar( id_page ) {
		$.ajax({
			url: base_url + '/sidebars/sidebar_delete',
			type: 'POST',
			data: { id_sidebar: id_page},
			success: function(data) {
				location.reload();
			}
	 	});

	}

});