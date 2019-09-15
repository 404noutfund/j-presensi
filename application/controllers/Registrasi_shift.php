<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_shift extends CI_Controller {

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
        $this->load->model('model_sebaran', 'sebaran');
        $this->load->model('model_registrasi_2017', 'registrasi');

        $user = $this->session->userdata('logged_in');
		if(!isset($user)){
			redirect(base_url('login'));
		}
    }

    public function index(){
        $data = array(
            'judul'         => "Registrasi Shift",
            'active_link'   => 'registrasi_shift'
        );
        $user = $this->session->userdata('logged_in');
        $data['skpdata'] = $this->emp->get($user["user_id"], false);
        $data['data_info'] = $this->emp->lister($data['skpdata']["unitk"],$data['skpdata']["sub_unitk"]);

        $this->template->admin('dashboard/registrasi_shift', $data);
    }

    public function show($pin = false)
    {
    	$data = array(
            'judul'         => "Form Registrasi Shift",
            'active_link'   => 'detail_registrasi_shift'
        );

        $this->user = $this->session->userdata('logged_in');
        if($this->input->post()){
            $iMonth = $this->input->post('iMonth');
            $iYear = $this->input->post('iYear' ); 
        }else{
            $iMonth = date('m');
            $iYear = date('Y');
        }

        if($this->user["user_group"]=="4"){
           $this->view($this->user["user_pin"], $iYear.str_pad($iMonth,2,STR_PAD_LEFT,'0') );
        }else{
           $this->view($pin, $iYear.str_pad($iMonth,2,STR_PAD_LEFT,'0'));
        }
    }

    public function view($pin = false, $date = false){
        if(false!==$date){
            $this->curr_month = $date;
        }else{                
            if($this->input->post()){
                $iMonth = $this->input->post( 'iMonth');
                $iYear = $this->input->post( 'iYear' );            
            }else{
                $iMonth = date('m');
                $iYear = date('Y');
            }
            $this->curr_month = $iYear.$iMonth;
        }
        $this->showdata($pin);
    }

    public function showdata($user_pin, $date = false){
    	$data = array(
            'judul'         => "Form Registrasi Shift",
            'active_link'   => 'detail_registrasi_shift'
        );

    	$year = substr($this->curr_month, 0,4);
        $month = substr($this->curr_month, 4,2);
        $monthName = 
                    array('1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember'); 
        
        $data['monthName'] = $monthName;
        $skpdata = $this->emp->get($this->user["user_id"], false);
        $data['absen_info'] =  array('period' => "$month $year", 'month'=> $month, 'year'=>$year, 'month_name'=> $monthName,'start_year'=>2012 );

        if(false == $user_pin){
            $absent_data = $this->emp->lister( $skpdata["kode_unitk"], $month, $year);
        }else{
            $alldata = false;
            $data['allsch'] = $this->registrasi->get_all_list_shift();
            $one_sch = $this->registrasi->get_list_shift($skpdata['unitk'], $skpdata['sub_unitk'], $alldata);
        	$days = $this->registrasi->get_reg_shif($user_pin, $month, $year);
        	$emp_data_x = $this->emp->get($user_pin, false);
        	if($this->user["user_group"]=="9" || $this->user["user_group"]=="1"){
            	$alldata=true;
            	$data['sch'] = $one_sch;
            	$data['days'] = $days;
            	$data['emp_data_x'] = $emp_data_x;
            }else{
            	$data['sch'] = $one_sch;
            	$data['days'] = $days;
            	$data['emp_data_x'] = $emp_data_x;
            }
        }

        $this->template->admin('dashboard/detail_registrasi_shift', $data);
    }
}