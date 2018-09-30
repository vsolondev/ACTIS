<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }

	public function index()
	{
		$this->load->view('common/headerAdmin');
		$this->load->view('admin_v');
		$this->load->view('common/footer');
    }

    public function get()
    {
        $data["success"] = false;
        
        $data["data"] = $this->AdminModel->get();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function add()
    {
        $data["success"] = false;

        $request = array(
            "fullname" => $this->input->post("fullname"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password")
        );
        
        $response = $this->AdminModel->add($request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function update()
    {
        $data["success"] = false;

        $admin_id = $this->input->post("admin_id");
        $request = array(
            "fullname" => $this->input->post("fullname")
        );
        
        $response = $this->AdminModel->update($admin_id, $request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
