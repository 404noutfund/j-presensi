	<table id="load_big" style="background-color:rgba(0,0,0,.1);width:100%;height:100%;position:fixed;top:0;left:0;z-index:1100;display:none"><tr><td align="center"><img width="10%" src="assets/img/loading/load3.gif"/></td></tr></table>
	<script>
	var st_load;
	function show_loading(delay=1000) {
		window.clearTimeout(st_load);
		st_load = window.setTimeout(function() { $('#load_big').show(); },delay);
	}
	function hide_loading() {
		window.clearTimeout(st_load);
		$('#load_big').fadeOut(500);
	}
	</script>
