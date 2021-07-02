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
		$this->load->model('PharmacistModel');
		$pharId = $this->session->userdata('uId');
		$dptId = $this->session->userdata('dptId');
		$data['data'] = $this->PharmacistModel->fetchPharPatinetAdminPdf($pharId,$dptId);

		$this->load->view('pharmacist/report-patient', $data, FALSE);
	}

	public function sales()
	{
		$this->load->model('SalesModel');
		$type = $this->input->post('type');
		if ($type == 1 || $type == 0){
			$userId = $this->session->userdata('uId');
			$data['data'] = $this->SalesModel->fetchPharSalesAdminPdf($userId);
		}elseif($type == 3) {
			$userId = $this->input->post('userId');
			$data['data'] = $this->SalesModel->fetchPatientSalesAdminPdf($userId);
			$data['username'] = $data['data'][0]['name'];
		}
		$this->load->view('pharmacist/report-sales', $data, FALSE);
	}

	public function medicine()
	{
		$this->load->model('MedicineModel');
		$data['data'] = $this->MedicineModel->fetchMedicinePdf();
		$this->load->view('pharmacist/report-medicine', $data, FALSE);
	}

}

/* End of file Report.php */
