<?php

class Model_scan_status extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->raw_data = FALSE;
    }

    function lister ( $page = FALSE )
	{
		
		$this->db->start_cache();
		$this->db->select( 'scan_id,scan_name');
		$this->db->from( 'scan_status' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
				'scan_id' => $row['scan_id'],
				'scan_name' => $row['scan_name'],
			 );
		}
		$this->db->flush_cache();
		return $temp_result;
	}

	function insert ( $data )
	{
		$this->db->insert( 'scan_status', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'scan_id', $id );
		$this->db->update( 'scan_status', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'scan_id', $id );
		}
		else
		{
			$this->db->where( 'scan_id', $id );
		}
		$this->db->delete( 'scan_status' );
		
	}

	function get ( $id, $get_one = false )
	{
		
		$select_statement = ( $this->raw_data ) ? 'scan_id,scan_name' : 'scan_id,scan_name';
		$this->db->select( $select_statement );
		$this->db->from('scan_status');
		

		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( 'scan_id', $id );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
				'scan_id' => $row['scan_id'],
				'scan_name' => $row['scan_name'],
			 );
		}
		else
		{
			return array();
		}
	}
}