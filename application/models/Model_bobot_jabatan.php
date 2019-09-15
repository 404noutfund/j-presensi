<?php

class Model_bobot_jabatan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get ( $id, $get_one = false )
	{
		
		$select_statement = "
                        registrasi.serial as pin,
                        identitas_pegawai.id_pegawai,
                        trim(concat(identitas_pegawai.nama, '  ', identitas_pegawai.gelar_depan, '  ', identitas_pegawai.gelar_belakang)) as nama,
                        posisi.unitk,
                        posisi.id_posisi,
                        posisi.sub_unitk,
                        sub_unitk.keterangan as sub_unit,
                        unitk.keterangan as unit_kerja,
                        replace(identitas_pegawai.nip_baru,' ','') as nip_baru,
                        posisi.keterangan as jabatan,
                        eselon.keterangan AS eselon,
                        a.golongan_ruang,
                        bobot_jabatan.bbt_jabatan                       
                        FROM
                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
                        Left join bobot_jabatan on bobot_jabatan.id_posisi = jabatan_terakhir.posisi and bobot_jabatan.id_pegawai = identitas_pegawai.id_pegawai                    
                        Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
                        Left Join unitk ON unitk.id_unitk = posisi.unitk
                        Left join sub_unitk on sub_unitk.id_sub_unitk = posisi.sub_unitk AND sub_unitk.deleted = 'N'
                        Left join registrasi ON identitas_pegawai.nip_baru = registrasi.nip_baru
                        Left Join eselon ON eselon.id_eselon = jabatan_terakhir.eselon
                        Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
                        Left Join (
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
			$this->db->where( "identitas_pegawai.nip_baru", $id);
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

	function insert ( $data )
	{
                $select_statement = "
                    insert into bobot_jabatan (id_pegawai, id_posisi, bbt_jabatan)
                    values ('$data[nip_pegawai]', '$data[id_posisi]','$data[bobot_jabatan]')
                    on duplicate key update bbt_jabatan = '$data[bobot_jabatan]'";
		$this->db->query( $select_statement, false );		            
		return $this->db->affected_rows();
	}
}