<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('ExamModel');
    }

	public function index()
	{
		$this->load->view('common/headerExaminee');
		$this->load->view('exam_v');
		$this->load->view('common/footer');
    }

    function getExamQuestions()
    {
        $data['success'] = false;

        $category_id = $this->input->post("category_id");
        $data['questions'] = $this->ExamModel->getExamQuestions($category_id);

        if ($data) {
            $data['success'] = true;
        }

        echo json_encode($data);
    }

    function getExamineeAnswers()
    {
        $data['success'] = false;

        $examinee_id = $this->session->userdata("examinee_id");
        $category_id = $this->input->post("category_id");

        $data['answers'] = $this->ExamModel->getExamineeAnswers($category_id, $examinee_id);

        if ($data) {
            $data['success'] = true;
        }

        echo json_encode($data);
    }

    function submitPartialAnswers()
    {
        $data['success'] = false;

        $examinee_id = $this->session->userdata("examinee_id");
        $category_id = $this->input->post("category_id");
        // Transform to json array
        $answers = json_decode($this->input->post("answers"));

        $result = $this->ExamModel->submitPartialAnswers($examinee_id, $category_id, $answers);

        if ($result) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    function endExam() {
        $data['success'] = false;

        $examinee_id = $this->session->userdata("examinee_id");
        $result = $this->ExamModel->endExam($examinee_id);

        if ($result) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
