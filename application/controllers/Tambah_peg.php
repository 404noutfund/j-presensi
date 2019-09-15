<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah_peg extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();

        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'judul'         => "Registrasi PIN",
            'active_link'   => 'tambah_peg'
        );

        $this->template->admin('dashboard/registrasi_serial', $data);
    }

    function add()
	{
		$iNip 		= $this->input->POST('nip_pegawai');
		if($iNip==''){
			redirect(base_url('tambah_peg'));
		}
		$iSerial 	= $this->input->POST('serial_pegawai');
		if($iSerial==''){
			redirect(base_url('tambah_peg'));
		}
			$q = $this->db->query("call check_serial($iSerial)");
			$data = $q->result();
			if(!empty($data)){
				redirect(base_url('tambah_peg'));
			}else{
				$q = $this->db->query("call registrasi_serial_pegawai('$iNip','$iSerial')");
				$data = $q->result();
				if(!empty($data)){
					redirect(base_url('tambah_peg/sukses'));
				}else{
					redirect(base_url('tambah_peg/gagal'));
				}
			}
	}

	function cheknip()
	{
		$iNIP 	= $this->input->GET('txtnip');
		if($iNIP==''){
			echo 'Anda Belum Memasukan Data';
		}else{
			if(!is_numeric($iNIP)){
				echo 'Format Data Angka~0';
			}else{
				$q = $this->db->query("call cari_pegawai_nip($iNIP)");
				$data = $q->result();
				if(!empty($data)){
					echo 'NIP Ditemukan~1';
				}else{
					echo 'NIP Tidak Ditemukan~0';
				}
			}
		}
	}
}