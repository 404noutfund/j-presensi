<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="panel panel-orange">
  <div class="panel-heading">
    <h5 id="judul"><i class="fa fa-table"></i> Data Tipe Lembur</h5>
    <div class="pull-right" id="btn-panel">
        <a href="<?= base_url('indikator/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
        <a href="<?= base_url('indikator/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
    </div>
  </div>
  <div class="panel-body">
      <table class="table table-bordered" id="datatable">
          <thead>
              <tr>
                <th class='with-checkbox' width="2%;"><input type="checkbox" name="check_all" id="check_all"></th>
                <th>ID Ind</th>
                <th>ID Bbt</th>
                <th>Nomor Ind</th>
                <th>Keterangan Ind</th>
                <th>Nilai Ind</th>
                <th>Faktor Ind</th>
                <th width="130" class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
                <?php foreach ($indikator_data as $i){ ?>
                  <tr>
                      <td class="with-checkbox"><input type="checkbox" class="checkbox" name="delete_ids[]" value="<?= $i['ind_id']; ?>" /></td>
                      <td><?= $i['ind_id']; ?></td>
                      <td><?= $i['bbt_id']; ?></td>
                      <td><?= $i['ind_nomor']; ?></td>
                      <td><?= $i['ind_keterangan']; ?></td>
                      <td><?= $i['ind_nilai']; ?></td>
                      <td><?= $i['ind_faktor']; ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('indikator/show/'.$i['ind_id']); ?>" class="btn btn-info btn-sm" rel="tooltip" title="Lihat">
                            <i class="fa fa-search"></i>
                        </a>
                        <a href="<?= base_url('indikator/edit/'.$i['ind_id']); ?>" class="btn btn-warning btn-sm" rel="tooltip" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?= base_url('indikator/delete/'.$i['ind_id']); ?>" class="btn btn-danger btn-sm" rel="tooltip" title="Hapus">
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