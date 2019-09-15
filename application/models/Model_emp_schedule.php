<?php

class Model_emp_schedule extends CI_Model {

    function __construct(){
		parent::__construct();
	}

	function lister ($id, $sub_unitk, $alldata = false)
	{
		
		$this->db->start_cache();
  		$this->db->select('schskpd.*, unitk.keterangan as unit_kerja, sub_unitk.keterangan as sub_unitkerja')
  					->from('schskpd')
  					->join('unitk','schskpd.sch_unitk=unitk.id_unitk','left')
  					->join('sub_unitk','sub_unitk.id_sub_unitk=schskpd.sch_sub_unitk','left');   

        if(!$alldata){
            $this->db->where('sch_unitk', $id);
            $this->db->where('sch_sub_unitk', $sub_unitk);
        }
        $this->db->order_by('sch_idx', 'asc');

		$query = $this->db->get();

        $temp_result = array();

		foreach ( $query->result_array() as $row )
		{
                        $days = explode("|", $row["sch_days"]);
                        for($i=1;$i<8;$i++){
                            $row["sch_days_ch"][$i] = "-";
                        }
                        foreach($days as $d){
                            if(isset($row["sch_days_ch"][$d])){
                                $row["sch_days_ch"][$d] = date("H:i", strtotime($row["sch_checkintime"]))."/".date("H:i", strtotime($row["sch_checkouttime"]));
                            }
                        }
			$temp_result[] = $row;
		}
		$this->db->flush_cache();
		return $temp_result;
	}

	function get ( $id, $get_one = false )
	{
		$this->db->select('schskpd.*, unitk.keterangan as unit_kerja, sub_unitk.keterangan as sub_unitkerja')
				->from('schskpd')
				->join('unitk','schskpd.sch_unitk = unitk.id_unitk','left')
				->join('sub_unitk','sub_unitk.id_sub_unitk = schskpd.sch_sub_unitk','left');

		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( 'sch_idx', $id );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
                        $days = explode("|", $row["sch_days"]);
                        foreach($days as $d){
                            $row["sch_days_".$d] = true;
                        }
			return $row;
		}
		else
		{
			return array();
		}
	}

    function insert ( $data )
    {
        $this->db->insert( 'schskpd', $data );
        return $this->db->insert_id();
    }

    function update ( $id, $data )
	{
		$this->db->where( 'sch_idx', $id );
		$this->db->update( 'schskpd', $data );
	}

	function delete ( $id )
	{
		if( is_array( $id ) )
		{
			$this->db->where_in( 'sch_idx', $id );
		}
		else
		{
			$this->db->where( 'sch_idx', $id );
		}
		$this->db->delete( 'schskpd' );
		
	}

    // function metadata()
    // {
    //     $this->load->library('explain_table');

    //     $metadata = $this->explain_table->parse( 'schskpd' );

    //     foreach( $metadata as $k => $md )
    //     {
    //         if( !empty( $md['enum_values'] ) )
    //         {
    //             $metadata[ $k ]['enum_names'] = array_map( 'lang', $md['enum_values'] );
    //         }
    //     }
    //     return $metadata;
    // }
}