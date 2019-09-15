<?php

class Model_init extends CI_Model {

    function __construct() {
        parent::__construct();

		$this->raw_data = FALSE;
    }

    public function GetHariPerBulan ($month,$year)
    {      
        $totalHari = 0;
        if ($month == 2){
            if ($this->isKabisat($year)== false)
            {
                $totalHari = 28;
            }else{
                $totalHari = 29;
            }
        }else{
            $totalHari = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
        }
        return $totalHari; 
    }

}