
/*
* Docstrap
*/

jQuery.fn.reverse = [].reverse;

$(document).ready(function() {

	var $document = $('#docstrap-document');

	// Scroll to content
	scrollTo = function(anchor) {
		console.log( $(anchor).offset().top );
		$("html, body").animate({
			scrollTop: $(anchor).offset().top - 75
		}, 500);
		location.hash = anchor;
	}

	// Document title
	$document.find('h1').wrap('<div class="page-header"/>');
	
	// Tables
	$document.find('table').addClass('table table-striped');

	// Content Link
	$document.find('h2, h3, h4, h5, h6').each(function(index) {
		var id = slugg($(this).text());
		$(this)
			.attr('id', id)
			.append('<a href="#' + id + '" class="glyphicon glyphicon-share"></a>');
	});
	
	// Position the page on the topic
	$document.find('h2 a, h3 a, h4 a, h5 a, h6 a').on('click', function(event) {
		event.preventDefault();
		scrollTo($(this).attr('href'));
	});
	
	// Got to the topic when open the document with an anchor
	if(location.hash) {
		scrollTo(location.hash);
	}
	
	// Go to Top button
	$('#docstrap-gototop').on('click', function(event) {
		event.preventDefault();
		scrollTo('#docstrap-document');
	});

	// Make code pretty
	$('#docstrap-document pre').addClass('prettyprint linenums');
    window.prettyPrint && prettyPrint();

	// Menu
	$('.nav-sidebar a.sub').on('click', function() {
		var ul = $(this).next('ul');
		if(ul.hasClass('open')) {
			$(this).find('span').text('+');
			ul.removeClass('open');
			ul.find('> li').reverse().each(function(i) {
				$(this).delay(i*25).fadeOut('fast');
			});
		} else {
			$(this).find('span').html('&ndash;');
			ul.addClass('open');
			ul.find('> li').each(function(i) {
				$(this).delay(i*25).fadeIn('fast');
			});
		}
	});
	
	$('.nav-sidebar .active').parents('ul').addClass('active open');
	$('.nav-sidebar .active').parents('ul').prev('.sub').find('span').html('&ndash;');
	
});

