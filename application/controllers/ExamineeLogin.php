<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamineeLogin extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('ExamineeModel');
    }

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('examinee_login_v');
		$this->load->view('common/footer');
    }

    public function login()
    {
        $data["success"] = false;
        $code = $this->input->post("code");

        $result = $this->ExamineeModel->login($code);

        if ($result) {
            $data["success"] = true;
        }
        
        echo json_encode($data);
    }
}
