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
        <h3>DAFTAR PERHITUNGAN TAMBAHAN PENGHASILAN PEGAWAI</h3>
    </div>
    <div class="col-lg-12 mb-35">
    	<table width="50%">
    		<tr>
    			<td>SKPD/UNIT KERJA</td>
    			<td>
    				: <?= ($skpdata['sub_unit'] == "") ? $skpdata['unit_kerja'] : $skpdata['sub_unit']; ?>
    			</td>
    		</tr>
    		<tr>
    			<td>BULAN</td>
    			<td>
    				: <?= $monthName[(int) $absen_info['month']].' '.$absen_info['year']; ?>
    			</td>
    		</tr>
    	</table>
        <table class="table table-bordered black-border" data-nosort="0" width="100%">
            <tr>
                <td class="text-center" width="10">NO</td>
                <td class="text-center">NAMA/NIP</td>
                <td class="text-center">GOL</td>
                <td class="text-center">JABATAN</td>
                <td class="text-center">BOBOT JABATAN</td>
                <td class="text-center">HARGA JABATAN</td>
                <td class="text-center">JUMLAH TP PNS</td>
                <td class="text-center">PENGURANGAN TP PNS</td>
                <td class="text-center">JUMLAH KOTOR</td>
                <td class="text-center">Pph Pasal 21</td>
                <td class="text-center">JUMLAH BERSIH</td>
                <td class="text-center">TANDA TANGAN</td>
            </tr>
	    	<?php 
	    		$total_tp = 0;
	    		$total_mintp = 0;
	    		$total_tpkotor = 0;
	    		$total_pph = 0;
	    		$total_tpbersih = 0;
	    		$no = 1;
	    		foreach ($result_data as $r){ ?>
	            <tr>
	                <td><?= $no; ?></td>
	                <td>
	                    <?= $r['gelar_depan'].' '.$r['nama'].' '.$r['gelar_belakang']; ?><br>
	                    NIP: <?= $r['nip_baru']; ?>
	                </td>
	                <td><?= $r['golongan_ruang']; ?></td>
	                <td><?= $r['jabatan']; ?></td>
	                <td><?= $r['bbt_jabatan']; ?></td>
	                <td><?= $r['harga_jb']; ?></td>
	                <td><?= number_format($r['total_tp_pns'],0," ","."); ?></td>
	                <td><?= number_format($r['pengurangan_tp_pns'],0," ","."); ?></td>
	                <td><?= number_format($r['tp_pns'],0," ","."); ?></td>
	                <td><?= number_format($r['pph_tp_pns'],0," ","."); ?></td>
	                <td><?= number_format($r['tp_pns_bersih'],0," ","."); ?></td>
	                <td class="<?php if($no % 2 ==0){echo "text-right";} ?>"><?= $no; ?> .........</td>
	            </tr>
	        <?php
	        	$total_tp += $r['total_tp_pns'];
	        	$total_mintp += $r['pengurangan_tp_pns'];
	        	$total_tpkotor += $r['tp_pns'];
	        	$total_pph += $r['pph_tp_pns'];
	        	$total_tpbersih += $r['tp_pns_bersih'];
	        	$no++;
	        	}
	        ?>
	        <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="center">TOTAL</td>
				<td align="right">-</td>
				<td align="right"><?= number_format($total_tp,0," ","."); ?></td>
				<td align="right"><?= number_format($total_mintp,0," ","."); ?></td>
				<td align="right"><?= number_format($total_tpkotor,0," ","."); ?></td>
				<td align="right"><?= number_format($total_pph,0," ","."); ?></td>
				<td align="right"><?= number_format($total_tpbersih,0," ","."); ?></td>
				<td></td>
			</tr>
        </table>
    </div>
</div>