<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Tipe Lembur</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('index_type/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('index_type/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-bordered" id="datatable">
          <thead>
              <tr>
                <th class='with-checkbox' width="2%;"><input type="checkbox" name="check_all" id="check_all"></th>
                <th>Tipe OT</th>
                <th>Nama Tipe</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach ($index_type_data as $i){ ?>
	              <tr>
	                  <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="<?= $i['type_ot']; ?>" /></td>
	                  <td><?= $i['type_ot']; ?></td>
	                  <td><?= $i['type_name']; ?></td>
	                  <td class="text-center">
	                    <a href="<?= base_url('index_type/show/'.$i['type_ot']); ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
	                    	<i class="fa fa-search"></i>
	                    </a>
	                    <a href="<?= base_url('index_type/edit/'.$i['type_ot']); ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
	                    	<i class="fa fa-edit"></i>
	                    </a>
	                    <a href="<?= base_url('index_type/delete/'.$i['type_ot']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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