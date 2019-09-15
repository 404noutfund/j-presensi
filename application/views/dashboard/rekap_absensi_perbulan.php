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
        <h2>REKAPITULASI ABSENSI PEGAWAI</h2>
        <h2>UNIT KERJA : <?= ($skpdata['sub_unit'] == "") ? ($skpdata['unit_kerja']) : ($skpdata['sub_unit']); ?></h2>
        <h3><?= $monthName[(int) $absen_info['month']].' '.$absen_info['year']; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered align-middle" id="datatable">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2" width="170">NAMA/NIP</th>
                    <th rowspan="2">Jabatan dan Pangkat</th>
                    <th rowspan="2">Jumlah Hari Efektif dalam 1 Bulan</th>
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
            </thead>
            <tbody>
            	<?php 
            	$counter = 1;
            	foreach($result_data as $r){ ?>
	                <tr>
	                    <td><?= $counter; ?></td>
	                    <td>
	                       	<?= $r['gelar_depan'].' '.$r['nama'].' '.$r['gelar_belakang']; ?><br/>
	                    	<?= $r['nip_baru']; ?>
	                    </td>
	                    <td>
	                        <?= $r['jabatan']; ?><br/>
	                        <?= $r['golongan_ruang']; ?>
	                    </td>
	                    <td><?= $r['hari_efektif']; ?></td>
	                    <td><?= $r['total_presensi']; ?></td>
	                    <td><?= $r['total_tki']; ?></td>
	                    <td><?= $r['total_tkc']; ?></td>
	                    <td><?= $r['total_tks']; ?></td>
	                    <td><?= $r['total_dl']; ?></td>
	                    <td><?= $r['total_absen']; ?></td>
	                    <td><?= $r['total_ci']; ?></td>
	                    <td><?= $r['total_co']; ?></td>
	                    <td><?= $r['prosen_presensi']; ?></td>
	                    <td><?= $r['total_lembur']; ?></td>
	                    <td><?= $r['total_cishift']; ?></td>
	                    <td><?= $r['total_coshift']; ?></td>
	                    <td><?= $r['keterangan']; ?></td>
	                </tr>
	            <?php
	            	$counter++;
	            } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="plugins/datatables/datatables.min.js"></script>
<script src="plugins/datatables/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $("#datatable").DataTable({
        "scrollX": true
    });
</script>