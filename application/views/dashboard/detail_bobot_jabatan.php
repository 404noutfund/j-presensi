<div class="panel panel-orange">
	<div class="panel-heading">
		<h5><i class="fa fa-table"></i> NIP : <?= $this->uri->segment('3'); ?></h5>
	</div>
	<form class="form form-horizontal form-bordered" method='post' action='' enctype="multipart/form-data">
		<table class="table" width="50%">
			<thead>
				<th width="20%"></th>
				<th></th>
			</thead>
			<tr class="{cycle values='odd,even'}">
				<th>NIK:</th>
				<td><?= $registrasi_data['nip_baru']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<th>Nama Pegawai:</th>
				<td><?= $registrasi_data['nama']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<th>NIK Absensi:</th>
				<td><?= $registrasi_data['pin']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<th>Golongan/Ruang:</th>
				<td><?= $registrasi_data['golongan_ruang']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<th>Eselon:</th>
				<td><?= $registrasi_data['eselon']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<th>Jabatan:</th>
				<td><?= $registrasi_data['jabatan']; ?></td>
			</tr>
			<tr class="{cycle values='odd,even'}">
				<th>Unit Kerja:</th>
				<td><?= $registrasi_data['unit_kerja']; ?></td>
			</tr>
			<?php if ($registrasi_data['sub_unit'] != ""){ ?>
				<tr>
					<th>UPT:</th>
					<td><?= $registrasi_data['sub_unit']; ?></td>
				</tr>
			<?php } ?>
			<tr class="{cycle values='odd,even'}">
				<th>Bobot Jabatan:</th>
				<td><input type="text" name="bobot_jabatan" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['bbt_jabatan']) ? ($registrasi_data['bbt_jabatan']) : ""; ?>"></td>
			</tr>
		</table>
		<div style="text-align:center;padding:20px;">
			<?php
				if (isset($update)){ 
					if ($update > 0){
						echo "Data Bobot Jabatan Telah di Update";
					}
				}
			?>
			<input type="hidden" name="nip_pegawai" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['id_pegawai']) ? ($registrasi_data['id_pegawai']) : ""; ?>">
			<input type="hidden" name="id_posisi" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['id_posisi']) ? ($registrasi_data['id_posisi']) : ""; ?>">
			<div>
				<button type="submit" class="btn btn-primary" name="submit-update" value="yes-add">Update Bobot Jabatan</button>
				<a href="<?= base_url('bobot_jabatan'); ?>">
					<button type="button" class="btn btn-danger">Kembali</button>
				</a>
			</div>
		</div>
	</form>
</div>
