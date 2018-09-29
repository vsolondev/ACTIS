<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('QuestionModel');
    }

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('question_v');
		$this->load->view('common/footer');
    }

    public function get()
    {
        $data["success"] = false;
        
        $data["data"] = $this->QuestionModel->get();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function add()
    {
        $data["success"] = false;

        $request = array(
            "schoolyear_id" => $this->input->post("schoolyear_id"),
            "category_id" => $this->input->post("category_id"),
            "question" => $this->input->post("question"),
            "choice_a" => $this->input->post("choice_a"),
            "choice_b" => $this->input->post("choice_b"),
            "choice_c" => $this->input->post("choice_c"),
            "choice_d" => $this->input->post("choice_d"),
            "answer" => $this->input->post("answer")
        );
        
        $response = $this->QuestionModel->add($request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function update()
    {
        $data["success"] = false;

        $question_id = $this->input->post("question_id");
        $request = array(
            "schoolyear_id" => $this->input->post("schoolyear_id"),
            "category_id" => $this->input->post("category_id"),
            "question" => $this->input->post("question"),
            "choice_a" => $this->input->post("choice_a"),
            "choice_b" => $this->input->post("choice_b"),
            "choice_c" => $this->input->post("choice_c"),
            "choice_d" => $this->input->post("choice_d"),
            "answer" => $this->input->post("answer")
        );
        
        $response = $this->QuestionModel->update($question_id, $request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
