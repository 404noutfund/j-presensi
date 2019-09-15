<?php

class Model_new_att_log_2017 extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_sum ( $id, $month=false, $year=false )
    {
        // Senin-Kamis
        $jamMasuk[0] = "08:00"; 
        $jamPulang[0] = "16:00"; 
            // Jumat
        $jamMasuk[1] = "07:30";
        $jamPulang[1] = "15:00";
        // sabtu minggu
        $jamMasuk[2] = "Libur";
        $jamPulang[2] = "Libur";
        
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

                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $ret = array();
                if($month == date('m') && $year == date('Y')){
                    $num = date('d');
                }
                for($i=0;$i<$num;$i++){
                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');
                    $ret[$logDate]['absent_date']=$logDate;
                    $ret[$logDate]['day']=date('D', strtotime($logDate));
                    $ret[$logDate]['checkintime'] = $logDate.' 08:00:00';
                    $ret[$logDate]['checkouttime'] = $logDate.' 16:00:00';
                    if(date('D', strtotime($logDate))=='Fri'){
                        $ret[$logDate]['checkintime'] = $logDate.' 07:30:00';
                        $ret[$logDate]['checkouttime'] = $logDate.' 15:00:00';
                    }
                    if(date('D', strtotime($logDate))=='Sun' || date('D', strtotime($logDate))=='Sat' || $this->isHoliday( $logDate )==1){
                        $ret[$logDate]['absent_remark'] = 'Hari Libur';
                        $ret[$logDate]['day_flag'] = '1';
                        $ret[$logDate]['checkintime'] = "";
                        $ret[$logDate]['checkouttime'] = "";
                    }                    
                    $ret[$logDate]['absent_in']['date'] = '';
                    $ret[$logDate]['absent_in']['time'] = '';
                    $ret[$logDate]['absent_in']['mode'] = '1';
                    $ret[$logDate]['absent_out']['date'] = '';
                    $ret[$logDate]['absent_out']['time'] = '';
                    $ret[$logDate]['absent_out']['mode'] = '1';
                    $ret[$logDate]['absent_break_in'] = '-';
                    $ret[$logDate]['absent_break_out'] = '-';
                    $ret[$logDate]['absent_total_hour'] = '-';
                    $ret[$logDate]['absent_overtime'] = '-';
                    $ret[$logDate]['absent_remark'] = '-';
                    $ret[$logDate]['day_flag'] = '0';
                    $ret[$logDate]['in']['att_remark'] = '';
                    $ret[$logDate]['out']['att_remark'] = '';
                    if(array_key_exists($logDate, $dtshift)){
	                    if($dtshift[$logDate]["is_workdays"]=="1"){
	                        $ret[$logDate]['absent_remark'] = '';
	                        $ret[$logDate]['day_flag'] = '0';
	                        $ret[$logDate]['checkintime'] = $dtshift[$logDate]["checkintime"];
	                        $ret[$logDate]['checkouttime'] = $dtshift[$logDate]["checkouttime"];
	                    }elseif($dtshift[$logDate]["is_workdays"]=="0"){
	                        $ret[$logDate]['absent_remark'] = 'Libur Shift';
	                        $ret[$logDate]['day_flag'] = '1';
	                        $ret[$logDate]['checkintime'] = "";
	                        $ret[$logDate]['checkouttime'] = "";
	                    }else{
	                        if ($row['verify_mode'] == 99) {
	                            $ret[$logDate]['day_flag'] = $row['io_mode'];
	                            $ret[$logDate]['att_remark'] = $row['att_remark'];
	                        }
	                    }
                    }
                }
        foreach ( $query->result_array() as $row )
        {
                        $logDate = date("Y-m-d", strtotime($row['scan_date']));
                        $ret[$logDate]['is_workdays'] = $row['is_workdays'];
                        if(intval($row['is_workdays']) == 0){
                            $ret[$logDate]['day_flag'] = 1;
                            $ret[$logDate]['absent_remark'] = 'LIBUR';
                        }
                        if (isset($row['sch_checkintime'])) 
                        {
                            $ret[$logDate]['checkintime'] = $logDate." ".$row['sch_checkintime'];
                        }                        
                        if (isset($row['sch_checkouttime'])) 
                        {
                            $ret[$logDate]['checkouttime'] = $logDate." ".$row['sch_checkouttime'];
                        }           
                        
                        $a_times = explode(":", $ret[$logDate]['checkintime']);
                        $b_times = explode(":", $ret[$logDate]['checkouttime']);
                        if($a_times[0] > $b_times[0]){
                            $ret[$logDate]['checkouttime'] = date("Y-m-d", strtotime($logDate." +1 day "))." ".$row['sch_checkouttime'];
                        }
                        
                        if(intval($row['io_mode'])==0){
                            if($ret[$logDate]['absent_in']['date']==""){
                                $ret[$logDate]['absent_in']['date'] = $row['scan_date'];
                                $ret[$logDate]['absent_in']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                $ret[$logDate]['absent_in']['mode'] = $row['verify_mode'];
                                $ret[$logDate]['in']['att_remark'] = $row['att_remark'];
                            }else if(strtotime($ret[$logDate]['absent_in']['date']) < strtotime($row['scan_date'])){
                                $ret[$logDate]['absent_in']['date'] = $row['scan_date'];
                            }
                        }elseif($row['io_mode']==1){
                            if($ret[$logDate]['absent_out']['date']==""){
                                $lastDate = date("Y-m-d", strtotime("-1 DAY", strtotime($logDate)));
                                if(date("Y-m-d", strtotime($ret[$lastDate]["checkouttime"])) 
                                        == date("Y-m-d", strtotime($row['scan_date']))){
                                    $ret[$lastDate]['absent_out']['date'] = $row['scan_date'];
                                    $ret[$lastDate]['absent_out']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                    $ret[$lastDate]['absent_out']['mode'] = $row['verify_mode'];
                                    $ret[$lastDate]['out']['att_remark'] = $row['att_remark'];
                                }else{
                                    $ret[$logDate]['absent_out']['date'] = $row['scan_date'];
                                    $ret[$logDate]['absent_out']['time'] = date('H:i:s',strtotime($row['scan_date']));
                                    $ret[$logDate]['absent_out']['mode'] = $row['verify_mode'];
                                    $ret[$logDate]['out']['att_remark'] = $row['att_remark'];
                                }
                            }
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
                                $ret[$logDate]['io_mode'] = $row['io_mode'];
                                $ret[$logDate]['in']['att_remark'] = $row['att_remark'];
                        }
                        $ret[$logDate]['day_flag'] = $ret[$logDate]['io_mode'];
//                        if($dtshift[$logDate]["is_workdays"]=="0"){
//                            $ret[$logDate]['absent_remark'] = 'LIBUR';
//                            $ret[$logDate]['day_flag'] = '1';
//                            $ret[$logDate]['checkintime'] = "";
//                            $ret[$logDate]['checkouttime'] = "";
//                        }elseif($dtshift[$logDate]["is_workdays"]=="1"){
//                            $ret[$logDate]['day_flag'] = '0';
//                        }
        }
                $totalHour = 0;
                $totalMinute = 0;
                $totalHadir = 0;
               
                for($i=0;$i<$num;$i++){
                    $logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');       
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
                    if(false!==$datetime1 && false!==$datetime2){
                        $ret[$logDate]['absent_total_hour']=date_diff($datetime1, $datetime2)->format("%h:%i");
                        $hour = 0;
                        $minute = 0;
                        list($hour, $minute) = explode(":", $ret[$logDate]['absent_total_hour']);
                        $totalHour += $hour;
                        $totalMinute += $minute;
                        if(strtotime($ret[$logDate]['absent_out']['date']) > strtotime($logDate." 16:00:00")){
                            $ret[$logDate]['absent_overtime']=date_diff(new DateTime($ret[$logDate]['absent_out']['date']), new DateTime($logDate." 16:00:00"))->format("%h : %i");
                        }
                        $ret[$logDate]['absent_remark'] = 'HADIR';
                        $totalHadir++;
                    }else{
                    	if(array_key_exists($logDate, $dtshift)){
	                        if($ret[$logDate]['io_mode']=='10'){
	                            $ret[$logDate]['absent_remark'] = 'IJIN';
	                        }else if($ret[$logDate]['io_mode']=='20'){
	                            $ret[$logDate]['absent_remark'] = 'CUTI';
	                        }else if($ret[$logDate]['io_mode']=='21'){
	                            $ret[$logDate]['absent_remark'] = 'TUGAS BELAJAR';
	                        }else if($ret[$logDate]['io_mode']=='22'){
	                                     $ret[$logDate]['absent_remark'] = 'PENDIDIKAN';
	                        }else if($ret[$logDate]['io_mode']=='23'){
	                            $ret[$logDate]['absent_remark'] = 'DINAS DALAM';    
	                        }else if($ret[$logDate]['io_mode']=='24'){
	                            $ret[$logDate]['absent_remark'] = 'CUTI SAKIT';
	                        }else if($ret[$logDate]['io_mode']=='30'){
	                            $ret[$logDate]['absent_remark'] = 'SAKIT';
	                        }else if($ret[$logDate]['io_mode']=='40'){
	                            $ret[$logDate]['absent_remark'] = 'DINAS LUAR';
	                        }else if($ret[$logDate]['io_mode']=='50'){
	                            $ret[$logDate]['absent_remark'] = 'DIPEKERJAKAN';
	                        }else{
	                            if($ret[$logDate]['day_flag'] == '0'){
	                                $ret[$logDate]['absent_remark'] = $ret[$logDate]['day_flag'];
	                                $ret[$logDate]['absent_remark'] = 'TK';
	                                $ret[$logDate]['sum_tl4'] = 0;
	                                $ret[$logDate]['sum_psw4'] = 0;
	                                $absent["absent"][] = $logDate;
	                            }else if($ret[$logDate]['day_flag'] == '1'){
	                                $ret[$logDate]['absent_remark'] = 'LIBUR';
	//                                $ret[$logDate]['absent_remark'] = 'TK';
	//                                $ret[$logDate]['sum_tl4'] = 0;
	//                                $ret[$logDate]['sum_psw4'] = 0;
	//                                $absent["absent"][] = $logDate;
	                            }else{
	                                $ret[$logDate]['absent_remark'] = $ret[$logDate]['day_flag'];
	                                $ret[$logDate]['absent_remark'] = 'TK';
	                                $ret[$logDate]['sum_tl4'] = 0;
	                                $ret[$logDate]['sum_psw4'] = 0;
	                                $absent["absent"][] = $logDate;
	                            }
	//                            if($ret[$logDate]['day_flag'] == '1'){
	//                                $ret[$logDate]['absent_remark'] = 'TK';
	//                            }
	                        }   
                        }
                    }
                }
                $total = ($totalHour * 60) + $totalMinute;
                $hours = floor($total / 60);
                $minutes = ($total % 60);
                $result["data"] = $ret;
                $result["totalHour"] = sprintf("%d Jam %d Menit", $hours, $minutes);
                $result["totalHadir"] = $totalHadir;
                return $result;
    }

    function isHoliday( $date ) {
        $this->db->select('COUNT(1) AS ono');
        $this->db->where( 'holiday_date', $date );
        $this->db->from('holiday_pns');
        $result = $this->db->get()->result();
        return $result[0]->ono;
    }
}