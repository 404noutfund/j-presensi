<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detail Harga Jabatan, ID: <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('harga_jabatan/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('harga_jabatan/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<form class="form form-horizontal form-bordered" method='post' action='' enctype="multipart/form-data">
		<table class="table" width="50%">
			<tr>
				<th width="20%">KOLOM</th>
				<th>HASIL</th>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Index:</td>
				<td><?= $harga_jabatan_data['id']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Tanggal Aktif:</td>
				<td><?= $harga_jabatan_data['aktif_date']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Harga:</td>
				<td><?= $harga_jabatan_data['harga_jb']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<td>Peraturan:</td>
				<td><?= $harga_jabatan_data['perpres']; ?></td>
			</tr>
		</table>
		<div>
			<a href="<?= base_url('harga_jabatan/edit/'.$id); ?>">
				<button type="button" class="btn btn-primary">Ubah</button>
			</a>
		</div>
	</form>
</div>
