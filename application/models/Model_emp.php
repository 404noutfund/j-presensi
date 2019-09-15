<?php

class Model_emp extends CI_Model {

    function __construct()
	{
		parent::__construct();
	}

    function get ( $id, $get_one = false )
	{
		
		$select_statement = "
                        registrasi.serial as pin,
                        trim(concat(identitas_pegawai.nama, '&nbsp;', identitas_pegawai.gelar_depan, '&nbsp;', identitas_pegawai.gelar_belakang)) as nama,
                        posisi.unitk,
                        posisi.id_posisi,
                        posisi.sub_unitk,
                        sub_unitk.keterangan as sub_unit,
                        unitk.keterangan as unit_kerja,
                        replace(identitas_pegawai.nip_baru,' ','') as nip_baru,
                        posisi.keterangan as jabatan,
                        eselon.keterangan AS eselon,
                        a.golongan_ruang
                        FROM
                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
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
			$this->db->where( "replace(identitas_pegawai.nip_baru,' ','')=", str_replace(" ", "", $id));
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

    function get_pegawai_by_id($id){
        $select_statement = "
                        registrasi.serial as pin,
                        trim(concat(identitas_pegawai.nama, '&nbsp;', identitas_pegawai.gelar_depan, '&nbsp;', identitas_pegawai.gelar_belakang)) as nama,
                        posisi.unitk,
                        posisi.id_posisi,
                        posisi.sub_unitk,
                        sub_unitk.keterangan as sub_unit,
                        unitk.keterangan as unit_kerja,
                        replace(identitas_pegawai.nip_baru,' ','') as nip_baru,
                        posisi.keterangan as jabatan,
                        eselon.keterangan AS eselon,
                        a.golongan_ruang
                        FROM
                        identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                        Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
                        Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
                        Left Join unitk ON unitk.id_unitk = posisi.unitk
                        Left join sub_unitk on sub_unitk.id_sub_unitk = posisi.sub_unitk AND sub_unitk.deleted = 'N'
                        Left join registrasi ON identitas_pegawai.nip_baru = registrasi.nip_baru
                        Left Join eselon ON eselon.id_eselon = jabatan_terakhir.eselon
                        Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
                        Left Join (
                        SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang

                    ";
        $this->db->select($select_statement);
		$this->db->where("identitas_pegawai.nip_baru=".$id);
                
        $query = $this->db->get();
		return $query->row();
    }

    function lister ( $id = false, $idunit= false)
	{
		   
		$this->db->start_cache();
		$select_statement = "
                    identitas_pegawai.id_pegawai,
                    trim(concat(identitas_pegawai.gelar_depan,'&nbsp;' ,identitas_pegawai.nama,'&nbsp;' ,identitas_pegawai.gelar_belakang) ) AS nama_pegawai,
                    posisi.unitk,
                    posisi.id_posisi,
                    unitk.keterangan AS unit_kerja,
                    sub_unitk.keterangan as sub_unit,
                    replace(identitas_pegawai.nip_baru,' ','') as nip_baru,
                    trim(posisi.keterangan) AS jabatan,
                    eselon.keterangan AS eselon,
                    a.golongan_ruang
                    FROM
                    identitas_pegawai inner join identitas_kepegawaian on identitas_pegawai.id_pegawai = identitas_kepegawaian.id_pegawai and (identitas_kepegawaian.status_pegawai in (1,2) and identitas_kepegawaian.keadaan_pegawai not in (2,5,7,8,9)) and identitas_pegawai.deleted = 'N' 
                    Left Join jabatan_terakhir ON jabatan_terakhir.id_pegawai = identitas_pegawai.id_pegawai
                    Left Join posisi ON posisi.id_posisi = jabatan_terakhir.posisi
                    Left Join unitk ON unitk.id_unitk = posisi.unitk AND unitk.deleted = 'N'
                    Left join sub_unitk on sub_unitk.id_sub_unitk = posisi.sub_unitk AND sub_unitk.deleted = 'N'
                    Left Join eselon ON eselon.id_eselon = jabatan_terakhir.eselon
                    Left Join pangkat_terakhir ON pangkat_terakhir.id_pegawai = identitas_pegawai.id_pegawai 
                    Left Join (
                    SELECT golruang.id_golruang, concat(golongan.keterangan, '/', ruang.keterangan) as golongan_ruang, golruang.keterangan FROM golruang Inner Join golongan ON golongan.id_golongan = golruang.golongan Inner Join ruang ON ruang.id_ruang = golruang.ruang) as a on pangkat_terakhir.golruang = a.id_golruang
                ";
		$this->db->select( $select_statement, false );	

        if($id!==false){
            $this->db->where("posisi.unitk", $id);
        }
        if($idunit!==false){
            $this->db->where("posisi.sub_unitk", $idunit);
        }
        $this->db->order_by("a.golongan_ruang","DESC");

		// Get the results
		$query = $this->db->get();
		// $temp_result = array();

		// foreach ( $query->result_array() as $row )
		// {
  //           $temp_result[$row['nip_baru']] = $row;
		// }
		$this->db->flush_cache();
		// return $temp_result;
		return $query->result();
	}
    
}