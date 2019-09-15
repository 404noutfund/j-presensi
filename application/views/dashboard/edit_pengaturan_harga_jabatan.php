<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> EDIT: ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('harga_jabatan/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('harga_jabatan/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<?php if(isset($errors)){ ?>
		<div class="flash text-center">
			<div class="message error">
				<p class="bg-danger"><?= $errors; ?></p>
			</div>
		</div>
	<?php } ?>
	<form class="form" method='post' action=''>
		<div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <tr class="{cycle values='odd,even'}">
                    <th width="25%" style="vertical-align: middle;">Periode Aktif <span class="text-danger">*</span></th>
                    <td><input type="text" name="aktif_date" value="<?= isset($bobot_jabatan_data['aktif_date']) ? $bobot_jabatan_data['aktif_date'] : ''; ?>" placeholder="Tahun-Bulan-Tanggal" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
                </tr>
                <tr class="{cycle values='odd,even'}">
                    <th width="25%" style="vertical-align: middle;">Harga</th>
                    <td><input type="text" name="harga_jb" value="<?= isset($bobot_jabatan_data['harga_jb']) ? $bobot_jabatan_data['harga_jb'] : ''; ?>" placeholder="Harga Jabatan" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
                </tr>
                <tr class="{cycle values='odd,even'}">
                    <th width="25%" style="vertical-align: middle;">Peraturan Pemerintah</th>
                    <td><input type="text" name="perpres" value="<?= isset($bobot_jabatan_data['perpres']) ? $bobot_jabatan_data['perpres'] : ''; ?>" placeholder="Nomor Perpres" class="form-control" style="width: 45%; margin-bottom: 0px; margin-top: 7px;"></td>
                </tr>
            </table>
		<div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="javascript:window.history.back();">
				<button type="button" class="btn btn-danger">Batal</button>
			</a>
		</div>
	</form>
</div>
