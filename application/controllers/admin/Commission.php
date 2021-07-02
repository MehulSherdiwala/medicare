<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/CommissionModel','CommissionModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->view('admin/commission');
	}

	public function fetchCommission($crId=0)
	{
		$res = $this->CommissionModel->fetchCommission($crId);

		echo json_encode($res);
	}

	public function editCommission()
	{
		$crId = $this->input->post('crId');
		$this->CommissionModel->editCommission($crId);
	}

	public function commissionList($ctId=0)
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$data['list'] = $this->CommissionModel->commissionList($ctId);

		if ($ctId == 0)
		{
			$this->load->view('admin/commission-list', $data, FALSE);
		} else {
			echo json_encode($data['list']);
		}
	}

	public function fetchCommissionUser()
	{
		$userType = $this->input->post('userType');
		$res = $this->CommissionModel->fetchCommissionUser($userType);

		echo json_encode($res);
	}
}

/* End of file Commission.php */
