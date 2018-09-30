<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ExamModel extends CI_Model
	{
		public function getQuestionChoices()
		{
			$id = $_SESSION['category_id'];
			$query = $this->db->query(
				"SELECT * FROM question question_a
				inner join choices on choices.question_id = question_a.question_id
				inner join (
					SELECT question_b.question_id, question_b.category_id FROM question question_b WHERE question_b.category_id = '$id'     ORDER BY RAND()
				) x ON question_a.question_id = x.question_id
				where question_a.category_id = '$id'"
			);

			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
	}
 ?>