<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tppns extends CI_Controller {

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
        $this->load->model('Model_harga_jabatan', 'harga_jabatan');
        $this->load->model('Model_tunjangan', 'tunjangan');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
        if($this->input->post()){
            $iMonth = $this->input->post( 'iMonth');
            $iYear = $this->input->post( 'iYear' );            
        }else{
            $iMonth = date('m');
            $iYear = date('Y');
        }
        $this->view($iYear.str_pad($iMonth,2,STR_PAD_LEFT,'0'));
	}

    public function view($date = false){
        if(false!==$date){
            $this->curr_month = $date;
        }else{
            $this->curr_month = date('Ym');
        }
        $this->showdata();
    }

    public function showdata(){
    	$data = array(
            'judul'         => "TPPNS",
            'active_link'   => 'tppns'
        );

    	$year = substr($this->curr_month, 0,4);
        $month = substr($this->curr_month, 4,2);
        $this->user = $this->session->userdata('logged_in');
        $data['skpdata'] = $this->emp->get($this->user["user_id"], false);
        $harga_bobot = $this->harga_jabatan->getCurrentHJB("$year-$month-01");
        $data['result_data'] = $this->tunjangan->lister_2017($data['skpdata']["unitk"],$data['skpdata']["sub_unitk"], $month, $year, true, false, $harga_bobot);
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
        $data['absen_info'] = array('period' => "$month $year", 'month'=> $month, 'year'=>$year, 'month_name'=> $monthName,'start_year'=>2012 );

    	$this->template->admin('dashboard/tppns', $data);
    }
}