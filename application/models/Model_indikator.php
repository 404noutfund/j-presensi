<?php

class Model_indikator extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->raw_data = FALSE;
    }

    function get ( $id, $get_one = false )
	{
		
		$select_statement = ( $this->raw_data ) ? 'ind_id,bbt_id,ind_nomor,ind_keterangan,ind_nilai,ind_faktor' : 'ind_id,bbt_id,ind_nomor,ind_keterangan,ind_nilai,ind_faktor';
		$this->db->select( $select_statement );
		$this->db->from('indikator');
		

		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( 'ind_id', $id );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'ind_id' => $row['ind_id'],
	'bbt_id' => $row['bbt_id'],
	'ind_nomor' => $row['ind_nomor'],
	'ind_keterangan' => $row['ind_keterangan'],
	'ind_nilai' => $row['ind_nilai'],
	'ind_faktor' => $row['ind_faktor'],
 );
		}
		else
		{
			return array();
		}
	}



	function insert ( $data )
	{
		$this->db->insert( 'indikator', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'ind_id', $id );
		$this->db->update( 'indikator', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'ind_id', $id );
		}
		else
		{
			$this->db->where( 'ind_id', $id );
		}
		$this->db->delete( 'indikator' );
		
	}



	function lister ( $page = FALSE )
	{
		
		$this->db->start_cache();
		$this->db->select( 'ind_id,bbt_id,ind_nomor,ind_keterangan,ind_nilai,ind_faktor');
		$this->db->from( 'indikator' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'ind_id' => $row['ind_id'],
	'bbt_id' => $row['bbt_id'],
	'ind_nomor' => $row['ind_nomor'],
	'ind_keterangan' => $row['ind_keterangan'],
	'ind_nilai' => $row['ind_nilai'],
	'ind_faktor' => $row['ind_faktor'],
 );
		}
		$this->db->flush_cache();
		return $temp_result;
	}
}