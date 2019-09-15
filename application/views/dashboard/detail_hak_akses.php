<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Data Detail Permission, ID: <?= $this->uri->segment('3'); ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('permission/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('permission/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<form class="form form-horizontal form-bordered" method='post' action='' enctype="multipart/form-data">
		<table class="table" width="100%">
			<thead>
				<tr>
					<th width="25%">KOLOM</th>
					<th>HASIL</th>
				</tr>
			</thead>
			<tbody>
				<tr class="{cycle values='odd,even'}">
					<td>ID Permission:</td>
					<td>1</td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<td>Nama Permission:</td>
					<td>Super Admin</td>
				</tr>
			</tbody>
		</table>
		<div>
			<a href="javascript:window.location='/bobot_jabatan'">
				<button type="button" class="btn btn-primary">Ubah</button>
			</a>
		</div>
	</form>
</div>
