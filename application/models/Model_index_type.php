<?php

class Model_index_type extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->raw_data = FALSE;
    }

    function get ( $id, $get_one = false )
	{
		
		$select_statement = ( $this->raw_data ) ? 'type_ot,type_name' : 'type_ot,type_name';
		$this->db->select( $select_statement );
		$this->db->from('index_type');
		

		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( 'type_ot', $id );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'type_ot' => $row['type_ot'],
	'type_name' => $row['type_name'],
 );
		}
		else
		{
			return array();
		}
	}



	function insert ( $data )
	{
		$this->db->insert( 'index_type', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'type_ot', $id );
		$this->db->update( 'index_type', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'type_ot', $id );
		}
		else
		{
			$this->db->where( 'type_ot', $id );
		}
		$this->db->delete( 'index_type' );
		
	}

    function lister ()
	{
		
		$this->db->start_cache();
		$this->db->select( 'type_ot,type_name');
		$this->db->from( 'index_type' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'type_ot' => $row['type_ot'],
	'type_name' => $row['type_name'],
 );
		}
		$this->db->flush_cache();
		return $temp_result;
	}
}