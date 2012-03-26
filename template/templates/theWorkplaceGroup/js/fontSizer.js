$('.moduletable.fontResize').on('click', 'a.smaller', function() {
	$('div#body p')
		.addClass('smaller')
});

$('.moduletable.fontResize').on('click', 'a.bigger', function() {
	$('div#body p')
		.addClass('bigger')
});