<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> EDIT: ID <?= $this->uri->segment('3'); ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('permission/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('permission/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<form class="form" method='post' action='' enctype="multipart/form-data">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" style="border: 1px solid #ddd;">
				<tbody>
					<tr class="{cycle values='odd,even'}">
						<th width="25%" style="vertical-align: middle;">Nama Permission:</th>
						<td><input type="text" name="per_name" value="Super Admin" placeholder="Masukkan Text" class="form-control" style="width: 45%; margin-top: 13px"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<a href="javascript:window.location='/bobot_jabatan'">
				<button type="button" class="btn btn-primary">Simpan</button>
			</a>
			<a href="javascript:window.location='/bobot_jabatan'">
				<button type="button" class="btn btn-default">Batal</button>
			</a>
		</div>
	</form>
</div>
