<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

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

    public function index()
    {
    }

    public function database(){
        $data = array(
            'judul'         => "Database Backup & Restore",
            'active_link'   => 'backup_database'
        );

        $this->template->admin('dashboard/backup_database', $data);
    }

    public function aplikasi(){
        $data = array(
            'judul'         => "Database Aplikasi",
            'active_link'   => 'backup_aplikasi'
        );

        $this->template->admin('dashboard/backup_aplikasi', $data);
    }

    public function konfigurasi(){
        $data = array(
            'judul'         => "Database Konfigurasi",
            'active_link'   => 'backup_konfigurasi'
        );

        $this->template->admin('dashboard/backup_konfigurasi', $data);
    }
}