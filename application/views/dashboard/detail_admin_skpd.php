<div class="panel panel-orange">
	<div class="panel-heading">
		<h5><i class="fa fa-table"></i> Registrasi Data Admin</h5>
	</div>
	<form class="form" method='post' action='' enctype="multipart/form-data">
		<div class="table-responsive">
			<table class="table" width="100%">
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
				<?php if ($registrasi_data['sub_unit']){ ?>					
					<tr class="{cycle values='odd,even'}">
						<th>UPT:</th>
						<td>Kelurahan Madyopuro</td>
					</tr>
				<?php } ?>
				<?php if(isset($registrasi_data['login_user'])){ ?>
					<tr>
						<th class="text-middle">GROUP ADMIN:</th>
						<td>
							<select class="form-control" style="width: 200px; margin-top: 13px;" name="group_admin">
								<option value="1" <?= ($registrasi_data['group_id_auto'] == 1) ? "selected" : ""; ?>>ADMIN KOTA</option>
								<option value="2" <?= ($registrasi_data['group_id_auto'] == 2) ? "selected": ""; ?>>ADMIN SKPD</option>
								<option value="3" <?= ($registrasi_data['group_id_auto'] == 3) ? "selected" : ""; ?>>PIMPINAN</option>
							</select>
						</td>
					</tr>
				<?php } ?>
				<?php if(isset($registrasi_data['login_user'])){ ?>
					<tr class="{cycle values='odd,even'}">
						<th>USERNAME ADMIN:</th>
						<td><?= $registrasi_data['login_user']; ?></td>
					</tr>
				<?php } ?>
				<?php if(isset($registrasi_data['login_password'])){ ?>
					<tr class="{cycle values='odd,even'}">
						<th class="text-middle">PASSWORD:</th>
						<td>
							<?= $registrasi_data['login_password']; ?>
							<input type="text" name="new_password">
							<button type="submit" class="btn btn-primary btn-sm" value="1" name="submit-password">Update Password</button>
						</td>
					</tr>
				<?php } ?>
				<?php if(isset($registrasi_data['login_status'])){ ?>
					<tr class="{cycle values='odd,even'}">
						<th>STATUS:</th>
						<td>
							<?= ($registrasi_data['login_status']) ? "AKTIF" : "NONAKTIF"; ?>
							<?php if(isset($registrasi_data['login_status']) && $registrasi_data['login_status'] == 1){ ?>
								<button type="submit" class="btn btn-primary btn-sm" value="0" name="submit-status">Non Aktifkan Admin</button>
							<?php }else{ ?>
								<button type="submit" class="btn btn-primary btn-sm" value="1" name="submit-status">Aktifkan Admin</button>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				<?php if(isset($registrasi_data['manual_absent'])){ ?>
				<tr class="{cycle values='odd,even'}">
					<th>ABSENT MANUAL:</th>
					<td>
						<?= ($registrasi_data['manual_absent']) ? "DIPERBOLEHKAN" : "TIDAK DIPERBOLEHKAN"; ?>
						<?php if(isset($registrasi_data['manual_absent']) && $registrasi_data['manual_absent'] == 1){ ?>
							<button type="submit" class="btn btn-primary btn-sm" name="submit-manual" value="0">Tidak Diperbolehkan</button>
						<?php }else{ ?>
							<button type="submit" class="btn btn-primary btn-sm" name="submit-manual" value="1">Tidak Diperbolehkan</button>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div style="text-align:center;padding:20px;">
			<!-- <input type="hidden" name="nip_pegawai" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['id_pegawai']) ? ($registrasi_data['id_pegawai']) : ""; ?>">
			<input type="hidden" name="id_posisi" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['id_posisi']) ? ($registrasi_data['id_posisi']) : ""; ?>"> -->
			 <input type="hidden" name="nip_pegawai" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['nip_baru']) ? $registrasi_data['nip_baru'] : ''; ?>">
            <input type="hidden" name="login_user" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($registrasi_data['login_user']) ? $registrasi_data['login_user'] : ''; ?>">
			<div>
				<button type="submit" class="btn btn-primary" name="submit-update" value="">Update Group Admin</button>
				<a href="javascript:window.history.back();">
					<button type="button" class="btn btn-danger">Kembali</button>
				</a>
			</div>
		</div>
	</form>
</div>
