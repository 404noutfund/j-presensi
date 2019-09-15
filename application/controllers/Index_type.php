<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_type extends CI_Controller {

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
        $this->load->model('Model_index_type', 'index_type');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
    	$data = array(
    		'judul'			=> 'Data Tipe Lembur',
    		'active_link'	=> 'tipe_lembur'
    	);
		$data['index_type_data'] = $this->index_type->lister();

        $this->template->admin('dashboard/tipe_lembur', $data);
    }

    public function show($id=false){
    	$data = array(
            'judul'         => "Data Detail Tipe Lembur",
            'active_link'   => 'detail_tipe_lembur'
        );
        $data['id'] = $id;
		$data['index_type_data'] = $this->index_type->get( $id );

        $this->template->admin('dashboard/detail_tipe_lembur', $data);
    }

    public function edit($id=false){
    	$data = array(
            'judul'         => "Data Tipe Lembur",
            'active_link'   => 'edit_tipe_lembur'
        );

        $user = $this->session->userdata('logged_in');
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->index_type->raw_data = TRUE;
				$data['index_type_data'] = $this->index_type->get( $id );
			break;

			case 'POST':
				$data['index_type_data'] = $this->index_type->get( $id );
				$this->form_validation->set_rules( 'type_name', 'type_name', 'required');
				
				$data_post['type_name'] = $this->input->post( 'type_name' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->index_type->update( $id, $data_post );

					redirect( 'index_type/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_tipe_lembur', $data);
    }

    public function create(){
    	$data = array(
            'judul'         => "Data Tipe Lembur",
            'active_link'   => 'create_tipe_lembur'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'type_name', 'type_name', 'required|max_length[50]');
				
				$data_post['type_name'] = $this->input->post( 'type_name' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$last_id = $this->db->select_max('type_ot')->get('index_type')->row()->type_ot;
					$data_post['type_ot'] = $last_id + 1;
					$insert_id = $this->index_type->insert( $data_post );
					
					redirect( 'index_type' );
				}
			break;
		}

        $this->template->admin('dashboard/create_tipe_lembur', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->index_type->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->index_type->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}