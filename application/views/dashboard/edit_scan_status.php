<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Edit: ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('scan_status/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
			<a href="<?= base_url('scan_status/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
		</div>
	</div>
	<form class="form " method="post" action="">
		<table class="table" width="100%">
			<tbody>
				<tr class="{cycle values='odd,even'}">
					<th class="text-middle">Nama Scan <span class="text-danger">*</span></th>
					<td>
						<input type="text" name="scan_name" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="<?= isset($scan_status_data) ? $scan_status_data['scan_name'] : ''; ?>" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="100">
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