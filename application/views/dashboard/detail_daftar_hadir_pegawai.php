<div class="row bb-2">
	<div class="col-lg-12">
		<div class="pull-left">
			<h3><i class="fa fa-list-alt"></i> Laporan</h3>
		</div>
		<div class="pull-right">
			<a href="" class="btn btn-primary">Cetak</a>
			<a href="" class="btn btn-primary">Lihat Log Presensi</a>
		</div>
	</div>
</div>
<div class="row p-20">
	<div class="col-lg-8">
		<form method='post' action="">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div class="row mr-0">
							<select name="iMonth" class="form-control">
								<?php for ($i=1;$i<=12;$i++){ ?>
									<option value='<?= $i; ?>' <?php echo ($i == $absen_info['month']) ? ("selected") : (""); ?>/><?= $monthName[$i]; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<select name="iYear" class="form-control">
							<?php for ($y=$absen_info['start_year'];$y<=date('Y');$y++){ ?>
								<option value='<?= $y; ?>' <?php echo ($y == $absen_info['year']) ? ("selected") : (""); ?>/><?= $y; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-1">
						<input type='button' class="btn btn-primary" id="btn-search" title="Cetak" onclick="submit();" value='submit'>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-sm-12 text-center mb-35">
		<h2>REKAPITULASI ABSENSI</h2>
		<p><?= $monthName[(int) $absen_info['month']].' '.$absen_info['year']; ?></p>
	</div>
	<div class="col-lg-12 mb-35">
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<th class="pull-left"><p>Nama </p></th>
				<td><p>: <?= $emp_data_x['nama']; ?></p></td>
			</tr>
			<tr>
				<th class="pull-left"><p>Pin </p></th>
				<td><p>: <?= $emp_data_x['pin']; ?></p></td>
			</tr>
			<tr>
				<th class="pull-left"><p>Nip </p></th>
				<td><p>: <?= $emp_data_x['nip_baru']; ?></p></td>
			</tr>
			<tr>
				<th class="pull-left"><p>Jabatan </p></th>
				<td><p>: <?= $emp_data_x['jabatan']; ?></p></td>
			</tr>
			<tr>
				<th class="pull-left"><p>Gol/Ruang </p></th>
				<td><p>: IV/c</p></td>
			</tr>
			<tr>
				<th class="pull-left"><p>Unit Kerja </p></th>
				<td><p>: <?= ($emp_data_x['sub_unit'] == "") ? ($emp_data_x['unit_kerja']) : ($emp_data_x['sub_unit']); ?></p></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered black-border" data-nosort="0" width="100%">
			<thead>
				<tr>
					<th class="th text-center" rowspan="2">No</th>
					<th class="th text-center" rowspan="2">Hari</th>
					<th class="th text-center" rowspan="2">Tanggal</th>
					<th class="th text-center" colspan="2">Jam Kerja</th>
					<th class="th text-center" colspan="2">Rekaman Presensi</th>
					<th class="th text-center" rowspan="2">Keterangan</th>
					<th class="th text-center" colspan="4">Terlambat (TL)</th>
					<th class="th text-center" colspan="4">Pulang Sebelum Waktunya (PSW)</th>
				</tr>
				<tr>
					<th class="th text-center">Datang</th>
					<th class="th text-center">Pulang</th>
					<th class="th text-center">Datang</th>
					<th class="th text-center">Pulang</th>
					<th class="th text-center">TL1</th>
					<th class="th text-center">TL2</th>
					<th class="th text-center">TL3</th>
					<th class="th text-center">TL4</th>
					<th class="th text-center">PSW1</th>
					<th class="th text-center">PSW2</th>
					<th class="th text-center">PSW3</th>
					<th class="th text-center">PSW4</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$counter = 1;
					foreach ($result_data['data'] as $r) { ?>
					<tr <?= $r['day_flag'] == 1 ? 'style="background-color: #dddddd"' : ''; ?>>
						<td class="td text-center"><?= $counter; ?></td>
						<td class="td text-center">
							<?php
								if ($r['day'] == 'Sun'){
									echo "Minggu";
								}elseif ($r['day']  == 'Mon'){
									echo "Senin";
								}elseif ($r['day']  == 'Tue'){
									echo "Selasa";
								}elseif ($r['day']  == 'Wed'){
									echo "Rabu";
								}elseif ($r['day']  == 'Thu'){
									echo "Kamis";
								}elseif ($r['day']  == 'Fri'){
									echo "Jumat";
								}else{
									echo "Sabtu";
								}
							?>
						</td>
						<td class="td text-center"><?= $r['absent_date']; ?></td>
						<td class="td text-center"><?= $r['checkintime']; ?></td>
						<td class="td text-center"><?= $r['checkouttime']; ?></td>
						<td class="td text-center"><?= $r['absent_in']['time']; ?></td>
						<td class="td text-center"><?= $r['absent_out']['time']; ?></td>
						<td class="td text-center"><?= $r['absent_remark']; ?></td>
						<td class="td text-center"><?= $r['sum_tl1']; ?></td>
						<td class="td text-center"><?= $r['sum_tl2']; ?></td>
						<td class="td text-center"><?= $r['sum_tl3']; ?></td>
						<td class="td text-center"><?= $r['sum_tl4']; ?></td>
						<td class="td text-center"><?= $r['sum_psw1']; ?></td>
						<td class="td text-center"><?= $r['sum_psw2']; ?></td>
						<td class="td text-center"><?= $r['sum_psw3']; ?></td>
						<td class="td text-center"><?= $r['sum_psw4']; ?></td>
					</tr>

					<script type="text/javascript">
						var tanggal = moment(<?= $r['checkintime']; ?>).add(30, 'm').toDate();
						// alert(tanggal);
					</script>
				<?php 
					$counter++;
				} ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered black-border" data-nosort="0" width="100%">
			<thead>
				<tr>
					<th class="th text-center" colspan="7">PENGHITUNGAN TUNJANGAN TAMBAHAN PENGHASILAN</th>
				</tr>
				<tr>
					<th class="th text-center" rowspan="2">Uraian</th>
					<th class="th text-center" colspan="2">Jumlah</th>
					<th class="th text-center" rowspan="2">Prestasi Kehadiran</th>
					<th class="th text-center" rowspan="2">Bobot Jabatan</th>
					<th class="th text-center" rowspan="2">Harga Bobot Jabatan</th>
					<th class="th text-center" rowspan="2">Jumlah Tunjangan Tambahan Penghasilan Yang Diterima</th>
				</tr>
				<tr>
					<th class="th text-center">Hari</th>
					<th class="th text-center">%</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-center">Hari Efektif</td>
					<td class="text-center"><?= $result_data['totalmasuk']; ?></td>
					<td class="text-center">100</td>
					<td class="text-center">
						<?=
							$value = (floatval($result_data['avg_tl1']) + floatval($result_data['avg_tl2']) + floatval($result_data['avg_tl3']) + floatval($result_data['avg_tl4']) + floatval($result_data['avg_psw1']) + floatval($result_data['avg_psw2']) + floatval($result_data['avg_psw3']) + floatval($result_data['avg_psw4']) + floatval($result_data['avgsakit']) + floatval($result_data['avgcuti']) +  + floatval($result_data['avgijin']) + floatval($result_data['avgtk']) + floatval($result_data['avgcutisakit']));
							$total_awal = $value;

							if ($total_awal > 1200){
								$total_prestasi = 100 - (1300 - $total_awal);
								$totalgaji = floatval($total_prestasi / 100) * floatval($honor['bbt_jabatan']) * $harga_jabatan;
							}else{
								$totalprestasi = 0;
								$totalgaji = floatval($totalprestasi) * floatval($honor['bbt_jabatan']) * $harga_jabatan;
							}
							
							$totalprestasi;
						?>
					</td>
					<td class="text-center"><?= $honor['bbt_jabatan']; ?></td>
					<td class="text-center"><?= $harga_jabatan; ?></td>
					<td class="text-right">Rp. <?= number_format($totalgaji,2,".",","); ?></td>
				</tr>
				<tr>
					<td class="text-center">TL1</td>
					<td class="text-center"><?= $result_data['tottl1']; ?></td>
					<td class="text-center"><?= $result_data['avg_tl1']; ?></td>
				</tr>
				<tr>
					<td class="text-center">TL2</td>
					<td class="text-center"><?= $result_data['tottl2']; ?></td>
					<td class="text-center"><?= $result_data['avg_tl2']; ?></td>
				</tr>
				<tr>
					<td class="text-center">TL3</td>
					<td class="text-center"><?= $result_data['tottl3']; ?></td>
					<td class="text-center"><?= $result_data['avg_tl3']; ?></td>
					<td class="text-center bc-white" colspan="4">Malang, <?= $result_data['tgl_ttd']; ?></td>
				</tr>
				<tr>
					<td class="text-center">TL4</td>
					<td class="text-center"><?= $result_data['tottl4']; ?></td>
					<td class="text-center"><?= $result_data['tottl4']; ?></td>
					<td class="text-center bc-white" colspan="4">Admin OPD</td>
				</tr>
				<tr>
					<td class="text-center">PSW1</td>
					<td class="text-center"><?= $result_data['totpsw1']; ?></td>
					<td class="text-center"><?= $result_data['avg_psw1']; ?></td>
				</tr>
				<tr>
					<td class="text-center">PSW2</td>
					<td class="text-center"><?= $result_data['totpsw2']; ?></td>
					<td class="text-center"><?= $result_data['avg_psw2']; ?></td>
					<td class="text-center bc-white" colspan="4"><b><?= $admin['nama']; ?></b></td>
				</tr>
				<tr>
					<td class="text-center">PSW3</td>
					<td class="text-center"><?= $result_data['totpsw3']; ?></td>
					<td class="text-center"><?= $result_data['avg_psw3']; ?></td>
					<td class="text-center bc-white" colspan="4">NIP. <?= $admin['nip_baru']; ?></td>
				</tr>
				<tr>
					<td class="text-center">PSW4</td>
					<td class="text-center"><?= $result_data['totpsw4']; ?></td>
					<td class="text-center"><?= $result_data['avg_psw4']; ?></td>
				</tr>
				<tr>
					<td class="text-center">Sakit</td>
					<td class="text-center"><?= $result_data['sakit']; ?></td>
					<td class="text-center"><?= $result_data['avgsakit']; ?></td>
				</tr>
				<tr>
					<td class="text-center">Cuti</td>
					<td class="text-center"><?= $result_data['cuti']; ?></td>
					<td class="text-center"><?= $result_data['avgcuti']; ?></td>
				</tr>
				<tr>
					<td class="text-center">Cuti Sakit</td>
					<td class="text-center"><?= $result_data['cutisakit']; ?></td>
					<td class="text-center"><?= $result_data['avgcutisakit']; ?></td>
				</tr>
				<tr>
					<td class="text-center">Ijin</td>
					<td class="text-center"><?= $result_data['ijin']; ?></td>
					<td class="text-center"><?= $result_data['avgijin']; ?></td>
				</tr>
				<tr>
					<td class="text-center">TK</td>
					<td class="text-center"><?= $result_data['tk']; ?></td>
					<td class="text-center"><?= $result_data['avgtk']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>