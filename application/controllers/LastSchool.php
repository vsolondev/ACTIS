<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LastSchool extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('LastSchoolModel');
    }

	public function index()
	{
		$this->load->view('common/headerAdmin');
        $this->load->view('lastschool_v');
		$this->load->view('common/footer');
    }

    public function getUniqueSchool()
    {
        $data["success"] = false;
        
        $data["schools"] = $this->LastSchoolModel->getUniqueSchool();

        if (count($data["schools"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
