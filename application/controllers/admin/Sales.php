<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SalesModel');
	}

	public function index()
	{
		$uId = $this->session->userdata('aId');
		if (!isset($uId)){
			redirect('admin/index');
		}
		$data['sales'] = $this->SalesModel->fetchSalesAdmin();
		$this->load->view('admin/sales', $data);
	}

	public function details($id){
		$res = $this->SalesModel->getDetails($id,1);

		echo json_encode($res);
	}

	public function getStatus($id){
		$res = $this->SalesModel->getStatus($id);

		echo json_encode($res);
	}

	public function fetchUserList(){
		$type = $this->input->post('type');
		$res = $this->SalesModel->fetchUserList($type);

		echo json_encode($res);
	}

	public function updateStatus(){
		$this->SalesModel->updateStatus();

		redirect('admin/sales');

	}

}

/* End of file Sales.php */
