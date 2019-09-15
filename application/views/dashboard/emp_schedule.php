<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Jadwal</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('emp_schedule/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('emp_schedule/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th class='with-checkbox'><input type="checkbox" name="check_all" id="check_all"></th>
                <th class="text-center">ID</th>
                <th class="text-center">Unit Kerja</th>
                <th class="text-center">Nama Jadwal</th>
                <th class="text-center">Senin</th>
                <th class="text-center">Selasa</th>
                <th class="text-center">Rabu</th>
                <th class="text-center">Kamis</th>
                <th class="text-center">Jumat</th>
                <th class="text-center">Sabtu</th>
                <th class="text-center">Minggu</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach ($emp_schedule_data as $e){ ?>
	              <tr>
	                  <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="" /></td>
	                  <td><?= $e['sch_idx']; ?></td>
	                  <td><?= isset($e['sub_unitkerja']) ? ($e['sub_unitkerja']) : ($e['unit_kerja']); ?></td>
	                  <td><?= $e['sch_nameid']; ?></td>
	                  <?php foreach ($e['sch_days_ch'] as $sch){ ?>
	                  	<td><?= $sch; ?></td>
	                  <?php } ?>
	                  </td>
	                  <td>
	                    <a href="<?= base_url('emp_schedule/show/'.$e['sch_idx']); ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
	                    	<i class="fa fa-search"></i>
	                    </a>
	                    <a href="<?= base_url('emp_schedule/edit/'.$e['sch_idx']); ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
	                    	<i class="fa fa-edit"></i>
	                    </a>
	                    <a href="<?= base_url('emp_schedule/delete/'.$e['sch_idx']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
	                    	<i class="fa fa-trash"></i>
	                    </a>
	                </td>
	             </tr>
	            <?php } ?>
         </tbody>
     </table>
 	</div>
</div>

<script src="plugins/datatables/datatables.min.js"></script>
<script src="plugins/datatables/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $("#datatable").DataTable();
</script>