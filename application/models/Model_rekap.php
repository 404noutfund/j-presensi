<?php

class Model_rekap extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->raw_data = FALSE;
    }

    function lister ( $id, $idunit, $month, $year)
	{
		
		$this->db->start_cache();
//		$this->db->select( 'no,nama_pegawai,nip_baru,golongan_ruang,jabatan_terakhir,unit_kerja,eselon,upt,serial,deskripsi_unit');
//		$this->db->from( 'registrasi' );
		//$this->db->order_by( '', 'ASC' );
                $month = intval($month);
                
		$select_statement = "
                        identitas_pegawai.nama,
                        identitas_pegawai.gelar_depan,
                        identitas_pegawai.gelar_belakang,
                        posisi.kode_unitk,
                        unitk.keterangan as unit_kerja,
                        identitas_pegawai.nip_baru,
                        posisi.keterangan as jabatan,
                        a.golongan_ruang,
                        (select p_count from presensi where p_status = 'H' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_presensi,
                        (select p_count from presensi where p_status = 'TK' and presensi.pin= registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_absen,
                        (select p_count from presensi where p_status = 'I' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_tki,
                        (select p_count from presensi where p_status = 'TB' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_tktb,
                        (select p_count from presensi where p_status = 'S' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_tks,
                        (select p_count from presensi where p_status = 'C' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_tkc,
                        (select p_count from presensi where p_status = 'DL' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month' limit 0,1) as total_dl
                        FROM
                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
                        Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
                        Left Join unitk ON unitk.id_unitk = posisi.unitk AND unitk.deleted = 'N'
                        Left Join 
                        registrasi
                        ON identitas_pegawai.nip_baru = registrasi.nip_baru
                        Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
                        Left Join (
                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang";
		$this->db->select( $select_statement, false );		
                $this->db->where("posisi.unitk", $id);
                $this->db->where("posisi.sub_unitk", $idunit);
                $this->db->order_by("id_posisi");
//$this->db->where("posisi.kode_unitk", $id);

		$query = $this->db->get();

		$temp_result = array();

                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $efektif= 0;
                $weekdays=0;
                for($d=1;$d<=$num;$d++) {
                    $wd = date("w",mktime(0,0,0,$month,$d,$year));
                    if($wd > 0 && $wd < 6) $weekdays++;
                }     
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
//                for($i=0;$i<$num;$i++){
//                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');
//                    if(date('D', strtotime($logDate))=='Sun' || date('D', strtotime($logDate))=='Sat'){
//                        $efektif -=1;
//                    }else{
//                        $efektif +=1;
//                    }
//                }                
                
		foreach ( $query->result_array() as $row )
		{
                        $row['hari_efektif'] = $efektif;
                        $row['total_presensi'] = isset($row['total_presensi'])?$row['total_presensi']:0;
                        $row['total_tki'] = isset($row['total_tki'])?$row['total_tki']:0;
                        $row['total_tkc'] = isset($row['total_tkc'])?$row['total_tkc']:0;
                        $row['total_tks'] = isset($row['total_tks'])?$row['total_tks']:0;
                        $row['total_dl'] = isset($row['total_dl'])?$row['total_dl']:0;
                        $row['total_absen'] = ($efektif - $row['total_presensi']);                        
                        $row['total_ci'] = '00:00';
                        $row['total_co'] = '00:00';
                        $row['prosen_presensi'] = number_format(($row['total_presensi']/$efektif)*100,2);
                        $row['total_lembur'] = 0;
                        $row['total_cishift'] = 0;
                        $row['total_coshift'] = 0;
                        $row['keterangan'] = '';
                        $temp_result[] = $row;
		}
		$this->db->flush_cache();
		return $temp_result;
	}

    function lister_validate ($nip, $id, $idunit, $month, $year, $page = FALSE )
    {
        
        $this->db->start_cache();
//      $this->db->select( 'no,nama_pegawai,nip_baru,golongan_ruang,jabatan_terakhir,unit_kerja,eselon,upt,serial,deskripsi_unit');
//      $this->db->from( 'registrasi' );
        //$this->db->order_by( '', 'ASC' );
                $month = intval($month);
                
        $select_statement = "
                        identitas_pegawai.nama,
                        identitas_pegawai.gelar_depan,
                        identitas_pegawai.gelar_belakang,
                        posisi.kode_unitk,
                        unitk.keterangan as unit_kerja,
                        identitas_pegawai.nip_baru,
                        posisi.keterangan as jabatan,
                        a.golongan_ruang,
                        (select p_count from presensi where p_status = 'H' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month') as total_presensi,
                        (select p_count from presensi where p_status = 'TK' and presensi.pin= registrasi.serial and r_year = '$year' and r_month = '$month') as total_absen,
                        (select p_count from presensi where p_status = 'I' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month') as total_tki,
                        (select p_count from presensi where p_status = 'TB' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month') as total_tktb,
                        (select p_count from presensi where p_status = 'S' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month') as total_tks,
                        (select p_count from presensi where p_status = 'C' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month') as total_tkc,
                        (select p_count from presensi where p_status = 'DL' and presensi.pin = registrasi.serial and r_year = '$year' and r_month = '$month') as total_dl
                        FROM
                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
                        Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
                        Left Join unitk ON unitk.id_unitk = posisi.unitk AND unitk.deleted = 'N'
                        Left Join 
                        registrasi
                        ON identitas_pegawai.nip_baru = registrasi.nip_baru
                        Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
                        Left Join (
                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang";
        $this->db->select( $select_statement, false );      
                $this->db->where("identitas_pegawai.nip_baru", $nip);
                $this->db->where("posisi.unitk", $id);
                $this->db->where("posisi.sub_unitk", $idunit);
                $this->db->order_by("id_posisi");

        $query = $this->db->get();

        $temp_result = array();

                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $efektif= 0;
                $weekdays=0;
                for($d=1;$d<=$num;$d++) {
                    $wd = date("w",mktime(0,0,0,$month,$d,$year));
                    if($wd > 0 && $wd < 6) $weekdays++;
                }     
                $efektif = $weekdays;
//                for($i=0;$i<$num;$i++){
//                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');
//                    if(date('D', strtotime($logDate))=='Sun' || date('D', strtotime($logDate))=='Sat'){
//                        $efektif -=1;
//                    }else{
//                        $efektif +=1;
//                    }
//                }                
                
        foreach ( $query->result_array() as $row )
        {
                        $row['hari_efektif'] = $efektif;
                        $row['total_presensi'] = isset($row['total_presensi'])?$row['total_presensi']:0;
                        $row['total_tki'] = isset($row['total_tki'])?$row['total_tki']:0;
                        $row['total_tkc'] = isset($row['total_tkc'])?$row['total_tkc']:0;
                        $row['total_tks'] = isset($row['total_tks'])?$row['total_tks']:0;
                        $row['total_dl'] = isset($row['total_dl'])?$row['total_dl']:0;
                        $row['total_absen'] = ($efektif - $row['total_presensi']);                        
                        $row['total_ci'] = '00:00';
                        $row['total_co'] = '00:00';
                        $row['prosen_presensi'] = number_format(($row['total_presensi']/$efektif)*100,2);
                        $row['total_lembur'] = 0;
                        $row['total_cishift'] = 0;
                        $row['total_coshift'] = 0;
                        $row['keterangan'] = '';
                        $temp_result[] = $row;
        }
        $this->db->flush_cache();
        return $temp_result;
    }

    function lister2_validate ($nip, $id, $idunit, $month, $year, $page = FALSE )
    {
        
        $this->db->start_cache();
//      $this->db->select( 'no,nama_pegawai,nip_baru,golongan_ruang,jabatan_terakhir,unit_kerja,eselon,upt,serial,deskripsi_unit');
//      $this->db->from( 'registrasi' );
        //$this->db->order_by( '', 'ASC' );
        $select_statement = "
                        identitas_pegawai.nama,
                        identitas_pegawai.gelar_depan,
                        identitas_pegawai.gelar_belakang,
                        posisi.kode_unitk,
                        unitk.keterangan as unit_kerja,
                        identitas_pegawai.nip_baru,
                        posisi.keterangan as jabatan,
                        a.golongan_ruang,
                        rekap.scan_date,
                        rekap.presensi_status
                        FROM
                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
                        Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
                        Left Join unitk ON unitk.id_unitk = posisi.unitk AND unitk.deleted = 'N'
                        Left Join registrasi ON identitas_pegawai.nip_baru = registrasi.nip_baru
                        left join rekap on rekap.pin = registrasi.serial
                        Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
                        Left Join (
                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang                ";
        $this->db->select( $select_statement, false );      
                $this->db->where("identitas_pegawai.nip_baru", $nip);
                $this->db->where("posisi.unitk", $id);
                $this->db->where("posisi.sub_unitk", $idunit);
                $this->db->where("year(scan_date)", $year);
                $this->db->where("month(scan_date)", $month);
                $this->db->order_by("id_posisi");
//$this->db->where("posisi.kode_unitk", $id);

        $query = $this->db->get();

        $temp_result = array();

                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $efektif= 0;
                $weekdays=0;
                for($d=1;$d<=$num;$d++) {
                    $wd = date("w",mktime(0,0,0,$month,$d,$year));
                    if($wd > 0 && $wd < 6) $weekdays++;
                }     
                $efektif = $weekdays;
//                for($i=0;$i<$num;$i++){
//                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');
//                    if(date('D', strtotime($logDate))=='Sun' || date('D', strtotime($logDate))=='Sat'){
//                        $efektif -=1;
//                    }else{
//                        $efektif +=1;
//                    }
//                }                
                
                $temp = array();
        foreach ( $query->result_array() as $row )
        {
                    if(!isset($temp[$row["nip_baru"]])){
                        $temp[$row["nip_baru"]] = $row;
                        for($i = 1; $i<=$num; $i++){
                            $status = "";
                            if(in_array(date("D",strtotime($year."-".$month."-".$i)), array("Sat","Sun"))){
                                $status = "LIBUR";
                            }
                            $temp[$row["nip_baru"]][intval(date("d",strtotime($year."-".$month."-".$i)))] = $status;
                        }
                    }
                    if(isset($row["presensi_status"])){
//                        if($row["presensi_status"]=="TK"){
//                            $status = "-";
//                        }else{
                            $status = $row["presensi_status"];
//                        }
                    }
                    $temp[$row["nip_baru"]][intval(date("d",strtotime($row["scan_date"])))] = $status;
        }
        $this->db->flush_cache();
        return $temp;
    }
}