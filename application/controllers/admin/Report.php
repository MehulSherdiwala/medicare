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
		$this->load->model('PatientModel');
		$data['data'] = $this->PatientModel->fetchPatientAdminPdf();
//		print_r($data);
		$this->load->view('admin/report-patient', $data, FALSE);
	}

	public function pharmacist()
	{
		$this->load->model('PharmacistModel');
		$type = $this->input->post('type');
		if ($type == 1 || !isset($type)){
			$data['data'] = $this->PharmacistModel->fetchPharAdminPdf();
			$this->load->view('admin/report-pharmacist', $data, FALSE);
		} else {
			$pharId = $this->input->post('pharId');
			$res = $this->PharmacistModel->getDetail($pharId);
			$data['data'] = $this->PharmacistModel->fetchPharPatinetAdminPdf($pharId,$res['dptId']);
			$data['pharName'] = $res['username'];
			$this->load->view('admin/report-pharmacist-patient', $data, FALSE);
		}
	}

	public function doctor()
	{
		$this->load->model('DoctorModel');
		$type = $this->input->post('type');
		if ($type == 1 || !isset($type)){
			$data['data'] = $this->DoctorModel->fetchDocAdminPdf();
			$this->load->view('admin/report-doctor', $data, FALSE);
		} else {
			$docId = $this->input->post('docId');
			$res = $this->DoctorModel->getDetail($docId);
			$data['data'] = $this->DoctorModel->fetchDocPatinetAdminPdf($docId,$res['dptId']);
			$data['docName'] = $res['username'];
			$this->load->view('admin/report-doctor-patient', $data, FALSE);
		}
	}

	public function ic_doctor()
	{
		$this->load->model('DoctorModel');
		$type = $this->input->post('type');
		if ($type == 1 || !isset($type)){
			$data['data'] = $this->DoctorModel->fetchICDocAdminPdf();
		} else {
			$docId = $this->input->post('docId');
			$res = $this->DoctorModel->getDetail($docId);
			$data['data'] = $this->DoctorModel->fetchICDocPatinetAdminPdf($docId);
			$data['docName'] = $res['username'];
		}
		$this->load->view('admin/report-ic-doctor-patient', $data, FALSE);
	}

	public function commission()
	{
		$this->load->model('admin/CommissionModel','CommissionModel');
		$type = $this->input->post('type');

		if ($type == 1 || !isset($type)){
			$data['data'] = $this->CommissionModel->fetchCommissionListAdminPdf();
			$this->load->view('admin/report-commission', $data, FALSE);
		} elseif ($type == 2){
			$userType = $this->input->post('userType');
			$userId = $this->input->post('userId');
			if (!isset($userId) || $userId=='' || $userId==0)
			{
				$data['data'] = $this->CommissionModel->fetchCommissionListUserAdminPdf($userType);
				$this->load->view('admin/report-commission', $data, FALSE);
			} else {
				$data['data'] = $this->CommissionModel->fetchCommissionListUserWiseAdminPdf($userType,$userId);
				$this->load->view('admin/report-commission-user-wise', $data, FALSE);
			}
		}
	}

	public function sales()
	{
		$this->load->model('SalesModel');
		$type = $this->input->post('type');
		if ($type == 1 || $type == 0){
			$data['data'] = $this->SalesModel->fetchSalesAdminPdf();
		}elseif($type == 2) {
			$userId = $this->input->post('userId');
			$data['type'] = 'Pharmacist';
			$data['username'] = $this->SalesModel->fetchPhar($userId);
			$data['data'] = $this->SalesModel->fetchPharSalesAdminPdf($userId);
		}elseif($type == 3) {
			$userId = $this->input->post('userId');
			$data['type'] = 'Patient';
			$data['data'] = $this->SalesModel->fetchPatientSalesAdminPdf($userId);
			$data['username'] = $data['data'][0]['name'];
		}
		$this->load->view('admin/report-sales', $data, FALSE);
	}

}

/* End of file Report.php */
