<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biometrik_wajah extends CI_Controller {

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
            'judul'         => "Biometrik Wajah",
            'active_link'   => 'biometrik_wajah'
        );
        $modal = 'dashboard/modal_upload';
        $this->template->admin('dashboard/biometrik_wajah', $data, $modal);
    }

    public function uploadImage()
	{
		$id_pegawai = '1';
		$upload_path = './upload/biometrik_wajah/'.$id_pegawai;
		$path_file  = 'upload/biometrik_wajah/'.$id_pegawai.'/';
		$config['file_name'] = $_FILES['fileToUpload']['name'];
		$config['upload_path']          = $upload_path;
	    $config['allowed_types']        = 'jpg|jpeg|png';
	    $config['max_size'] 			= 20000;
		$config['overwrite']			= true;

		if (!is_dir($upload_path)) mkdir($upload_path,0777,true);

	    $this->load->library('upload', $config);
		$this->upload->initialize($config);

	    if ($this->upload->do_upload('fileToUpload')) {
	        $this->upload->data("file_name");
	        $gambar = array(
	        	'id_pegawai' => $id_pegawai,
	        	'file' => $path_file
	        ); 
	        $upload = $this->db->insert('biometrik_pegawai', $gambar);
	    }else{
	    	$error = $this->upload->display_errors();
			echo $error;
	    }
	    
	    return "default.jpg";
	}
}