<?php

class Model_registrasi_2017 extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_reg_shif($id, $month= false, $year = false){
    	$this->db->select( '*' );
                $this->db->from('registrasi_shift');
                $this->db->where( 'nik', str_pad( $id, 4, "0", STR_PAD_LEFT ));
                if($month!==false && $year!==false){
                    $this->db->where( 'month(sch_date)', $month );
                    $this->db->where( 'year(sch_date)', $year );
                }
                $this->db->order_by('sch_date');
                $this->db->order_by('idrshift');
		$query = $this->db->get();

        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$ret = array();        

		for($i=0;$i<$num;$i++){
			$logDate = "$year-$month-".str_pad($i+1, 2, STR_PAD_LEFT, '0');
			$ret[$logDate]['tanggal']=$logDate;
			$ret[$logDate]['day']=date('D', strtotime($logDate));
			$ret[$logDate]['is_workdays'] = "1";
			$ret[$logDate]['sch_nameid'] = "REGULER ";
			$ret[$logDate]['sch_checkintime'] = '08:00';
			$ret[$logDate]['sch_checkouttime'] = '16:00';
		}

		foreach ($query->result_array() as $key ) {
			$logDate = date("Y-m-d", strtotime($key['sch_date']));
			$ret[$logDate]['is_workdays'] = $key['is_workdays'];
                        if($key['is_workdays']==1){
                            $ret[$logDate]['sch_nameid'] = $key['sch_nameid'];
                            $ret[$logDate]['sch_checkintime'] = date('H:i:s', strtotime($key['sch_checkintime']));
                            $ret[$logDate]['sch_checkouttime'] = $key['sch_checkouttime'];
                        }else{
                            $ret[$logDate]['sch_nameid'] = "LIBUR";
                            $ret[$logDate]['sch_checkintime'] = "";
                            $ret[$logDate]['sch_checkouttime'] = "";
                        }
		}

		return $ret;
    }

    function get_list_shift($id, $sub, $all)
	{	
		// $sql = "SELECT sch_nameid, sch_idx  FROM schskpd  GROUP BY sch_nameid";
		$this->db->select('sch_nameid, sch_idx, sch_checkintime, sch_checkouttime');
		$this->db->from('schskpd');
		if (!$all) {
			$this->db->where('sch_unitk', $id);
			$this->db->where('sch_sub_unitk', $sub);
		}
		$this->db->order_by('sch_nameid');

		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$temp_result = array();
			foreach ($data->result_array() as $key) {
				$temp_result[] = array(
					'sch_nameid' => $key['sch_nameid'],
					'sch_idx' => $key['sch_idx'],
					'sch_checkintime' => $key['sch_checkintime'],
					'sch_checkouttime' => $key['sch_checkouttime'],
				);
			}
			// $this->db->flush_cache();
			return $temp_result;
			// var_dump($temp_result);
		}else{
			return false;
		}
	}

	function get_all_list_shift(){
		$this->db->select('sch_nameid, sch_idx, sch_checkintime, sch_checkouttime');
		$this->db->from('schskpd');
		
		$data = $this->db->get();

		if ($data->num_rows() > 0) {
			$temp_result = array();
			foreach ($data->result_array() as $key) {
				$temp_result[] = array(
					'sch_nameid' => $key['sch_nameid'],
					'sch_idx' => $key['sch_idx'],
					'sch_checkintime' => $key['sch_checkintime'],
					'sch_checkouttime' => $key['sch_checkouttime'],
				);
			}
			// $this->db->flush_cache();
			return $temp_result;
			// var_dump($temp_result);
		}else{
			return false;
		}
	}
}