<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {
    function get(){
        $result = $this->db->query(
                            "SELECT * FROM category
                            inner join schoolyear on category.schoolyear_id = schoolyear.schoolyear_id"
                        )->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function add($request){
        $this->db->insert('category',$request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    function update($id, $request){
        $this->db->where('category_id', $id);
        $this->db->update('category', $request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}   
    }
}
