<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi_rekap extends CI_Controller {

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
        $this->load->model('Model_emp', 'emp');
        $this->load->model('Model_rekap', 'rekap');
        $this->load->model('Model_att_log_2017', 'att_log');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        if($this->input->post()){
            $iNip = $this->input->post( 'iNip');
            $iMonth = $this->input->post( 'iMonth');
            $iYear = $this->input->post( 'iYear' );            
        }else{
            $iNip = "";
            $iMonth = date('m');
            $iYear = date('Y');
        }
        $this->view($iNip, $iYear.str_pad($iMonth,2,STR_PAD_LEFT,'0'));
    }

    public function view($iNip, $date = false){
        if(false!==$date){
            $this->curr_month = $date;
        }else{
            $this->curr_month = date('Ym');
        }
        $this->nip_pegawai = $iNip;
        $this->showdata();
    }

    public function showdata(){
    	$data = array(
            'judul'         => "Form Validasi Rekap",
            'active_link'   => 'validasi_rekap'
        );

    	$year = substr($this->curr_month, 0,4);
        $month = substr($this->curr_month, 4,2);
        if($this->nip_pegawai!==""){
            // $pegdata = $this->emp->get($this->nip_pegawai, false);                    
            // $data['absent_data'] = $this->rekap->lister_validate($this->nip_pegawai, $pegdata["unitk"],$pegdata["sub_unitk"], $month, $year );
            // $data['absent_data_2'] = $this->rekap->lister2_validate($this->nip_pegawai,  $pegdata["unitk"],$pegdata["sub_unitk"], $month, $year );                
            // $data['absent_data_3'] = $this->att_log->get_sum( $pegdata['pin'], $month, $year );
        }
        $monthName = 
                    array('1' => 'JANUARI',
                        '2' => 'FEBRUARI',
                        '3' => 'MARET',
                        '4' => 'APRIL',
                        '5' => 'MEI',
                        '6' => 'JUNI',
                        '7' => 'JULI',
                        '8' => 'AGUSTUS',
                        '9' => 'SEPTEMBER',
                        '10' => 'OKTOBER',
                        '11' => 'NOVEMBER',
                        '12' => 'DESEMBER');
        $data['monthName'] = $monthName;
        $data['absen_info'] = array('period' => "$month $year", 'month'=> $month, 'year'=>$year, 'month_name'=> $monthName,'start_year'=>2012,'nip'=>$this->nip_pegawai );
        $data['monthDays'] = date('t', strtotime("$year-$month-01"));

        $this->template->admin('dashboard/validasi_rekap', $data);
    }
}