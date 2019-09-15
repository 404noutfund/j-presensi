<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> EDIT: ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('emp_schedule/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<a href="<?= base_url('emp_schedule/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
	</div>
	<form class="form form-inline" method="post" action="">
		<table class="table table-bordered" width="100%">
			<tbody>
				<tr class="{cycle values='odd,even'}">
					<td>Unit Kerja</td>
					<td>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</td>
				</tr>
				<tr class="{cycle values='odd,even'}">
					<td>Nama Jadwal <span class="text-danger">*</span></td>
					<td>
						<input type="text" name="sch_nameid" placeholder="Masukkan Text" class="form-control" value="<?= isset($emp_schedule_data['sch_nameid']) ? ($emp_schedule_data['sch_nameid']) : ""; ?>">
						<input type="hidden" name="sch_idx" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field" value="<?= isset($emp_schedule_data['sch_idx']) ? $emp_schedule_data['sch_idx'] : ''; ?>">
					</td>
				</tr><tr class="{cycle values='odd,even'}">
					<td>Hari <span class="text-danger">*</span></td>
					<td>
						<div class="table-responsive">
							<table class="table table-bordered table-hover dataTable dataTable-tools dataTable-scroll-x dataTable-nosort" data-nosort="0">
								<tr>
									<th>Senin</th>
									<th>Selasa</th>
									<th>Rabu</th>
									<th>Kamis</th>
									<th>Jumat</th>
									<th>Sabtu</th>
									<th>Minggu</th>                                   
								</tr>
								<tr>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="1" <?= isset($emp_schedule_data['sch_days_1']) ? 'checked' : ''; ?>/></td>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="2" <?= isset($emp_schedule_data['sch_days_2']) ? 'checked' : ''; ?>/></td>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="3" <?= isset($emp_schedule_data['sch_days_3']) ? 'checked' : ''; ?>/></td>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="4" <?= isset($emp_schedule_data['sch_days_4']) ? 'checked' : ''; ?>/></td>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="5" <?= isset($emp_schedule_data['sch_days_5']) ? 'checked' : ''; ?>/></td>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="6" <?= isset($emp_schedule_data['sch_days_6']) ? 'checked' : ''; ?>/></td>
									<td><input type="checkbox" class="checkbox" name="sch_days[]" value="7" <?= isset($emp_schedule_data['sch_days_7']) ? 'checked' : ''; ?>/></td>
								</tr>
							</table>
						</div>
					</td>
				</tr><tr class="{cycle values='odd,even'}">
					<td>Waktu Checkin <span class="text-danger">*</span></td>
					<td>
						<select class="form-control" name="sch_checkintimeHour">
							<?php foreach($jam as $j) { ?>
								<option <?php if($j == $hourIn){echo "selected";}; ?>><?= $j; ?></option>
							<?php } ?>
						</select>
						<select class="form-control" name="sch_checkintimeMinute">
							<?php foreach($menit as $m) { ?>
								<option <?php if($m == $minuteIn){echo "selected";}; ?>><?= $m; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr><tr class="{cycle values='odd,even'}">
					<td>Waktu Checkout <span class="text-danger">*</span></td>
					<td>
						<select class="form-control" name="sch_checkouttimeHour">
							<?php foreach($jam as $j) { ?>
								<option <?php if($j == $hourOut){echo "selected";}; ?>><?= $j; ?></option>
							<?php } ?>
						</select>
						<select class="form-control" name="sch_checkouttimeMinute">
							<?php foreach($menit as $m) { ?>
								<option <?php if($m == $minuteOut){echo "selected";}; ?>><?= $m; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="actions">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?= base_url('emp_schedule'); ?>">
				<button type="button" class="btn btn-danger">Batal</button>
			</a>
		</div>
	</form>
</div>