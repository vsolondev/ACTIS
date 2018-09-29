<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleModel extends CI_Model {
    function get(){
        $result = $this->db->query(
                            "SELECT * FROM schedule
                            inner join schoolyear on schedule.schoolyear_id = schoolyear.schoolyear_id"
                        )->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function getScheduleBySchoolYear($schoolyear_id){
        $result = $this->db->query(
                            "SELECT * FROM schedule
                            inner join schoolyear on schedule.schoolyear_id = schoolyear.schoolyear_id
                            where schedule.schoolyear_id = '$schoolyear_id'"
                        )->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function add($request){
        $this->db->insert('schedule',$request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    function update($id, $request){
        $this->db->where('schedule_id', $id);
        $this->db->update('schedule', $request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}   
    }
}
