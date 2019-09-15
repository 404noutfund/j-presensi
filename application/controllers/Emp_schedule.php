<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_schedule extends CI_Controller {

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
        $this->load->model('model_emp', 'emp');
        $this->load->model('model_emp_schedule', 'schedule');

        $user = $this->session->userdata('logged_in');
		if(!isset($user)){
			redirect(base_url('login'));
		}
    }

    public function index(){
        $data = array(
            'judul'         => "Data Jadwal",
            'active_link'   => 'emp_schedule'
        );
        $user = $this->session->userdata('logged_in');
        $skpdata = $this->emp->get($user["user_id"], false);
        $alldata = false;
        if($user["user_group"]=="9" || $user["user_group"]=="1"){
            $alldata=true;
        }
        $data['emp_schedule_data'] = $this->schedule->lister($skpdata["unitk"], $skpdata["sub_unitk"], $alldata);

        $this->template->admin('dashboard/emp_schedule', $data);
    }

    public function show($id){
        $data = array(
            'judul'         => "Data Detail Jadwal",
            'active_link'   => 'detail_emp_schedule'
        );
        $data['id'] = $id;
		$data['emp_schedule_data'] = $this->schedule->get($id);

        $this->template->admin('dashboard/detail_emp_schedule', $data);
    }

    public function edit($id){
    	$data = array(
            'judul'         => "Data Master Jadwal",
            'active_link'   => 'edit_emp_schedule'
        );
        $data['id'] = $id;

        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$data['jam'] = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
				$data['menit'] = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"];
				$data['emp_schedule_data'] = $this->schedule->get( $id );
				$data['hourIn'] = date('H', strtotime($data['emp_schedule_data']['sch_checkintime']));
				$data['minuteIn'] = date('i', strtotime($data['emp_schedule_data']['sch_checkintime']));
				$data['hourOut'] = date('H', strtotime($data['emp_schedule_data']['sch_checkouttime']));
				$data['minuteOut'] = date('i', strtotime($data['emp_schedule_data']['sch_checkouttime']));
				// $data['metadata'] = $this->schedule->metadata();
			break;
			case 'POST':
				$data_post['sch_nameid'] = $this->input->post( 'sch_nameid' );
				$data_post['sch_days'] = implode("|", $this->input->post( 'sch_days' ));
				$data_post['sch_date1'] = $this->input->post( 'sch_date1' );
				$data_post['sch_date2'] = $this->input->post( 'sch_date2' );
                                $hourIn = $this->input->post( 'sch_checkintimeHour');
                                $minutIn = $this->input->post( 'sch_checkintimeMinute');
				$data_post['sch_checkintime'] = $hourIn.":".$minutIn;
				$data_post['sch_checkinlimit'] = 15;
                                $hourOut = $this->input->post( 'sch_checkouttimeHour');
                                $minutOut = $this->input->post( 'sch_checkouttimeMinute');
				$data_post['sch_checkouttime'] = $hourOut.":".$minutOut;
				$data_post['sch_checkoutlimit'] = 15;
				$data_post['sch_lastupdate'] = date("Y-m-d H:i:S");

				$this->schedule->update( $id, $data_post );
				redirect('emp_schedule');
			break;
		}

        $this->template->admin('dashboard/edit_emp_schedule', $data);
    }

    public function create($id = false){
    	$data = array(
            'judul'         => "Data Master Jadwal",
            'active_link'   => 'create_emp_schedule'
        );

        $user = $this->session->userdata('logged_in');
        switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$data['emp_schedule_data'] = $this->schedule->get( $id );
				$data['jam'] = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
				$data['menit'] = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"];
				// $data['metadata'] = $this->schedule->metadata();
			break;
			case 'POST':
                                $data_post['sch_idx'] = $this->input->post( 'sch_idx', null );
                                $skpdata = $this->emp->get($user["user_id"], false);
                                $data_post['sch_unitk'] = $skpdata["unitk"];
                                $data_post['sch_sub_unitk'] = $skpdata["sub_unitk"];
                                $data_post['sch_nameid'] = $this->input->post( 'sch_nameid' );
				$data_post['sch_days'] = implode("|", $this->input->post( 'sch_days' ));
				$data_post['sch_date1'] = $this->input->post( 'sch_date1' );
				$data_post['sch_date2'] = $this->input->post( 'sch_date2' );
                                $hourIn = $this->input->post( 'sch_checkintimeHour');
                                $minutIn = $this->input->post( 'sch_checkintimeMinute');
				$data_post['sch_checkintime'] = $hourIn.":".$minutIn;
				$data_post['sch_checkinlimit'] = 15;
                                $hourOut = $this->input->post( 'sch_checkouttimeHour');
                                $minutOut = $this->input->post( 'sch_checkouttimeMinute');
				$data_post['sch_checkouttime'] = $hourOut.":".$minutOut;
				$data_post['sch_checkoutlimit'] = 15;
				$data_post['sch_lastupdate'] = date("Y-m-d H:i:S");

				$insert_id = $this->schedule->insert( $data_post );
				redirect('emp_schedule');
			break;
		}

        $this->template->admin('dashboard/create_emp_schedule', $data);
    }

    function delete( $id = FALSE )
	{
		switch ( $_SERVER ['REQUEST_METHOD'] )
		{
			case 'GET':
				$this->schedule->delete( $id );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;

			case 'POST':
				$this->schedule->delete( $this->input->post('delete_ids') );
				redirect( $_SERVER['HTTP_REFERER'] );
			break;
		}
	}
}