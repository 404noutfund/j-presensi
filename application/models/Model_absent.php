<?php

class Model_absent extends CI_Model {

    function __construct() {
        parent::__construct();
        
		$this->raw_data = FALSE;
    }

    function lister ()
	{
		
		$this->db->start_cache();
		$this->db->select( 'absent_id,absent_name');
		$this->db->from( 'absent' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
				'absent_id' => $row['absent_id'],
				'absent_name' => $row['absent_name'],
			 );
		}
		$this->db->flush_cache();
		return $temp_result;
	}

	function get ( $id, $get_one = false )
	{
		
		$select_statement = ( $this->raw_data ) ? 'absent_id,absent_name' : 'absent_id,absent_name';
		$this->db->select( $select_statement );
		$this->db->from('absent');
		

		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( 'absent_id', $id );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
				'absent_id' => $row['absent_id'],
				'absent_name' => $row['absent_name'],
			 );
		}
		else
		{
			return array();
		}
	}

	function insert ( $data )
	{
		$this->db->insert( 'absent', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'absent_id', $id );
		$this->db->update( 'absent', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'absent_id', $id );
		}
		else
		{
			$this->db->where( 'absent_id', $id );
		}
		$this->db->delete( 'absent' );
		
	}
}