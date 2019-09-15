<?php

class Model_auth extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_login($user, $pass){
        $select_statement = "emp.*,identitas_pegawai.* from emp left join identitas_pegawai on emp.nik = identitas_pegawai.nip_baru where nik = '$user' and auth_pwd=password('$pass')";
        $this->db->select( $select_statement );
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 )
        {
                $row = $query->row_array();
               $this->save_session( array( 'valid' => 'yes', 'user_id' => $row['nik'], 'user_pin' => $row['pin'],'user_name' => $row['nama'], 'user_group'=> $row['auth_id'], 'gelar_d'=> $row['gelar_depan'], 'gelar_b'=> $row['gelar_belakang'] ) );
        }else{
                $select_statement = "identitas_pegawai.nip_baru, identitas_pegawai.nama, identitas_pegawai.gelar_depan, identitas_pegawai.gelar_belakang, user_login.group_id_auto, user_login.manual_absent, emp.pin from identitas_pegawai right join user_login on identitas_pegawai.nip_baru = user_login.emp_nik left join emp on identitas_pegawai.nip_baru = emp.nik where user_login.login_id = '$user' and user_login.login_pwd=password('$pass') and user_login.login_status='1'";
                $this->db->select( $select_statement, false );
                $query = $this->db->get();
                if ( $query->num_rows() > 0 ){
                    $row = $query->row_array();

                    $this->save_session( array( 'valid' => 'yes', 'user_id' => $row['nip_baru'], 'user_pin' => $row['pin'],'user_name' => $row['nama'], 'user_group'=> $row['group_id_auto'], 'manual_absent'=> $row['manual_absent'], 'gelar_d'=> $row['gelar_depan'], 'gelar_b'=> $row['gelar_belakang'] ) );
                }else{
                    $this->save_session( array('valid' => 'no') );
                }            
        }            
    }

    function save_session( $compData )
	{
		$this->session->set_userdata( 'logged_in', $compData );
	}

	function check( $redirect = TRUE )
	{
		$udata = $this->session->userdata( 'logged_in' );

		if( $udata['valid'] == 'yes' )
		{
			return $udata;
		}
		else
		{
			return FALSE;
		}
	}

	// function logout()
	// {
	// 	$data = array(
	// 				'valid' => 'no',
	// 				'uid'   => FALSE,
	// 				'name'  => '');

	// 	$this->session->set_userdata( 'logged_in', array() );
 //        $this->session->sess_destroy();
	// }
}