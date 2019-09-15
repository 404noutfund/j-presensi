	var reload_tbl='';
	var reload_isi;
	(function( $ ){ $.fn.dattr = function(atr,val='') { this.attr('data-'+atr,val); this.data(atr,val); return this; }; })( jQuery );
	$(function() {
		$('input[type=file]').on('change',function(e) {
			var preview  = $(this).attr('rel');
			var oFReader = new FileReader();
				oFReader.readAsDataURL(this.files[0]);
				console.log(this.files[0]);
				oFReader.onload = function(oFREvent) {
					$(preview).attr('src',oFREvent.target.result).show(200);
				};
		});
		$('input[readonly]').css('background-color','#eee').on('click',function() {
			$(this).closest('.table-sr').find('.btn-look').click();
		});
		$('input.num').val('0').on('keyup',function() {
			if (!$(this).val()) $(this).val('0');
		});
		$('.modal').on('shown.bs.modal',function(e) {
			var wrp = $(this).find('tbody[id]');
			if (wrp.length) {
				var mdl = $(this);
				wrp.each(function() {
					var tbl = $(this).attr('id');
					if ($(this).is('[data-rel]')) tbl+= '/'+$(this).data('rel');
					load_tabel(tbl,$(this).find('tr').length);
					reload_isi = setInterval(function() {
						load_tabel(tbl,1);						
					},3000);
					mdl.one('hidden.bs.modal',function() {
						clearInterval(reload_isi);
					});
				});
			}
		});
		$('form')
		.on('keyup blur','.price',function() {
			$(this).val(num_f($(this).val().replace(/\D/g,'').split(',').join(''),','));
		})
		.on('keydown','.num',function(e) {
			if ($.inArray(e.keyCode,[46,8,9,27,13,110,190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) return;
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) e.preventDefault();
		})
		.on('submit',function() {
			$(this).find('.price').each(function() {
				$(this).val($(this).val().split(',').join(''));
			});
		})
		.on('blur','.num_f',function() {
			if (!!$(this).val()) $(this).val(num_f($(this).val().split('.').join(''))); else $(this).val('0');
		});
		$('.cari').on('change keyup',function() {
			var rel = $(this).attr('rel');
			var val = $(this).val().toLowerCase();
			$(rel).find('tr').each(function() {
				console.log($(this).text().toLowerCase());
				$(this).toggle(($(this).text().toLowerCase().indexOf(val) > -1));
			});
		});
		$('.num_f:empty').val('0');
	});
	function num_f(n,d='.') {
		if (!!!n) return '0';
		n  += '';
		x  = n.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + d + '$2');
		}
		return x1 + x2;
	}
    function format_tanggal(val) {
    	var date = new Date(val);
		var d    = ('0'+date.getDate()).slice(-2);
		var m    = ('0'+(date.getMonth()+1)).slice(-2);
		var y    = date.getFullYear();
		date     = d+'-'+m+'-'+y;
		return date;
    };
