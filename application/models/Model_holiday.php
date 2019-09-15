<?php

class Model_holiday extends CI_Model {

    function __construct() {
        parent::__construct();
        
        $this->raw_data = FALSE;
    }

    function lister() {

        $this->db->start_cache();
        $this->db->select('holiday_id,holiday_date,holiday_type,holiday_note,lastupdate_date,lastupdate_user');
        $this->db->from('holiday_pns');
        $this->db->order_by('holiday_date', 'ASC');

        // Get the results
        $query = $this->db->get();

        $temp_result = array();

        foreach ($query->result_array() as $row) {
            $temp_result[] = array(
                'holiday_id' => $row['holiday_id'],
                'holiday_date_format' => date("d-m-Y", strtotime($row['holiday_date'])),
                'holiday_date' => $row['holiday_date'],
                'holiday_type' => $row['holiday_type'],
                'holiday_note' => $row['holiday_note'],
                'lastupdate_date_format' => date("d-m-Y H:i:s", strtotime($row['lastupdate_date'])),
                'lastupdate_date' => $row['lastupdate_date'],
                'lastupdate_user' => $row['lastupdate_user'],
            );
        }
        $this->db->flush_cache();
        return $temp_result;
    }

    function get($id, $get_one = false) {

        $select_statement = ( $this->raw_data ) ? 'holiday_id,holiday_date,holiday_type,holiday_note,lastupdate_date,lastupdate_user' : 'holiday_id,holiday_date,holiday_type,holiday_note,lastupdate_date,lastupdate_user';
        $this->db->select($select_statement);
        $this->db->from('holiday_pns');


        // Pick one record
        // Field order sample may be empty because no record is requested, eg. create/GET event
        if ($get_one) {
            $this->db->limit(1, 0);
        } else { // Select the desired record
            $this->db->where('holiday_date', $id);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return array(
            'holiday_id' => $row['holiday_id'],
            'holiday_date_format' => date("d-m-Y", strtotime($row['holiday_date'])),
            'holiday_date' => $row['holiday_date'],
            'holiday_type' => $row['holiday_type'],
            'holiday_note' => $row['holiday_note'],
            'lastupdate_date_format' => date("d-m-Y H:i:s", strtotime($row['lastupdate_date'])),
            'lastupdate_date' => $row['lastupdate_date'],
            'lastupdate_user' => $row['lastupdate_user']
            );
        } else {
            return array();
        }
    }

    function insert($data) {
        $this->db->insert('holiday', $data);
        return $this->db->insert_id();
    }

    function update($id, $data) {
        $this->db->where('holiday_date', $id);
        $this->db->update('holiday_pns', $data);
    }

    function delete($id) {
        if (is_array($id)) {
            $this->db->where_in('holiday_date', $id);
        } else {
            $this->db->where('holiday_date', $id);
        }
        $this->db->delete('holiday_pns');
    }

    function getHolidaysDate($year = 0, $month = 0) {
        list($y, $m) = explode('-', date('Y-m'));
        if (!$year)
            $year = $y;
        if (!$month)
            $month = $m;

        $end_date = date('t', strtotime("$year-$month-01"));

        $list = array();
        $result = $this->db
                ->from('holiday_pns')
                ->where('holiday_date >=', "$year-$month-01")
                ->where('holiday_date <=', "$year-$month-$end_date")
                ->get();
        foreach ($result->result() as $row) {
            $list[$row->holiday_date] = $row;
        }

        return $list;
    }

    function insertHoliday($data) {
        $this->db->insert('holiday_pns', $data);
        return $this->db->insert_id();
    }

    function deleteHoliday($date) {
        if (is_array($date)) {
            $this->db->where_in('holiday_date', $date);
        } else {
            $this->db->where('holiday_date', $date);
        }
        $this->db->delete('holiday_pns');
    }
}