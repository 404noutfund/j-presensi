<table id="load_screen" style="width:100%;height:100%;background:#fff;position:fixed;left:0;top:0;z-index:1060;" ondblclick="$(this).remove()">
<tr><td align="center"><img id="load_screen_img" src="assets/img/loader.gif"/></td></tr>
</table>
<script>
$('<p class="big" style="display:none;position:absolute;top:50%;left:50%;margin-top:22px;color:#ccc"><b>'+document.title+'</b></p>').insertAfter('#load_screen_img').show();
$(window).on('load', function() {
	$('#load_screen').delay(200).fadeOut('slow');
});
</script>