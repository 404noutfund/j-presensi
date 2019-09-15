<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
  	<h5><i class="fa fa-table"></i> Pengaturan Bobot Jabatan</h5>
  </div>
  <div class="panel-body">
      <table class="table table-striped" id="datatable">
          <thead>
              <tr>
                <th>NIK</th>
                <th>Detail Pegawai</th>
                <th>Golongan</th>
                <th>Eselon</th>
                <th>Bobot Jabatan</th>
                <th width="70">Lihat</th>
              </tr>
          </thead>
          <tbody>
          	<?php foreach($data_info as $d) { ?>
              <tr>
                  <td><?= $d->nip_baru; ?></td>
                  <td>
                  	<b><u><?= $d->nama_pegawai; ?></b></u>
                  	<br/>
                    <b style="font-size:smaller"><?= $d->jabatan; ?></b>
                    <br/>
                    <?php if ($d->sub_unit == ""){ ?>
                        <?= $d->unit_kerja; ?>
                    <?php }else{ ?>
                        <?= $d->sub_unit; ?>
                    <?php } ?>
                  </td>
                  <td><?= $d->golongan_ruang; ?></td>
                  <td>III/a</td>
                  <td><?= $d->eselon; ?></td>
                  <td>
                    <a href="<?= base_url('bobot_jabatan/show/'.$d->nip_baru); ?>" class="btn btn-sm btn-info" rel="tooltip" title="Lihat">
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