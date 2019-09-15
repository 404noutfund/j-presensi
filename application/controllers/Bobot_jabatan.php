<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bobot_jabatan extends CI_Controller {

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
        $this->load->model('model_emp', 'emp');
        $this->load->model('model_sebaran', 'sebaran');
        $this->load->model('model_bobot_jabatan', 'bobot');

        $user = $this->session->userdata('logged_in');
		if(!isset($user)){
			redirect(base_url('login'));
		}
    }

    public function index(){
        $data = array(
            'judul'         => "Pengaturan Bobot Jabatan",
            'active_link'   => 'bobot_jabatan'
        );
        $user = $this->session->userdata('logged_in');
        $data['skpdata'] = $this->emp->get($user["user_id"], false);
        $data['data_info'] = $this->emp->lister($data['skpdata']["unitk"],$data['skpdata']["sub_unitk"]);

        $this->template->admin('dashboard/bobot_jabatan', $data);
    }

    public function show($id){
    	$data = array(
    		'judul'			=> "Pengaturan Bobot Jabatan Pegawai",
    		'active_link'	=> 'detail_bobot_jabatan'
    	);
    	$nip = $this->input->post( 'nip_pegawai', false);
        $id_posisi = $this->input->post( 'id_posisi', false);
        $bobot_jabatan = $this->input->post( 'bobot_jabatan', false);
        $status_update = $this->input->post( 'submit-update', false);
        $update = 0;

        if(false!==$status_update){
            $data_post = array();
            $data_post['nip_pegawai'] = $nip;
            $data_post['id_posisi'] = $id_posisi;
            $data_post['bobot_jabatan'] = $bobot_jabatan;
            $update = $this->bobot->insert( $data_post );
        }

		$data['registrasi_data'] = $this->bobot->get( $id );

    	$this->template->admin('dashboard/detail_bobot_jabatan', $data);
    }
}