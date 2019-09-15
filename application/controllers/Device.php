<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {

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
            'active_link'   => 'device'
        );
		$data['device_data'] = $this->device->lister();

        $this->template->admin('dashboard/perangkat_absensi', $data);
    }

    public function create(){
        $data = array(
            'judul'         => "Data Mesin",
            'active_link'   => 'create_perangkat_absensi'
        );

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
			break;

			case 'POST':
				$this->form_validation->set_rules( 'ip_address', 'ip_address', 'required' );
				$this->form_validation->set_rules( 'device_name', 'device_name', 'required' );
				$this->form_validation->set_rules( 'sn', 'sn', 'required' );
				$this->form_validation->set_rules( 'ethernet_port', 'ethernet_port', 'required' );

				$data_post['ip_address'] = $this->input->post( 'ip_address' );
				$data_post['device_name'] = $this->input->post( 'device_name' );
				$data_post['sn'] = $this->input->post( 'sn' );
				$data_post['ethernet_port'] = $this->input->post( 'ethernet_port' );
				$data_post['lastupdate_date'] = $this->input->post( 'lastupdate_date' );
				$data_post['lastupdate_user'] = $this->input->post( 'lastupdate_user' );
				$data_post['dev_id'] = $this->input->post( 'dev_id' );
				$data_post['activation_code'] = $this->input->post( 'activation_code' );
				$data_post['auto_dl_time'] = $this->input->post( 'auto_dl_time' );
				$data_post['auto_dl_enable'] = $this->input->post( 'auto_dl_enable' );
				$data_post['layar'] = $this->input->post( 'layar' );
				$data_post['web_stamp'] = $this->input->post( 'web_stamp' );
				$data_post['web_user_stamp'] = $this->input->post( 'web_user_stamp' );
				$data_post['web_template_stamp'] = $this->input->post( 'web_template_stamp' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$insert_id = $this->device->insert( $data_post );
					
					redirect( 'device' );
				}
			break;
		}

        $this->template->admin('dashboard/create_perangkat_absensi', $data);
    }

    public function show($id = false){
        $data = array(
            'judul'         => "Detail Data Mesin",
            'active_link'   => 'detail_perangkat_absensi'
        );
        $data['id'] = $id;
		$data['device_data'] = $this->device->get( $id );

        $this->template->admin('dashboard/detail_perangkat_absensi', $data);
    }

    public function edit($id = false){
        $data = array(
            'judul'         => "Data Mesin",
            'active_link'   => 'edit_perangkat_absensi'
        );
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$data['device_data'] = $this->device->get( $id );
			break;

			case 'POST':
				$data['device_data'] = $this->device->get( $id );
				$this->form_validation->set_rules( 'ip_address', 'ip_address', 'required' );
				$this->form_validation->set_rules( 'device_name', 'device_name', 'required' );
				$this->form_validation->set_rules( 'sn', 'sn', 'required' );
				$this->form_validation->set_rules( 'ethernet_port', 'ethernet_port', 'required' );

				$data_post['ip_address'] = $this->input->post( 'ip_address' );
				$data_post['device_name'] = $this->input->post( 'device_name' );
				$data_post['sn'] = $this->input->post( 'sn' );
				$data_post['ethernet_port'] = $this->input->post( 'ethernet_port' );

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->device->update( $id, $data_post );
					
					redirect( 'device/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_perangkat_absensi', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->device->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->device->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}