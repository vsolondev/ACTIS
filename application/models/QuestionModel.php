<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionModel extends CI_Model {
    function get(){
        $result = $this->db->query(
                            "SELECT question_id, question, choice_a, choice_b, choice_c, choice_d, answer, category.category_id, schoolyear.schoolyear_id FROM question
                            inner join category on question.category_id = category.category_id
                            inner join schoolyear on schoolyear.schoolyear_id = category.schoolyear_id"
                        )->result_array();
        
        if (count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function add($request){
        $this->db->insert('question',$request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
    }

    function update($id, $request){
        $this->db->where('question_id', $id);
        $this->db->update('question', $request);
        
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}   
    }
}
