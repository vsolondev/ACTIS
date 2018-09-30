<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('AdminModel');
        $this->load->model('ExamineeModel');
    }

	public function index()
	{
		$this->load->view('common/headerHome');
		$this->load->view('home_v');
		$this->load->view('common/footer');
    }

    public function adminLogin()
    {
        $data["success"] = false;

        $response = $this->AdminModel->adminLogin($this->input->post("username"), $this->input->post("password"));

        if (count($response) > 0) {
            $data["success"] = true;
            $this->session->set_userdata($response);
        }

        echo json_encode($data);
    }

    public function examineeLogin()
    {
        $data["success"] = false;

        $code = $this->input->post("code");
        $response = $this->ExamineeModel->examineeLogin($code);

        if (count($response) > 0) {
            $data["success"] = true;
            $this->session->set_userdata($response);
        }

        echo json_encode($data);
    }
}
