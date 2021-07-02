<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}
		$data['patient'] = $this->DoctorModel->fetchPatient();
		$this->load->view('doctor/patient-list', $data, FALSE);
	}

	public function records($pId)
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}
		$this->load->view('doctor/patient-record');
	}

	public function fetchFileDetails($pmrId)
	{

		$res = $this->DoctorModel->fetchFile($pmrId);

		echo json_encode($res);
	}

	public function fetchCase($id){
		$res = $this->DoctorModel->fetchCase($id);

		echo json_encode($res);
	}
}

/* End of file Patient.php */
