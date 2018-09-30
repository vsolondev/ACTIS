<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamineeModel extends CI_Model {
    function get(){
        $result = $this->db->get('examinee')->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function add($request){
        $this->db->insert('examinee',$request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    function update($id, $request){
        $this->db->where('examinee_id', $id);
        $this->db->update('examinee', $request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    function examineeLogin($code)
    {
        $result = $this->db->query(
            "SELECT * FROM examinee WHERE code='$code'"
        )->result_array();
        
        if (count($result) > 0) {
            return $result[0];
        } else {
            return array();
        }   

    }
}
