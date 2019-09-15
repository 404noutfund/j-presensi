<?php

class Model_tunjangan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function lister_2017 ( $id, $idunit, $month, $year, $sch = false, $hrgjabatan = 0 )
	{
                
                $this->load->model( 'model_att_log_2017' );
//                $month = intval($month);
//		$select_statement = "
//                        registrasi.serial,
//                        identitas_pegawai.nama,
//                        identitas_pegawai.gelar_depan,
//                        identitas_pegawai.gelar_belakang,
//                        posisi.kode_unitk,
//                        unitk.keterangan as unit_kerja,
//                        identitas_pegawai.nip_baru,
//                        jabatan_terakhir.eselon,
//                        posisi.keterangan as jabatan,
//                        b.bbt_jabatan,
//                        a.id_golruang as golo,
//                        a.golongan_ruang
//                        FROM
//                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N'
//                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
//                        Left join bobot_jabatan as b on b.id_pegawai = identitas_pegawai.id_pegawai and b.id_posisi = jabatan_terakhir.posisi 
//                        Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
//                        Left Join unitk ON unitk.kode_unitk = posisi.kode_unitk AND unitk.deleted = 'N'
//                        Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
//                        Left Join (
//                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang
//                        Left Join registrasi ON identitas_pegawai.nip_baru = registrasi.nip_baru
//                    "; 

//		$this->db->select( ' * ', false );		
//                $this->db->where("unitk", $id);
                $this->db->where("unitk", $id);
                $this->db->where("sub_unitk", $idunit);
//                $this->db->order_by("eselon","ASC");
//                $this->db->order_by("golongan_ruang","DESC");

		$query = $this->db->get('view_pegawai_opd');
		$temp_result = array();
                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $efektif= 0;
                $weekdays=0;
                for($d=1;$d<=$num;$d++) {
                    $wd = date("w",mktime(0,0,0,$month,$d,$year));
                    if($wd > 0 && $wd < 6) $weekdays++;
                }   
//                $this->db->reset_query();
        //updateORadd 2016-08
					$iQueryHoliday = $this->db->query("	SELECT COUNT(holiday_id)totHoliday FROM holiday_pns 
										WHERE YEAR(holiday_date) = $year AND MONTH(holiday_date) = $month"
									);
					$row = $iQueryHoliday->result();
					if (!empty($row[0]->totHoliday)){
						$iTotHoliday = $row[0]->totHoliday;
						$weekdays = $weekdays - $iTotHoliday;
					}
				//end add				
                $efektif = $weekdays;

		foreach ( $query->result_array() as $row )
		{
                        $dataRow = array();
                        $dataRow = $row;
                        $dataRow['total_presensi'] = 0;
//                        $pswResult = $this->model_att_log_2017->get_sum($row["serial"], $month, $year);
/*                        value=(
 *                              $result_data["avg_tl1"]|floatval + 
 *                              $result_data["avg_tl2"]|floatval + 
 *                              $result_data["avg_tl3"]|floatval + 
 *                              $result_data["avg_tl4"]|floatval + 
 *                              $result_data["avg_psw1"]|floatval + 
 *                              $result_data["avg_psw2"]|floatval + 
 *                              $result_data["avg_psw3"]|floatval + 
 *                              $result_data["avg_psw4"]|floatval + 
 *                              $result_data["avgsakit"]|floatval + 
 *                              $result_data["avgcuti"]|floatval + 
 *                              $result_data["avgijin"]|floatval + 
 *                              $result_data["avgtk"]|floatval + 
 *                              $result_data['avgcutisakit']|floatval)} 
				{if $totalawal > 1200}
					{assign var = "totalprestasi" value= 100 - (1300 - $totalawal)	}
					{assign var="totalgaji" value=(($totalprestasi|floatval / 100) * $honor["bbt_jabatan"]|floatval * $harga_jabatan)}
				{else }
					{assign var = "totalprestasi" value= 0	}
					{assign var="totalgaji" value=( $totalprestasi|floatval * $honor["bbt_jabatan"]|floatval * $harga_jabatan)}
				{/if}
                     var_dump($pswResult); die();
 * 
 */
//                        $pswCount = $pswResult["avg_tl1"] +
//                                    $pswResult["avg_tl2"] +
//                                    $pswResult["avg_tl3"] +
//                                    $pswResult["avg_tl4"] +
//                                    $pswResult["avg_psw1"] +
//                                    $pswResult["avg_psw2"] +
//                                    $pswResult["avg_psw3"] +
//                                    $pswResult["avg_psw4"] + 
//                                    $pswResult["avgsakit"] +
//                                    $pswResult["avgcuti"] +
//                                    $pswResult["avgijin"] +
//                                    $pswResult["avgtk"]+
//                                    $pswResult["avgcutisakit"];
                        
                        $pswCount = $this->get_sum_2017($row["serial"], $month, $year);
                        $dataRow['pswCount'] = $pswCount;
                        $dataRow['total_presensi'] = 100 - (1300 - $pswCount);                            
                        if($pswCount <= 1200){
                            $dataRow['total_presensi'] = 0;                            
                        }
                        $dataRow['bobot_jb'] = $row["bbt_jabatan"];
//                        $row['harga_jb'] = 3700;                        
                        $dataRow['bobot_jb'] = $row["bbt_jabatan"];
                        $dataRow['harga_jb'] = $hrgjabatan;
                        $dataRow['total_tp_pns'] = $row["bbt_jabatan"]*$hrgjabatan;
                        if($dataRow['total_presensi'] == 0){
                            $dataRow['tp_pns'] = 0;
                            $dataRow['pengurangan_tp_pns'] = 0;
                            $dataRow['pph_tp_pns'] = 0;
                        }else{
                            $dataRow['tp_pns'] = round(($dataRow['total_presensi']/100)*$dataRow['total_tp_pns'],2);
                            $dataRow['pengurangan_tp_pns'] = $dataRow['total_tp_pns'] - abs($dataRow['tp_pns']);
                            if ($dataRow['golo']>=13) {
                                    $dataRow['pph_tp_pns'] = round((15/100)*$dataRow['tp_pns'],2);
                            }else if ($dataRow['golo']>=9){
                                   $dataRow['pph_tp_pns'] = round((5/100)*$dataRow['tp_pns'],2);
                            }else {
                                    $dataRow['pph_tp_pns'] = 0;
                            };

                        }                        
                        $dataRow['tp_pns_bersih'] = round($dataRow['tp_pns']-$dataRow['pph_tp_pns']);
                        $temp_result[] = $dataRow;
		}
//		$this->db->flush_cache();
		return $temp_result;
	}

	function get_sum_2017 ( $id, $month=false, $year=false)
	{
                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $dtshift = array();

                $this->db->select('*');
                $this->db->from('registrasi_shift');
                $this->db->where('pin', str_pad( $id, 4, "0", STR_PAD_LEFT ));
                $this->db->order_by('sch_date');
                $this->db->order_by('idrshift');
		$result_shift = $this->db->get();
                foreach($result_shift->result_array() as $shift){
                    $dtshift[$shift["sch_date"]]["is_workdays"] = $shift["is_workdays"];
                    if( $shift["is_workdays"] == "1"){
                        $dtshift[$shift["sch_date"]]["checkintime"] = $shift["sch_date"]." ".$shift["sch_checkintime"];
                        $dtshift[$shift["sch_date"]]["checkouttime"] = $shift["sch_date"]." ".$shift["sch_checkouttime"];
                    }elseif( $shift["is_workdays"] == "0"){
                        $dtshift[$shift["sch_date"]]["checkintime"] = "";
                        $dtshift[$shift["sch_date"]]["checkouttime"] = "";
                    }
                }
                
		$select_statement = '*';
		$this->db->select( $select_statement );
                $this->db->from('view_logatt');
                $this->db->where( 'pin', str_pad( $id, 4, "0", STR_PAD_LEFT ));
                if($month!==false && $year!==false){
                    $this->db->where( 'month(scan_date)', $month );
                    $this->db->where( 'year(scan_date)', $year );
                }
                $this->db->order_by('scan_date');
		$query = $this->db->get();

//                if($month == date('m') && $year == date('Y')){
//                    $num = date('d');
//                }
                $totalHour = 0;
                $totalMinute = 0;
                for($i=0;$i<$num;$i++){
                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');
                    $ret[$logDate]['absent_date']=$logDate;
                    $ret[$logDate]['day']=date('D', strtotime($logDate));
                    $ret[$logDate]['absent_in']['date'] = '';
                    $ret[$logDate]['absent_in']['time'] = '';
                    $ret[$logDate]['absent_in']['mode'] = '1';
                    $ret[$logDate]['absent_out']['date'] = '';
                    $ret[$logDate]['absent_out']['time'] = '';
                    $ret[$logDate]['absent_out']['mode'] = '1';
                    $ret[$logDate]['absent_break_in'] = '-';
                    $ret[$logDate]['absent_break_out'] = '-';
                    $ret[$logDate]['att_remark'] = '-';
                    
                    $ret[$logDate]['checkintime'] = $logDate.' 08:00:00';
                    $ret[$logDate]['checkouttime'] = $logDate.' 16:00:00';
                    if(date('D', strtotime($logDate))=='Fri'){
                        $ret[$logDate]['checkintime'] = $logDate.' 07:30:00';
                        $ret[$logDate]['checkouttime'] = $logDate.' 15:00:00';
                    }
                    if(date('D', strtotime($logDate))=='Sun' || date('D', strtotime($logDate))=='Sat' || $this->isHoliday( $logDate )==1){
                        $ret[$logDate]['checkintime'] = "";
                        $ret[$logDate]['checkouttime'] = "";
                    }
                    
                    // tl1-4 tws
                    $ret[$logDate]['sum_tl1'] = 0;
                    $ret[$logDate]['sum_tl2'] = 0;
                    $ret[$logDate]['sum_tl3'] = 0;
                    $ret[$logDate]['sum_tl4'] = 0;
                    $ret[$logDate]['sum_psw1'] = 0;
                    $ret[$logDate]['sum_psw2'] = 0;
                    $ret[$logDate]['sum_psw3'] = 0;
                    $ret[$logDate]['sum_psw4'] = 0;
                    $ret[$logDate]['minute_in'] = 0;
                    $ret[$logDate]['minute_out'] = 0;

                    $ret[$logDate]['tottl1'] = 0;
                    $ret[$logDate]['tottl2'] = 0;
                    $ret[$logDate]['tottl3'] = 0;
                    $ret[$logDate]['tottl4'] = 0;
                    $ret[$logDate]['totpsw1'] = 0;
                    $ret[$logDate]['totpsw2'] = 0;
                    $ret[$logDate]['totpsw3'] = 0;
                    $ret[$logDate]['totpsw4'] = 0;
                    $ret[$logDate]['absent_total_hour']= 0;
                    $ret[$logDate]['absent_overtime'] = '0';
                    $ret[$logDate]['absent_remark'] = '-';
                    $ret[$logDate]['day_flag'] = '0';
                    if(date('D', strtotime($logDate))=='Sun' || date('D', strtotime($logDate))=='Sat' || $this->isHoliday( $logDate )==1){
                        $ret[$logDate]['absent_remark'] = 'LIBUR';
                        $ret[$logDate]['day_flag'] = '1';
                        $ret[$logDate]['absent_total_hour']='-';
                        $ret[$logDate]['absent_overtime'] = '-';
                        $ret[$logDate]['checkintime'] = "";
                        $ret[$logDate]['checkouttime'] = "";                        
                    }
                    
                    if(array_key_exists($logDate, $dtshift)){
	                    if($dtshift[$logDate]["is_workdays"]=="1"){
	                        $ret[$logDate]['absent_remark'] = '';
	                        $ret[$logDate]['day_flag'] = '0';
	                        $ret[$logDate]['checkintime'] = $dtshift[$logDate]["checkintime"];
	                        $ret[$logDate]['checkouttime'] = $dtshift[$logDate]["checkouttime"];
	                    }elseif($dtshift[$logDate]["is_workdays"]=="0"){
	                        $ret[$logDate]['absent_remark'] = 'LIBUR';
	                        $ret[$logDate]['day_flag'] = '1';
	                        $ret[$logDate]['checkintime'] = "";
	                        $ret[$logDate]['checkouttime'] = "";
	                    }
                    }
                }

        
        $date_group = array();
        $date_scanned_group = array();
        $checkin_group = array();
        $checkout_group = array();
        $rowguid = array();
		foreach ( $query->result_array() as $row )
		{
//                        if(in_array($row["rowguid"], $rowguid))
//                              continue;
                        $rowguid[] = $row["rowguid"];                        
                        $logDate = date("Y-m-d", strtotime($row['scan_date']));
//                        $ret[$logDate]['is_workdays'] = $row['is_workdays'];
//                        if(intval($row['is_workdays']) == 0){
//                            $ret[$logDate]['day_flag'] = 1;
//                            $ret[$logDate]['absent_remark'] = 'LIBUR';
//                        }else{
//                            $ret[$logDate]['day_flag'] = 0;
//                        }
                        
                        $date_scanned_group[] = $logDate;
                        $date_group[$logDate] = "";
                        if((intval($row['io_mode'])==0)){
                            if($ret[$logDate]['absent_in']['date']==""){
                                $ret[$logDate]['absent_in']['date'] = $row['scan_date'];
                                $ret[$logDate]['absent_in']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                $ret[$logDate]['absent_in']['mode'] = $row['verify_mode'];        

                            }else if(strtotime($ret[$logDate]['absent_in']['date']) < strtotime($row['scan_date'])){
//                                $ret[$logDate]['absent_in']['date'] = $row['scan_date']; //UPDATE
                            }
                        }elseif($row['io_mode']==1){
                                $lastDate = date("Y-m-d", strtotime("-1 DAY", strtotime($logDate)));
                                if(date("Y-m-d", strtotime($ret[$lastDate]["checkouttime"])) 
                                        == date("Y-m-d", strtotime($row['scan_date']))){
                                    $ret[$lastDate]['absent_out']['date'] = $row['scan_date'];
                                    $ret[$lastDate]['absent_out']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                    $ret[$lastDate]['absent_out']['mode'] = $row['verify_mode'];
                                    $ret[$lastDate]['out']['att_remark'] = $row['att_remark'];
                                }else{ //UPDATE
                                    $ret[$logDate]['absent_out']['date'] = $row['scan_date'];
                                    $ret[$logDate]['absent_out']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                    $ret[$logDate]['absent_out']['mode'] = $row['verify_mode'];
                                    $ret[$logDate]['out']['att_remark'] = $row['att_remark'];
                                }
//                            
//                            if($ret[$logDate]['absent_out']['date']==""){
//                                $ret[$logDate]['absent_out']['date'] = $row['scan_date'];
//                                $ret[$logDate]['absent_out']['time'] = date('H:i:s',strtotime($row['scan_date']));
//                                    $ret[$logDate]['absent_out']['mode'] = $row['verify_mode'];
//                            }
                        }elseif($row['io_mode']==7){
                            if($row['scan_date'] <=  date('Y-m-d 10:00:00',strtotime($row['scan_date'])) ){
                                $ret[$logDate]['absent_in']['date'] = $row['scan_date'];
                                $ret[$logDate]['absent_in']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                $ret[$logDate]['absent_out']['date'] = '';
                                $ret[$logDate]['absent_out']['time'] = '00:00:00';
                            }else{
                                $ret[$logDate]['absent_out']['date'] = $row['scan_date'];
                                $ret[$logDate]['absent_out']['time'] = date('H:i:s',strtotime($row['scan_date']));
                            }
                        }elseif($row['io_mode']>=10){
//                                $ret[$logDate]['day_flag'] = $row['io_mode'];
                            if ($row['verify_mode'] == 99) {
                                $ret[$logDate]['day_flag'] = $row['io_mode'];
                                $ret[$logDate]['att_remark'] = $row['att_remark'];
                            }

                        }

//                        if($dtshift[$logDate]["is_workdays"]=="0"){
//                            $ret[$logDate]['absent_remark'] = 'LIBUR';
//                            $ret[$logDate]['day_flag'] = '1';
//                            $ret[$logDate]['checkintime'] = "";
//                            $ret[$logDate]['checkouttime'] = "";
//                        }elseif($dtshift[$logDate]["is_workdays"]=="1"){
//                            $ret[$logDate]['absent_remark'] = '';
//                            $ret[$logDate]['day_flag'] = '0';
//                        }else{
//                            if ($row['verify_mode'] == 99) {
//                                $ret[$logDate]['day_flag'] = $row['io_mode'];
//                                $ret[$logDate]['att_remark'] = $row['att_remark'];
//                            }
//                        }
                        
                        

//                        $masuk = strtotime($ret[$logDate]['absent_in']['date']));
//                        $keluar = date('H:i:s', strtotime($ret[$logDate]['absent_out']['date']));

                        // buat parsing data double
                        $intime_diff = 0;
                        $outtime_diff = 0;
                        if (isset($row['sch_checkintime']) && $row['sch_checkintime']!="") 
                        {
                            $ret[$logDate]['checkintime'] = $logDate." ".$row['sch_checkintime'];
                        }
                        $current_intime = date_create($ret[$logDate]['checkintime']);
                        $hin = (int)$current_intime->diff(date_create($ret[$logDate]['absent_in']['date']))->format('%r%h');
                        $min = (int)$current_intime->diff(date_create($ret[$logDate]['absent_in']['date']))->format('%r%i');
                        $sin = (int)$current_intime->diff(date_create($ret[$logDate]['absent_in']['date']))->format('%r%s');                        
                        $intime_diff = ceil(((60 * ((60 * $hin) + $min)) + $sin)/60);
//                              $intime_diff = $min;
//                        }                        
                        if (isset($row['sch_checkouttime']) && $row['sch_checkouttime']!="") 
                        {
                            $ret[$logDate]['checkouttime'] = $logDate." ".$row['sch_checkouttime'];
                        }
                        $a_times = explode(":", $ret[$logDate]['checkintime']);
                        $b_times = explode(":", $ret[$logDate]['checkouttime']);
                        if($a_times[0] > $b_times[0]){
                            $ret[$logDate]['checkouttime'] = date("Y-m-d", strtotime($logDate." +1 day "))." ".$row['sch_checkouttime'];
                        }
                        $current_outtime = date_create($ret[$logDate]['checkouttime']);
                        $hout = (int)$current_outtime->diff(date_create($ret[$logDate]['absent_out']['date']))->format('%r%h');
                        $mout = (int)$current_outtime->diff(date_create($ret[$logDate]['absent_out']['date']))->format('%r%i');                        
                        $sout = (int)$current_outtime->diff(date_create($ret[$logDate]['absent_out']['date']))->format('%r%s');                        
                        $outtime_diff = ceil(((60 * ((60 * $hout) + $mout)) + $sout)/60);
//                          $outtime_diff = abs(ceil((int)$current_outtime->diff(date_create($ret[$logDate]['absent_out']['date']))->format('%r%s')/60));                        
                        
//                        }                        
                            // $this->__debug_log__($checkin_group);
//                        }
                        $ret[$logDate]['minute_in'] = $intime_diff;
                        $ret[$logDate]['minute_out'] = $outtime_diff;
                        if(in_array($row['io_mode'], array("0","1","7","99"))){
                            $ret[$logDate]['sum_tl1'] = ($intime_diff > 0 && $intime_diff <= 30)?1:0;
                            $ret[$logDate]['sum_tl2'] = ($intime_diff > 30 && $intime_diff <= 60)?1:0;
                            $ret[$logDate]['sum_tl3'] = ($intime_diff > 60 && $intime_diff <= 90)?1:0;
                            $ret[$logDate]['sum_tl4'] = ($intime_diff > 90)?1:0;
                            $ret[$logDate]['sum_psw1'] = ($outtime_diff >= -30 && $outtime_diff < 0)?1:0;
                            $ret[$logDate]['sum_psw2'] = ($outtime_diff >= -60 && $outtime_diff < -30)?1:0;
                            $ret[$logDate]['sum_psw3'] = ($outtime_diff >= -90 && $outtime_diff < -60)?1:0;
                            $ret[$logDate]['sum_psw4'] = ($outtime_diff <  -90)?1:0;
//                            $ret[$logDate]['sum_psw1'] = ($outtime_diff >= -30 && $outtime_diff < 0)?1:0;
//                            $ret[$logDate]['sum_psw2'] = ($outtime_diff >= -60 && $outtime_diff <= -30)?1:0;
//                            $ret[$logDate]['sum_psw3'] = ($outtime_diff >= -90 && $outtime_diff <= -60)?1:0;
//                            $ret[$logDate]['sum_psw4'] = ($outtime_diff < -90)?1:0;
                        }
                            // $this->__debug_log__($tl1);
//                            if ($intime_diff >= 120) {
//                                $ret[$logDate]['sum_tl1'] = ($intime_diff >= 120)?1:0;
//                                $ret[$logDate]['sum_tl2'] = ($intime_diff >= 120)?1:0;
//                                $ret[$logDate]['sum_tl3'] = ($intime_diff >= 120)?1:0;
//                                $ret[$logDate]['sum_tl4'] = ($intime_diff >= 120)?1:0;
//                            } else if ($intime_diff >= 90) {
//                                $ret[$logDate]['sum_tl1'] = 0;
//                                $ret[$logDate]['sum_tl2'] = 0;
//                                $ret[$logDate]['sum_tl3'] = 1;
//                                $ret[$logDate]['sum_tl4'] = 0;
//                            } else if ($intime_diff >= 60) {
//                                $ret[$logDate]['sum_tl1'] = 0;
//                                $ret[$logDate]['sum_tl2'] = 1;
//                                $ret[$logDate]['sum_tl3'] = 0;
//                                $ret[$logDate]['sum_tl4'] = 0;
//                            } else if ($intime_diff >= 30) {
//                                $ret[$logDate]['sum_tl1'] = 1;
//                                $ret[$logDate]['sum_tl2'] = 0;
//                                $ret[$logDate]['sum_tl3'] = 0;
//                                $ret[$logDate]['sum_tl4'] = 0;
//                            }else{
//                                $ret[$logDate]['sum_tl1'] = 0;
//                                $ret[$logDate]['sum_tl2'] = 0;
//                                $ret[$logDate]['sum_tl3'] = 0;
//                                $ret[$logDate]['sum_tl4'] = 0;
//                            }

                            // $this->__debug_log__($tl1);
//                            if ($outtime_diff <= -120) {
//                                //$this->__debug_log__([$outtime_diff_hour, $outtime_diff_minute]);
//                                $ret[$logDate]['sum_psw1'] = 0;
//                                $ret[$logDate]['sum_psw2'] = 0;
//                                $ret[$logDate]['sum_psw3'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 1;
//                            } else if ($outtime_diff >= -90) {
//                                $ret[$logDate]['sum_psw1'] = 0;
//                                $ret[$logDate]['sum_psw2'] = 0;
//                                $ret[$logDate]['sum_psw3'] = 1;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                            } else if ($outtime_diff >= -60) {
//                                $ret[$logDate]['sum_psw1'] = 0;
//                                $ret[$logDate]['sum_psw2'] = 1;
//                                $ret[$logDate]['sum_psw3'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                            } else if ($outtime_diff >= -30) {
//                                $ret[$logDate]['sum_psw1'] = 1;
//                                $ret[$logDate]['sum_psw2'] = 0;
//                                $ret[$logDate]['sum_psw3'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                            } else{
//                                $ret[$logDate]['sum_psw1'] = 0;
//                                $ret[$logDate]['sum_psw2'] = 0;
//                                $ret[$logDate]['sum_psw3'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                            }
                    
		}

                $totalHourS = 0;
                $totalMinuteS = 0;
                $totalHadir = 0;
                $totaltelat1 = 0;
                $totaltelat2 = 0;
                $totaltelat3 = 0;
                $totaltelat4 = 0;
                $totalpsw1 = 0;
                $totalpsw2 = 0;
                $totalpsw3 = 0;
                $totalpsw4 = 0;
                
                $absent["ijin"] = array();
                $absent["cuti"] = array();
                $absent["cutisakit"] = array();
                $absent["sakit"] = array();
                $absent["absent"] = array();
                $libur = 0;
                for($i=0;$i<$num;$i++){
                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');       
                    /*$totaltelat1 += $ret[$logDate]['sum_tl1'];
                    $totaltelat2 += $ret[$logDate]['sum_tl2'];
                    $totaltelat3 += $ret[$logDate]['sum_tl3'];
                    $totaltelat4 += $ret[$logDate]['sum_tl4'];
                    $totalpsw1 += $ret[$logDate]['sum_psw1'];
                    $totalpsw2 += $ret[$logDate]['sum_psw2'];
                    $totalpsw3 += $ret[$logDate]['sum_psw3'];
                    $totalpsw4 += $ret[$logDate]['sum_psw4'];
		    */

                    if($ret[$logDate]['absent_out']['date']==''){
                        $datetime1 = false;
                    }else{
                        $datetime1 = date_create($ret[$logDate]['absent_out']['date']);
                    }
                    if($ret[$logDate]['absent_in']['date']==''){
                        $datetime2 = false;
                    }else{
                        $datetime2 = date_create($ret[$logDate]['absent_in']['date']); 
                    }
//                    if(date('D', strtotime($logDate))=='Fri'){
//                        $jamMasukA = $jamMasuk[1];
//                        $jamPulangA = $jamPulang[1];
//                    }else{
//                        $jamMasukA = $jamMasuk[0];
//                        $jamPulangA = $jamPulang[0];
//                    }
                    if(false!==$datetime1 && false!==$datetime2 && $ret[$logDate]['absent_remark'] !== 'LIBUR'){
                        $hour = 0;
                        $minute = 0;
                        $ret[$logDate]['absent_remark'] = 'HADIR';
                        $totalHadir++;
		    }
			// TAMBAHAN HITUNG TK
			else if (false==$datetime1 && false==$datetime2 && $ret[$logDate]['absent_remark'] !== 'LIBUR' && $ret[$logDate]['day_flag'] == '0') {
						$ret[$logDate]['absent_remark'] = 'TK';
			//				if ($ret[$logDate]['absent_remark'] == 'TK'){
								$absent["absent"][] = $logDate;
			//					}
			}
			/*
			// tambahan buat ngecek aja 
			else if($datetime2==false && $datetime1 !== false){
						if($ret[$logDate]['absent_remark'] !== 'LIBUR'){
									$ret[$logDate]['absent_remark'] = 'HADIR';
									$totalHadir++;
									$ret[$logDate]['sum_tl4'] = 1;
								}else{
									$ret[$logDate]['sum_tl4'] = 0;
									$ret[$logDate]['sum_psw4'] = 0;
								}
			} */// sampe sini
			else if(false==$datetime2 && false!==$datetime1){
                        if($ret[$logDate]['absent_remark'] !== 'LIBUR'){
                            $ret[$logDate]['absent_remark'] = 'HADIR';
                            //$ret[$logDate]['absent_remark'] = $intime_diff;
                            $totalHadir++;
                            $ret[$logDate]['sum_tl1'] = 0; //tambahan buat counter yg masuk ke selain TL4
                            $ret[$logDate]['sum_tl2'] = 0; 	//tambahan buat counter yg masuk ke selain TL4
                            $ret[$logDate]['sum_tl3'] = 0; //tambahan buat counter yg masuk ke selain TL4
                            $ret[$logDate]['sum_tl4'] = 1;
                        }else{
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                        }
//			$ret[$logDate]['absent_remark'] = 'HADIR';
//			$totalHadir++;
//			$ret[$logDate]['sum_tl4'] = 1;
		    }else if(false==$datetime1 && false!==$datetime2){
                        if($ret[$logDate]['absent_remark'] !== 'LIBUR'){
                            $ret[$logDate]['absent_remark'] = 'HADIR';
                            $totalHadir++;
                            $ret[$logDate]['sum_psw4'] = 1;
                        }else{
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                        }
		    }else if(false!==$datetime1 && false!==$datetime2 && $ret[$logDate]['absent_remark'] == 'LIBUR'){
//                            $ret[$logDate]['absent_remark'] = 'HADIR';
//                            $totalHadir++;
                            $ret[$logDate]['sum_psw3'] = 0; //tambahan arsyad untuk yg lembur dihari libur
                            $ret[$logDate]['sum_psw4'] = 0;
                    }
                    else 
                    {
                        
                    }
//                    else{
			   /*
                        if($ret[$logDate]['day_flag']=='10'){
                            $ret[$logDate]['absent_remark'] = 'IJIN';
                        }else if($ret[$logDate]['day_flag']=='20'){
                            $ret[$logDate]['absent_remark'] = 'CUTI';
                        }else if($ret[$logDate]['day_flag']=='21'){
                            $ret[$logDate]['absent_remark'] = 'CUTI';
                        }else if($ret[$logDate]['day_flag']=='30'){
                            $ret[$logDate]['absent_remark'] = 'SAKIT';
                        }else if($ret[$logDate]['day_flag']=='40'){
                            $ret[$logDate]['absent_remark'] = 'DINAS LUAR';
                        }else{
                            $ret[$logDate]['absent_remark'] = 'TK ';
                        }
                        */
	
                        //updated April 27, 2016 by Hari Harmaen
                        //requested by Agung T.A. 
			   
                        if($ret[$logDate]['day_flag']=='10'){
                            $ret[$logDate]['absent_remark'] = 'IJIN';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["ijin"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='20'){
                            $ret[$logDate]['absent_remark'] = 'CUTI';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["cuti"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='21'){
                            $ret[$logDate]['absent_remark'] = 'TUGAS BELAJAR';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["tb"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='22'){
                         $ret[$logDate]['absent_remark'] = 'PENDIDIKAN';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["pnd"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='23'){
                            $ret[$logDate]['absent_remark'] = 'DINAS DALAM';	
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["dd"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='24'){
                            $ret[$logDate]['absent_remark'] = 'CUTI SAKIT';	
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["cutisakit"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='30'){
                            $ret[$logDate]['absent_remark'] = 'SAKIT';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["sakit"][] = $logDate;
                        }else if($ret[$logDate]['day_flag']=='40'){
                            $ret[$logDate]['absent_remark'] = 'DINAS LUAR';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["dl"][] = $logDate;
			}else if($ret[$logDate]['day_flag']=='50'){
                            $ret[$logDate]['absent_remark'] = 'DIPEKERJAKAN';
                            $ret[$logDate]['sum_tl4'] = 0;
                            $ret[$logDate]['sum_psw4'] = 0;
                            $absent["cuti"][] = $logDate;
                        }else{
                            if($ret[$logDate]['day_flag'] == '0'){
//                                $ret[$logDate]['absent_remark'] = $ret[$logDate]['day_flag'];
//                                $ret[$logDate]['absent_remark'] = 'TK';
//                                $ret[$logDate]['sum_tl4'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                                $absent["absent"][] = $logDate;
                            }else if($ret[$logDate]['day_flag'] == '1'){
                                $ret[$logDate]['absent_remark'] = 'LIBUR';
//                                $ret[$logDate]['absent_remark'] = 'TK';
//                                $ret[$logDate]['sum_tl4'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                                $absent["absent"][] = $logDate;
                            }else{
//                                $ret[$logDate]['absent_remark'] = $ret[$logDate]['day_flag'];
//                                $ret[$logDate]['absent_remark'] = 'TK';
//                                $ret[$logDate]['sum_tl4'] = 0;
//                                $ret[$logDate]['sum_psw4'] = 0;
//                                $absent["absent"][] = $logDate;
                            }
                        }                      
                        
                        
//                    }
                    
                    if($ret[$logDate]['absent_remark'] == 'LIBUR'){
                        $libur++;
                    }
                    $totaltelat1 += $ret[$logDate]['sum_tl1'];
                    $totaltelat2 += $ret[$logDate]['sum_tl2'];
                    $totaltelat3 += $ret[$logDate]['sum_tl3'];
                    $totaltelat4 += $ret[$logDate]['sum_tl4'];
                    $totalpsw1 += $ret[$logDate]['sum_psw1'];
                    $totalpsw2 += $ret[$logDate]['sum_psw2'];
                    $totalpsw3 += $ret[$logDate]['sum_psw3'];
                    $totalpsw4 += $ret[$logDate]['sum_psw4'];
                }

                $count_active_absent = count($ret);
                $hari_aktif = $count_active_absent - $libur;
                $tk = count($absent["absent"]);
                $dinas_luar = count($absent["absent"]);
                $sakit = count($absent["sakit"]);
                $cuti = count($absent["cuti"]);
                $ijin = count($absent["ijin"]);
                $cutisakit = count($absent["cutisakit"]);                
        
                $bbt_jbt = 0;            

                $result['totalmasuk'] = $hari_aktif;
                $totals = ($totalHourS * 60) + $totalMinuteS;
                $hours = floor($totals / 60);
                $minutes = ($totals % 60);
                $result["data"] = $ret;
                
                $result["avg_tl1"] = 100 - ( 0.5 * $totaltelat1);
                $result["avg_tl2"] = 100 - ( 1 * $totaltelat2);
                $result["avg_tl3"] = 100 - ( 1.25 * $totaltelat3);
                $result["avg_tl4"] = 100 - ( 1.5 * $totaltelat4);

                $result["avg_psw1"] =100 - ( 0.5 * $totalpsw1);
                $result["avg_psw2"] =100 - ( 1 * $totalpsw2);
                $result["avg_psw3"] =100 - ( 1.25 * $totalpsw3);
                $result["avg_psw4"] =100 - ( 1.5 * $totalpsw4);

                $result["bbt_jabatan"] = $bbt_jbt;

                $result["sakit"] = $sakit;
                $result["cuti"] = $cuti;
                $result["ijin"] = $ijin;
                $result["tk"] = $tk;
                $result['cutisakit'] = $cutisakit;

                $result["avgsakit"] = 100 - (4 * $result["sakit"]);
                $result["avgcuti"] = 100 - (4 * $result["cuti"]);
                $result["avgijin"] = 100 - (5 * $result["ijin"]);
                $result["avgtk"] = 100 - (6 * $result["tk"]);
                $result["avgcutisakit"] = 100 - (3 * $result['cutisakit']);

                $result["totalmasuk"] = $hari_aktif;
                $result["tgl_ttd"] = date("d F Y");
                $result["totalprestasi"] = 100 -(1300 -($result["avg_tl1"]+$result["avg_tl2"]+$result["avg_tl3"]+$result["avg_tl4"]+$result["avg_psw1"]+$result["avg_psw2"]+$result["avg_psw3"]+$result["avg_psw4"]+$result["avgsakit"]+$result["avgcutisakit"]+$result["avgcuti"]+$result["avgijin"]+$result["avgtk"])); 
                // $result["totalgaji"] = number_format((($result["totalprestasi"]/100)*$bbt_jbt*2500));



                $result["totalHourS"] = sprintf("%d Jam %d Menit", $hours, $minutes);
                $total = ($totalHour * 60) + $totalMinute;
                $hour = floor($total / 60);
                $minute = ($total % 60);
                $result["totalHour"] = sprintf("%d Jam %d Menit", $hour, $minute);
                //$ret[$logDate]['att_remark'] = $row['att_remark'];
                $total1 = $total - $totals;
                $hour1 = floor($total1 / 60);
                $minute1 = ($total1 % 60);
                $result["totalHourA"] = sprintf("%d Jam %d Menit", $hour1, $minute1);
                $result["totalHadir"] = $totalHadir;
                $result["tottl1"] = $totaltelat1;
                $result["tottl2"] = $totaltelat2;
                $result["tottl3"] = $totaltelat3;
                $result["tottl4"] = $totaltelat4;
                $result["totpsw1"] = $totalpsw1;
                $result["totpsw2"] = $totalpsw2;
                $result["totpsw3"] = $totalpsw3;
                $result["totpsw4"] = $totalpsw4;
                
                $prosent = $result["avg_tl1"] +
                            $result["avg_tl2"] +
                            $result["avg_tl3"] +
                            $result["avg_tl4"] +
                            $result["avg_psw1"] +
                            $result["avg_psw2"] +
                            $result["avg_psw3"] +
                            $result["avg_psw4"] + 
                            $result["avgsakit"] +
                            $result["avgcuti"] +
                            $result["avgijin"] +
                            $result["avgtk"]+
                            $result["avgcutisakit"];
                return $prosent;
	}

	function isHoliday( $date ) {
//                $this->db->reset_query();
		$this->db->select('COUNT(1) AS ono');
		$this->db->where( 'holiday_date', $date );
		$this->db->from('holiday_pns');
		$result = $this->db->get()->result();
		return $result[0]->ono;
	} 
}