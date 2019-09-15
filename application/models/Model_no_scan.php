<?php

class Model_no_scan extends CI_Model {

    function __construct() {
        parent::__construct();
        
        $this->raw_data = FALSE;
    }

    function lister ()
	{
		
		$this->db->start_cache();
		$this->db->select( 'no_scan_in,no_scan_as,late,early,no_break');
		$this->db->from( 'no_scan' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'no_scan_in' => $row['no_scan_in'],
	'no_scan_as' => $row['no_scan_as'],
	'late' => $row['late'],
	'early' => $row['early'],
	'no_break' => $row['no_break'],
 );
		}
		$this->db->flush_cache();
		return $temp_result;
	}

    function get ( $id, $get_one = false )
    {
        
        $select_statement = ( $this->raw_data ) ? 'no_scan_in,no_scan_as,late,early,no_break' : 'no_scan_in,no_scan_as,late,early,no_break';
        $this->db->select( $select_statement );
        $this->db->from('no_scan');
        

        // Pick one record
        // Field order sample may be empty because no record is requested, eg. create/GET event
        if( $get_one )
        {
            $this->db->limit(1,0);
        }
        else // Select the desired record
        {
            $this->db->where( 'no_scan_in', $id );
        }

        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return array( 
    'no_scan_in' => $row['no_scan_in'],
    'no_scan_as' => $row['no_scan_as'],
    'late' => $row['late'],
    'early' => $row['early'],
    'no_break' => $row['no_break'],
 );
        }
        else
        {
            return array();
        }
    }

    function insert ( $data )
	{
		$this->db->insert( 'no_scan', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'no_scan_in', $id );
		$this->db->update( 'no_scan', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'no_scan_in', $id );
		}
		else
		{
			$this->db->where( 'no_scan_in', $id );
		}
		$this->db->delete( 'no_scan' );
		
	}
}