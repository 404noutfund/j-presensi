<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends CI_Controller {

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
        $this->load->model('Model_holiday', 'holiday');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
    	$data = array(
            'judul'         => "Data Hari Libur",
            'active_link'   => 'holiday'
        );
		$data['holiday_data'] = $this->holiday->lister();

        $this->template->admin('dashboard/holiday', $data);
    }

    public function show($id){
    	$data = array(
            'judul'         => "Data Hari Libur",
            'active_link'   => 'detail_holiday'
        );
        $data['id'] = $id;
		$data['holiday_data'] = $this->holiday->get( $id );

        $this->template->admin('dashboard/detail_holiday', $data);
    }

    public function edit($id){
    	$data = array(
            'judul'         => "Data Hari Libur",
            'active_link'   => 'edit_holiday'
        );

        $user = $this->session->userdata('logged_in');
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->holiday->raw_data = TRUE;
				$data['holiday_data'] = $this->holiday->get( $id );
			break;

			case 'POST':
				$this->form_validation->set_rules( 'holiday_note', 'holiday_note', 'required|max_length[200]' );
				// $this->form_validation->set_rules( 'holiday_date', 'masukkan tanggal, ex:2014-08-15', 'required' );

				$data['holiday_data'] = $this->holiday->get( $id );
				$data_post['holiday_note'] = $this->input->post( 'holiday_note' );
				$data_post['lastupdate_date'] = date("Y-m-d H:i:s");
				$data_post['lastupdate_user'] = $user['user_name'];

				if ( $this->form_validation->run() == FALSE )
				{
					$data['errors'] = validation_errors();
				}
				elseif ( $this->form_validation->run() == TRUE )
				{
					$this->holiday->update( $id, $data_post );
					
					redirect( 'holiday/show/' . $id );
				}
			break;
		}

        $this->template->admin('dashboard/edit_holiday', $data);
    }

  //   public function create(){
  //   	$data = array(
  //           'judul'         => "Data Hari Libur",
  //           'active_link'   => 'create_holiday'
  //       );

  //       switch ( $_SERVER ['REQUEST_METHOD'] )
		// {
		// 	case 'GET':
		// 	break;

		// 	case 'POST':
		// 		$data_post['holiday_date'] = $this->input->post( 'holiday_date' );
		// 		$data_post['holiday_note'] = $this->input->post( 'holiday_note' );
  //               $data_post['holiday_type'] = 1;
		// 		$data_post['lastupdate_date'] = date("Y-m-d");
		// 		$data_post['lastupdate_user'] = 'admin kota';

		// 		if ( $this->form_validation->run() == FALSE )
		// 		{
		// 			$data['errors'] = validation_errors();
		// 		}
		// 		elseif ( $this->form_validation->run() == TRUE )
		// 		{
		// 			$insert_id = $this->holiday->insert( $data_post );
		// 			redirect( 'holiday' );
		// 		}
		// 	break;
		// }

  //       $this->template->admin('dashboard/create_holiday', $data);
  //   }
}