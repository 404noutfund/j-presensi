<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataabsen extends CI_Controller {

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
        $this->load->model('Model_emp', 'emp');
        $this->load->model('Model_sebaran', 'sebaran');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'judul'         => "Sebaran Absen Pegawai",
            'active_link'   => 'dataabsen'
        );

        $user = $this->session->userdata('logged_in');
        $skpdata = $this->emp->get($user["user_id"], false);
		// $data_info = $this->sebaran->list_device();

        $this->template->admin('dashboard/sebaran_absen_pegawai', $data);
    }
}