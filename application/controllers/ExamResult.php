<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamResult extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('ExamResultModel');
    }

	public function index()
	{
		$this->load->view('common/headerAdmin');
		$this->load->view('examresult_v');
		$this->load->view('common/footer');
    }

    public function getUniqueSchool()
    {
        $data["success"] = false;
        
        $data["schools"] = $this->ExamResultModel->getUniqueSchool();

        if (count($data["schools"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function filterExaminee()
    {
        $data["success"] = false;

        $status = $this->input->post("status");
        $lastschool = $this->input->post("lastschool");

        $data["examinees"] = $this->ExamResultModel->filterExaminee($status, $lastschool);

        if (($data["examinees"]) >= 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
