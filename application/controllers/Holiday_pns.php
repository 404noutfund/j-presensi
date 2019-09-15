<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday_pns extends CI_Controller {

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
        $this->load->model('Model_init', 'init');
        $this->load->model('Model_holiday', 'holiday');
        
        $user = $this->session->userdata('logged_in');
        if(!isset($user)){
            redirect(base_url('login'));
        }
    }

    public function index(){
    	$data = array(
            'judul'         => "Data Hari Libur",
            'active_link'   => 'holiday_pns'
        );

    	$dayNames = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $monthNames = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $bulanini = date('M-Y');            
        list($calendar,$prev_ym, $next_ym) = $this->generateCalendar();
        //echo "<pre>";
       // print_r($calendar);
        //echo "</pre>";
        $data['params'] = array(
            'bulanini'=>$bulanini,
            'monthName'=>$monthNames,
            'dayName'=>$dayNames,
            'calendar'=>$calendar,
            'prev_ym'=>$prev_ym,
            'next_ym'=>$next_ym,
        );

        $this->template->admin('dashboard/holiday_pns', $data);
    }

    private function generateCalendar($year=0, $month=0)
    {
        $typeDays = array('last_month', 'curr_month', 'next_month');
        $groupDays = array('booked', 'available', 'unavailable');
        
        //echo "$year-$month";
        //exit();
        if (($year != 0)&&($month != 0))
        {
            $end_date = $this->init->GetHariPerBulan($month,$year);
            $y=$year;
            $m=$month;
            $d="01";           
        }else{
            list($y,$m,$d, $end_date) = explode('-', date('Y-m-d-t'));
        }
        
        if (!$month) $month = $m;
        if (!$year) $year = $y;
        
        $prev_year = $year;
        $prev_month = $month - 1;
        if ($prev_month < 1)
        {
            $prev_month = 12;
            $prev_year = $year - 1;
        }
        
        $next_year = $year;
        $next_month = $month + 1;
        if ($next_month > 12)
        {
            $next_year = $year + 1;
            $next_month = 1;
        }
        
        $start_month_time = strtotime("$year-$month-01");
        
        $w = date('w', $start_month_time);
        $offset = $w - 1;
        
        if ($offset < 0) $offset = 6; //change from 7
        
        
        $start_month_time = $start_month_time - ($offset * 86400);
        $end_month_time = strtotime("$year-$month-$end_date") + (42 - ($offset + $end_date)) * 86400;
        
        $listHolidays = $this->holiday->getHolidaysDate($year, $month);
        
        $now = strtotime("$y-$m-$d");
        $t = strtotime("$year-$month-01");
        $t2 = strtotime("$year-$month-$end_date");
        $arrDate = array();
        $cursor = $start_month_time;
        //echo "END TIME :". date('d',$start_month_time);
        while ($cursor <= $end_month_time)
        {
            list($y, $m, $d, $w) = explode('-', date('Y-m-d-w', $cursor));
            $date = "$y-$m-$d";            
            if (isset($listHolidays[$date]))
            {
                $group = 'hari_libur';
                $content = 'Hari Libur';               
            }
            else
            {
                $group = 'hari_kerja';
                $content = 'Hari Kerja';                
            }
            
            
            if ($cursor < $t)
            {
                $type = 'last_month';
                $content = '&nbsp;';
                if ($cursor < $now)
                {
                    $type = 'past_day';
                }
            }
            else if ($cursor > $t2)
            {
                $type = 'next_month';
                if ($cursor < $now)
                {
                    $type = 'past_day';
                }
            }
            else
            {
                $type = 'curr_month';
            }

            
            $arrDate[$cursor] = array(
                'type' => $type,
                'group' => $group,
                'y' => $y,
                'm' => $m,
                'd' => $d,              
                'content' => $content,
            );
            
            $cursor += 86400;
        }
        
        $prev_ym = "$prev_year-$prev_month";
        $next_ym = "$next_year-$next_month";
        
        return array($arrDate, $prev_ym, $next_ym);
    }

    public function libur($year='')
    {
        $arrMonthName = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        if (!$year) $year = date('Y-m');
        
        list($y,$m) = explode("-", $year);
        
        list($calendar,$prev_ym, $next_ym) = $this->generateCalendar($y,$m);
       
        $output = '';
        foreach ($calendar as $params)
        {
            $output .= '
            <div class="DOP_BackendBookingCalendar_Day '.$params['type'].' '.$params['group'].'" id="cims_'.$params['y'].'-'.$params['m'].'-'.$params['d'].'" style="width: 135px; height: 46px;">
                <span class="header"><span class="day">'.$params['d'].'</span><br style="clear:both;" /></span>
                <span class="content" style="line-height: 27px; height: 27px;">'.$params['content'].'</span>
                </span>
            </div>';
            
        }
        
        $current = $arrMonthName[$m-1]."-$y";
        
        $o = array(
            'prev' => $prev_ym,
            'next' => $next_ym,
            'current' => $current,
            'detail' => $output
        );
        
        //echo $output;
        echo json_encode($o);
    }

    public function save()
    {            
        if (isset($_POST['data_lbr']) && count($_POST['data_lbr']))
        {
            $user = $this->session->userdata( 'logged_in' );
            
            $dates  = explode(',', $_POST['data_lbr']);  
            $mynote = "hari libur";
            
            foreach ($dates as $dt)
            {
                $arr = explode(';;', $dt);
                $date = $arr[0];    
                $type = isset($arr[1]) ? intval($arr[1]) : 2;                    
                if ($date && $type)
                {                       
                    list($y,$m,$d) = explode('-', $date);
                    $listHolidays = $this->holiday->getHolidaysDate($y, $m);
                    if((!isset($listHolidays[$date])) && ($type != 1))
                    {    
                        $data = array(
                           'holiday_date' => $date,
                           'holiday_type' => $type,
                           'holiday_note' => $mynote,
                           'lastupdate_date' => date("Y-m-d H:i:s"),
                           'lastupdate_user' => $user['user_name']
                        );                        
                        $this->holiday->insertHoliday($data); 
                    }else{
                        $this->holiday->deleteHoliday($date);   
                    }
                }
            }
            
        }
       
    }
}