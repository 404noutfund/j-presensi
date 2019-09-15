<div class="panel panel-orange">
    <div class="panel-heading">
        <h5 id="judul"><i class="fa fa-table"></i> Data Detail Indikator, ID <?= $id; ?></h5>
        <div class="pull-right" id="btn-panel">
            <a href="<?= base_url('indikator/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
            <a href="<?= base_url('indikator/create'); ?>" class="btn btn-md btn-default">Tambah Data</a>
        </div>
    </div>
    <table class="table" width="100%">
        <thead>
            <th width="25%">Kolom</th>
            <th>Hasil</th>
        </thead>
        <tbody>
            <tr class="{cycle values='odd,even'}">
                <td>ID Ind:</td>
                <td><?= $indikator_data['ind_id']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>ID Bbt:</td>
                <td><?= $indikator_data['bbt_id']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Nomor Ind:</td>
                <td><?= $indikator_data['ind_nomor']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Keterangan Ind:</td>
                <td><?= $indikator_data['ind_keterangan']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Nilai Ind:</td>
                <td><?= $indikator_data['ind_nilai']; ?></td>
            </tr>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Faktor Ind:</td>
                <td><?= $indikator_data['ind_faktor']; ?></td>
            </tr>
        </tbody>
    </table>
</div>