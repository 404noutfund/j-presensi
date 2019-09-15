<?php

class Model_adminskpd extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function lister ( $page = FALSE )
	{
		
		$this->db->start_cache();
		$select_statement = "
                        select
                        c.nip_baru,
                        trim(concat(c.gelar_depan, ' ',c.nama, ' ',c.gelar_belakang)) as 'nama',
                        posisi.keterangan AS jabatan,
                        unitk.keterangan AS unit_kerja,
                        sub_unitk.keterangan as sub_unit,
                        eselon.keterangan AS eselon,
                        a.golongan_ruang golongan_ruang,
                        b.group_id_auto,
                        b.login_status,
                        b.manual_absent,
                        concat(left(c.nama,3),right(c.nip_baru,6)) as login_user, concat(right(c.nip_baru,4),right(left(c.nip_baru,6),2)) as login_password
                        from  
                        user_login as b inner join identitas_pegawai as c on b.emp_nik = c.nip_baru 
                        left Join identitas_kepegawaian ON identitas_kepegawaian.id_pegawai =c.id_pegawai and identitas_kepegawaian.status_pegawai = 2
                        left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = c.id_pegawai
                        left Join posisi ON (posisi.id_posisi = jabatan_terakhir.posisi AND posisi.deleted = 'N' )
                        left Join unitk ON (unitk.id_unitk = posisi.unitk AND unitk.deleted = 'N')
                        Left join sub_unitk on sub_unitk.id_sub_unitk = posisi.sub_unitk AND sub_unitk.deleted = 'N'
                        left Join eselon ON eselon.id_eselon = jabatan_terakhir.eselon
                        left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai =c.id_pegawai 
                        left Join (
                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang
                        where group_id_auto in ('1','2','3')
                        order by nama
                ";
		$query = $this->db->query( $select_statement, false );	

		// Get the results
//		$query = $this->db->get();
		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
                        $temp_result[$row['nip_baru']] = $row;
		}
		$this->db->flush_cache();
		return $temp_result;
	}

	function update_password ( $id, $data )
	{
		$this->db->where( 'login_id', $id );
		$this->db->update( 'user_login', $data );
                $select_statement = "update user_login set login_pwd = password(login_pwd2) where login_id='$id'";
		$this->db->query( $select_statement, false );		            
	}

	function update ( $id, $data )
	{
		$this->db->where( 'login_id', $id );
		$this->db->update( 'user_login', $data );
	}

	function get ( $id, $get_one = false )
	{
		
		$select_statement = "
                        c.nip_baru,
                        trim(concat(c.gelar_depan, ' ',c.nama, ' ',c.gelar_belakang)) as 'nama',
                        posisi.keterangan AS jabatan,
                        unitk.keterangan AS unit_kerja,
                        sub_unitk.keterangan as sub_unit,
                        eselon.keterangan AS eselon,
                        a.golongan_ruang golongan_ruang,
                        b.*,
                        concat(left(c.nama,3),right(c.nip_baru,6)) as login_user, 
                        if(login_pwd2 is null,concat(right(c.nip_baru,4),right(left(c.nip_baru,6),2)),login_pwd2) as login_password
                        from  
                        user_login as b inner join identitas_pegawai as c on b.emp_nik = c.nip_baru 
                        left Join identitas_kepegawaian ON identitas_kepegawaian.id_pegawai =c.id_pegawai and identitas_kepegawaian.status_pegawai = 2
                        left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = c.id_pegawai
                        left Join posisi ON (posisi.id_posisi = jabatan_terakhir.posisi AND posisi.deleted = 'N' )
                        left Join unitk ON (unitk.id_unitk = posisi.unitk AND unitk.deleted = 'N')
                        Left join sub_unitk on sub_unitk.id_sub_unitk = posisi.sub_unitk AND sub_unitk.deleted = 'N'
                        left Join eselon ON eselon.id_eselon = jabatan_terakhir.eselon
                        left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai =c.id_pegawai 
                        left Join (
                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang
                    ";
		$this->db->select( $select_statement, false );

		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
		{
			$this->db->limit(1,0);
		}
		else // Select the desired record
		{
			$this->db->where( "nip_baru",$id);
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
}