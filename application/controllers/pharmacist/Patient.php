<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}
		$this->load->model('PharmacistModel');
		$data['list'] = $this->PharmacistModel->fetchPatient();
		$this->load->view('pharmacist/patient-list',$data);
	}

}

/* End of file Patient.php */
