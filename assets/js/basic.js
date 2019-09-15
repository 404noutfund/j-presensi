	///////////// scrolling XD ////////////////////////////
	function scroll_to(elm,pos='default',offset=85) {
		if (!$(elm).length) return;
		var top = 0;
		if (pos == 'default') {
			top = $(elm).offset().top - offset;
		} else if (pos == 'middle') {
			top = $(elm).offset().top + ($(elm).outerHeight()/2) - ($(window).height()/2) + offset;
		} else if (pos == 'bottom') {
			top = $(elm).offset().top + $(elm).outerHeight();
		}
		$('html,body').animate({'scrollTop':top},800);
	}
	function scroll_up() {
		$('html,body').animate({'scrollTop':0},800);
	}

	///////////// formatting :V ////////////////////////////
	function num_f(n,d='.') {
		n += '';
		x = n.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + d + '$2');
		}
		return x1 + x2;
	}
