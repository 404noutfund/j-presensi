<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detail Absent, ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('absent/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('absent/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<table class="table" width="100%">
		<thead>
			<th width="25%">Kolom</th>
			<th>Hasil</th>
		</thead>
		<tbody>
			<tr class="{cycle values='odd,even'}">
				<td>ID Absen:</td>
				<td><?= $absent_data['absent_id']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Absen:</td>
				<td><?= $absent_data['absent_name']; ?></td>
			</tr>
		</tbody>
	</table>
	<a href="<?=base_url();?>absent/edit/<?= $absent_data['absent_id']; ?>" class="btn btn-primary">Ubah</a>
</div>