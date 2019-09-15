<div class="panel panel-orange">
	<div class="panel-heading">
		<h5><i class="fa fa-th-list"></i> Registrasi PIN</h5>
	</div>
	<form class="form form-inline" method="post" action="<?= base_url('registrasi_serial/add'); ?>">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%">
				<tr class="{cycle values='odd,even'}">
					<th width="25%" class="text-middle">NIP PEGAWAI:</th>
					<td><input type="text" name="sch_nameid" value="" placeholder="Masukkan NIP" class="form-control" style="width: 100%; margin-bottom: 0px; margin-top: 7px;" maxlength="18" onKeyUp="cekNIP(this.value)"></td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th width="25%" class="text-middle">NO SERIAL:</th>
					<td><input type="text" name="sch_nameid" value="" placeholder="Masukkan SERIAL" class="form-control" style="width: 100%; margin-bottom: 0px; margin-top: 7px;" maxlength="5"><button class="btn btn-primary btn-sm" style="margin-left: 10px">Check</button></td>
				</tr>
			</table>
		</div>
		<div class="actions-bar wat-cf">
			<div class="actions">
				<button type="submit" class="btn btn-primary" disabled id="myBtn">Simpan</button>
				<a href="javascript:window.history.back();">
					<button type="button" class="btn btn-danger">Batal</button>
				</a>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
function cekNIP(pNIP){
	console.log('success');
	var n = pNIP.length;
	if(n=='18'){
		$.ajax({
			type: "GET",
			url : 'tambah_peg/cheknip?txtnip='+pNIP,
			success: function ( data ) {
				var msg = data.split("~");
				alert(msg[0]);
				if(msg[1]==1){
					document.getElementById("btnchk").disabled = false;
				}
			},
			error : function ( err ) {
			}
		});
	}
}
function disBtn(){
	document.getElementById("myBtn").disabled = true;
}
function chek(){
	// alert($('#serial_pegawai').val());
	$.ajax({
		type: "GET",
		url : 'tambah_peg/chek?srl='+$('#serial_pegawai').val(),
		success: function ( data ) {
			var msg = data.split("~");
			alert(msg[0]);
			if(msg[1]==1){
				document.getElementById("myBtn").disabled = false;
			}
		},
		error : function ( err ) {
		}
	});
	
}
</script>