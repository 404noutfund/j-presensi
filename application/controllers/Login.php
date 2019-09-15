<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	function __construct() {
        parent::__construct();
		$this->load->model('Model_auth', 'auth');
    }

	public function index()
	{
		if ($this->session->has_userdata('logged_in')) redirect('dashboard');
		$data['judul'] = "LOGIN";
		$this->load->view('login/auth', $data);
	}

	public function validation()
	{
		$user = $this->input->post( 'username' );
		$pass = $this->input->post( 'password' );
		
		$this->auth->check_login($user, $pass);                
        $this->logged_in = $this->auth->check( TRUE );

		if( false!==$this->logged_in )
		{
			$response= ['status'=>'success','message'=>""];
		}
		else
		{
			$response= ['status'=>'fail','message'=>"Username / Password Yang Anda Masukkan Salah"];
		}
		echo json_encode($response);
	}	

	function out()
	{
		$this->session->unset_userdata('logged_in');
		$response = ['status'=>"success",'message'=>"Logout Berhasil",'url'=>"login"];
		echo json_encode($response);
	}
}
