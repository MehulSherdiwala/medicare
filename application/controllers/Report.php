<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
		$this->load->model('DoctorModel');
	}

	public function index()
	{

	}

	public function record($id)
	{
		$data['data'] = $this->DoctorModel->fetchFile($id);
		$data['patient'] = $this->DoctorModel->getPatient($id);
//		print_r($data);
		$this->load->view('report-file', $data, FALSE);
	}

	public function prescription($pmdId, $date)
	{
		$data['data'] = $this->DoctorModel->fetchPrescription($pmdId,date('Y-m-d',strtotime($date)));
		$this->load->view('report-prescription', $data, FALSE);
	}
}

/* End of file Report.php */
