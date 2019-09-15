<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan_status extends CI_Controller {

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
        $this->load->model('Model_scan_status', 'scan_status');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
    	$data = array(
    		'judul'			=> 'Data Scan Status',
    		'active_link'	=> 'scan_status'
    	);
		$data['scan_status_data'] = $this->scan_status->lister();

        $this->template->admin('dashboard/scan_status', $data);
    }

    public function create(){
    	$data = array(
            'judul'         => "Data Scan Status",
            'active_link'   => 'create_scan_status'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'scan_name', 'scan_name', 'required' );
				
				$data_post['scan_name'] = $this->input->post( 'scan_name' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$insert_id = $this->scan_status->insert( $data_post );
					
					redirect( 'scan_status' );
				}
			break;
		}

        $this->template->admin('dashboard/create_scan_status', $data);
    }

    public function edit($id=false){
    	$data = array(
            'judul'         => "Data Scan Status",
            'active_link'   => 'edit_scan_status'
        );

        $user = $this->session->userdata('logged_in');
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->scan_status->raw_data = TRUE;
				$data['scan_status_data'] = $this->scan_status->get( $id );
			break;

			case 'POST':
				$this->form_validation->set_rules( 'scan_name', 'scan_name', 'required' );
				
				$data_post['scan_name'] = $this->input->post( 'scan_name' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->scan_status->update( $id, $data_post );
					
					redirect( 'scan_status/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_scan_status', $data);
    }

    public function show($id=false){
    	$data = array(
            'judul'         => "Data Detail Scan Status",
            'active_link'   => 'detail_scan_status'
        );
        $data['id'] = $id;
		$data['scan_status_data'] = $this->scan_status->get( $id );

        $this->template->admin('dashboard/detail_scan_status', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->scan_status->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->scan_status->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}