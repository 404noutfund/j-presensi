<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Master Harga Jabatan</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('harga_jabatan/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('harga_jabatan/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th width="15"><input type="checkbox" name="check_all" id="check_all"></th>
                <th>ID</th>
                <th>Aktif Periode</th>
                <th>Harga Bobot Jabatan</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach($bobot_jabatan_data as $b){ ?>
		              <tr>
		                  <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="<?= $b['id']; ?>" /></td>
		                  <td><?= $b['id']; ?></td>
		                  <td><?= $b['aktif_date']; ?></td>
		                  <td><?= $b['harga_jb']; ?></td>
		                  <td>
		                    <a href="<?= base_url('harga_jabatan/show/'.$b['id']) ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
		                    	<i class="fa fa-search"></i>
		                    </a>
		                    <a href="<?= base_url('harga_jabatan/edit/'.$b['id']) ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
		                    	<i class="fa fa-edit"></i>
		                    </a>
		                    <a href="<?= base_url('harga_jabatan/delete/'.$b['id']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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