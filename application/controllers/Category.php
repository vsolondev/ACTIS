<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
    }

	public function index()
	{
		$this->load->view('common/headerAdmin');
		$this->load->view('category_v');
		$this->load->view('common/footer');
    }

    public function get()
    {
        $data["success"] = false;
        
        $data["data"] = $this->CategoryModel->get();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function getCategoryBySchoolYear()
    {
        $data["success"] = false;
        
        $schoolyear_id = $this->input->post("schoolyear_id");
        $data["data"] = $this->CategoryModel->getCategoryBySchoolYear($schoolyear_id);

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function getCategoryByActiveSchoolYear()
    {
        $data["success"] = false;
        
        $data["data"] = $this->CategoryModel->getCategoryByActiveSchoolYear();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function add()
    {
        $data["success"] = false;
        $data["unique"] = false;

        $request = array(
            "schoolyear_id" => $this->input->post("schoolyear_id"),
            "category_name" => $this->input->post("category_name")
        );

        $isUnique = $this->CategoryModel->isUniqueCategory($this->input->post("schoolyear_id"), $this->input->post("category_name"));
        
        if ($isUnique == true) {
            $data["unique"] = true;
            $response = $this->CategoryModel->add($request);

            if ($response) {
                $data["success"] = true;
            }
        }
        
        echo json_encode($data);
    }

    public function update()
    {
        $data["success"] = false;

        $category_id = $this->input->post("category_id");
        $request = array(
            "schoolyear_id" => $this->input->post("schoolyear_id"),
            "category_name" => $this->input->post("category_name")
        );
        
        $response = $this->CategoryModel->update($category_id, $request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
