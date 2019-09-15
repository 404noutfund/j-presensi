<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absent extends CI_Controller {

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
        $this->load->model('Model_absent', 'absent');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
    	$data = array(
            'judul'         => "Data Status Absen",
            'active_link'   => 'absent'
        );
		$data['absent_data'] = $this->absent->lister();

        $this->template->admin('dashboard/absent', $data);
    }

    public function show($id=false){
    	$data = array(
            'judul'         => "Data Detail Status Absent",
            'active_link'   => 'detail_absent'
        );
        $data['id'] = $id;
		$data['absent_data'] = $this->absent->get( $id );

        $this->template->admin('dashboard/detail_absent', $data);
    }

    public function edit($id=false){
    	$data = array(
            'judul'         => "Data Status Absen",
            'active_link'   => 'edit_absent'
        );

        $user = $this->session->userdata('logged_in');
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->absent->raw_data = TRUE;
				$data['absent_data'] = $this->absent->get( $id );
			break;

			case 'POST':
				$this->form_validation->set_rules( 'absent_name', 'absent_name', 'required' );
				
				$data_post['absent_name'] = $this->input->post( 'absent_name' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->absent->update( $id, $data_post );
					
					redirect( 'absent/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_absent', $data);
    }

    public function create(){
    	$data = array(
            'judul'         => "Data Status Absen",
            'active_link'   => 'create_absent'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'absent_name', 'absent_name', 'required' );
				
				$data_post['absent_id'] = '';
				$data_post['absent_name'] = $this->input->post( 'absent_name' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$insert_id = $this->absent->insert( $data_post );
					
					redirect( 'absent' );
				}
			break;
		}

        $this->template->admin('dashboard/create_absent', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->absent->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->absent->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}