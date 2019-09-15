<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_jabatan extends CI_Controller {

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
        $this->load->model('Model_harga_jabatan', 'harga_jabatan');

        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'judul'         => "Bobot Jabatan",
            'active_link'   => 'harga_jabatan'
        );
        $data['bobot_jabatan_data'] = $this->harga_jabatan->lister();

        $this->template->admin('dashboard/pengaturan_harga_jabatan', $data);
    }

    public function create(){
        $data = array(
            'judul'         => "Create Harga Jabatan",
            'active_link'   => 'create_pengaturan_harga_jabatan'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'aktif_date', 'aktif_date', 'required|date' );
				$this->form_validation->set_rules( 'harga_jb', 'harga_jb', 'required' );
				$this->form_validation->set_rules( 'perpres', 'perpres', 'required' );

				$data_post['aktif_date'] = $this->input->post( 'aktif_date' );
				$data_post['harga_jb'] = $this->input->post( 'harga_jb' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ($this->form_validation->run() == TRUE)
				{
					$insert_id = $this->harga_jabatan->insert( $data_post );
					redirect( 'harga_jabatan' );
				}

			break;
		}

        $this->template->admin('dashboard/create_pengaturan_harga_jabatan', $data);
    }

    public function show($id){
        $data = array(
            'judul'         => "Bobot Jabatan",
            'active_link'   => 'detail_pengaturan_harga_jabatan'
        );
        $data['id'] = $id;
		$data['harga_jabatan_data'] = $this->harga_jabatan->get( $id );

        $this->template->admin('dashboard/detail_pengaturan_harga_jabatan', $data);
    }

    public function edit($id){
        $data = array(
            'judul'         => "Edit Harga Jabatan",
            'active_link'   => 'edit_pengaturan_harga_jabatan'
        );
		$data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$data['bobot_jabatan_data'] = $this->harga_jabatan->get( $id );
			break;

			case 'POST':
				$data['bobot_jabatan_data'] = $this->harga_jabatan->get( $id );
				$this->form_validation->set_rules( 'harga_jb', 'bbt_jab', 'required' );
				$this->form_validation->set_rules( 'aktif_date', 'bbt_jab', 'required' );

                $data_post['aktif_date'] = $this->input->post( 'aktif_date' );
                $data_post['harga_jb'] = $this->input->post( 'harga_jb' );
				$data_post['perpres'] = $this->input->post( 'perpres' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif($this->form_validation->run() == TRUE){
					$this->harga_jabatan->update( $id, $data_post );
					redirect( 'harga_jabatan/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_pengaturan_harga_jabatan', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->harga_jabatan->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->harga_jabatan->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}