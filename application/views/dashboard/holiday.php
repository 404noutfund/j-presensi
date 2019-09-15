<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Hari Libur</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('holiday/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('holiday_pns/'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-bordered" id="datatable">
          <thead>
              <tr>
                <th class='with-checkbox' width="2%;"><input type="checkbox" name="check_all" id="check_all"></th>
                <th class="text-center">Tanggal Libur</th>
                <th class="text-center">Keterangan Libur</th>
                <th class="text-center">Log Perubahan</th>
                <th class="text-center">User Perubahan</th>
                <th width="130" class="text-center">Operasi</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach ($holiday_data as $h){ ?>
	              <tr>
	                  <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="<?= $h['holiday_date']; ?>" /></td>
	                  <td><?= $h['holiday_date_format']; ?></td>
	                  <td><?= $h['holiday_note']; ?></td>
	                  <td><?= $h['lastupdate_date_format']; ?></td>
                  	  <td><?= $h['lastupdate_user']; ?></td>
	                  <td>
	                    <a href="<?= base_url('holiday/show/'.$h['holiday_date']); ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
	                    	<i class="fa fa-search"></i>
	                    </a>
	                    <a href="<?= base_url('holiday/edit/'.$h['holiday_date']); ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
	                    	<i class="fa fa-edit"></i>
	                    </a>
	                    <a href="<?= base_url('holiday/delete/'.$h['holiday_date']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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