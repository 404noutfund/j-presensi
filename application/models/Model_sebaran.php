<?php

class Model_sebaran extends CI_Model {

    function __construct() {
        parent::__construct();

	$this->raw_data = FALSE;
    }
    
    function get ($id)
	{
            $select_statement = "
                    d.*";
        
        $this->db->select( $select_statement )
                ->from('sebaran_absen_pegawai s')
                ->join('device d','s.device_sn=d.sn')
                ->where( 's.pin regexp ', $id);
                $query = $this->db->get();
                $return = array();
        
		foreach ( $query->result_array() as $row )
		{
			$return[] = $row;
        }
        return $return;        
    }

    function list_device ( $page = FALSE )
	{
		
		$this->db->start_cache();
		$this->db->select( "device.*, 
                    (select count(sebaran_absen_pegawai.pin) from sebaran_absen_pegawai where sebaran_absen_pegawai.device_sn = device.sn) as total,
                    (select count(sebaran_absen_pegawai.pin) from sebaran_absen_pegawai where sebaran_absen_pegawai.device_sn = device.sn and template='0') as total_verify,
                    (select count(DISTINCT att_log.pin) from att_log where att_log.sn = device.sn) as total_absen");
		$this->db->from( 'device' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
                        $row['sn'] = trim($row['sn']);
			$temp_result[] = $row;
		}
		$this->db->flush_cache();
		return $temp_result;
	}
}