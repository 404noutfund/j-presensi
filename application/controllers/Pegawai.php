<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

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

        $user = $this->session->userdata('logged_in');
		if(!isset($user)){
			redirect(base_url('login'));
		}
    }

    public function index(){
        $data = array(
            'judul'         => "Data Pegawai",
            'active_link'   => 'pegawai'
        );
        $user = $this->session->userdata('logged_in');
        $data['skpdata'] = $this->emp->get($user["user_id"], false);
        $data['data_info'] = $this->emp->lister($data['skpdata']["unitk"],$data['skpdata']["sub_unitk"]);

        $this->template->admin('dashboard/data_pegawai_opd', $data);
    }

    public function show($id){
        $data = array(
            'judul'         => "Detail Pegawai",
            'active_link'   => 'detail_data_pegawai_opd'
        );
        $data['pegawai'] = $this->emp->get_pegawai_by_id( $id );
        $data['device_data'] = $this->sebaran->get($data['pegawai']->pin);
        
        $this->template->admin('dashboard/detail_data_pegawai_opd', $data);
    }
}