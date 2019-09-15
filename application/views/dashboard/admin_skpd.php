<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
  	<h5 id="judul"><i class="fa fa-table"></i></h5>
	<div class="pull-right" id="btn-panel">
		<a href="<?= base_url('adminmgnt/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
		<a href="<?= base_url('adminmgnt/create'); ?>" class="btn btn-md btn-danger">Tambah Admin</a>
	</div>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th>NIK</th>
                <th>Detail Pegawai</th>
                <th>Admin Level</th>
                <th>Username Admin</th>
                <th>Password</th>
                <th>Manual Absent</th>
                <th width="70" class="text-center">Lihat</th>
              </tr>
          </thead>
          <tbody>
          	<?php foreach ($registrasi_data as $r) { ?>
	              <tr>
	                  <td><?= $r['nip_baru']; ?></td>
	                  <td>
	                  	<b><u><?= $r['nama']; ?></b></u>
	                  	<br/>
	                    <b class="text-sm"><?= $r['jabatan']; ?></b>
	                    <br/>
                        <?= ($r['sub_unit'] == "") ? $r['unit_kerja'] : $r['sub_unit']; ?>
	                  </td>
	                  <td>
                      	<?php
                      		if($r['group_id_auto'] == "2"){
                      			echo "SKPD";
                      		}elseif($r['group_id_auto'] == "2"){
                      			echo "ADMIN KOTA";
                      		}elseif($r['group_id_auto'] == "3"){
                      			echo "PIMPINAN KOTA";
                      		}
                      	?>
	                  </td>
	                  <td><?= $r['login_user']; ?></td>
	                  <td><?= $r['login_password']; ?></td>
	                  <td>
	                  	<?php
                      		if($r['manual_absent'] == "1"){
                      			echo "Di Perbolehkan";
                      		}elseif($r['group_id_auto'] == "0"){
                      			echo "Tidak Boleh";
                      		}
                      	?>
	                  </td>
	                  <td class="text-center">
	                    <a href="<?= base_url('adminmgnt/show/'.$r['nip_baru']); ?>" class="btn btn-sm btn-info" rel="tooltip" title="Lihat">
	                    <i class="fa fa-search"></i></a>
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