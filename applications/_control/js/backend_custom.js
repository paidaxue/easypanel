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

		if ( ! user.length )  {

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

	//===== Themes - enabling =====//

	$(".enableTheme").click( function() {

			$( this ).attr( 'class' , 'blueBtn enableTheme');
			id_theme = $( this ).attr('id');
			$( this ).html('...');

			enable_theme(id_theme);

	});

	function enable_theme( id_theme ) {
		$.ajax({
			url: base_url + '/settings/theme_process',
			type: 'POST',
			data: { id_theme: id_theme },
			success: function(data) {
				location.reload();
			}
	 	});
	}
	//===== Alert windows - delete =====//

	$(".bConfirm").click( function() {

		id = $( this ).attr( 'id' );

		if($(this).hasClass('user-delete')){
			jConfirm('Are you sure you want to delete this user?', 'Delete user', function(r) {

				if( r ) {
					delete_user( id );
				}

			});
		}

		if($(this).hasClass('page-delete')){
			jConfirm('Are you sure you want to delete this page?', 'Delete page', function(r) {

				if( r ) {
					delete_page( id );
				}

			});
		}

		if($(this).hasClass('sidebar-delete')){
			jConfirm('Are you sure you want to delete this sidebar?', 'Delete sidebar', function(e) {

				if( e ) {
					delete_sidebar( id );
				}

			});
		}

		if($(this).hasClass('module-delete')){
			jConfirm('Are you sure you want to delete this module?', 'Delete module', function(e) {

				if( e ) {
					delete_module( id );
				}

			});
		}

		if($(this).hasClass('post-delete')){
			jConfirm('Are you sure you want to delete this post?', 'Delete post', function(e) {

				if( e ) {
					delete_post( id );
				}

			});
		}

	});

	function delete_user( id_user ) {

		$.ajax({
			url: base_url + '/users/user_delete',
			type: 'POST',
			data: { id_user: id_user },
			success: function(data) {
				location.reload();
			}
	 	});
	}

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

	function delete_sidebar( id_sidebar ) {
		$.ajax({
			url: base_url + '/sidebars/sidebar_delete',
			type: 'POST',
			data: { id_sidebar: id_sidebar},
			success: function(data) {
				location.reload();
			}
	 	});
	}

	function delete_module( id_module ) {
		$.ajax({
			url: base_url + '/settings/module_delete',
			type: 'POST',
			data: { id_module: id},
			success: function(data) {
				location.reload();
			}
	 	});
	}

	function delete_post( id_post ) {
		$.ajax({
			url: base_url + '/blog/delete',
			type: 'POST',
			data: { id_post: id},
			success: function(data) {
				location.reload();
			}
	 	});
	}

});