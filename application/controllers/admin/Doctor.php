<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->view('admin/doctor-list');
	}

	public function fetchDoctorList(){
		$rec = $this->DoctorModel->fetchDoctorList();

		echo json_encode($rec);
	}

	public function doctorDetail($id){
		$rec = $this->DoctorModel->doctorDetail($id);

		echo json_encode($rec);
	}

	public function fetchDoc($id){
		$rec = $this->DoctorModel->fetchDoc($id);

		echo json_encode($rec);
	}
	public function updateStatus(){
		$rec = $this->DoctorModel->updateStatus();

		echo json_encode($rec);
	}

	public function fetchICDoctorList(){
		$rec = $this->DoctorModel->fetchICDoctorList();

		echo json_encode($rec);
	}

}

/* End of file Doctors.php */
