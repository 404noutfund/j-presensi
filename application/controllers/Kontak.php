<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . 'vendor\chriskacerguis\codeigniter-restserver\application\libraries\REST_Controller.php';
require FCPATH . 'vendor\chriskacerguis\codeigniter-restserver\application\libraries\Format.php';

class Kontak extends REST_Controller
{
	
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	function index_get(){
		$id = $this->get('id');
		if($id == ''){
			$kontak = $this->db->get('telepon')->result();
		}else{
			$this->db->where('id', $id);
			$kontak = $this->db->get('telepon')->result();
		}
		$this->response($kontak, 200);
	}

	function index_post() {
        $data = array(
                    'id'           => 20,
                    'nama'          => 'badrus',
                    'nomor'    => '089653157689');
        $insert = $this->db->insert('telepon', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}