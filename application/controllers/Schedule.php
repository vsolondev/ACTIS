<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('ScheduleModel');
    }

	public function index()
	{
		$this->load->view('common/headerAdmin');
		$this->load->view('schedule_v');
		$this->load->view('common/footer');
    }

    public function get()
    {
        $data["success"] = false;
        
        $data["data"] = $this->ScheduleModel->get();

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function getScheduleBySchoolYear()
    {
        $data["success"] = false;
        
        $schoolyear_id = $this->input->post("schoolyear_id");
        $data["data"] = $this->ScheduleModel->getScheduleBySchoolYear($schoolyear_id);

        if (count($data["data"]) > 0) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
    
    public function add()
    {
        $data["success"] = false;

        $request = array(
            "schoolyear_id" => $this->input->post("schoolyear_id"),
            "dateofsched" => $this->input->post("dateofsched")
        );
        
        $response = $this->ScheduleModel->add($request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }

    public function update()
    {
        $data["success"] = false;

        $schedule_id = $this->input->post("schedule_id");
        $request = array(
            "schoolyear_id" => $this->input->post("schoolyear_id"),
            "dateofsched" => $this->input->post("dateofsched")
        );
        
        $response = $this->ScheduleModel->update($schedule_id, $request);

        if ($response) {
            $data["success"] = true;
        }

        echo json_encode($data);
    }
}
