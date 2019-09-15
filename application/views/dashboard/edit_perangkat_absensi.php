<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> EDIT: ID <?= $this->uri->segment('3'); ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('device/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('device/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<form class="form" method='post' action='' enctype="multipart/form-data">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%">
				<tr class="{cycle values='odd,even'}">
					<th width="25%" style="vertical-align: middle;">Nama Device:</th>
					<td><input type="text" name="device_name" value="<?= isset($device_data) ? $device_data[0]['device_name'] : ''; ?>" placeholder="Masukkan Text" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th width="25%" style="vertical-align: middle;">SN:</th>
					<td><input type="text" name="sn" value="<?= isset($device_data) ? $device_data[0]['sn'] : ''; ?>" placeholder="Masukkan Text" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th width="25%" style="vertical-align: middle;">Alamat IP:</th>
					<td><input type="text" name="ip_address" value="<?= isset($device_data) ? $device_data[0]['ip_address'] : ''; ?>" placeholder="Masukkan Text" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<th width="25%" style="vertical-align: middle;">Enthernet Port:</th>
					<td><input type="text" name="ethernet_port" value="<?= isset($device_data) ? $device_data[0]['ethernet_port'] : ''; ?>" placeholder="Masukkan Text" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
				</tr>
			</table>
		</div>
		<div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="javascript:window.history.back();">
				<button type="button" class="btn btn-danger">Batal</button>
			</a>
		</div>
	</form>
</div>
