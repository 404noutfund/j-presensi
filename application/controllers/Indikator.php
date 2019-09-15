<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator extends CI_Controller {

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
        $this->load->model('Model_indikator', 'indikator');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
    	$data = array(
    		'judul'			=> 'Data Indikator',
    		'active_link'	=> 'indikator'
    	);
		$data['indikator_data'] = $this->indikator->lister();

        $this->template->admin('dashboard/indikator', $data);
    }

    public function show($id=false){
    	$data = array(
            'judul'         => "Data Detail Indikator",
            'active_link'   => 'detail_indikator'
        );
        $data['id'] = $id;
		$data['indikator_data'] = $this->indikator->get( $id );

        $this->template->admin('dashboard/detail_indikator', $data);
    }

    public function edit($id=false){
    	$data = array(
            'judul'         => "Data Indikator",
            'active_link'   => 'edit_indikator'
        );

        $user = $this->session->userdata('logged_in');
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->indikator->raw_data = TRUE;
				$data['indikator_data'] = $this->indikator->get( $id );
			break;

			case 'POST':
				$data['indikator_data'] = $this->indikator->get( $id );
				$this->form_validation->set_rules( 'bbt_id', 'bbt_id', 'required' );
				
				$data_post['bbt_id'] = $this->input->post( 'bbt_id' );
				$data_post['ind_nomor'] = $this->input->post( 'ind_nomor' );
				$data_post['ind_keterangan'] = $this->input->post( 'ind_keterangan' );
				$data_post['ind_nilai'] = $this->input->post( 'ind_nilai' );
				$data_post['ind_faktor'] = $this->input->post( 'ind_faktor' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->indikator->update( $id, $data_post );

					redirect( 'indikator/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_indikator', $data);
    }

    public function create(){
    	$data = array(
            'judul'         => "Data Indikator",
            'active_link'   => 'create_indikator'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'bbt_id', 'bbt_id', 'required' );
				// $this->form_validation->set_rules( 'ind_nomor', 'ind_nomor', 'required' );
				
				$data_post['bbt_id'] = $this->input->post( 'bbt_id' );
				$data_post['ind_nomor'] = $this->input->post( 'ind_nomor' );
				$data_post['ind_keterangan'] = $this->input->post( 'ind_keterangan' );
				$data_post['ind_nilai'] = $this->input->post( 'ind_nilai' );
				$data_post['ind_faktor'] = $this->input->post( 'ind_faktor' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$insert_id = $this->indikator->insert( $data_post );
					
					redirect( 'indikator' );
				}
			break;
		}

        $this->template->admin('dashboard/create_indikator', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->indikator->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->indikator->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}