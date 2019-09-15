<div class="panel panel-orange">
    <div class="panel-heading">
        <h5 id="judul"><i class="fa fa-table"></i> Data Detail Tipe Lembur, ID <?= $id; ?></h5>
        <div class="pull-right" id="btn-panel">
            <a href="<?= base_url('index_type/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
            <a href="<?= base_url('index_type/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
        </div>
    </div>
    <table class="table" width="100%">
        <thead>
            <th width="25%">Kolom</th>
            <th>Hasil</th>
        </thead>
        <tbody>
            <tr class="{cycle values='odd,even'}">
                <td>ID Scan:</td>
                <td><?= $index_type_data['type_ot']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Nama Scan:</td>
                <td><?= $index_type_data['type_name']; ?></td>
            </tr>
        </tbody>
    </table>
    <a href="<?= base_url().'index_type/edit/'.$id; ?>" class="btn btn-primary">Ubah</a>
</div>