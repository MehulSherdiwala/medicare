<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
	}

	public function index()
	{

	}

	public function patient()
	{
		$this->load->model('DoctorModel');
		$docId = $this->session->userdata('uId');
		$dptId = $this->session->userdata('dptId');
		$data['data'] = $this->DoctorModel->fetchDocPatinetAdminPdf($docId,$dptId);
		$this->load->view('doctor/report-patient', $data, FALSE);
	}

	public function appointment()
	{
		$this->load->model('AppointmentModel');
		$type = $this->input->post('type');
		$docId = $this->session->userdata('uId');
		if ($type == 1 || !isset($type))
		{
			$data['data'] = $this->AppointmentModel->fetchAppointmentPdf($docId);
		} else {
			$data['data'] = $this->AppointmentModel->fetchAppStatusWisePdf($docId,$type);
		}
		$this->load->view('doctor/report-appointment', $data, FALSE);
	}

	public function ic_doctor()
	{
		$this->load->model('DoctorModel');
		$docId = $this->session->userdata('uId');
		$data['data'] = $this->DoctorModel->fetchICDocPatinetAdminPdf($docId);
		$this->load->view('doctor/report-ic-doctor-patient', $data, FALSE);
	}

}

/* End of file Report.php */
