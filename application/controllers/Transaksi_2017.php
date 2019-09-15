<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_2017 extends CI_Controller {

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
        $this->load->model('model_new_att_log_2017', 'new_att_log');

        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

	public function index()
	{
		$data = array(
            'judul'         => "Absensi Manual Pegawai",
            'active_link'   => 'manual_absensi'
        );
        $user = $this->session->userdata('logged_in');
        $data['skpdata'] = $this->emp->get($user["user_id"], false);
        $data['data_info'] = $this->emp->lister($data['skpdata']["unitk"],$data['skpdata']["sub_unitk"]);

        $this->template->admin('dashboard/manual_absensi', $data);
	}

	public function show($pin=false){
        $this->user = $this->session->userdata('logged_in');
        if($this->input->post()){
            $iMonth = $this->input->post( 'iMonth');
            $iYear = $this->input->post( 'iYear' );            
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

    public function showdata($user_pin){
    	$data = array(
            'judul'         => "Modul Absensi Manual",
            'active_link'   => 'detail_manual_absensi'
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
        $absen_info = array('period' => "$month $year", 'month'=> $month, 'year'=>$year, 'month_name'=> $monthName,'start_year'=>2012 );
		$data['monthName'] = $monthName;
        if(false == $user_pin){
            $skpdata = $this->emp->get($this->user["user_id"], false);
            $data['result_data'] = $this->emp->lister( $skpdata["kode_unitk"], $month, $year);
            $data['absen_info'] = array('period' => "$month $year", 'month'=> $month, 'year'=>$year, 'month_name'=> $monthName,'start_year'=>2012 );
		}else{
            $pegdata = $this->emp->get($user_pin, false);
            $absent_data = $this->new_att_log->get_sum( $pegdata['pin'], $month, $year );
            $data['result_data'] = $absent_data["data"];
            $data['absen_info'] = array('period' => "$month $year", 'month'=> $month, 'year'=>$year, 'month_name'=> $monthName,'start_year'=>2012 );
            if(($this->user["user_group"]<4 || $this->user["user_group"]==9)){
            	$data['emp_data_x'] = $pegdata;
            }
		}
        
        $this->template->admin('dashboard/detail_manual_absensi', $data);
    }

    public function checkin($userpin, $userdate){
     	if($this->user["manual_absent"]==1){
     		print_r('expression');
     		exit;
            // $user = $this->input->post( 'submit', false );
            // if(false!==$user){
            //     $errors = $this->insert_log(0);
            //     if(true===$errors){
            //         redirect('/transaksi_2017/view/'.$userpin.'/'.date("Ym", strtotime($userdate)));
            //     }else{
            //         $this->template->assign( 'errors', $errors );
            //     }
            // }
    
            // $this->template->assign('checkuser', array('userpin'=>$userpin, 'userdate'=>$userdate, 'checktype'=>"0:checkin"));
            // $this->template->assign( 'emp_data_x', $this->model_emp->get($userpin, false));
            // $this->template->assign( 'template', 'form_absent_manual_2017' );
            // $this->display();
        }else{
        	redirect('/transaksi_2017/show/'.$userpin);
        }   
    }
}
