<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}
		$data['day'] = $this->DoctorModel->fetchScheduleDay();

		$this->load->view('doctor/schedule',$data);
	}

	public function save(){
		echo $this->DoctorModel->saveSchedule();
	}

	public function displaySchedule(){
		$docId = $this->session->userdata('uId');
		$res = $this->DoctorModel->displaySchedule($docId);
		echo json_encode($res);
	}

	public function fetchSchedule(){
		$docId = $this->session->userdata('uId');
		$res = $this->DoctorModel->fetchSchedule($docId);
		echo json_encode($res);
	}

}

/* End of file Schedule.php */
