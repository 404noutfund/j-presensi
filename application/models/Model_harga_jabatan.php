<?php

class Model_harga_jabatan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCurrentHJB ($curdate=false)
	{
		
                if($curdate==false){
                    $curdate = date("Y-m-d");
                }
		$this->db->from('hargajb');
                $this->db->limit(1,0);
                $this->db->where( 'aktif_date <= ', $curdate );
                $this->db->order_by('aktif_date', 'DESC');
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
                        return $row['harga_jb'];
		}
		else
		{
			return0;
		}
	}

    function lister ()
    {
        
        $this->db->start_cache();
        $this->db->select( '*');
        $this->db->from( 'hargajb' );
        $this->db->order_by( 'aktif_date', 'DESC' );
        
        // Get the results
        $query = $this->db->get();

        $temp_result = array();

        foreach ( $query->result_array() as $row )
        {
            $temp_result[] = array( 
                            'id' => $row['id'],
                            'aktif_date' => $row['aktif_date'],
                            'perpres' => $row['perpres'],
                            'harga_jb' => $row['harga_jb'],
                        );
        }
        $this->db->flush_cache();
        return $temp_result;
    }

    function get ( $id, $get_one = false )
	{
		
		$this->db->from('hargajb');
		
		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( 'id', $id );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}
		else
		{
			return array();
		}
	}

	function insert ( $data )
	{
		$this->db->insert( 'hargajb', $data );
		return $this->db->insert_id();
	}



	function update ( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( 'hargajb', $data );
	}



	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'id', $id );
		}
		else
		{
			$this->db->where( 'id', $id );
		}
		$this->db->delete( 'hargajb' );
		
	}
}