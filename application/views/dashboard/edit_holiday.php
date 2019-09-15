<div class="panel panel-orange">
	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> EDIT: ID <?= $id; ?></h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('holiday/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
			<!-- <a href="<?= base_url('holiday/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a> -->
		</div>
	</div>
	<form class="form form-inline" method="post" action="">
		<table class="table" width="100%">
			<tbody>
				<?= isset($errors) ? $errors : ''; ?>
				<tr class="{cycle values='odd,even'}">
					<th>Keterangan Libur</th>
					<td>
						<textarea type="text" name="holiday_note" id="textfield" placeholder="Masukkan Text" rows="4" style="width: 632px; height: 74px; margin: 7px;" class="form-control" maxlength="200"><?= isset($holiday_data) ? $holiday_data['holiday_note'] : ''; ?></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">Simpan</button>
						<a href="<?= base_url('emp_schedule'); ?>">
							<button type="button" class="btn btn-danger">Batal</button>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>