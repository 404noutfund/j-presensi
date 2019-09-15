<div class="row bb">
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
						<div class="row mr-0">
							<select name="iYear" class="form-control">
								<?php for ($y=$absen_info['start_year'];$y<=date('Y');$y++){ ?>
									<option value='<?= $y; ?>' <?php echo ($y == $absen_info['year']) ? ("selected") : (""); ?>/><?= $y; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>     
					<div class="col-lg-1">
						<div class="row mr-0">             
							<input type='button' class="btn btn-primary" id="btn-search" title="Cetak" onclick="submit();" value='submit'>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-sm-12 text-center mb-35">
		<h2>FORM REGISTRASI SHIFT</h2>
	</div>
	<div class="col-lg-12 mb-35">
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<th style="text-align:left"><p>Nama </p></th>
				<td><p>: <?= $emp_data_x['nama']; ?></p></td>
			</tr>
			<tr>
				<th style="text-align:left"><p>Pin </p></td>
				<td><p>: <?= $emp_data_x['pin']; ?></p></td>
			</tr>
			<tr>
				<th style="text-align:left"><p>Nip </p></th>
				<td><p>: <?= $emp_data_x['nip_baru']; ?></p></td>
			</tr>
			<tr>
				<th style="text-align:left"><p>Jabatan </p></th>
				<td><p>: <?= $emp_data_x['jabatan']; ?></p></td>
			</tr>
			<tr>
				<th style="text-align:left"><p>Unit Kerja </p></th>
				<td>
					<p>: <?= ($emp_data_x['sub_unit'] == "") ? ($emp_data_x['unit_kerja']) : ($emp_data_x['sub_unit']); ?></p>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-lg-12 mb-35">
		<table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0" id="responsive-table">
			<thead>
				<tr>
					<th class="th text-middle text-center" rowspan="2">No</th>
					<th class="th text-middle text-center" rowspan="2">Hari</th>
					<th class="th text-middle text-center" rowspan="2">Tanggal</th>
					<th class="th" colspan="2"><center>Hari Kerja</center></th>
					<th class="th text-middle text-center" rowspan="2">Shift</th>
					<th class="th text-middle text-center" rowspan="2">Jam Masuk</th>
					<th class="th text-middle text-center" rowspan="2">Jam Pulang</th>
					<th class="th text-middle text-center" rowspan="2">Pilihan Jadwal</th>
					<th class="th text-middle text-center" rowspan="2">Action</th>
				</tr>
				<tr>
					<th class="th"><center>LIBUR</center></th>
					<th class="th"><center>EFEKTIF</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 1;
					foreach ($days as $d) { ?>
							<form method='post' id="sch_{$emp_data_x['pin']}"  action="{$module_name}/insert_shift/{$emp_data_x['nip_baru']}" class="form"><tr>
								<td class="td"><?= $counter; ?></td>
								<td class="td">
									<?php
										if ($d['day'] == 'Sun'){
											echo "Minggu";
										}elseif ($d['day'] == 'Mon'){
											echo "Senin";
										}else if ($d['day'] == 'Tue') {
											echo "Selasa";
										}elseif ($d['day'] == 'Wed') {
											echo "Rabu";
										}elseif($d['day'] == 'Thu'){
											echo "Kamis";
										}elseif ($d['day'] == 'Fri') {
											echo "Jumat";
										}else{
											echo "Sabtu";
										}
									?>
								</td>
								<td class="td">
									<?= $d['tanggal']; ?>
								</td>
								<td class="td text-center">
									<input type="radio" name="is_workdays" id="is_workdays_<?= $d['tanggal']; ?>" value="0" <?= ($d['is_workdays'] == 0) ? "checked" : ""; ?>/>
								</td>
								<td class="td text-center">
									<input type="radio" name="is_workdays" id="is_workdays_<?= $d['tanggal']; ?>"value="1" <?= ($d['is_workdays'] == 1) ? "checked" : ""; ?>/>
								</td>
								<td class="td">
									<?= $d['sch_nameid']; ?>
								</td>
								<td class="td">
									<?= $d['sch_checkintime']; ?>
								</td>
								<td class="td">
									<?= $d['sch_checkouttime']; ?>
								</td>
								<td>
									<select name="sch_id" class="form-control">
										<?php foreach ($sch as $s){ ?>
											<option value="<?= $s['sch_idx']; ?>" <?php echo ($s['sch_idx'] == $allsch[0]['sch_idx']) ? ("selected") : (""); ?>/>
												<?= $s['sch_nameid']; ?> / <?= $s['sch_checkintime']; ?> - <?= $s['sch_checkouttime']; ?>
											</option>
										<?php } ?>
									</select>
									<input type="hidden" name="nik" value="<?= $emp_data_x['nip_baru']; ?>">
									<input type="hidden" name="pin" value="<?= $emp_data_x['pin']; ?>">
									<input type="hidden" name="tanggal" value="<?= $d['tanggal']; ?>" readonly="true">
								</td>
								<td class="td text-center">
									<button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-file"></i></button>
									<button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-plus-circle"></i></button>
								</td>
							</tr>
					</form>
				<?php 
					$counter++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>