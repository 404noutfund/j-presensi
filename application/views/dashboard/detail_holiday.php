<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detail Libur, Tanggal <?= $holiday_data['holiday_date_format']; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('holiday/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<!-- <a href="<?= base_url('holiday/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a> -->
		</div>
	</div>
	<table class="table" width="100%">
		<thead>
			<th width="25%">Kolom</th>
			<th>Hasil</th>
		</thead>
		<tbody>
			<tr class="{cycle values='odd,even'}">
				<td>Tanggal Libur:</td>
				<td><?= $holiday_data['holiday_date_format']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Keterangan Libur:</td>
				<td><?= $holiday_data['holiday_note']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Log Perubahan:</td>
				<td><?= $holiday_data['lastupdate_date_format']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>User Perubahan:</td>
				<td><?= $holiday_data['lastupdate_user']; ?></td>
			</tr>
		</tbody>
	</table>
</div>