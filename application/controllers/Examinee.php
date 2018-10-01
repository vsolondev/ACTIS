<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examinee extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('ExamineeModel');
    }

	public function index()
	{
		$data['examineecode']=$this->randStrGen(5);
		$this->load->view('common/headerAdmin');
		$this->load->view('examinee_v', $data);
		$this->load->view('common/footer');
    }

    function randStrGen($len){
        $result="";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        return $result;
    }

    public function get()
    {
        $data["success"] = false;
        
        $data["data"] = $this->ExamineeModel->get();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function add()
    {
        $data["success"] = false;

        $request = array(
            "ornum" => $this->input->post("ornum"),
            "fullname" => $this->input->post("fullname"),
            "lastschool" => $this->input->post("lastschool"),
            "code" => $this->input->post("code"),
            "status" => $this->input->post("status")
        );
        $response = $this->ExamineeModel->add($request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function update()
    {
        $data["success"] = false;

        $examinee_id = $this->input->post("examinee_id");
        $request = array(
            "ornum" => $this->input->post("ornum"),
            "fullname" => $this->input->post("fullname"),
            "lastschool" => $this->input->post("lastschool")
        );
        
        $response = $this->ExamineeModel->update($examinee_id, $request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
