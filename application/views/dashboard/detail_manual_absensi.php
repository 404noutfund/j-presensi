<div class="row bb-2">
	<div class="col-lg-12">
		<div class="pull-left">
			<h3><i class="fa fa-list-alt"></i> Laporan</h3>
		</div>
		<div class="pull-right">
			<a href="" class="btn btn-primary">Cetak</a>
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
		<h2>MODUL ABSENSI MANUAL</h2>
		<p><?= $monthName[(int) $absen_info['month']].' '.$absen_info['year'] ; ?></p>
	</div>
	<div class="col-lg-12 mb-35">
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<th class="pull-left"><p>Nama </p></th>
				<td><p>: <?= $emp_data_x['nama']; ?></p></td>
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
				<th class="pull-left"><p>Unit Kerja </p></th>
				<td><p>: <?= $emp_data_x['sub_unit'] == "" ? $emp_data_x['unit_kerja'] : $emp_data_x['sub_unit']; ?></p></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered black-border" data-nosort="0" width="100%">
			<thead>
				<tr>
					<th rowspan="2" class="text-center">No</th>
					<th rowspan="2" class="text-center">Hari</th>
					<th rowspan="2" class="text-center">Tanggal</th>
					<th colspan="2" class="text-center">Jam Kerja</th>
					<th colspan="2" class="text-center">Rekaman Presensi</th>
					<th rowspan="2" class="text-center">Tindakan</th>
					<th colspan="2" class="text-center">Keterangan</th>
				</tr>
				<tr>
					<th class="text-center">Datang</th>
					<th class="text-center">Pulang</th>
					<th class="text-center">Datang</th>
					<th class="text-center">Pulang</th>
					<th class="text-center">Datang</th>
					<th class="text-center">Pulang</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 1;
					foreach($result_data as $r){ ?>
						<tr>
							<td><?= $counter; ?></td>
							<td>
								<?php
									if($r['day'] == 'Sun'){
										echo "Minggu";
									}elseif($r['day'] == 'Mon'){
										echo "Senin";
									}elseif($r['day'] == 'Tue'){
										echo "Selasa";
									}elseif($r['day'] == 'Wed'){
										echo "Rabu";
									}elseif($r['day'] == 'Thu'){
										echo "Kamis";
									}elseif($r['day'] == 'Fri'){
										echo "Jumat";
									}else {
										echo "Sabtu";
									}
								?>
							</td>
							<td><?= $r['absent_date']; ?></td>
							<td><?= $r['checkintime']; ?></td>
							<td><?= $r['checkouttime']; ?></td>
							<td class="text-center">
								<?php if($r['day_flag']<10){
									if($r['absent_in']['time']==''){ ?>
										<button class="btn btn-primary btn-sm" title="Check In" onclick="v('transaksi2017/checkin/'<?= $emp_data_x['nip_baru'].'/'.$r['absent_date']; ?>)">CheckIn</button>
									<?php }else{ 
										echo $r['absent_in']['date'];
									}
								} ?>
							</td>
							<td class="text-center">
								<?php if($r['day_flag']<10){
									if($r['absent_out']['time']==''){ ?>
										<button class="btn btn-primary btn-sm" title="Check Out" onclick="v('transaksi2017/checkout/'<?= $emp_data_x['nip_baru'].'/'.$r['absent_date']; ?>)">CheckOut</button>
									<?php }else{ 
										echo $r['absent_out']['date'];
									}
								} ?>
							</td>
							<td class="text-center">
								<?php if($r['day_flag']<10){
									if($r['absent_remark']=='TK'){ ?>
										<button class="btn btn-primary btn-sm" title="Absent" onclick="v('transaksi2017/absent/'<?= $emp_data_x['nip_baru'].'/'.$r['absent_date']; ?>)">I/C/S/DL</button>
									<?php }else{ 
										echo $r['absent_remark'];
									}
								} ?>
							</td>
							<td><?= $r['in']['att_remark']; ?></td>
							<td><?= $r['out']['att_remark']; ?></td>
						</tr>
					<?php
					$counter++;
				} ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	function v(url){
	  var win = window.open(url, '_self');
	  win.focus();
	}
</script>