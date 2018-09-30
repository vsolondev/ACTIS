<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamResultModel extends CI_Model {
    function getUniqueSchool() 
    {
        $query = $this->db->query(
            "SELECT DISTINCT lastschool FROM examinee"
        )->result_array();
        
        if (count($query) > 0) {
            return $query;
        } else {
            return array();
        }
    }

    function filterExaminee($status, $lastschool)
    {
        if ($status != "all") {
            $this->db->where("status", $status);
        }

        if ($lastschool != "all") {
            $this->db->where("lastschool", $lastschool);
        }

        $response = $this->db->get("examinee")->result_array();

        if (count($response) > 0) {
            return $response;
        } else {
            return array();
        }
    }
}
