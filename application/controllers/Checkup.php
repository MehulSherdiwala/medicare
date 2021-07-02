<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index()
	{

	}

	public function record($id=0){
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}
		if ($id==0)
		{
			$data['record'] = $this->DoctorModel->fetchRecord();
			$this->load->view('checkup-record', $data);
		} else {
			$this->load->view('view-file');
		}
	}

	public function fetchFileDetails($id){
		$res = $this->DoctorModel->fetchFile($id);

		echo json_encode($res);
	}

	public function fetchCase($id){
		$res = $this->DoctorModel->fetchCase($id);

		echo json_encode($res);
	}

	public function fetchDates($id){
		$res = $this->DoctorModel->fetchDates($id);

		echo json_encode($res);
	}

	public function checkMedicine($id){
		$res = $this->DoctorModel->checkMedicine($id);

		echo json_encode($res);
	}

	public function fetchCurrentPrescription($id){
		$res = $this->DoctorModel->fetchCurrentPrescription($id);

		echo json_encode($res);
	}

}

/* End of file Checkup.php */
