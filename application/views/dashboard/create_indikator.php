<div class="panel panel-orange">
    <div class="panel-heading">
        <h5 id="judul"><i class="fa fa-table"></i> Tambah</h5>
        <div class="pull-right" id="btn-panel">
            <a href="<?= base_url('indikator/'); ?>" class="btn btn-md btn-default">Tabel Data</a>
            <a href="<?= base_url('indikator/create'); ?>" class="btn btn-md btn-success">Tambah Data</a>
        </div>
    </div>
    <form class="form " method="post" action="">
        <table class="table" width="100%">
            <tbody>
                <tr class="{cycle values='odd,even'}">
                    <th class="text-middle">ID Bbt <span class="text-danger">*</span></th>
                    <td>
                        <input type="text" name="bbt_id" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" max-length="11" required>
                    </td>
                </tr>
                <tr class="{cycle values='odd,even'}">
                    <th class="text-middle">Nomor Ind</th>
                    <td>
                        <input type="text" name="ind_nomor" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;" maxlength="12">
                    </td>
                </tr>
                <tr class="{cycle values='odd,even'}">
                    <th class="text-middle">Keterangan Ind</th>
                    <td>
                        <input type="text" name="ind_keterangan" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;">
                    </td>
                </tr>
                <tr class="{cycle values='odd,even'}">
                    <th class="text-middle">Nilai Ind</th>
                    <td>
                        <input type="text" name="ind_nilai" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;">
                    </td>
                </tr>
                <tr class="{cycle values='odd,even'}">
                    <th class="text-middle">Faktor Ind</th>
                    <td>
                        <input type="text" name="ind_faktor" id="textfield" placeholder="Masukkan Text" class="input-xlarge text_field form-control" value="" style="margin-top: 13px; width: 250px; margin-left: 7px;">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="javascript:window.history:back;">
                            <button type="button" class="btn btn-danger">Batal</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>