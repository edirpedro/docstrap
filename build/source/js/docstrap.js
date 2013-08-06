
/*
* Docstrap
*/

$(document).ready(function() {

	var $document = $('#docstrap-document');
	var $content_list = $('#docstrap-content-list');
	var content_list_ids = [];

	// Scroll to content
	scrollTo = function(anchor) {
		$("html, body").animate({
			scrollTop: $(anchor).offset().top - ($('#docstrap-header').height() + 10)
		}, 500);
		location.hash = anchor;
	}

	// Document title
	$document.find('h1').wrap('<div class="page-header"/>');
	
	// Tables
	$document.find('table').addClass('table table-bordered table-striped');

	// Content List
	var $headings = $document.find('h2, h3, h4, h5, h6');
	if($headings.length == 0) {
		$content_list.parent('li').remove();
	} else {
		$headings.each(function(index) {
			var id = $(this).text().toLowerCase();
			id = id.replace(new RegExp("[àáâãäå]", 'g'),"a");
			id = id.replace(new RegExp("æ", 'g'),"ae");
			id = id.replace(new RegExp("ç", 'g'),"c");
			id = id.replace(new RegExp("[èéêë]", 'g'),"e");
			id = id.replace(new RegExp("[ìíîï]", 'g'),"i");
			id = id.replace(new RegExp("ñ", 'g'),"n");                            
			id = id.replace(new RegExp("[òóôõö]", 'g'),"o");
			id = id.replace(new RegExp("œ", 'g'),"oe");
			id = id.replace(new RegExp("[ùúûü]", 'g'),"u");
			id = id.replace(new RegExp("[ýÿ]", 'g'),"y");
			id = id.replace(/[^a-z0-9]/gi, '-');
		
			// Do not repeat
			if(content_list_ids.indexOf(id) != -1)
				id += '-' + index;

			content_list_ids.push(id);
		
			$(this)
				.attr('id', id)
				.prepend('<a href="#' + id + '"><i class="icon-share"></i></a>');

			var heading = $(this).prop('nodeName').replace('H', '');
			var anchor = heading > 2 ? '<li class="sub">' : '<li>';
			anchor += '<a href="#' + id + '">';
			anchor += $(this).text();
			anchor += '</a></li>';
		
			$content_list.append(anchor);
		});
	}
	
	// Scroll when select a topic
	$content_list.find('a').on('click', function(event) {
		event.preventDefault();
		scrollTo($(this).attr('href'));
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
	
	$document.find('.sidebar')	
		.appear()
		.on('appear', function() {
			$('#docstrap-gototop').fadeOut();
		}).on('disappear', function() {
			$('#docstrap-gototop').fadeIn();
		});
		
	
		
	// Open dropdown when mouse is over
	$('li.dropdown').hover(function() {
		$(this).addClass('open');
	}, function() {
		$(this).removeClass('open');
	});

	// make code pretty
	$('#docstrap-document pre').addClass('prettyprint linenums');
    window.prettyPrint && prettyPrint();

});

