<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detail Ketentuan Absensi, ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('no_scan/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
			<a href="<?= base_url('no_scan/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
		</div>
	</div>
	<table class="table" width="100%">
		<thead>
			<th width="25%">Kolom</th>
			<th>Hasil</th>
		</thead>
		<tbody>
			<tr class="{cycle values='odd,even'}">
				<td>No Scan In:</td>
				<td><?= $no_scan_data['no_scan_in']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>No Scan As:</td>
				<td><?= $no_scan_data['no_scan_as']; ?></td>
			</tr>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Late:</td>
				<td><?= $no_scan_data['late']; ?></td>
			</tr>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Early:</td>
				<td><?= $no_scan_data['early']; ?></td>
			</tr>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Istirahat:</td>
				<td><?= $no_scan_data['no_break']; ?></td>
			</tr>
		</tbody>
	</table>
	<a href="<?= base_url().'no_scan/edit/'.$id; ?>" class="btn btn-primary">Ubah</a>
</div>