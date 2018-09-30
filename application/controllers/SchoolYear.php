<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SchoolYear extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('SchoolYearModel');
    }

	public function index()
	{
		$this->load->view('common/headerAdmin');
		$this->load->view('schoolyear_v');
		$this->load->view('common/footer');
    }

    public function get()
    {
        $data["success"] = false;
        
        $data["data"] = $this->SchoolYearModel->get();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function add()
    {
        $data["success"] = false;

        $request = array(
            "schoolyear" => $this->input->post("schoolyear")
        );
        
        $response = $this->SchoolYearModel->add($request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function update()
    {
        $data["success"] = false;

        $schoolyear_id = $this->input->post("schoolyear_id");
        $request = array(
            "schoolyear" => $this->input->post("schoolyear")
        );
        
        $response = $this->SchoolYearModel->update($schoolyear_id, $request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function assign()
    {
        $data['success'] = false;

        $schoolyear_id = $this->input->post('schoolyear_id');
        
        $response = $this->SchoolYearModel->assign($schoolyear_id);

        if ($response) {
            $data['success'] = true;
        }

        echo json_encode($data);
    }

    public function getCurrent()
    {
        $data["success"] = false;
        
        $data["data"] = $this->SchoolYearModel->getCurrent();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
