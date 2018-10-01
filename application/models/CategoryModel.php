<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {
    function get() {
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

    function isUniqueCategory($schoolyear_id, $category_name) {
        $result = $this->db->query(
            "SELECT * FROM category
            WHERE category.schoolyear_id = '$schoolyear_id' AND category.category_name = '$category_name'"
        )->result_array();
        
		if (count($result) > 0) {
			return false;
		} else {
			return true;
		}
    }

    function getCategoryBySchoolYear($schoolyear_id) {
        $result = $this->db->query(
                            "SELECT * FROM category
                            inner join schoolyear on category.schoolyear_id = schoolyear.schoolyear_id
                            WHERE category.schoolyear_id = '$schoolyear_id'"
                        )->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function getCategoryByActiveSchoolYear() {
        $result = $this->db->query(
                    "SELECT * FROM category
                    inner join schoolyear on category.schoolyear_id = schoolyear.schoolyear_id
                    where schoolyear.iscurrent = 1"
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
