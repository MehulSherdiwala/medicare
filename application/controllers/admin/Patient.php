<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PatientModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->view('admin/patient-list');
	}

	public function fetchPatientList(){
		$rec = $this->PatientModel->fetchPatientList();

		echo json_encode($rec);
	}

	public function viewPatientDetail($id){
		$rec = $this->PatientModel->viewPatientDetail($id);

		echo json_encode($rec);
	}

	public function fetchPatientDetails($id){
		$rec = $this->PatientModel->fetchPatientDetails($id);

		echo json_encode($rec);
	}
	public function updateStatus(){
		$rec = $this->PatientModel->updateStatus();

		echo json_encode($rec);
	}

}

/* End of file Doctors.php */
