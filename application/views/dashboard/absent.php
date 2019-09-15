<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Status Absen</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('absent/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('absent/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-bordered" id="datatable">
          <thead>
              <tr>
                <th class='with-checkbox' width="2%;"><input type="checkbox" name="check_all" id="check_all"></th>
                <th class="text-center">Absen</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach ($absent_data as $a){ ?>
	              <tr>
	                  <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="<?= $a['absent_id']; ?>" /></td>
	                  <td><?= $a['absent_name']; ?></td>
	                  <td>
	                    <a href="<?= base_url('absent/show/'.$a['absent_id']); ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
	                    	<i class="fa fa-search"></i>
	                    </a>
	                    <a href="<?= base_url('absent/edit/'.$a['absent_id']); ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
	                    	<i class="fa fa-edit"></i>
	                    </a>
	                    <a href="<?= base_url('absent/delete/'.$a['absent_id']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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