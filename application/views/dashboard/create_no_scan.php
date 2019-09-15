<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Tambah</h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('no_scan/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
			<a href="<?= base_url('no_scan/create'); ?>" class="btn btn-md btn-success">Tambah Data</a>
		</div>
	</div>
	<form class="form " method="post" action="">
		<table class="table" width="100%">
			<tbody>
				<tr class="{cycle values='odd,even'}">
					<th class="text-middle">No Scan As <span class="text-danger">*</span></th>
					<td>
						<input type="number" name="no_scan_as" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="4">
					</td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th class="text-middle">Late <span class="text-danger">*</span></th>
					<td>
						<input type="number" name="late" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="6">
					</td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th class="text-middle">Early <span class="text-danger">*</span></th>
					<td>
						<input type="number" name="early" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="6">
					</td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th class="text-middle">Istirahat <span class="text-danger">*</span></th>
					<td>
						<input type="number" name="no_break" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="6">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">Simpan</button>
						<a href="javascript:window.history:back;">
							<button type="button" class="btn btn-danger">Batal</button>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>