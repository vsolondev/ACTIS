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

}
