<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Hak Akses</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('permission/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('permission/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th width="15"><input type="checkbox" name="check_all" id="check_all"></th>
                <th>ID Permission</th>
                <th>Nama Permission</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach($permission_data as $p){ ?>
		            <tr>
		                <td><input type="checkbox" class="checkbox" name="delete_ids[]" value="" /></td>
		                <td><?= $p['per_id']; ?></td>
		                <td><?= $p['per_name']; ?></td>
		                <td>
		                    <a href="<?= base_url('permission/show/'.$p['per_id']) ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
		                    	<i class="fa fa-search"></i>
		                    </a>
		                    <a href="<?= base_url('permission/edit/'.$p['per_id']) ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
		                    	<i class="fa fa-edit"></i>
		                    </a>
		                    <a href="<?= base_url('permission/delete/'); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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