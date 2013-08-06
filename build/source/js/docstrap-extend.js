
$(document).ready(function() {

	// Theme chooser
	$('#docstrap-header .nav').append('<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Themes <b class="caret"></b></a><ul id="padoc-themes" class="dropdown-menu"></ul></li>');
	$themes = $('#padoc-themes');

	$.each([
			'bootstrap.default.min.css',
			'bootstrap.amelia.min.css',
			'bootstrap.cerulean.min.css',
			'bootstrap.cosmo.min.css',
			'bootstrap.cyborg.min.css',
			'bootstrap.journal.min.css',
			'bootstrap.readable.min.css',
			'bootstrap.simplex.min.css',
			'bootstrap.slate.min.css',
			'bootstrap.spacelab.min.css',
			'bootstrap.spruce.min.css',
			'bootstrap.superhero.min.css',
			'bootstrap.united.min.css'
		], function(index, value) {
			$themes.append('<li><a href="#" rel="' + value + '">' + value + '</a>');
		});
		
	$themes.find('a').on('click', function() {
		$themes.find('li').removeClass();
		$(this).parent('li').addClass('active');
		$('body').hide();
		$('#docstrap-theme').remove();
		$('head').prepend('<link id="docstrap-theme" rel="stylesheet" href="source/themes/' + $(this).attr('rel') + '" media="screen">');
		$('body').show();
	});
	
});

// Google Analytics
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-7101907-1']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ?  'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();