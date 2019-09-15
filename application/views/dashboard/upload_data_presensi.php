<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
  	<h5><i class="fa fa-table"></i> Upload Data Log Presensi</h5>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th>NO</th>
                <th>SN</th>
                <th>Nama Device</th>
                <th>Alamat IP</th>
                <th width="70">Upload</th>
              </tr>
          </thead>
          <tbody>
          		<?php 
          		$counter = 1;
          		foreach($device_data as $d){ ?>
	              <tr>
	                <td><?= $counter; ?></td>
	                <td><?= $d['sn']; ?></td>
	                <td><?= $d['device_name']; ?></td>
	                <td><?= $d['ip_address']; ?>:<?= $d['ethernet_port']; ?></td>
	                <td>
	                  <a href="<?= base_url('upload/show/'.$d['devid_auto']); ?>" class="btn btn-sm btn-success" style="margin-top: 0;" rel="tooltip" title="Upload">
	                  <i class="fa fa-upload"></i></a>
	                </td>
	             </tr>
	            <?php 
	            	$counter++;
	        		} 
	        	?>
         </tbody>
     </table>
 </div>
</div>

<script src="plugins/datatables/datatables.min.js"></script>
<script src="plugins/datatables/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $("#datatable").DataTable();
</script>