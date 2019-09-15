<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmgnt_2016 extends CI_Controller {

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
        $this->load->model('Model_adminskpd', 'adminskpd');
        $this->load->model('Model_emp', 'emp');

        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'judul'         => "Data Admin SKPD",
            'active_link'   => 'adminmgnt_2016'
        );
        $user = $this->session->userdata('logged_in');
        $skpdata = $this->emp->get($user["user_id"], false);
        $data['registrasi_data'] = $this->adminskpd->lister();

        $this->template->admin('dashboard/admin_skpd', $data);
    }

    public function create(){
        $data = array(
            'judul'         => "Registrasi Data Admin",
            'active_link'   => 'create_admin_skpd'
        );

        $this->template->admin('dashboard/create_admin_skpd', $data);
    }

    public function show($id){
        $data = array(
            'judul'         => "Detail Pegawai",
            'active_link'   => 'detail_admin_skpd'
        );

        $nip = $this->input->post( 'nip_pegawai', false);
        $group = $this->input->post( 'group_admin', false);
        $user = $this->input->post( 'login_user', false);
        $status = $this->input->post( 'submit-status', false);
        $status_manual = $this->input->post( 'submit-manual', false);
        $status_password = $this->input->post( 'submit-password', false);
        $new_password = $this->input->post( 'new_password', false);

        if($status_password && $new_password){
            $data_post = array();
            $data_post['login_id'] = $user;
            $data_post['login_pwd2'] = $new_password;
            $this->adminskpd->update_password( $user, $data_post );
        }
        if(false!==$status){
            $data_post = array();
            $data_post['login_id'] = $user;
            $data_post['login_status'] = $status;
            $this->adminskpd->update( $user, $data_post );
        }
        $status_update = $this->input->post( 'submit-update', false);
        if(false!==$status_update){
            $data_post = array();
            $data_post['login_id'] = $user;
            $data_post['group_id_auto'] = $group;
            $this->adminskpd->update( $user, $data_post );
        }
        if(false!==$status_manual){
	        $data_post = array();
	        $data_post['login_id'] = $user;
	        $data_post['manual_absent'] = $status_manual;
	        $this->adminskpd->update( $user, $data_post );
	    }
	    $data['registrasi_data'] = $this->adminskpd->get($id);

        $this->template->admin('dashboard/detail_admin_skpd', $data);
    }
}