<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Detail MESIN, ID <?= $id.' '.$device_data[0]['device_name']; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('device/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('device/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<form class="form form-horizontal form-bordered" method='post' action='' enctype="multipart/form-data">
		<table class="table" width="100%">
			<tr>
				<th width="20%">KOLOM</th>
				<th>HASIL</th>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Device ID Otomatis:</td>
				<td><?= $device_data[0]['devid_auto']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Alamat IP:</td>
				<td><?= $device_data[0]['ip_address']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Nama Device:</td>
				<td><?= $device_data[0]['device_name']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>SN:</td>
				<td><?= $device_data[0]['sn']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Ethernet Port:</td>
				<td><?= $device_data[0]['ethernet_port']; ?></td>
			</tr>
		</table>
		<div>
			<a href="<?= base_url('device/edit/'.$id); ?>">
				<button type="button" class="btn btn-primary">Ubah</button>
			</a>
		</div>
	</form>
</div>
