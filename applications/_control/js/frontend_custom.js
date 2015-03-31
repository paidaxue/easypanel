$(document).ready(function() {

	//===== Multiple select with dropdown =====//
	$(".chzn-select").chosen();


	//===== Form elements styling =====//
	$("select, input:checkbox, input:radio, input:file:not(.default)").uniform();

	//===== Tooltip =====//
	$('.leftDir').tipsy({fade: true, gravity: 'e'});
	$('.rightDir').tipsy({fade: true, gravity: 'w'});
	$('.topDir').tipsy({fade: true, gravity: 's'});
	$('.botDir').tipsy({fade: true, gravity: 'n'});

	//===== PrettyPhoto lightbox plugin =====//
	$("a[rel^='prettyPhoto']").prettyPhoto();


	//===== Image gallery control buttons =====//
	$(".pics ul li").hover(
		function() { $(this).children(".actions").show("fade", 200); },
		function() { $(this).children(".actions").hide("fade", 200); }
	);


	//===== Dropdown Menu =====//
  $(".sub").hide();

	$(".exp").click(function() {
		if( $(this).children('a.active').length > 0 ) {
			$(this).children('a').removeClass('active');
		} else {
			$(this).children('a').addClass('active');
		}

		$(this).find("ul.sub").slideToggle(300);
	});

	$("ul.sub li a").hover(
		function () {
			$(this).stop().animate({ 'color' : '#676767' }, 400);
		},
		function () {
			$(this).stop().animate({ 'color' : '#d5d5d5' }, 400);
	});


	//===== Alert windows =====//
	$(".deleteBtn").click( function() {
		jConfirm('Are you sure?', 'Hmmm...', function(r) {
			if ( r ) {
				jAlert('Roger that!', 'Confirmation');
			} else {
				jAlert('Okay! :(', 'Confirmation');
			}
		});
	});

	//===== Information boxes =====//
	$("#notifications").click(function() {
		$(this).fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(300, function() { //slide up
				$('.hideit').remove(); //then remove from the DOM
			});
		});
	});

	//==== Add/Edit page sidebar options =====//
	$('#sidebar_name_left:not(.show)').hide();
	$('#sidebar_name_right:not(.show)').hide();
	$('#left_sidebar:not(.show)').hide();
	$('#right_sidebar:not(.show)').hide();

	$("#sidebar_style").change(function () {
		var style = $(this).val();

		if(style == 'none') {
			$('#sidebar_name_left').hide();
			$('#sidebar_name_right').hide();
			$('#left_sidebar').hide();
			$('#right_sidebar').hide();
		}
		if(style == 'left') {
			$('#sidebar_name_left').show();
			$('#sidebar_name_right').hide();
			$('#left_sidebar').show();
			$('#right_sidebar').hide();
		}
		if(style == 'right') {
			$('#sidebar_name_left').hide();
			$('#sidebar_name_right').show();
			$('#left_sidebar').hide();
			$('#right_sidebar').show();
		}
		if(style == 'both') {
			$('#sidebar_name_left').show();
			$('#sidebar_name_right').show();
			$('#left_sidebar').show();
			$('#right_sidebar').show();
		}
	});

	//==== Trumbowyg =====//
	$('.js-trumbowyg').trumbowyg();
});