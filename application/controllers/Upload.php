<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

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
        $this->load->model('Model_device', 'device');

        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'judul'         => "Data Mesin",
            'active_link'   => 'upload'
        );
		$data['device_data'] = $this->device->lister();

        $this->template->admin('dashboard/upload_data_presensi', $data);
    }

    public function show($id){
    	$data = array(
            'judul'         => "Upload Log Mesin Presensi",
            'active_link'   => 'detail_upload_data_presensi'
        );
    	$data['id'] = $id;
		$data['device_data'] = $this->device->get( $id );
		
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'POST':
				$savedir = '/data/raw/'.$id.'/'.date("Y").'/'.date("m").'/'.date("d");	        
		        if(!file_exists($savedir)){
		            mkdir($savedir, 0777, true);
		        }

		        if($this->input->post("submit")){   
		            $file_name = explode(".", $_FILES['userfile']['name']);
		            
		            $config['upload_path'] = $savedir; 
		            $config['allowed_types'] = 'dat';
		            $config['max_size']	= '10000KB';                    
		            $config['file_name'] = $file_name[0]."-$id-".$data['device_data'][0]["sn"]."-".date("YmdHis")."";
		            $this->load->library('upload', $config);

		            if ( ! $this->upload->do_upload())
		            {
		                $data['error'] = array('error' => $this->upload->display_errors());
		            }
		            else
		            {
		                $data = array('upload_data' => $this->upload->data());               
		                $result = $this->deploy_log($id, $data["upload_data"]["full_path"]);
		                
		                //$data["upload_data"]["full_path"];
		                
		                $this->template->assign( 'messages', "FILE LOG PRESENSI PEGAWAI TELAH BERHASIL DI UPLOAD<br/>".$result);
		            }                       
		        }

		        $dh  = opendir($savedir);
		        $files = array();
		        while (false !== ($filename = readdir($dh))) {
		            if($filename!="." && $filename!=".."){
		            $file = explode('-', $filename);
		            $update = explode(".", $file[3]);
		            $arrays = array(
		                "file" => $file[0].".dat",
		                "autoid" => $file[1],
		                "devsn" => $file[2],
		                "datetime" => date("Y-m-d H:i:s", strtotime($update[0])),
		                "filesize" => filesize($savedir."/".$filename)
		            );
		            $files[] = $arrays;
		            }
		        }
		        $data['uploaded_files'] = $files;
		    break;
	        $data['uploaded_files'] = $files;
		}

        $this->template->admin('dashboard/detail_upload_data_presensi', $data);
    }

    public function deploy_log($devid, $filename) {
        return exec("python /var/www/html/bkdmlg/script/plogf.py $devid $filename 2>&1");
    }
}