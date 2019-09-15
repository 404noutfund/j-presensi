<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detail Scan Status, ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('scan_status/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
			<!-- <a href="<?= base_url('scan_status/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a> -->
		</div>
	</div>
	<table class="table" width="100%">
		<thead>
			<th width="25%">Kolom</th>
			<th>Hasil</th>
		</thead>
		<tbody>
			<tr class="{cycle values='odd,even'}">
				<td>ID Scan:</td>
				<td><?= $scan_status_data['scan_id']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Nama Scan:</td>
				<td><?= $scan_status_data['scan_name']; ?></td>
			</tr>
		</tbody>
	</table>
	<a href="<?= base_url().'scan_status/edit/'.$id; ?>" class="btn btn-primary">Ubah</a>
</div>