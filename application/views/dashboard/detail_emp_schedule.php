<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detil emp_schedule, ID : <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('emp_schedule/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('emp_schedule/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<table class="table" width="100%">
		<thead>
			<th width="25%">Kolom</th>
			<th>Hasil</th>
		</thead>
		<tbody>
			<tr class="{cycle values='odd,even'}">
				<td>Nomor ID:</td>
				<td><?= $emp_schedule_data['sch_idx']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Nama Jadwal:</td>
				<td><?= $emp_schedule_data['sch_nameid']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Hari Efektif:</td>
				<td><?= $emp_schedule_data['sch_days']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Periode:</td>
				<td><?= $emp_schedule_data['sch_date1']; ?> - <?= $emp_schedule_data['sch_date2']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Jam Masuk:</td>
				<td><?= $emp_schedule_data['sch_checkintime']; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<td>Jam Pulang:</td>
				<td><?= $emp_schedule_data['sch_checkouttime']; ?></td>
			</tr>
		</tbody>
	</table>
	<div class="actions-bar wat-cf">
		<div class="actions">
			<a class="button" href="pegawai/edit/{$id}">
				<button type="submit" class="btn btn-primary">Ubah</button>
			</a>
		</div>
	</div>
</div>