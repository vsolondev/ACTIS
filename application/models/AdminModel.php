<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
    function get(){
        $result = $this->db->get('admin')->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function add($request){
        $this->db->insert('admin',$request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    function update($id, $request){
        $this->db->where('admin_id', $id);
        $this->db->update('admin', $request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }
}
