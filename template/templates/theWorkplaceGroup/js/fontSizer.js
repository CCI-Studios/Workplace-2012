window.addEvent('domready', function() {
	var resizer = $$('.moduletable.fontResize')[0],
		minus = resizer.getElement('.smaller'),
		plus = resizer.getElement('.bigger'),
		content = $('content'),
		current = parseInt(content.getStyle('font-size'), 10);
		
	console.log(current);
	minus.addEvent('click', function(event) {
		current--;
		if (current < 9)
			current = 9;
		content.setStyle('font-size', current);
		event.preventDefault();
	});
	
	plus.addEvent('click', function(event) {
		current++;
		if (current > 16)
			current = 16;
		content.setStyle('font-size', current);
		event.preventDefault();
	});
});