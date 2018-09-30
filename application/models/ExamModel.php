<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ExamModel extends CI_Model
	{
		public function getExamQuestions($category_id)
		{
			$query = $this->db->query(
				"SELECT question_id, question, choice_a, choice_b, choice_c, choice_d, category_id FROM question
				WHERE question.category_id = '$category_id'
				ORDER BY RAND()"
			)->result_array();

			if (count($query) > 0) {
				return $query;
			} else {
				return array();
			}
		}

		public function getExamineeAnswers($category_id, $examinee_id)
		{
			$query = $this->db->query(
				"SELECT * FROM examinee_question_answer
				WHERE examinee_question_answer.category_id = '$category_id' AND examinee_question_answer.examinee_id = '$examinee_id'"
			)->result_array();

			if (count($query) > 0) {
				return $query;
			} else {
				return array();
			}
		}

		public function submitPartialAnswers($examinee_id, $category_id, $answers)
		{
			$newAnswers = array();
			$internalArray = array(
				"category_id" => $category_id,
				"examinee_id" => $examinee_id
			);

			$counter = 1;
			foreach ($answers as $key => $answer) {
				if ($counter === 1) {
					$internalArray["question_id"] = $answer->value;
				}

				if ($counter === 2) {
					$internalArray["eqa_id"] = $answer->value;
				}

				if ($counter === 3) {
					$internalArray["answer"] = $answer->value;
					array_push($newAnswers, $internalArray);
					$counter = 0;
				}
				
				$counter++;
			}

			foreach ($newAnswers as $answer) {
				if ($answer["eqa_id"] === "0") {
					// add
					$this->db->insert('examinee_question_answer',$answer);
				} else {
					// update
					$this->db->set("answer", $answer["answer"]);
					$this->db->where('category_id', $answer["category_id"]);
					$this->db->where('examinee_id', $answer["examinee_id"]);
					$this->db->where('question_id', $answer["question_id"]);
        			$this->db->update('examinee_question_answer');
				}
			}

			return true;
		}

		function endExam($examinee_id) {
			// Get current schoolyear
			$this->db->where("iscurrent", 1);
			$currentSchoolYear = $this->db->get("schoolyear")->result_array();
			
			// Get overall question
			$overallQuestion = $this->db->query(
				"SELECT question_id, question.schoolyear_id FROM question
				INNER JOIN schoolyear ON schoolyear.schoolyear_id = question.schoolyear_id
				WHERE question.schoolyear_id = '".$currentSchoolYear[0]['schoolyear_id']."'"
			)->result_array();

			// Get the examinee correct answer
			$examineeCorrectAnswer = $this->db->query(
				"SELECT question.question_id, question.answer as correct_answer, eqa.answer, question.answer = eqa.answer FROM question
				INNER JOIN examinee_question_answer eqa ON eqa.question_id = question.question_id
				WHERE examinee_id = '$examinee_id' AND question.answer = eqa.answer"
			)->result_array();

			$percent = count($examineeCorrectAnswer) / count($overallQuestion);
			$examResult = "0";

			if ($percent >= 0.80) {
				$examResult = "2";
			} else {
				$examResult = "1";
			}

			// Update examinee to is_taken and update the examinee status
			$this->db->set("is_taken", 1);
			$this->db->set("status", $examResult);
			$this->db->where("examinee_id", $examinee_id);
			$this->db->update("examinee");

			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}
 ?>