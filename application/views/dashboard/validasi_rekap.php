<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="plugins/datatables/scroller.dataTables.min.css"/>
<div class="row bb-2">
    <div class="col-lg-12">
        <div class="pull-left">
            <h3><i class="fa fa-list-alt"></i> Laporan</h3>
        </div>
        <div class="pull-right">
            <a href="" class="btn btn-primary">Cetak</a>
        </div>
    </div>
</div>
<div class="row p-20">
    <div class="col-lg-8">
        <form method='post' action="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="row mr-0">
                            <select name="iMonth" class="form-control">
                                <?php for ($i=1;$i<=12;$i++){ ?>
									<option value='<?= $i; ?>' <?php echo ($i == $absen_info['month']) ? ("selected") : (""); ?>/><?= $monthName[$i]; ?></option>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <select name="iYear" class="form-control">
                            <?php for ($y=$absen_info['start_year'];$y<=date('Y');$y++){ ?>
								<option value='<?= $y; ?>' <?php echo ($y == $absen_info['year']) ? ("selected") : (""); ?>/><?= $y; ?></option>
							<?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <input type='button' class="btn btn-primary" id="btn-search" title="Cetak" onclick="submit();" value='submit'>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12 text-center mb-35">
        <h3>VALIDASI REKAPITULASI ABSENSI PEGAWAI</h3>
        <h3>Unit Kerja : Badan Kepegawaian Daerah</h3>
        <h3><?= $monthName[(int) $absen_info['month']].' '.$absen_info['year']; ?></h3>
    </div>
    <div class="col-lg-12 mb-35">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA/NIP</th>
                <th rowspan="2">Jabatan dan Perangkat</th>
                <th rowspan="2">Jumlah Kehadiran</th>
                <th colspan="4">Keterangan Ketidak Hadiran</th>
                <th rowspan="2">Jumlah Akumulasi Ketidak hadiran dalam 1 Bulan</th>
                <th rowspan="2">Jam Datang</th>
                <th rowspan="2">Jam Pulang</th>
                <th rowspan="2">Prosentase Kehadiran %</th>
                <th rowspan="2">Lembur</th>
                <th colspan="2">Sistem Shift</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th>I</th>
                <th>C</th>
                <th>S</th>
                <th>DL</th>
                <th>Datang</th>
                <th>Pulang</th>
            </tr>
        </table>
    </div>
    <div class="col-lg-12 mb-35">
        <table class="table table-bordered">
            <tr>
                <th colspan="30">TANGGAL</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>18</th>
                <th>19</th>
                <th>20</th>
                <th>21</th>
                <th>22</th>
                <th>23</th>
                <th>24</th>
                <th>25</th>
                <th>26</th>
                <th>27</th>
                <th>28</th>
                <th>29</th>
                <th>30</th>
            </tr>
        </table>
    </div>
    <div class="col-lg-3">
        <table class="table table-bordered" style="margin-bottom: 0">
            <tr>
                <th>Hadir</th>
                <th>Ijin</th>
                <th>Cuti</th>
                <th>Sakit</th>
                <th>DL</th>
                <th>TK</th>
                <th>Libur</th>
            </tr>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
        </table>
    </div>
    <div class="col-lg-12 mb-35">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">Hari</th>
                <th rowspan="2">Tanggal</th>
                <th colspan="4">Data Finger Print</th>
                <th rowspan="2">Jam Kerja Normal</th>
                <th rowspan="2">Jam Kerja Real</th>
                <th rowspan="2">Jam Pulang</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th>Datang</th>
                <th>Istirahat</th>
                <th>Kembali</th>
                <th>Pulang</th>
            </tr>
        </table>
    </div>
    <div class="col-lg-3">
        <table class="table table-bordered">
            <tr>
                <th>Hadir</th>
                <th>Ijin</th>
                <th>Cuti</th>
                <th>Sakit</th>
                <th>DL</th>
                <th>TK</th>
                <th>Libur</th>
            </tr>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
        </table>
    </div>
</div>

<script src="plugins/datatables/datatables.min.js"></script>
<script src="plugins/datatables/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $("#datatable").DataTable();
</script>