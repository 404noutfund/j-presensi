<div class="panel panel-orange">
	<div class="panel-heading">
		<h5><i class="fa fa-th-list"></i> Form Registrasi Serial</h5>
	</div>
	<form class="form" method="post" action="">
		<table class="table" width="100%">
			<!-- <thead>
				<th width="25%">Kolom</th>
				<th>Hasil</th>
			</thead> -->
			<tbody>
				<tr class="{cycle values='odd,even'}">
					<th class="text-middle">NIP Pegawai</th>
						<!-- <input type="number" name="no_scan_as" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="4"> -->
					<td><input type="text" name="sch_nameid" value="" placeholder="Masukkan Text" class="form-control" style="width: 250px;"></td>
				</tr><tr class="{cycle values='odd,even'}">
					<th class="text-middle">Jenis Admin</th>
					<td>
						<select class="form-control" style="width: 250px">
							<option>PIMPINAN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">Simpan</button>
						<a href="javascript:window.history.back();">
							<button type="button" class="btn btn-danger">Batal</button>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>