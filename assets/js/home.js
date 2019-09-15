	//As of jQuery 3.0, only the first syntax is recommended => $( handler ); the other syntaxes still work but are deprecated.
	//Tuh, dengerin tuh, ngapain orang" suka ngetik yang panjang" :'v
	//sumber: http://api.jquery.com/ready/
	
	$(function() {
		// the body of this function is in assets/material-kit.js
		//materialKit.initSliders();
        window_width = $(window).width();

        if (window_width >= 992) {
            big_image = $('.wrapper > .header');

			$(window).on('scroll', materialKitDemo.checkScrollForParallax);
			//$(window).trigger('scroll');
		}
		// $('.li-akun a').on('click',function() {
		// 	$('#myModal').modal('show');
		// });
		$('a[href="Logout"]').on('click',function(e) {
			e.preventDefault();
			if (confirm('Apakah Anda yakin ingin mengakhiri sesi sekarang?')) window.location.href='Logout';
		});
	});
	scroll_up();
