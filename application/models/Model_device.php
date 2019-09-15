<?php

class Model_device extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function lister ()
	{
		
		$this->db->start_cache();
		$this->db->select( 'device.*');
		$this->db->from( 'device' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = $row;
		}
		$this->db->flush_cache();
		return $temp_result;
	}

    function get ( $id, $get_one = false )
    {
        
        $select_statement = ( FALSE ) ? '*':'*';
        $this->db->select( $select_statement );
        $this->db->from('device');
        

        // Pick one record
        // Field order sample may be empty because no record is requested, eg. create/GET event
        if( $get_one )
        {
            $this->db->limit(1,0);
        }
        else // Select the desired record
        {
            $this->db->where( 'devid_auto', $id );
        }

        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
    }

    function insert ( $data )
	{
		$this->db->insert( 'device', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'devid_auto', $id );
		$this->db->update( 'device', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'devid_auto', $id );
		}
		else
		{
			$this->db->where( 'devid_auto', $id );
		}
		$this->db->delete( 'device' );
		
	}
}