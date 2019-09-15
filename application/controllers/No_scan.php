<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_scan extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_no_scan', 'no_scan');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
    		'judul'			=> 'Data Ketentuan Absensi',
    		'active_link'	=> 'no_scan'
    	);
		$data['no_scan_data'] = $this->no_scan->lister();

        $this->template->admin('dashboard/no_scan', $data);
    }

    public function show($id=false){
    	$data = array(
            'judul'         => "Data Detail Ketentuan Absensi",
            'active_link'   => 'detail_no_scan'
        );
        $data['id'] = $id;
		$data['no_scan_data'] = $this->no_scan->get( $id );

        $this->template->admin('dashboard/detail_no_scan', $data);
    }

    public function edit($id=false){
    	$data = array(
            'judul'         => "Data Ketentuan Absensi",
            'active_link'   => 'edit_no_scan'
        );

        $user = $this->session->userdata('logged_in');
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->no_scan->raw_data = TRUE;
				$data['no_scan_data'] = $this->no_scan->get( $id );
			break;

			case 'POST':
				$this->form_validation->set_rules( 'no_scan_as', 'no_scan_as', 'required' );
				$this->form_validation->set_rules( 'late', 'late', 'required' );
				$this->form_validation->set_rules( 'early', 'early', 'required' );
				$this->form_validation->set_rules( 'no_break', 'no_break', 'required' );
				
				$data_post['no_scan_as'] = $this->input->post( 'no_scan_as' );
				$data_post['late'] = $this->input->post( 'late' );
				$data_post['early'] = $this->input->post( 'early' );
				$data_post['no_break'] = $this->input->post( 'no_break' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
					print_r($data['errors']);
					exit;
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->no_scan->update( $id, $data_post );
					
					redirect( 'no_scan/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_no_scan', $data);
    }

    public function create(){
    	$data = array(
            'judul'         => "Data Ketentuan Absensi",
            'active_link'   => 'create_no_scan'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'no_scan_as', 'no_scan_as', 'required' );
				$this->form_validation->set_rules( 'late', 'late', 'required' );
				$this->form_validation->set_rules( 'early', 'early', 'required' );
				$this->form_validation->set_rules( 'no_break', 'no_break', 'required' );
				
				$data_post['no_scan_as'] = $this->input->post( 'no_scan_as' );
				$data_post['late'] = $this->input->post( 'late' );
				$data_post['early'] = $this->input->post( 'early' );
				$data_post['no_break'] = $this->input->post( 'no_break' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$insert_id = $this->no_scan->insert( $data_post );
					
					redirect( 'no_scan' );
				}
			break;
		}

        $this->template->admin('dashboard/create_no_scan', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->no_scan->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->no_scan->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}