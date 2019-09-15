<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
	<h5 id="judul"><i class="fa fa-table"></i> Data Mesin</h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('device/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('device/create'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th class='with-checkbox'><input type="checkbox" name="check_all" id="check_all"></th>
                <th>SN</th>
                <th>Nama Device</th>
                <th>Alamat IP</th>
                <th>Firmware</th>
                <th>Download Terakhir</th>
                <th>Status Alat</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
          		<?php foreach($device_data as $d){ ?>
		              <tr>
		                  <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="<?= $d['devid_auto']; ?>" /></td>
		                  <td><?= $d['sn']; ?></td>
		                  <td><?= $d['device_name']; ?></td>
		                  <td><?= $d['ip_address'].':'.$d['ethernet_port']; ?></td>
		                  <td><?= $d['firmware']; ?></td>
		                  <td><?= $d['last_log_download']; ?></td>
		                  <td><?php if($d['last_dev_status']==1){echo "AKTIF";}elseif($d['last_dev_status']==-1){echo "TIDAK AKTIF";} ?></td>
		                  <td>
		                    <a href="<?= base_url('device/show/'.$d['devid_auto']) ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
		                    	<i class="fa fa-search"></i>
		                    </a>
		                    <a href="<?= base_url('device/edit/'.$d['devid_auto']) ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
		                    	<i class="fa fa-edit"></i>
		                    </a>
		                    <a href="<?= base_url('device/delete/'.$d['devid_auto']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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