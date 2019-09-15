<div class="panel panel-orange">
	<div class="panel-heading">
		<h5><i class="fa fa-table"></i> NIP : <?= $this->uri->segment('3'); ?></h5>
	</div>
	<table class="table">
		<thead>
			<th width="20%"></th>
			<th></th>
		</thead>
		<tbody>
			<tr class="{cycle values='odd,even'}">
				<th>NIK:</th>
				<td><?= $pegawai->nip_baru; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<th>Nama Pegawai:</th>
				<td><?= $pegawai->nama; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<th>NIK Absensi:</th>
				<td><?= $pegawai->pin; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<th>Golongan/Ruang:</th>
				<td><?= $pegawai->golongan_ruang; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<th>Eselon:</th>
				<td><?= $pegawai->eselon; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<th>Jabatan:</th>
				<td><?= $pegawai->jabatan; ?></td>
			</tr><tr class="{cycle values='odd,even'}">
				<th>Unit Kerja:</th>
				<td><?= $pegawai->unit_kerja; ?></td>
				<?php if($pegawai->sub_unit != ""){ ?>
				</tr><tr class="{cycle values='odd,even'}">
					<th>UPT:</th>
					<td><?= $pegawai->sub_unit; ?></td>
				<?php } ?>
			</tr><tr class="{cycle values='odd,even'}">
				<th>Lokasi Data FingerPrint:</th>
				<td>
					<?php foreach($device_data as $row){ ?>
						<div><?= $row['device_name']; ?></div>
					<?php } ?>  
				</td>
			</tr>
		</tbody>
	</table>
	<!-- <div class="container">
		<div class="row"> -->
            <!-- <a class="button" href="pegawai/edit/{$id}">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </a> -->
        <!-- </div>
    </div> -->
</div>