<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LastSchoolModel extends CI_Model {
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
}
?>