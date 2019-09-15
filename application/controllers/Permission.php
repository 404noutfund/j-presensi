<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

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
        $this->load->model('Model_permission', 'permission');

        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'judul'         => "Data Hak Akses",
            'active_link'   => 'permission'
        );
        $data['permission_data'] = $this->permission->lister();
        $data['permission_fields'] = $this->permission->fields(TRUE);

        $this->template->admin('dashboard/hak_akses', $data);
    }

    public function create(){
        $data = array(
            'judul'         => "Data Jabatan",
            'active_link'   => 'create_hak_akses'
        );

        $this->template->admin('dashboard/create_hak_akses', $data);
    }

    public function show($id){
        $data = array(
            'judul'         => "Detail Hak Akses",
            'active_link'   => 'detail_hak_akses'
        );

        $this->template->admin('dashboard/detail_hak_akses', $data);
    }

    public function edit($id){
        $data = array(
            'judul'         => "Data Jabatan",
            'active_link'   => 'edit_hak_akses'
        );

        $this->template->admin('dashboard/edit_hak_akses', $data);
    }
}