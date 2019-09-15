<?php

class Model_permission extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function lister ()
	{
		
		$this->db->start_cache();
		$this->db->select( 'per_id,per_name');
		$this->db->from( 'permission' );
		//$this->db->order_by( '', 'ASC' );

		// Get the results
		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'per_id' => $row['per_id'],
	'per_name' => $row['per_name'],
 );
		}
		$this->db->flush_cache();
		return $temp_result;
	}

    function fields( $withID = FALSE )
    {
        $fs = array(
    'per_id' => lang('per_id'),
    'per_name' => lang('per_name')
);

        if( $withID == FALSE )
        {
            unset( $fs[0] );
        }
        return $fs;
    }
}